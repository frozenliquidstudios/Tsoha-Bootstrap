<?php

class ClipController extends BaseController{
    
    public static function index(){
        View::make('clipList/index.html');
    }
    
    public static function yourClips(){
        self::check_logged_in();
        $id = self::get_user_logged_in();
  //      $params = $_GET;
  //      $options = array('login_id' => $options);
        
  //      if(isset($params['search'])){
  //          $options['search'] = $params['search'];
 //           $clips = Clip::your($options);
 //           View::make('clipList/yourClips.html', array('clips' => $clips));
  //      } else {
     //      $options = $user_logged_in;
           $clips = Clip::your($id);
            View::make('clipList/yourClips.html', array('clips' => $clips));
   //     }
  
    }
    
    public static function allClips(){       
        $clips = Clip::all();       
        View::make('clipList/allClips.html', array('clips' => $clips));
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
    View::make('clipList/clipModify.html', array('clips' => $clip)); 
  }

  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'id' => $id,
      'title' => $params['title'],
      'game' => $params['game'],
      'resolution' => $params['resolution'],
      'fps' => $params['fps'],
      'description' => $params['description']
    );

    $clip = new Clip($attributes);
    $oldclip = Clip::find($id);
    $errors = $clip->errors();

    if(count($errors) > 0){
        View::make('/clipList/clipModify.html', array('errors' => $errors, 'clips' => $oldclip));
    }else {
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