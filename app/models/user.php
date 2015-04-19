<?php

class User extends BaseModel {
    
    public $id, $username, $password;
     
    public function __construct($attributes){
        parent::__construct($attributes); 
    }
    
     public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Login WHERE username = :username AND password = :password LIMIT 1', array('username' => $username, 'password' => $password));
        $query->execute();
        $entry = $query->fetch();

        if($entry) {
        $usr[] = new User(array(
        'username' => $entry['username'],
        'password' => $entry['password']
            ));
            return $usr;
        } else {
            return null;
        }     
     
        
     }
    
    public static function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM Login WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $entry = $query->fetch();

    if($entry){
      $user[] = new User(array(
        'id' => $entry['id'],
        'username' => $entry['username'],
        'password' => $entry['password']
      ));

      return $user;
    }
    return null;   
  }
}

