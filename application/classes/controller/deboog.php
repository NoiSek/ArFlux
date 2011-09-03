<?php defined('SYSPATH') OR die('No Direct Script Access');

	class Controller_Deboog extends Controller_Template
	{				
		public function action_index()
		{
			$this->template = View::factory('deboog');
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
			$this->foo = print_r($bar);
		}
	}
?>