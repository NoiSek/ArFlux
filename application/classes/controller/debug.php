<?php defined('SYSPATH') OR die('No Direct Script Access');

	class Controller_Debug extends Controller_Template
	{				
		public function action_index()
		{
			$bar = DB::query(Database::SELECT,
				'SELECT *
				FROM hardcore_rranks
				WHERE requirement <= :richliness'
				)
				->parameters(array(
					':richliness' => $richliness,
				))
				->execute();
			$bar = end($bar);
			die($bar);
		}
	}
?>