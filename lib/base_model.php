<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();
    //  $validators = array();
      
  //    foreach($this->validators as $validatorErrors){
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
   //     $errors = array_merge($validatorErrors, $errors); // Ei toimi
      
      return $errors;
    }
  }
