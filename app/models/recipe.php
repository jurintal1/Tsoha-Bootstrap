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
		$this->validators = array('validate_name', 'validate_instructions', 'validate_method', 'validate_glass');
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



  	public static function find($id) {
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



  	public function update() { 		
  		$query=DB::connection()->prepare(
  			'UPDATE RECIPE
          SET name=:name, author=:author, instructions=:instructions,
           glass=:glass, method=:method
          WHERE id=:id' 				
  			);      		    
   		$query->execute(array(
   			'id' => $this->id,
   			'name' => $this->name,
   			'author' => $this->author,
   			'instructions' => $this->instructions,
   			'glass' => $this->glass,
   			'method' => $this->method 			
   			));
 		
  	}


    public function destroy() {    
      $query=DB::connection()->prepare('DELETE from RECIPE WHERE id = :id');
      $query->execute(array('id' => $this->id));    
    }

  	public function validate_name() {
  		$errors = array();
  		if (!$this -> validate_string_min_length($this->name, 2)
  			&& $this -> validate_string_not_empty($this->name)) {
  			$errors[] = "Liian lyhyt nimi, laita pidempi!";
  		}

  		if (!$this -> validate_string_not_empty($this->name)){
  			$errors[] = "Lisää nimi!";
  		}

  		if (!$this -> validate_string_max_length($this->name, 50)){
  			$errors[] = "Liian pitkä nimi!";
  		}

  		return $errors;
  	}

  	public function validate_instructions() {
      Kint::dump($this->instructions);
  		$errors = array();  		
  		if (!$this -> validate_string_max_length($this->instructions, 50)){
  			$errors[] = "Liian pitkä ohje!";
  		}
  		if (!$this -> validate_string_min_length($this->instructions, 3)
  			&& $this -> validate_string_not_empty($this->instructions)){
  			$errors[] = "Liian lyhyt ohje!";
  		}
  		return $errors;

  	}

  	public function validate_method() {
  		$errors = array();
  		if ($this->validate_string_not_empty($this ->method)
  			&& !$this -> validate_string_min_length($this->method, 3)){
  				$errors[] = "Liian lyhyt valmistustapa!";
  		}

  		if (!$this -> validate_string_max_length($this->method, 50)){
  			$errors[] = "Liian pitkä valmistustapa!";
  		}

  		return $errors;
  	}



  	public function validate_glass() {
  		$errors = array();
      if($this -> validate_string_not_empty($this->glass)) {

  		  if (!$this -> validate_string_min_length($this->glass, 3)) {
  			$errors[] = "Liian lyhyt lasi!";
  		  }

  		  if (!$this -> validate_string_max_length($this->glass, 50)){
  			$errors[] = "Liian pitkä lasi!";
  		  }

      }

  		return $errors;
  	}

    public function validate_ingredients() {

    }


    public function getAuthorName() {
      $author = UserAccount::find($this->author);
      return $author->name;
    }
}		