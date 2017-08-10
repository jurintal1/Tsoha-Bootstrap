<?php
/**
* 
*/
class Ingredient extends BaseModel
{
	public $id, $name;	

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM Ingredient');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $ingredients = array();

	    foreach($rows as $row){
	      $ingredients[] = new Ingredient(array(
	        'id' => $row['id'],
	        'name' => $row['name']	        	        
	        ));  
		}

		return $ingredients;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Ingredient WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$ingredient = new Ingredient(array(
        	'id' => $row['id'],
	        'name' => $row['name']	                
	        ));  

      		return $ingredient;
    	}

    	return null;
  	}

  	public static function findName($name)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Ingredient WHERE LOWER(name) = LOWER(:name) LIMIT 1');
    	$query->execute(array('name' => $name));
    	$row = $query->fetch();

    	if($row){
      		$ingredient = new Ingredient(array(
        	'id' => $row['id'],
	        'name' => $row['name']	                
	        ));  

      		return $ingredient;
    	}

    	return null;
  	}
}
}