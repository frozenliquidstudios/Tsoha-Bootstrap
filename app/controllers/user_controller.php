<?php

class UserController extends BaseController {
    
    public static function login() {
        View::make('user/login.html');
    }
  
    public static function handle_login() {
        $params = $_POST;
        $user = User::authenticate($params['username'], $params['password']);
        
        $query = DB::connection()->prepare('SELECT * FROM Login WHERE username = :username AND password = :password LIMIT 1', array('username' => $username, 'password' => $password));
        $query->execute();
        $entry = $query->fetch();
        
        if($entry) {
         $user = $entry;
        } else {
            return null;
        }
        
        if(!$user) {
        View::make('user/login.html', array('error' => 'Wrong username or password!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Welcome back ' . $user->name . ' :D'));
    }
  }
}