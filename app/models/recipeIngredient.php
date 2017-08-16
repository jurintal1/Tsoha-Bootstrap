<?php
/**
* 
*/
class RecipeIngredient extends BaseModel
{
	public $id, $recipe_id, $ingredient_id, $quantity;

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}

	public static function find($recipe_id)
    {
      $query = DB::connection()->prepare
        ('SELECT * FROM RecipeIngredient WHERE recipe_id = :recipe_id');
      $query->execute(array('recipe_id' => $recipe_id));
      $rows = $query->fetchAll();
      $recipeIngredients = array();     
      foreach($rows as $row){     
        $recipeIngredients[] = new RecipeIngredient(array(
          'recipe_id' => $row['recipe_id'],
          'ingredient_id' => $row['ingredient_id'],
          'quantity' => $row['quantity']
          ));
      }
      return $recipeIngredients;
    }
}
