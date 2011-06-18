<?php defined('SYSPATH') OR die('No Direct Script Access');
	Class Controller_Getmonster extends Controller_Template
	{
		public function action_index() 
		{
			$manliness = $_GET['manliness'];
			$max = $manliness*2;
			$monster = DB::query(Database::SELECT, 'SELECT * from hardcore_monsters WHERE manliness <= :max');
			$monster->parameters(array(
				':max' => $max,	
			));
		
			echo "
				<div id=''>
			";
		}
	}
?>