<?php

class User extends BaseModel {

    public $id, $username, $password, $joined;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function checkDuplicate($username) {
        $result = DB::query('SELECT * FROM user_table WHERE username = :username', array('username' => $username));
        
        if ($result) {
            return true;
        }
        return false;
    }
    
    public static function newUser($attributes) {
        $username = $attributes['username'];
        $password = $attributes['password'];
        $joined = $attributes['joined'];
        
        $id = DB::query('INSERT INTO user_table (username, password, joined) '
                . 'VALUES (:username, :password, :joined) RETURNING id', 
                array(
                    'username' => $username, 'password' => $password, 'joined' => $joined));
        
        return $id[0]['id'];
    }

    public static function authenticate($username, $password) {

        $rows = DB::query('SELECT * FROM user_table '
                . 'WHERE username = :username '
                . 'AND password = :password '
                . 'LIMIT 1', 
                array(
                    'username' => $username, 
                    'password' => $password));
        
        if (count($rows) > 0) {
            $row = $rows[0];
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }

    public static function find($id) {
        $rows = DB::query('SELECT * FROM user_table WHERE id = :id', array('id' => $id));

        if (count($rows) > 0) {
            $row = $rows[0];
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }
}
