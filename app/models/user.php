<?php

class User extends BaseModel {
    
    public $id, $username, $password;
     
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_password', 'validate_duplicate_user');
    }
    
     public static function authenticate($username, $password) {
        $query = DB::connection()->prepare("SELECT * FROM Login WHERE username = '$username' AND password = '$password' LIMIT 1");
        $query->execute();
        $entry = $query->fetch();

        if($entry) {
            $valid_username = new User(array(
            'id' => $entry['id'],
            'username' => $entry['username'],
            'password' => $entry['password']
                ));
            return $valid_username;
        } else {
            return null;
        }
     }
     
    public function handle_signup(){ 
        $query = DB::connection()->prepare('INSERT INTO Login (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $entry = $query->fetch();
        $this->id = $entry['id'];
  }
       
    public static function find($user_id) {
        $query = DB::connection()->prepare('SELECT * FROM Login WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $user_id));
        $entry = $query->fetch();

            if($entry){
                $user = new User($entry);
                return $user;
            }
        return null;   
    }
  
  // VALIDATION METHODS
  
    public function validate_username(){
        $errors = array();
        if($this->username == '' || $this->username == null || strlen($this->username) < 4){
            $errors[] = 'Your username has to be at least 4 characters!';
        }
    return $errors;
    }

    public function validate_password(){
        $errors = array();
        if($this->password == '' || $this->password == null || strlen($this->password) < 4){
            $errors[] = 'Your password has to be at least 4 characters!';
        }
    return $errors;
    }
    
    public function validate_duplicate_user() {
        $errors = array();
        $query = DB::connection()->prepare('SELECT * FROM Login WHERE username = :username LIMIT 1');
        $query->execute(array('username' => $this->username));
        $entry = $query->fetch();
        if ($entry) {
            $errors[] = 'The username is already in use, try another one.';
        }
        return $errors;
    }
}

