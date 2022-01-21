<?php

namespace App\Http\Controllers;
use App\Models\api;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function test()
    {
        api::create([
           
            "FirstName" => "Hema",
            "LastName" => "Asker",
            "Address" => "xyz",
        ]);
        dd("done");
    }
    
}
