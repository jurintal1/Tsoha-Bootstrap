<?php .
/**
* 
*/
class Kayttaja extends BaseClass
{
public $id, $nimi, $salasana, $oikeustaso;	
	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM Kayttaja');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $people = array();

	    foreach($rows as $row){
	      $people[] = new Kayttaja(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'salasana' => $row['salasana'],
	        'oikeustaso' => $row['oikeustaso']	        
	        ));  
	}
		return $people;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$person = new Kayttaja(array(
        	'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'salasana' => $row['salasana'],
	        'oikeustaso' => $row['oikeustaso']	        
	        ));  

      		return $receipe;
    	}

    	return null;
  	}
}
}