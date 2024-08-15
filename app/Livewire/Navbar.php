<?php

namespace App\Livewire;

use App\Models\Speech;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {

        $speeaches = Speech::where('publish', true);

        $books = Speech::where('type', 'book')->where('publish', true)->get();

        $audio = Speech::where('type', 'audio')->where('publish', true)->get();

        $youtube = Speech::where('type', 'youtube')->where('publish', true)->get();

        $videos = Speech::where('type', 'video')->where('publish', true)->get();

        return view('livewire.navbar',compact('audio', 'books', 'youtube', 'speeaches', 'videos'));
    }
}
