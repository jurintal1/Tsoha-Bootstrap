<?php .
/**
* 
*/
class ReseptiAines extends BaseClass
{
	public $id, $resepti_id; $ainesosa_id, $maara;

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM ReseptiAinesosa');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $ingredients = array();

	    foreach($rows as $row){
	      $receipeIngredients[] = new Ainesosa(array(
	        'id' => $row['id'],
	        'resepti_id' => $row['resepti_id'],	        	        
	        'resepti_id' => $row['resepti_id'],	        	        
	        'maara' => $row['maara'],	        	        
	        ));  
	}
		return $receipeIngredients;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM ReseptiAinesosa WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$receipeIngredient = new Ainesosa(array(
        	'id' => $row['id'],
	        'resepti_id' => $row['resepti_id'],	        	        
	        'resepti_id' => $row['resepti_id'],	        	        
	        'maara' => $row['maara'],	        	        
	        )); 

      		return $receipeIngredient;
    	}

    	return null;
  	}
}
}