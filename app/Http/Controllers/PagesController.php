<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    

    public function about(){

        return view('about');
    }

    public function index(){

        $links = [
    
            "https://laravel.com/docs" => "Docs", "https://laracasts.com" => "Laracasts",
            "https://laravel-news.com" => "News", "https://blog.laravel.com" =>"Blog",
            "https://nova.laravel.com" => "Nova", "https://forge.laravel.com" => "Forge",
            "https://github.com/laravel/laravel" => "Github"
        
        ];
        
        return view('index', [
                "links" => $links,
                "teacher" => "Virgilio Padron Batun",
        ]);


    
        
    }

    //Rutas laratter
    public function home(){
        
        $messages = [
            [
                'id' => 1,
                'content' => 'Primer mensaje',
                'image' => 'http://lorempixel.com/600/388?1'
            ],
            [
                'id' => 2,
                'content' => 'Segundo mensaje',
                'image' => 'http://lorempixel.com/600/388?2'
            ],
            [
                'id' => 3,
                'content' => 'Tercero mensaje',
                'image' => 'http://lorempixel.com/600/388?3'
            ],
            [
                'id' => 4,
                'content' => 'Cuarto mensaje',
                'image' => 'http://lorempixel.com/600/388?4'
            ],
        ];
        
        return view('welcome', [
                "messages" => $messages,
                "teacher" => "Virgilio Padron Batun",
        ]);


    }
}
