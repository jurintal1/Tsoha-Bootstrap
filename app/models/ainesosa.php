<?php .
/**
* 
*/
class Ainesosa extends BaseClass
{
public $id, $nimi;	
	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM Ainesosa');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $ingredients = array();

	    foreach($rows as $row){
	      $ingredients[] = new Ainesosa(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi']	        	        
	        ));  
	}
		return $ingredients;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Ainesosa WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$ingredient = new Ainesosa(array(
        	'id' => $row['id'],
	        'nimi' => $row['nimi']	                
	        ));  

      		return $ingredient;
    	}

    	return null;
  	}
}
}