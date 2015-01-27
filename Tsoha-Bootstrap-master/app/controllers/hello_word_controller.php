<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  // echo 'Tämä on etusivu';
    	self::render_view('etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä	
      self::render_view('helloworld.html');
    }

    public static function home(){
    	self::render_view('home.html');
    }

    public static function signin(){
    	self::render_view('kirjautuminen.html');
    }

    public static function newquestion(){
    	self::render_view('uuskys.html');
    }
  }
