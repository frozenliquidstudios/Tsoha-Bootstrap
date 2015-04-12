<?php

class Clip extends BaseModel {

    public $id, $login_id, $title, $game, $resolution, $fps, $added, $description;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_title', 'validate_game', 'validate_resolution', 'validate_fps', 'validate_description');
    }
    
  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Clip');
    $query->execute();
    $entries = $query->fetchAll();
    $clips = array();

    foreach($entries as $entry){
        
      $clips[] = new Clip(array(
        'id' => $entry['id'],
        'login_id' => $entry['login_id'],
        'title' => $entry['title'],
        'game' => $entry['game'],
        'resolution' => $entry['resolution'],
        'fps' => $entry['fps'],
        'added' => $entry['added'],
        'description' => $entry['description']
      ));
    }
    return $clips;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Clip WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $entry = $query->fetch();

    if($entry){
      $clip[] = new Clip(array(
        'id' => $entry['id'],
        'login_id' => $entry['login_id'],
        'title' => $entry['title'],
        'game' => $entry['game'],
        'resolution' => $entry['resolution'],
        'fps' => $entry['fps'],
        'added' => $entry['added'],
        'description' => $entry['description']
      ));

      return $clip;
    }
    return null;
  }
  
 public function save(){
    $query = DB::connection()->prepare('INSERT INTO Clip (title, game, resolution, fps, added, description) VALUES (:title, :game, :resolution, :fps, :added, :description) RETURNING id');
    $query->execute(array('title' => $this->title, 'game' => $this->game, 'resolution' => $this->resolution, 'fps' => $this->fps, 'added' => $this->added, 'description' => $this->description));
    $entry = $query->fetch();
 // Kint::trace();      //Debug 
 // Kint::dump($entry); //Debug - Uncomment these and comment line below.
    $this->id = $entry['id'];
  }
  
  public function update(){
    $query = DB::connection()->prepare('UPDATE Clip (title, game, resolution, fps, added, description) VALUES (:title, :game, :resolution, :fps, :added, :description) RETURNING id');
    $query->execute(array('title' => $this->title, 'game' => $this->game, 'resolution' => $this->resolution, 'fps' => $this->fps, 'added' => $this->added, 'description' => $this->description));
    $entry = $query->fetch();
 // Kint::trace();      //Debug 
 // Kint::dump($entry); //Debug - Uncomment these and comment line below.
    $this->id = $entry['id'];
  }

 public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Clip (title, game, resolution, fps, added, description) VALUES (:title, :game, :resolution, :fps, :added, :description) RETURNING id');
    $query->execute(array('title' => $this->title, 'game' => $this->game, 'resolution' => $this->resolution, 'fps' => $this->fps, 'added' => $this->added, 'description' => $this->description));
    $entry = $query->fetch();
 // Kint::trace();      //Debug 
 // Kint::dump($entry); //Debug - Uncomment these and comment line below.
    $this->id = $entry['id'];
  }
  
// VALIDATION METHODS
  
public function validate_title(){
    $errors = array();
    if($this->title == '' || $this->title == null || strlen($this->title) < 5){
        $errors[] = 'Add a more descriptive title! (At least 5 characters, so lazy gosh...)';
    }
    return $errors;
}

public function validate_game(){
    $errors = array();
    if($this->game == '' || $this->game == null || strlen($this->game) < 3){
        $errors[] = 'Add a proper game name, geez!';
    }
    return $errors;
}

public function validate_resolution(){
    $errors = array();
    if($this->resolution == '' || $this->resolution == null || strlen($this->resolution) < 7){
        $errors[] = 'That is not a proper resolution, unless you record with a potato!';
    }
    return $errors;
}

public function validate_fps(){
    $errors = array();
    if($this->fps == '' || $this->fps == null || is_int( $this->fps )){
        $errors[] = 'You need to add the framerate of the clip!';
    }
    else if(strlen($this->fps) > 3){
        $errors[] = 'If you really record above 1000 FPS, just put in 999.';
    }
    return $errors;
}

public function validate_description(){
    $errors = array();
    if($this->description == '' || $this->description == null || strlen($this->description) < 10){
        $errors[] = 'Describe the clip a little better. Maybe add map name etc.)';
    }
    return $errors;
}

}