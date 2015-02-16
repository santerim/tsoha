<?php

class User extends BaseModel {

    public $id, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($username, $password) {
//        $username = $params['username'];
//        $password = $params['password'];

        $rows = DB::query('SELECT * FROM user_table WHERE username = :username AND password = :password LIMIT 1', array('username' => $username, 'password' => $password));
        
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
