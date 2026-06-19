<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea)
    {
        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
        ])->toArray();

        $data['links'] = collect($attributes['links'] ?? [])
            ->filter(fn ($link) => filled($link))
            ->values()
            ->all();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        $steps = collect($attributes['steps'] ?? [])
            ->filter(fn ($step) => filled($step['description'] ?? null))
            ->map(fn ($step) => [
                'description' => $step['description'],
                'completed' => $step['completed'] ?? false,
            ])
            ->values()
            ->all();

        DB::transaction(function () use ($idea, $data, $steps) {
            $idea->update($data);

            $idea->steps()->delete();
            $idea->steps()->createMany($steps);
        });
    }
}