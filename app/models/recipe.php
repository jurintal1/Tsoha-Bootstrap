<?php 
/**
* 
*/
class Recipe extends BaseModel
{
	public $id, $name, $instructions, $glass, $method, $dateAdded;

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM Recipe');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $recipes = array();

	    foreach($rows as $row){
	      $recipes[] = new Recipe(array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'instructions' => $row['instructions'],
	        'glass' => $row['glass'],
	        'method' => $row['method'],
	        'dateAdded' => $row['dateAdded']
	        ));  
		}

		return $recipes;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Recipe WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$recipe = new Recipe(array(
        		'id' => $row['id'],
	        	'name' => $row['name'],
	        	'instructions' => $row['instructions'],
	        	'glass' => $row['glass'],
	        	'method' => $row['method'],
	        	'dateAdded' => $row['dateAdded']
      		));

      		return $recipe;
    	}

    	return null;
  	}
}
}