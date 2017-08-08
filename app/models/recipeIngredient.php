<?php
/**
* 
*/
class RecipeIngredient extends BaseModel
{
	public $id, $recipe_id; $ingredient_id, $quantity;

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM RecipeIngredient');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $recipeIngredients = array();

	    foreach($rows as $row){
	      $receipeIngredients[] = new RecipeIngredient(array(
	        'id' => $row['id'],
	        'recipe_id' => $row['recipe_id'],	        	        
	        'ingredient_id' => $row['ingredient_id'],	        	        
	        'quantity' => $row['quantity'],	        	        
	        ));  
	}
		return $recipeIngredients;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM RecipeIngredient WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$receipeIngredient = new Ainesosa(array(
        	'id' => $row['id'],
	        'recipe_id' => $row['recipe_id'],	        	        
	        'ingredient_id' => $row['ingredient_id'],	        	        
	        'quantity' => $row['quantity'],	        	        
	        )); 

      		return $receipeIngredient;
    	}

    	return null;
  	}
}
}