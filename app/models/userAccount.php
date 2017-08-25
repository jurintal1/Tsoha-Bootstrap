<?php

class UserAccount extends BaseModel
{
	public $id, $name, $password, $role, $active;	
	
	function __construct($attributes)
	{
		parent::__construct($attributes);
		$this->validators = array('validate_name', 'validate_password');
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM UserAccount');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $users = array();

	    foreach($rows as $row){
	      $users[] = new UserAccount(array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'password' => $row['password'],
	        'role' => $row['role'],        
	        'active' => $row['active']	        
	        ));
	    }  
	
		return $users;
	}

	public static function allPassive()
	{    
	    $query = DB::connection()->prepare
	    	('SELECT * FROM UserAccount WHERE active = false');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $users = array();

	    foreach($rows as $row){
	      $users[] = new UserAccount(array(
	        'id' => $row['id'],
	        'name' => $row['name'],
	        'password' => $row['password'],
	        'role' => $row['role'],        
	        'active' => $row['active']	        
	        ));
	    }  
	
		return $users;
	}


  	public static function find($id) {
    	$query = DB::connection()->prepare
    		('SELECT * FROM UserAccount WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$user = new UserAccount(array(
        	'id' => $row['id'],
	        'name' => $row['name'],
	        'password' => $row['password'],
	        'role' => $row['role'],
	        'active' => $row['active']	        	        
	        ));  

      		return $user;
    	}
    	return null;    	
  	}



  	  	public static function findName($name)	{
	    	$query = DB::connection()->prepare
	    		('SELECT * FROM UserAccount WHERE name=:name LIMIT 1');
	    	$query->execute(array('name' => $name));
	    	$row = $query->fetch();

	    	if($row){
	      		$UserAccount = new UserAccount(array(
	        	'id' => $row['id'],
		        'name' => $row['name'],
		        'password' => $row['password'],
		        'role' => $row['password'],
		        'active' => $row['active']                
		        )); 
	      		return $UserAccount;
	    	}
	    	return null;
  		}

  		public static function authenticate($name, $password) {  			$query = DB::connection()->prepare
  				('SELECT * FROM UserAccount WHERE name = :name AND password = :password
  				LIMIT 1');
  			$query->execute(
  				array('name' => $name, 'password' => $password)
  				);
  			$row = $query->fetch();
  			if($row['active']) {
  			  $UserAccount = new UserAccount(array(
	        	'id' => $row['id'],
		        'name' => $row['name'],
		        'password' => $row['password'],
		        'role' => $row['role'],
		        'active' => $row['active']                
		        )); 
	      		return $UserAccount;
			}else{
  				return null;
			}
  		}

  		public function validate_name() {
	  		$errors = array();
	  		if (!$this -> validate_string_min_length($this->name, 5)
	  			&& $this -> validate_string_not_empty($this->name)) {
	  			$errors[] = "Käyttäjätunnuksen pitää olla vähintään viiden merkin pituinen";
	  		}

	  		if (!$this -> validate_string_not_empty($this->name)){
	  			$errors[] = "Lisää nimi!";
	  		}

	  		if (!$this -> validate_string_max_length($this->name, 50)){
	  			$errors[] = "Liian pitkä käyttäjätunnus!";
	  		}

	  		return $errors;
  		}



  		public function validate_password() {
	  		$errors = array();
	  		if (!$this -> validate_string_min_length($this->password, 10)
	  			&& $this -> validate_string_not_empty($this->password)) {
	  			$errors[] = "Salasanan pitää olla vähintään kymmenen merkin pituinen";
	  		}

	  		if (!$this -> validate_string_not_empty($this->password)){
	  			$errors[] = "Lisää salasana!";
	  		}

	  		if (!$this -> validate_string_max_length($this->name, 50)){
	  			$errors[] = "Liian pitkä salasana!";
	  		}

	  		if ($this->password == $this->name){
	  			$errors[] = "Salasana ei saa olla sama kuin käyttäjätunnus";
	  		}
	  		return $errors;
  		}


	  	public function save() {
	      $query=DB::connection()->prepare(
	        'INSERT INTO UserAccount (name, password, role) VALUES (:name, :password, 1) RETURNING id'
	        );
	      $query->execute(array(
	      	'name' => $this->name, 'password' => $this->password
	      	));
	      $row = $query->fetch();
	      $this->id = $row['id'];
	    }


	    public function update() { 		
  		$query=DB::connection()->prepare(
  			'UPDATE UserAccount
        	SET name = :name, password = :password, role =:role,
           	active = :active WHERE id=:id' 				
  			);      		    
   		$query->execute(array(
   			'id' => $this->id,
   			'name' => $this->name,
   			'password' => $this->password,
   			'role' => $this->role,
   			'active' => $this->active			
   			)); 		
  		}

}
