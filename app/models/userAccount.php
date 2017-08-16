<?php

class UserAccount extends BaseModel
{
	public $id, $name, $password, $role, $active;	
	
	function __construct($attributes)
	{
		parent::__construct($attributes);
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


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM UserAccount WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$user = new UserAccount(array(
        	'id' => $row['id'],
	        'name' => $row['name'],
	        'password' => $row['password'],
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

  		public static function authenticate($name, $password) {
  			Kint::dump($name, $password); 			
  			$query = DB::connection()->prepare
  				('SELECT * FROM UserAccount WHERE name = :name AND password = :password
  				LIMIT 1');
  			$query->execute(array('name' => $name, 'password' => $password));
  			$row = $query->fetch();
  			if($row) {
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
}
