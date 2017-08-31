<?php

class RecipeIngredientController extends BaseController {

	public static function store($recipe) {
		$errors = array();
		$recipeIngredients = array();      	
		$params = $_POST;

		for ($x = 1; $x <= 10; $x++) {          
			$ingredientName = trim($params['ingredient'.$x]);
			$quantity = trim($params['quantity'.$x]);
			$ingredient = "";

			if ($ingredientName) {
				$ingredient = Ingredient::findName($ingredientName);       	
				if (!$ingredient) {          		
					$attributes = array('name' => $ingredientName);
					$ingredient = new Ingredient($attributes);
					if (!$ingredient->errors()) {
						$ingredient->save();
					} else {
						$errors = 
						array_merge($errors, $ingredient->errors());
					}       		
				}
				$attributes = array(
					'quantity' => $params['quantity'.$x],
					'recipe_id' => $recipe->id,
					'ingredient_id' => $ingredient->id
					);
				$recipeIngredient = 
				new RecipeIngredient($attributes);		    	
				$errors = array_merge($errors, $recipeIngredient->errors());
				$recipeIngredients[] = $recipeIngredient;
			}
		}
		if (count($recipeIngredients) == 0) {
			$errors[] = "Lisää ainakin yksi ainesosa!";
		}

		if (count($errors) == 0) {     
			foreach($recipeIngredients as $ri) {
				$ri->save();
			}	     	
			Redirect::to('/resepti/' . $recipe->id, array(
				'message' => 'Tässä lisäämäsi uusi resepti!'));
		} else {
			Redirect::to('/resepti/' . $recipe->id . '/muokkaa', array(
				'errors' => $errors,
				'params' => $params,	           		
				));
			Kint::dump($recipe);
		}

	}



	public static function update($recipe) {
		$errors = array();
		$recipeIngredients = array();      	
		$params = $_POST;

		for ($x = 1; $x <= 10; $x++) {          
			$ingredientName = trim($params['ingredient'.$x]);
			$quantity = trim($params['quantity'.$x]);
			$ingredient = "";

			if ($ingredientName) {
				$ingredient = Ingredient::findName($ingredientName);       	
				if (!$ingredient) {          		
					$attributes = array('name' => $ingredientName);
					$ingredient = new Ingredient($attributes);
					if (!$ingredient->errors()) {
						$ingredient->save();
					} else {
						$errors = 
						array_merge($errors, $ingredient->errors());
					}       		
				}
				$attributes = array(
					'quantity' => $params['quantity'.$x],
					'recipe_id' => $recipe->id,
					'ingredient_id' => $ingredient->id
					);
				$recipeIngredient = 
				new RecipeIngredient($attributes);		    	
				$errors = array_merge($errors, $recipeIngredient->errors());
				$recipeIngredients[] = $recipeIngredient;
			}
		}
		if (count($recipeIngredients) == 0) {
			$errors[] = "Lisää ainakin yksi ainesosa!";
		}

		if (count($errors) == 0) {
			$oldRecipeIngredients = RecipeIngredient::find($recipe->id);
			foreach($oldRecipeIngredients as $ori) {
				$ori->destroy();
			}
			foreach($recipeIngredients as $ri) {
				$ri->save();
			}
			foreach($oldRecipeIngredients as $ori) {
				Ingredient::removeIfNotUsed($ori->recipe_id);
			}


			Redirect::to('/resepti/' . $recipe->id, array(
				'message' => 'Reseptin muokkaaminen onnistui!'));
		} else {
			View::make('/recipe/edit_recipe.html', array(
				'errors' => $errors,	           		
				'recipe' => $recipe,
				'recipeIngredients' => RecipeIngredient::find($recipe->id)	
				));
			
		}

	}
}

