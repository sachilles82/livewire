<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    //Das sind die Variable (Datenbankeinträge Namen)
    public $user;
    public $email;
    public $success = false;

    protected $rules = ['user'=>'min:3'];

    //mit dieser Methode werden Sie von der Datenbank geholt
    public function mount(){

        $this->user = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    //mit dieser Methode werden sie angezeigt
    public function render()
    {
        return view('livewire.profile');
    }

    public function updateprofile(){
        $this->validate();

        auth()->user()->update([
            'name' => $this->user,
            'email' => $this->email,
        ]);
        $this->success = true;
    }

}
