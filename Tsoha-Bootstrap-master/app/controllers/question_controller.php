<?php

class QuestionController extends BaseController {

    public static function index() {
        $questions = Question::all();
        self::render_view('etusivu.html', array('questions' => $questions));
    }

    public static function signin() {
        self::render_view('kirjautuminen.html');
    }

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
            self::render_view('/create', array('attributes' => $attributes));
        }
    }

    public static function find($id) {
        self::render_view('kysymys.html', array(Question::find($id)));
    }

    public static function edit($id) {
        $question = Question::find($id);
        
        self::render_view('question/edit.html', array('attributes' => $question));
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
            self::render_view('question/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            Question::update($id, $attributes);
            
            redirect_to('/', array('message' => 'Kysymystä muokattu onnistuneesti!'));
        }
    }
    
    public static function destroy($id) {
        Question::destroy($id);
        
        self::redirect_to('/', array('message' => 'Kysymys poistettu.'));
    }
}
