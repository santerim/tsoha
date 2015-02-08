<?php

class Question extends BaseModel{
	public $id, $user_id, $topic, $description, $answer, $answered, $added;

	public function __construct($attributes){
		parent::__construct($attributes);
                
                $this->validators = array('validate_topic', 'validate_description');
	}

	public static function all(){
		$questions = array();
		$rows = DB::query('SELECT * FROM Question');

		foreach ($rows as $row) {
			$questions[] = new Question(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'topic' => $row['topic'],
				'description' => $row['description'],
				'answer' => $row['answer'],
				'answered' => $row['answered'],
				'added' => $row['added']
				));
		}
		return $questions;
	}

	public static function find($id){
		$rows = DB::query('SELECT * FROM Question WHERE id = :id LIMIT 1', array('id' => $id));

		if(count($rows) > 0) {
			$row = $rows[0];

			$question = new Question(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'topic' => $row['topic'],
				'description' => $row['description'],
				'answer' => $row['answer'],
				'answered' => $row['answered'],
				'added' => $row['added']
				));
			return $question;
		}
		return null;
	}

	public static function create($array) {
		$topic = $array['topic'];
		$description = $array['description'];

		$row = DB::query("INSERT INTO Question (topic, description) VALUES (:topic, :description) RETURNING id", array('topic' => $topic, 'description' => $description)); return $row[0]['id'];
	}
        
        public function validate_topic() {
            $errors = array();
            
            if ($this->topic == '' || $this->topic == null) {
                $errors[] = 'Aihe ei saa olla tyhjä';
            }
            
            if (strlen($this->topic) < 3) {
                $errors[] = 'Aiheen pitää olla vähintään kolme merkkiä';
            }
            
            return $errors;
        }
        
        public function validate_description() {
            $errors = array();
            
            if($this->description == '' || $this->description == null) {
                $errors[] = 'Kuvaus ei saa olla tyhjä';
            }

            return $errors;
        }
}