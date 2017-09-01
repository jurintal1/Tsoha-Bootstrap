<?php

class BaseController{

  public static function get_user_logged_in(){
    if(isset($_SESSION['user'])){
      $user_id = $_SESSION['user'];
      $user = UserAccount::find($user_id);        
      return $user;
    }
    return null;
  }



  public static function check_logged_in(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
    }
  }


  public static function check_admin_logged_in(){
    BaseController::check_logged_in();
    $user = BaseController::get_user_logged_in();
    if($user->role != 1) {
      Redirect::to('/login', array('message' => 'Kirjaudu admin-tunnuksilla!'));
    }
  }

  public static function check_admin_or_own($recipe) {
    $user = BaseController::get_user_logged_in();
    if($user->role != 1) {
      if($user->id != $recipe->author) {
        Redirect::to('/login', array('message' => 'Kirjaudu admin-tunnuksilla!'));
      }
    }
  }

}
