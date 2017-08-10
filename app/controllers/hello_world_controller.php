<?php
  
  class HelloWorldController extends BaseController{


    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      $recipes = Recipe::all();      
      View::make('suunnitelmat/index.html', array('recipes' => $recipes));
    }

    public static function sandbox(){
      $recipe = Recipe::find(1);
      $recipeAuthor = UserAccount::find(1);                  
      Kint::dump($recipeAuthor->name);
      Kint::dump($recipe->name);
      Kint::dump($recipe->author);

      
    }

    public static function recipe(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/recipe.html');
    }

    public static function listRecipes(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/recipeList.html');
    }

    public static function listUsers(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/userList.html');
    }

    public static function editUser(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/editUser.html');
    }

    public static function editRecipe(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/editRecipe.html');
    }

    public static function login(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/editRecipe.html');
    }



  }
