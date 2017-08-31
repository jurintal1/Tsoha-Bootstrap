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

}