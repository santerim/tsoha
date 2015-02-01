<?php

class QuestionController extends BaseController {
	public static function index() {
		$questions = Question::all();
		self::render_view('etusivu.html', array('questions' => $questions));
	}

	public static function signin(){
    	self::render_view('kirjautuminen.html');
    }

    public static function create(){
    	self::render_view('uusikysymys.html');
    }

    public static function add() {
    	$params = $_POST;

    	$id = Question::create(array(
    		'topic' => $params['topic'],
    		'description' => $params['description']
		));

		self::redirect_to('{{base_path}}/', array('message' => 'Uusi kysymys lisätty!'));
    }
}