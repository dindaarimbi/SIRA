<?php

namespace App\Controllers;

//jalur url baru
class Home extends BaseController
{
    //method satu
    public function index(): string
    {
        return view('welcome_message'); //artinya tampilkan tampilan welcome message
    }





}
