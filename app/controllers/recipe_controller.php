<?php

	class RecipeController extends BaseController {
	
		public static function index() {
			$recipes = Recipe::all();
			// tähän vielä laatijanimien nouto			
			View::make('recipe/recipeList.html', array('recipes' => $recipes));
		}

		public static function show($id) {
			$recipe = Recipe::find($id);
			$author = UserAccount::find($recipe->author);											
			View::make('recipe/recipe.html', array('recipe' => $recipe, 'author' => $author));
		}

		public static function add() {													
			View::make('recipe/add_recipe.html');
		}

		public static function store() {												
			$params = $_POST;
			Kint::dump($params);

			$recipe = new Recipe(array(			
		        'author' => '1',  //korjataan myöhemmin!
		        'name' => $params['name'],
		        'instructions' => $params['instructions'],
		        'glass' => $params['glass'],
		        'method' => $params['method']		        
	        )); 
	        //lisäksi käsiteltävä ainesosat
	        $recipe->save();
	        Redirect::to('/resepti/' . $recipe->id, array('message' => 'Tässä lisäämäsi uusi resepti!'));

		}
	}