<?php

class ClipController extends BaseController{
    
    
    
    public static function index(){
        $clips = Clip::all();
        View::make('clipList/index.html', array('clips' => $clips));
    }
    
    public static function create(){
        View::make('clipList/newClip.html');
    }
    
    public static function show($id){
        $clip = Clip::find($id);
        View::make('clipList/showInfo.html', array('clips' => $clip));
    }
    
    public static function store(){
    $params = $_POST;
    $attributes = array(
      'title' => $params['title'],
      'game' => $params['game'],
      'resolution' => $params['resolution'],
      'fps' => $params['fps'],
      'added' => $params['added'],
      'description' => $params['description']
    );
    
    $clip = new Clip($attributes);
    $errors = $clip->errors();
    
    if(count($errors) == 0) {
        $clip->save();
        Redirect::to('/clipList/' . $clip->id, array('message' => 'Clip has been successfully added!'));
     // Kint::dump($params);   //Debug - Uncomment this and comment Redirect::to line.
    } else {
        View::make('clipList/newClip.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
  
  public static function edit($id){
    $clip = Clip::find($id);
    View::make('clipList/clipModify.html', array('attributes' => $clip));
  }

  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'title' => $params['title'],
      'game' => $params['game'],
      'resolution' => $params['resolution'],
      'fps' => $params['fps'],
      'description' => $params['description']
    );

    $clip = Clip::find($id);
    $errors = $clip->errors();

    if(count($errors) > 0){
      View::make('clipList/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      $clip->update();

      Redirect::to('/clipList/' . $clip->id, array('message' => 'The clip has been successfully modified!'));
    }
  }
  
   public static function destroy($id){
    $clip = new Clip(array('id' => $id));
    $clip->destroy($id);

    Redirect::to('/clipList', array('message' => 'Clip was deleted successfully!'));
  }
}