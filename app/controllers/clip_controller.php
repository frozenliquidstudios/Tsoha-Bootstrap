<?php

class ClipController extends BaseController{
    public static function index(){
        $clips = Clip::all();
        View::make('clipList/index.html', array('clips' => $clips));
    }
    
    public static function store(){
    $params = $_POST;
    $clip = new Clip(array(
      'title' => $params['title'],
      'game' => $params['game'],
      'resolution' => $params['resolution'],
      'fps' => $params['fps'],
      'description' => $params['description']
    ));
    
    Kint::dump($params);
    
    $clip->save();

   // Redirect::to('/clipList/' . $clip->id, array('message' => 'Clip has been successfully added!'));
  }
    
    
    
    
    
    
    
    
    
    
}