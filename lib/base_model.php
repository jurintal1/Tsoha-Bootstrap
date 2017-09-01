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

  public function validate_string_min_length($string, $minLength) {      
    $length = strlen($string);
    if ($length >= $minLength) {
      return true;
    }
    return FALSE;
  }

  public function validate_string_not_empty($string) {
    if ($string == "" || $string == null) {
      return false;
    }
    return TRUE;
  }
  


  public function validate_string_max_length($string, $maxLength) {
    $length = strlen($string);
    if ($length <= $maxLength) {
      return true;
    }
    return false;
  }

  

  public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
    $errors = array();

    foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      $validator_errors = array();
      
      if (count($this->{$validator}()) > 0) {                 
        $errors = array_merge($errors, $this->{$validator}());
      }        
      
    }

    return $errors;
  }

}
