<?php

class UserController extends BaseController {
    
    public static function signup() {
        View::make('user/signup.html');
    }
    
    public static function create_signup(){
    $params = $_POST;
    $attributes = array(
      'username' => $params['username'],
      'password' => $params['password']
    );
    
    $account = new User($attributes);
    $errors = $account->user_errors();
    
    if(count($errors) == 0) {
        $account->handle_signup();
        Redirect::to('/login', array('message' => 'Account created successfully!'));
    } else {
        View::make('user/signup.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
    
    public static function login() {
        View::make('user/login.html');
    }
  
    public static function handle_login() {
        $params = $_POST;   
        $user = User::authenticate($params['username'], $params['password']);        
        
        if(!$user) {
            View::make('user/login.html', array('error' => 'Wrong username or password!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

         Redirect::to('/', array('message' => 'Welcome back ' . $user->username . ' :D'));
    }
  }
  
    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'You logged out. See you soon!'));
    }
}