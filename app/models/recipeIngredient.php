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
    $this->validators = array('validate_quantity');
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

    public function getIngredientName() {
    	$ingredient = Ingredient::find($this->ingredient_id);      
      return $ingredient->name;
    }

    public function validate_quantity() {    
      if (!$this -> validate_string_max_length($this->quantity, 50)) {
        $errors[] = "Määrä-kentässä liikaa selitystä, vähempikin riittäisi.";
      }
    }


    public function save() {
      $query=DB::connection()->prepare(
        'INSERT INTO RecipeIngredient(quantity, recipe_id, ingredient_id)
          VALUES(:quantity, :recipe_id, :ingredient_id)'  
        );

      $query->execute(array(
        'quantity' => $this->quantity,
        'recipe_id' => $this->recipe_id,
        'ingredient_id' => $this->ingredient_id
        ));      
    }

    public function destroy() {    
      $query=DB::connection()->prepare(
        'DELETE from RecipeIngredient 
        WHERE recipe_id = :recipe_id AND ingredient_id = :ingredient_id'
        );
      $query->execute(array(
        'recipe_id' => $this->recipe_id,
        'ingredient_id' => $this->ingredient_id
        ));
            
      

    }



  }
