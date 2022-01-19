<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CustomerJob;

class EmailController extends Controller
{
    public function sendEmail()
    {

        dispatch(new CustomerJob());

        dd('Email has been delivered');
    }
}
