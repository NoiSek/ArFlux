<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_handler extends Controller_Template
{
	public $template;
	
	public function before()
	{
		$this->template = new stdClass;
	}
	
	public function action_submit()
	{
		$this->template = View::factory('return');
		$this->template->enemy_submission = true;
		
		if (isset($_GET['name']))
		{
			if (!is_numeric($_GET['manliness']))
			{
				$error = 'Value of manliness not a number.';
			}
			else if (!is_numeric($_GET['richliness_reward']))
			{
				$error = 'Richliness reward not a number.';
			}
			else if (!is_numeric($_GET['manliness_reward']))
			{
				$error = 'Manliness reward not a number.';
			}
			else
			{
	            list($insert_id, $num_rows) = DB::query(Database::INSERT,
					'INSERT INTO hardcore_monsters (
						name, manliness, richliness_reward, manliness_reward, richliness_penalty, manliness_penalty, author)
					VALUES (
						:name, :manliness, :richliness_reward, :manliness_reward, :richliness_penalty, :manliness_penalty, :author)')
					->parameters(array(
						':name' => $_GET['name'],
						':manliness' => $_GET['manliness'],
						':richliness_reward' => $_GET['richliness_reward'],
						':manliness_reward' => $_GET['manliness_reward'],
						':richliness_penalty' => $_GET['richliness_penalty'],
						':manliness_penalty' => $_GET['manliness_penalty'],
						':author' => $_GET['author']
						))
					->execute();
				
				$return = array(
					'success' => true,
					'name' => $_GET['name'],
				);
				$this->template->return = json_encode($return);
			}
		}
		
		if(isset($error))
		{
			$return = array(
				'success' => false,
				'err' => $error,
			);
			$this->template->return = json_encode($return);
		}	
	}

	public function action_request()
	{
		$enemy = Model::factory('enemy'); 
		$this->template = View::factory('return');
		
		if (isset($_GET['type']) && $_GET['type'] == 'enemy')
		{
			$return = $enemy->pull_monster($_GET['uid']);
		}
		else if (isset($_GET['type']) && $_GET['type'] == 'user')
		{
			$return = $enemy->pull_user($_GET['uid']);
		}
		else
		{
			$return = array(
				'success' => false,
				'err' => "Undefined request, received {$_GET['type']}",	
			);
			$this->template->return = json_encode($return);
		}

		if(isset($return))
		{
			$this->template->return = json_encode($return);
		}
		else
		{
			$return = array(
				'success' => false,
				'err' => "Function failed to return data.",	
			);
			$this->template->return = json_encode($return);
		}

	}

	public function action_combat()
	{
		$this->template = View::factory('return');
		$enemy = Model::factory('enemy');
		$return = $enemy->combat($_GET['uid'], $_GET['enemy_id']);
		$this->template->return = json_encode($return);
	}
	
	public function action_update()
	{
		$this->template = View::factory('return');
		$user = Model::factory('user');
		$return = $user->hardcore_data($_GET['uid']);
		$this->template->return = json_encode($return);
	}
}

?>