<?php

class Question extends BaseModel{
	public $id, $user_id, $topic, $description, $answered, $answer, $added, $modified;

	public function __construct($attributes){
		parent::__construct($attributes);
                
                $this->validators = array('validate_topic', 'validate_description');
	}

        // hakee kaikki kysymykset, sekä jokaiselle kysymykselle siihen kuuluvan vastauksen
        // (jos sellaista on)
	public static function all(){
		$questions = array();
		$questionRows = DB::query('SELECT * FROM Question ORDER BY added DESC');

		foreach ($questionRows as $row) {
			$questions[] = new Question(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'topic' => $row['topic'],
				'description' => $row['description'],
				'answered' => $row['answered'],
				'added' => $row['added'],
                                
                                'answer' => Question::findAnswer($row['id'])
				));
		}
		return $questions;
	}

        public static function update($id, $attributes) {
            Question::updateQuestion($id, $attributes);
            Question::updateAnswer($id, $attributes);
        }
        
        // päivittää kysymyksen tiedot
        private function updateQuestion($id, $attributes) {
            $topic = $attributes['topic'];
            $description = $attributes['description'];
            $answered = $attributes['answered'];
            $user_id = $attributes['user_id'];
            $modified = $attributes['modified'];
            
            DB::query("UPDATE Question SET "
                    . "user_id = :user_id, "
                    . "topic = :topic, "
                    . "description = :description, "
                    . "answered = :answered, "
                    . "modified = :modified "
                    . "WHERE id = :id", 
                    array(
                        'id' => $id,
                        'user_id' => $user_id,
                        'topic' => $topic, 
                        'description' => $description, 
                        'answered' => $answered,
                        'modified' => $modified));
        }
        
        // päivittää vastauksen tiedot
        private function updateAnswer($id, $attributes) {
            $user_id = $attributes['user_id'];
            $modified = $attributes['modified'];
            $answer = $attributes['answer'];
            
            $answer_exists = DB::query('SELECT * FROM Answer WHERE question_id = :id', array('id' => $id));
            
            // jos vastaus on ylipäätään olemassa
            if ($answer_exists) {
                // päivitetään sen tiedot
                DB::query("UPDATE Answer SET "
                    . "user_id = :user_id, "
                    . "content = :answer, "
                    . "modified = :modified "
                    . "WHERE question_id = :question_id", 
                    array(
                        'user_id' => $user_id, 
                        'answer' => $answer, 
                        'modified' => $modified,
                        'question_id' => $id));
            } 
            // jos taas ei
            else {
                // luodaan uusi vastaus Answer-tauluun
                DB::query("INSERT INTO Answer ("
                        . "user_id, "
                        . "question_id, "
                        . "content, "
                        . "added) VALUES (:user_id, :question_id, :content, :added)", 
                    array(
                        'user_id' => $user_id, 
                        'content' => $answer, 
                        'added' => $modified,
                        'question_id' => $id));
            }
        }
        
        // etsii kysymyksen id-numeron perusteella
	public static function find($id){
		$rows = DB::query('SELECT * FROM Question WHERE id = :id LIMIT 1', array('id' => $id));

		if(count($rows) > 0) {
			$row = $rows[0];

			$question = new Question(array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'topic' => $row['topic'],
				'description' => $row['description'],
				'answered' => $row['answered'],
				'added' => $row['added'],
                                'answer' => Question::findAnswer($id)
				));
			return $question;
		}
		return null;
	}
        
        // etsii vastauksen kysymys-id:n perusteella (vastaus liittyy aina kysymykseen)
        private function findAnswer($id) {
            $find = DB::query('SELECT * FROM Answer WHERE question_id = :id', array('id' => $id));
            if ($find) {
            return $find[0]['content'];
            } else {
                return null;
            }
        }
        
        // tuhoaa kysymyksen ja siihen liittyvän vastauksen
        public static function delete($id) {
            DB::query('DELETE FROM Answer WHERE question_id = :id', array('id' => $id));
            DB::query('DELETE FROM Question WHERE id = :id', array('id' => $id));
        }

        // luo uuden kysymyksen
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