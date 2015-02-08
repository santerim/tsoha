<?php


class UserController extends BaseController {
    
    public static function signin() {
        self::render_view('kirjautuminen.html');
    }
    
    public static function handle_signin() {
        $params = $_POST;
        
        $user = User::authenticate($params['username'], $params['password']);
        
        if(!$user){
            self::redirect_to('/signin', array('error' => 'Väärä käyttäjätunnus tai salasana'));
        } else {
            $_SESSION['user'] = $user->id;
            
            self::redirect_to('/', array('message' => 'Tervetuloa takaisin' . $user->name . '!'));
        }
    }
}
