<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Eventslist extends Component
{
    use WithPagination;
 
    public $search = null, $type = null;
 
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
         if($this->search != null)
         {
            $events = Event::latest()->where('title', 'like', '%'.$this->search.'%')->where('publish',true)->paginate(6);
         }
         elseif($this->type != null)
         {
            $events = Event::latest()->where('type',$this->type)->where('title', 'like', '%'.$this->search.'%')->where('publish',true)->paginate(6);

         }
         else
         {
            $events = Event::latest()->where('publish',true)->paginate(6);

         }


        return view('livewire.eventslist', compact('events'));
    }


    public function selectType($name)
    {
        $this->type = $name; 
    }

    public function clear()
    {
        $this->type = null;
        $this->search = null;
    }
}
