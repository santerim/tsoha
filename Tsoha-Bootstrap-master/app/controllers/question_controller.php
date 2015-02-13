<?php

class QuestionController extends BaseController {

    public static function index() {
        $questions = Question::all();
        self::render_view('etusivu.html', array('questions' => $questions));
    }

//    public static function signin() {
//        self::render_view('kirjautuminen.html');
//    }

    public static function create() {
        self::render_view('uusikysymys.html');
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'topic' => $params['topic'],
            'description' => $params['description']
        );
        
        $question = new Question($attributes);
        $errors = $question->errors();
        
        if(count($errors) == 0) {
            $id = Question::create($attributes);
            
            self::redirect_to('/', array('message' => 'Uusi kysymys lisätty'));
        } else {
            self::render_view('uusikysymys.html', array('question' => $attributes, 'errors' => $errors));
        }
    }

    public static function find($id) {
        $question = Question::find($id);
        self::render_view('kysymys.html', array('question' => $question));
    }

    public static function show($id) {
        $question = Question::find($id);
        
        self::render_view('kysymys.html', array('question' => $question));
    }
    
    public static function update($id) {
        $params = $_POST;
        
        $attributes = array(
            'topic' => $params['topic'],
            'description' => $params['description']
        );
        
        $question = new Question($attributes);
        $errors = $question->errors();
        
        if (count($errors) > 0) {
            self::render_view('kysymys.html', array('errors' => $errors, 'question' => $attributes));
        } else {
            Question::update($id, $attributes);
            
            self::redirect_to('/', array('message' => 'Kysymystä muokattu'));
        }
    }
    
    public static function delete($id) {
        Question::delete($id);
        
        self::redirect_to('/', array('message' => 'Kysymys ' . ($id) . ' poistettu.'));
    }
}
