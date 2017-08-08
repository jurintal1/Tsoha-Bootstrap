<?php . 
/**
* 
*/
class Resepti extends BaseModel
{
	public $id, $nimi, $ohje, $lasi, $valmistustapa, $lisaysaika

	function __construct($attributes)
	{
		parent::__construct($attributes);
	}


	public static function all()
	{    
	    $query = DB::connection()->prepare('SELECT * FROM Resepti');    
	    $query->execute();    
	    $rows = $query->fetchAll();
	    $receipes = array();

	    foreach($rows as $row){
	      $receipes[] = new Resepti(array(
	        'id' => $row['id'],
	        'nimi' => $row['nimi'],
	        'ohje' => $row['ohje'],
	        'lasi' => $row['lasi'],
	        'valmistustapa' => $row['valmistustapa'],
	        'lisaysaika' => $row['lisaysaika']
	        ));  
	}
		return $receipes;
	}


  	public static function find($id)
  	{
    	$query = DB::connection()->prepare
    		('SELECT * FROM Resepti WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
      		$receipe = new Resepti(array(
        		'id' => $row['id'],
	        	'nimi' => $row['nimi'],
	        	'ohje' => $row['ohje'],
	        	'lasi' => $row['lasi'],
	        	'valmistustapa' => $row['valmistustapa'],
	        	'lisaysaika' => $row['lisaysaika']
      		));

      		return $receipe;
    	}

    	return null;
  	}
}
}