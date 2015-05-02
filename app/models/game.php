<?php

class Game extends BaseModel {

    public $id, $gamename;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_gamename');
    }
  
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Game');
        $query->execute();
        $entries = $query->fetchAll();
        $games = array();

        foreach($entries as $entry){
            $games[] = new Game(array(
                'id' => $entry['id'],
                'gamename' => $entry['gamename']
                ));
        }
        return $games;
    }
           
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $entry = $query->fetch();   
    
    if($entry){
      $game[] = new Game(array(
        'id' => $entry['id'],
        'gamename' => $entry['gamename']
      ));
      return $game;
    }
    return null;
  }
  
 public function save(){ 
    $query = DB::connection()->prepare('INSERT INTO Game (gamename) VALUES (:gamename) RETURNING id');
    $query->execute(array('gamename' => $this->gamename));
    $entry = $query->fetch();
    $this->id = $entry['id']; 
  }
  
  public function update(){
    $query = DB::connection()->prepare('UPDATE Game SET gamename = :gamename WHERE :id = id RETURNING id'); 
    $query->execute(array('id' => $this->id, 'gamename' => $this->gamename));
    $entry = $query->fetch();
    $this->id = $entry['id'];
  }

 public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Game WHERE :id = id RETURNING id');
    $query->execute(array('id' => $this->id));
    $entry = $query->fetch();
    $this->id = $entry['id'];
  }
  
// VALIDATION METHODS
  
public function validate_gamename(){
    $errors = array();
    if($this->gamename == '' || $this->gamename == null || strlen($this->gamename) < 3){
        $errors[] = 'Game name is too short!';
    }
    return $errors;
    }
}