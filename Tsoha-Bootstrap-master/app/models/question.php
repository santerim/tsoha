<?php

class Question extends BaseModel{
	public $id, $user_id, $topic, $description, $answer, $answered, $added;

	public function __construct($attributes){
		parent::__construct($attributes);
                
                $this->validators = array('validate_topic', 'validate_description');
	}

	public static function all(){
		$questions = array();
		$rows = DB::query('SELECT * FROM Question ORDER BY added');

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

        public static function update($id, $attributes) {
            $topic = $attributes['topic'];
            $description = $attributes['description'];
            $answer = $attributes['answer'];
            $answered = $attributes['answered'];
            
            DB::query("UPDATE Question SET "
                    . "topic = :topic, "
                    . "description = :description, "
                    . "answer = :answer, "
                    . "answered = :answered "
                    . "WHERE id = :id", 
                    array(
                        'id' => $id, 
                        'topic' => $topic, 
                        'description' => $description, 
                        'answer' => $answer, 
                        'answered' => $answered));
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
        
        public static function delete($id) {
            DB::query('DELETE FROM Question WHERE id = :id', array('id' => $id));
        }

	public static function create($array) {
		$topic = $array['topic'];
		$description = $array['description'];
                $added = $array['added'];

		$row = DB::query("INSERT INTO Question (topic, description, added) "
                        . "VALUES (:topic, :description, :added) "
                        . "RETURNING id", 
                        array(
                            'topic' => $topic, 
                            'description' => $description, 
                            'added' => $added)); 
                return $row[0]['id'];
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
                $errors[] = 'Kuvaus ei voi olla tyhjä';
            }

            return $errors;
        }
}