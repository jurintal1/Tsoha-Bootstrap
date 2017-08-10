<?php 
/**
* 
*/
class Recipe extends BaseModel
{
	public $id, $name, $author, $instructions, $glass, $method, $timeAdded;

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
	        'author' => $row['author'],
	        'name' => $row['name'],
	        'instructions' => $row['instructions'],
	        'glass' => $row['glass'],
	        'method' => $row['method'],
	        'timeAdded' => $row['timeadded']
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
	        	'author' => $row['author'],
	        	'instructions' => $row['instructions'],
	        	'glass' => $row['glass'],
	        	'method' => $row['method'],
	        	'timeAdded' => $row['timeadded']
      		));

      		return $recipe;
    	}

    	return null;
  	}

  	public static function getAuthor()
  	{
  		return $author;
  	}

  	public function save() {
  		$query=DB::connection()->prepare(
  			'INSERT INTO RECIPE(name, author, instructions, glass, method, timeadded)
  				VALUES(:name, :author, :instructions, :glass, :method, now())  
  				RETURNING id'
  			);		    
 		$query->execute(array(
 			'name' => $this->name,
 			'author' => $this->author,
 			'instructions' => $this->instructions,
 			'glass' => $this->glass,
 			'method' => $this->method
 			
 			));
 		$row=$query->fetch();
 		$this->id = $row['id'];

  	}

}
