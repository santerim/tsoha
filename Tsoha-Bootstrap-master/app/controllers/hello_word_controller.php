<?php

  class HelloWorldController extends BaseController{

//    public static function index(){
//   	  // echo 'Tämä on etusivu';
//    	self::render_view('etusivu.html');
//    }

    public static function sandbox(){
      // Testaa koodiasi täällä	
      $questions = Question::find(1);

      print_r($questions);

      //self::render_view('helloworld.html');
    }

    public static function home(){
    	self::render_view('home.html');
    }


  }
