<?php

	class RecipeController extends BaseController {
	
		public static function index() {
			$recipes = Recipe::all();						
			View::make('recipe/recipe_list.html', array('recipes' => $recipes));
		}



		public static function show($id) {
			$recipe = Recipe::find($id);
			$author = UserAccount::find($recipe->author);
			$recipeIngredients = RecipeIngredient::find($id);		
										
			View::make('recipe/recipe.html', array('recipe' => $recipe, 'recipeIngredients' => $recipeIngredients));
		}



		public static function add() {												
			View::make('recipe/add_recipe.html');
		}



		public static function store() {
			$params = $_POST;
			$user = self::get_user_logged_in();
			$attributes = array(
				'author' => $user->id,
		        'name' => trim($params['name']),
		        'instructions' => trim($params['instructions']),
		        'glass' => trim($params['glass']),
		        'method' => trim($params['method'])
				);
			$recipe = new Recipe($attributes);
			if (Recipe::findName($recipe->name)) {
				$errors[] = "Nimi on jo käytössä!";
			} 
	        $errors = $recipe->errors();
	        if (count($errors) == 0) {
	        	$recipe->save();
	        	RecipeIngredientController::store($recipe);
	        } else {
	        	View::make('/recipe/add_recipe.html', array(
	        		'errors' => $errors,
	           		'recipe' => $recipe,	           		
	           		));
	        }        
	                   
	    }

	    

    



		public static function edit($id) {
			$recipe = Recipe::find($id);			
			$recipeIngredients = RecipeIngredient::find($id);
			View::make('recipe/edit_recipe.html',
				array('recipe' => $recipe, 'recipeIngredients' => $recipeIngredients));
		}



		public static function update($id) {											
			$params = $_POST;						
			$attributes = array(
				'id' => $id,
				'author' => $params['author'],
		        'name' => $params['name'],
		        'instructions' => $params['instructions'],
		        'glass' => $params['glass'],
		        'method' => $params['method']
				);
			$recipe = new Recipe($attributes); 
	        $errors = $recipe->errors();	        
	               
	        if (count($errors) == 0) {
	        	$recipe->update();
	        	RecipeIngredientController::update($recipe);
	        } else {
	        	View::make('/resepti/' . $id . '/muokkaa', array(
	        		'errors' => $errors,
	           		'params' => $params,
	           		'recipe' => $recipe	           		
	           		));
	        }     


	        
	        

		}

		public static function delete($id) {
			$recipe = Recipe::find($id);
			$recipe->destroy();
			Redirect::to('/', array('message'=> 'Resepti poistettu'));
		}
	}