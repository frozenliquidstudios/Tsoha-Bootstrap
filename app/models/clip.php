<?php

class Clip extends BaseModel {

    public $id, $title, $game, $resolution, $fps, $added, $description;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
// $clip1 = new Clip(array('id' => 1, 'title' => 'Cinematic Clip of Beachfront', 'game' => 'Battlefield: Hardline', 'resolution' => '1920x1080', 'fps' => '60', 'added' => '30/03/2015', 'description' => 'Smooth pan of the oceanfront.'));
// echo $clip1->title; // Prints contents of title.
    
  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Clip');
    $query->execute();
    $entries = $query->fetchAll();
    $clips = array();

    foreach($entries as $entry){
        
      $clips[] = new Clip(array(
        'id' => $entry['id'],
        'title' => $entry['title'],
        'game' => $entry['game'],
        'resolution' => $entry['resolution'],
        'fps' => $entry['fps'],
        'added' => $entry['added'],
        'description' => $entry['description'],
      ));
    }
    return $clips;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Clip WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $entry = $query->fetch();

    if($entry){
      $clip = new Clip(array(
        'id' => $entry['id'],
        'title' => $entry['title'],
        'game' => $entry['game'],
        'resolution' => $entry['resolution'],
        'fps' => $entry['fps'],
        'added' => $entry['added'],
        'description' => $entry['description'],
      ));

      return $clip;
    }
    return null;
  }
  
 public function save(){
    $query = DB::connection()->prepare('INSERT INTO Clip (title, game, resolution, fps, description) VALUES (:title, :game, :resolution, :fps, :description) RETURNING id');
    $query->execute(array('title' => $this->title, 'game' => $this->game, 'resolution' => $this->resolution, 'fps' => $this->fps, 'description' => $this->description));
    $entry = $query->fetch();
    $this->id = $entry['id'];
  }
}