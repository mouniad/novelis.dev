<?php

namespace App\Http\Controllers;

use App\Http\Concerns\SendableTrait;
use App\PhoneType;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    use SendableTrait;
    public function phoneTypes(){
        return $this->send(PhoneType::get());
    }
}
