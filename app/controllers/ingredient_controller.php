<?php

	class IngredientController extends BaseController {
	
		public static function ingredientList() {
			$ingredients = Ingredient::all();						
			View::make('ingredient/ingredient_list.html', array('ingredients' => $ingredients));
		}



		public static function showRecipes($id) {
			$ingredient = Ingredient::find($id);
			$recipes = Recipe::findIngredient($id);				
										
			View::make('ingredient/ingredient.html', array('ingredient' => $ingredient, 'recipes' => $recipes));
		}



		public static function add() {												
			View::make('recipe/add_recipe.html');
		}



		public static function store() {												
			$params = $_POST;
			$attributes = array(
				'author' => 1,  //korjataan myöhemmin!
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
	        	Redirect::to('/resepti/' . $recipe->id, array('message' => 'Reseptin muokkaaminen onnistui.'));
	        } else {
	        	View::make('/recipe/edit_recipe.html', array('errors' => $errors,
	        	 'recipe' => $recipe));
	        }       


	        //lisäksi käsiteltävä ainesosat
	        

		}

		public static function delete($id) {
			$recipe = Recipe::find($id);
			$recipe->destroy();
			Redirect::to('/', array('message'=> 'Resepti poistettu'));
		}
	}