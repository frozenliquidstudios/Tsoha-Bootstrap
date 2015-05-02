<?php

class GameController extends BaseController{
    
    public static function allGames(){       
        $games = Game::all();       
        View::make('clipList/clipsByGame.html', array('games' => $games));
    }
     
    public static function create(){
        View::make('clipList/newGame.html');
    }
    
    public static function store(){
    $params = $_POST;
    $attributes = array(
      'gamename' => $params['gamename']
    );
    
    $game = new Game($attributes);
    $errors = $game->game_errors();
    
    if(count($errors) == 0) {
        $game->save();
        Redirect::to('/clipList/clipsByGame', array('message' => 'Game has been successfully added!'));
    } else {
        View::make('clipList/newGame.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
  
  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'id' => $id,
      'gamename' => $params['gamename'],
    );

    $game = new Game($attributes);
    $oldgame = Game::find($id);
    $errors = $game->game_errors();

    if(count($errors) > 0){
        View::make('/clipList/clipsByGame', array('errors' => $errors, 'games' => $oldgame));
    }else {
      $game->update();
      Redirect::to('/clipList/clipsByGame' . $game->id, array('message' => 'The game has been successfully modified!'));
    }
  }
  
   public static function destroy($id){
    $game = new Game(array('id' => $id));
    $game->destroy($id);

    Redirect::to('/clipList/clipsByGame', array('message' => 'Game was deleted successfully!'));
  }
}