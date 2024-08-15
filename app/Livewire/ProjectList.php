<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectList extends Component
{
    use WithPagination;
 
    public $search = null;
 
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
         if($this->search != null)
         {
            $projects = Project::latest()->where('title', 'like', '%'.$this->search.'%')->where('publish',true)->paginate(6);
         }
         else
         {
            $projects = Project::latest()->where('publish',true)->paginate(6);

         }


        return view('livewire.projectlist', compact('projects'));
    }




  
}
