<?php

  class BaseModel{
    protected $validators;

    public function __construct($attributes = null){
      foreach($attributes as $attribute => $value){
        if(property_exists($this, $attribute)){
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();

        $validate_title = 'validate_title';
        $errors = array_merge($errors, $this->{$validate_title}());
        $validate_game = 'validate_game';
        $errors = array_merge($errors, $this->{$validate_game}());
        $validate_resolution = 'validate_resolution';
        $errors = array_merge($errors, $this->{$validate_resolution}());
        $validate_fps = 'validate_fps';
        $errors = array_merge($errors, $this->{$validate_fps}());
        $validate_description = 'validate_description';
        $errors = array_merge($errors, $this->{$validate_description}());
      
      return $errors;
    }
    
    public function user_errors(){
      $errors = array();

        $validate_username = 'validate_username';
        $errors = array_merge($errors, $this->{$validate_username}());
        $validate_password = 'validate_password';
        $errors = array_merge($errors, $this->{$validate_password}());
        $validate_duplicate_user = 'validate_duplicate_user';
        $errors = array_merge($errors, $this->{$validate_duplicate_user}());
      
      return $errors;
    }
    
    public function game_errors(){
      $errors = array();

        $validate_gamename = 'validate_gamename';
        $errors = array_merge($errors, $this->{$validate_gamename}());
      
      return $errors;
    }
  }