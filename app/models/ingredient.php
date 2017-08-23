<?php

class Ingredient extends BaseModel {
  public $id, $name;	

  	function __construct($attributes)
  	{
  		parent::__construct($attributes);
      $this->validators = array('validate_name');
  	}


	public static function all() {    
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


  	public static function find($id) {      
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

  	public static function findName($name) {
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


    public function validate_name() {
      $errors = array();
      if (!$this -> validate_string_min_length($this->name, 2)
        && $this -> validate_string_not_empty($this->name)) {
        $errors[] = "Liian lyhyt ainesosan nimi, laita pidempi!";
      }

      if (!$this -> validate_string_not_empty($this->name)){
        $errors[] = "Lisää nimi!";
      }

      if (!$this -> validate_string_max_length($this->name, 50)){
        $errors[] = "Liian pitkä nimi!";
      }

      
      return $errors;
    }

    public function save() {
      $query=DB::connection()->prepare(
        'INSERT INTO Ingredient(name) VALUES(:name) RETURNING id'
        );
      $query->execute(array('name' => $this->name));
      $row = $query->fetch();
      $this->id = $row['id'];
    }
}
