<?php

class User extends BaseModel {
    
    public $id, $username, $password;
     
     public static function authenticate($username, $password) {
        $user[] = new User(array(
        'username' => $username,
        'password' => $password
      ));

      return $user;
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

