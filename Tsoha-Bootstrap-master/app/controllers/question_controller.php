<?php

class QuestionController extends BaseController {

    // näyttää etusivun
    public static function index() {
        $questions = Question::all();
        self::render_view('etusivu.html', array('questions' => $questions));
    }

    // ohjaa uuden kysymyksen luomissivulle
    public static function create() {
        $topics = Question::getTopics();
        self::render_view('uusikysymys.html', array('topics' => $topics));
    }

    // uutta kysymystä luotaessa
    public static function store() {
        $params = $_POST;

        $attributes = array(
            'topic' => $params['topic'],
            'description' => $params['description'],
            'added' => date('Y-m-d H:i:s')
        );

        $question = new Question($attributes);
        $errors = $question->errors();

        if (count($errors) == 0) {
            $id = Question::create($attributes);

            self::redirect_to('/', array('message' => 'Uusi kysymys lisätty'));
        } else {
            $topics = Question::getTopics();
            self::render_view('uusikysymys.html', array('question' => $attributes, 'errors' => $errors, 'topics' => $topics));
        }
    }

    // edit-nappula tuo tähän. Näyttää kysymyssivun, jossa kysymystä voi muokata
    // ja antaa sille vastauksen
    public static function show($id) {
        $question = Question::find($id);

        self::render_view('kysymys.html', array('question' => $question));
    }

    // tätä kutsutaan kun muokataan jo olemassaolevaa kysymystä
    public static function update($id) {
        $params = $_POST;

        if ($params['answer'] != null) {
            $attributes = array(
                'topic' => $params['topic'],
                'description' => $params['description'],
                'answer' => $params['answer'],
                'answered' => true,
                'modified' => date('Y-m-d H:i:s'),
                'user_id' => $_SESSION['user']
            );
        } else {
            $attributes = array(
                'topic' => $params['topic'],
                'description' => $params['description'],
                'answer' => null,
                'answered' => false,
                'modified' => date('Y-m-d H:i:s'),
                'user_id' => $_SESSION['user']
            );
        }

        $question = new Question($attributes);
        $errors = $question->errors();

        if (count($errors) > 0) {
            self::render_view('kysymys.html', array('errors' => $errors, 'question' => $attributes));
        } else {
            Question::update($id, $attributes);

            self::redirect_to('/', array('message' => 'Kysymystä muokattu'));
        }
    }

    // kun painetaan delete-nappia
    public static function delete($id) {
        Question::delete($id);

        self::redirect_to('/', array('message' => 'Kysymys poistettu'));
    }

}
