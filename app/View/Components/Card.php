<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    //public $title;

    public function __construct()
    {
       // $this->title = $title;
    }
    public function formatAlert($message){
        return $message;
    }
    public function render()
    {
        return view('components.card');
    }


}
