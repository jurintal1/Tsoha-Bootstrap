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
			$attributes = array(
				'author' => '1',  //korjataan myöhemmin!
		        'name' => $params['name'],
		        'instructions' => $params['instructions'],
		        'glass' => $params['glass'],
		        'method' => $params['method']
				);
			$recipe = new Recipe($attributes); 
	        $errors = $recipe->errors();
	        
	        if (count($errors) == 0) {	        
	        	$recipe->save();
	        	Redirect::to('/' . $recipe->id, array('message' => 'Tässä lisäämäsi uusi resepti!'));
	        } else {
	        	View::make('/recipe/add_recipe.html', array('errors' => $errors, 'attributes' => $attributes));
	        }       


	        //lisäksi käsiteltävä ainesosat
	        

		}



		public static function edit($id) {
			$recipe = Recipe::find($id);
			View::make('recipe/edit_recipe.html', array('recipe' => $recipe));
		}



		public static function update($id) {											
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'author' => "1", //korjatttava!
		        'name' => $params['name'],
		        'instructions' => $params['instructions'],
		        'glass' => $params['glass'],
		        'method' => $params['method']
				);
			$recipe = new Recipe($attributes); 
	        $errors = $recipe->errors();
	        
	        if (count($errors) == 0) {	        
	        	$recipe->update();
	        	Redirect::to('/' . $recipe->id, array('message' => 'Reseptin muokkaaminen onnistui.'));
	        } else {
	        	View::make('/recipe/edit_recipe.html', array('errors' => $errors, 'attributes' => $attributes));
	        }       


	        //lisäksi käsiteltävä ainesosat
	        

		}

		public static function delete($id) {
			$recipe = Recipe::find($id);
			$recipe->destroy();
			Redirect::to('/', array('message'=> 'Resepti poistettu'));
		}
	}