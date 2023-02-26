<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    //Das sind die Variable (Datenbankeinträge Namen)
    public $name;
    public $email;
    public $success = false;
    public User $user;

    //Setzt die Bedingung für die Felder (minimum 3 Buchstaben, und email muss vorhanden sein)
    protected $rules = [
        'user.name'=>'min:3',
        'user.email'=>'email'];

    //mit dieser Methode werden Sie von der Datenbank geholt
    public function mount(){

        $this->user =auth()->user();
    }

    //mit dieser Methode werden sie angezeigt
    public function render()
    {
        return view('livewire.profile');
    }

    public function updateprofile()
    {
        $this->validate();
        $this->user->save();
        $this->success = true;
    }

    public function checkname()
    {
        $this->validate();
    }

    public function updatedUserName($value)
    {
        $this->validateOnly('user.name');
    }

}
