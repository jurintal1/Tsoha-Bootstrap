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
}
