<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tag;

class TagSelect extends Component
{
    public $tags = [];

    public function render()
    {
        $existingTags = Tag::pluck('name')->toArray();

        return view('livewire.tag-select', [
            'existingTags' => $existingTags,
        ]);
    }

    public function addTag($tag)
    {
        Tag::create(['name' => $tag]);
    }
}
