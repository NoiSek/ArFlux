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
					'INSERT INTO hardcore_enemies (
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
		$this->template = View::factory('return');
		$this->template->request_enemy = true;
		if (isset($_GET['type']) && $_GET['type'] == 'enemy')
		{
			$max = DB::query(database::SELECT,
			'SELECT *
			FROM hardcore_enemies
			WHERE manliness <= :manliness')
			->parameters(array(
				':manliness' => $_GET['manliness'] * 5,
			))
			->execute()->count();
			$max = floor($max);

			$rand_id = rand(0, $max);
			$enemy = DB::query(database::SELECT,
			'SELECT *
			FROM hardcore_enemies
			WHERE manliness <= :manliness
			AND id = :id'
			)
			->parameters(array(
				':manliness' => $_GET['manliness'] * 5,
				':id' => $rand_id,
			))
			->execute()->current();
			
			if (!$enemy)
			{
				$return = array(
					'success' => false,
				);
			}
			else
			{
				$return = array(
					'success' => true,
					'id' => $enemy['id'],
					'name' => $enemy['name'],
					'manliness' => $enemy['manliness'],
					'manliness_reward' => $enemy['manliness_reward'],
					'richliness_reward' => $enemy['richliness_reward'],
					'manliness_penalty' => $enemy['manliness_penalty'],
					'richliness_penalty' => $enemy['richliness_penalty'],
				);
			}
		}
		else if (isset($_GET['type']) && $_GET['type'] == 'user')
		{
			$max = DB::query(database::SELECT,
			'SELECT *
			FROM hardcore_users
			WHERE manliness <= :manliness')
			->parameters(array(
				':manliness' => $_GET['manliness'] * 5,
			))
			->execute()->count();
			$max = floor($max);

			$rand_id = rand(0, $max);
			$user = DB::query(database::SELECT,
			'SELECT *
			FROM hardcore_users
			WHERE manliness <= :manliness
			AND id = :id'
			)
			->parameters(array(
				':manliness' => $_GET['manliness'] * 5,
				':id' => $rand_id,
			))
			->execute()->current();
			
			if (!$user)
			{
				$return = array(
					'success' => false,
				);
			}
			else
			{
				$return = array(
					'success' => true,
					'id' => $user['id'],
					'name' => $user['username'],
					'manliness' => $user['manliness'],
					'richliness_reward' => floor(($user['richliness']/10)),
				);
			}
		}
		if(isset($return))
		{
			$this->template->return = json_encode($return);
		}
		else
		{
			$return = array(
				'success' => false,
				'err' => "Undefined request, recieved {$_GET['type']}",	
			);
			$this->template->return = json_encode($return);
		}
	}

	public function action_combat()
	{
		$this->template = View::factory('return');
		$this->template->combat = true;
		
		$chance = 50 + ($_GET['user_manliness'] - $_GET['enemy_manliness'])/10;
		
		if(rand(0,100) <= $chance)
		{
			$return = array(
				'success' => true,	
			);
			$this->template->return = json_encode($return);
		}
		else
		{
			$return = array(
				'success' => false,
			);
			$this->template->return = json_encode($return);
		}
	}
}

?>