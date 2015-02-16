<?php

class UserController extends BaseController {
    
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
