<?php

class UserController extends BaseController {
    
    public static function signup() {
        self::render_view('tunnuksenluonti.html');
    }
    
    public static function handle_signup() {
        $params = $_POST;
        
        if (User::checkDuplicate($params['username'])) {
            self::redirect_to('/signup', array('error' => 'Käyttäjätunnus on jo varattu'));
        } else {
            $attributes = array(
                'username' => $params['username'],
                'password' => $params['password'],
                'joined' => date('Y-m-d'));
            
            $id = User::newUser($attributes);
            $_SESSION['user'] = $id;
            
            self::redirect_to('/', array('message' => 'Tervetuloa, ' . $params['username'] . '!'));
        }
    }
    
    public static function login() {
        self::render_view('kirjautuminen.html');
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        
        self::redirect_to('/', array('message' => 'Olet kirjautunut ulos'));
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $user = User::authenticate($params['username'], $params['password']);
        
        if(!$user){
            self::redirect_to('/login', array('error' => 'Väärä käyttäjätunnus tai salasana'));
        } else {
            $_SESSION['user'] = $user->id;
            
            self::redirect_to('/', array('message' => 'Tervetuloa, ' . $user->username . '!'));
        }
    }
}
