<?php defined('SYSPATH') OR die('No Direct Script Access');
	
	class Model_enemy extends Model
	{
		
		public function monster_data($enemy_id)
		{
			$monster = DB::query(Database::SELECT,
				'SELECT *
				FROM hardcore_monsters
				WHERE id = :enemy_id')
			->parameters(array(
				':enemy_id' => $enemy_id,
			))
			->execute()->current();
			return $monster;
		}
		
		public function pull_monster($uid)
		{
			$user = Model::factory('user');
			$user = $user->hardcore_data($uid);
			
			$enemy = DB::query(Database::SELECT,
				'SELECT *
				FROM hardcore_monsters
				WHERE manliness <= :manliness'
			)
			->parameters(array(
				':manliness' => $user['manliness'] * 5,
			))
			->execute();
			
			if (count($enemy) == 0)
			{
				$return = array(
					'success' => false,
					'err' => "Failed to find a matching monster",
				);
			}
			else
			{
				$enemy = $enemy[rand(0,count($enemy)-1)];
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
			return $return;
		}

		public function pull_user($manliness, $return)
		{
			$max = DB::query(Database::SELECT,
				'SELECT *
				FROM hardcore_users
				WHERE manliness <= :manliness')
			->parameters(array(
				':manliness' => $manliness * 5,
			))
			->execute()->count();
			$max = floor($max);

			$rand_id = rand(0, $max);
			$user = DB::query(Database::SELECT,
				'SELECT *
				FROM hardcore_users
				WHERE manliness <= :manliness
				AND id = :id'
			)
			->parameters(array(
				':manliness' => $manliness * 5,
				':id' => $rand_id,
			))
			->execute()->current();
			
			if (!$user)
			{
				$return = array(
					'success' => false,
					'err' => "Failed to find a matching user.",
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
			return $return;
		}
		
		public function combat($uid, $enemy_id)
		{
			$user_func = Model::factory('user');
			$user = $user_func->hardcore_data($uid);
			$monster = $this->monster_data($enemy_id);
			
			//Grab both ranks, to see if we need to upgrade the user's rank.
			$ranks = $user_func->rank($user['manliness_rank'], $user['richliness_rank'], $user['id']);
			$manliness_rank = $ranks['manliness'];
			$richliness_rank = $ranks['richliness'];
			
			// Default
			$update_richliness_rank = false;
			$update_manliness_rank = false;
			
			//Calculate our win percentage
			$chance = 50 + ($user['manliness'] - $monster['manliness'])/10;
			if ($chance <= 0){
				$chance = 1;
			}

			//Use the percentage to see if user won in combat
			if(rand(0,100) <= $chance)
			{
				$manliness = $user['manliness'] + $monster['manliness_reward'];
				$richliness = $user['richliness'] + $monster['richliness_reward'];
				
				if ($manliness > $manliness_rank['requirement'])
				{
					$update_manliness_rank = true;
					
					$new_manliness_rank_count = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_mranks
						WHERE requirement <= :manliness'
					)
					->parameters(array(
						':manliness' => $manliness,
					))
					->execute()->count();

					$new_manliness_rank = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_mranks
						WHERE requirement <= :manliness'
					)
					->parameters(array(
						':manliness' => $manliness,
					))
					->execute();
					
					$new_manliness_rank = $new_manliness_rank[$new_manliness_rank_count-1];	
					
					$update_user = DB::query(Database::UPDATE,
						'UPDATE hardcore_users
						SET manliness_rank = :manliness_rank
						WHERE id = :uid'
					)
					->parameters(array(
						':uid' => $user['id'],
						':manliness_rank' => $new_manliness_rank['id'],
					))
					->execute();
				}
				
				if ($richliness > $richliness_rank['requirement'])
				{
					$update_richliness_rank = true;
					
					$new_richliness_rank_count = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_rranks
						WHERE requirement <= :richliness'
					)
					->parameters(array(
						':richliness' => $richliness,
					))
					->execute()->count();

					$new_richliness_rank = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_rranks
						WHERE requirement <= :richliness'
					)
					->parameters(array(
						':richliness' => $richliness,
					))
					->execute();
					
					$new_richliness_rank = $new_richliness_rank[$new_richliness_rank_count-1];	
					
					$update_user = DB::query(Database::UPDATE,
						'UPDATE hardcore_users
						SET richliness_rank = :richliness_rank
						WHERE id = :uid'
					)
					->parameters(array(
						':uid' => $user['id'],
						':richliness_rank' => $new_richliness_rank['id'],
					))
					->execute();
				}
				
				$update_user = DB::query(Database::UPDATE,
					'UPDATE hardcore_users
					SET manliness = :manliness, richliness = :richliness
					WHERE id = :uid'
				)
				->parameters(array(
					':uid' => $user['id'],
					':manliness' => $manliness,
					':richliness' => $richliness,
				))
				->execute();
				
				$progress = $user_func->progress($user_func->hardcore_data($user['id']));
				
				$return = array(
					'success' => true,
					'update_richliness_rank' => $update_richliness_rank,
					'update_manliness_rank' => $update_manliness_rank,
					'manliness_progress' => $progress['manliness'],
					'richliness_progress' => $progress['richliness'],
				);
				if ($update_richliness_rank == true)
				{
					$return['new_richliness_rank'] = $new_richliness_rank['name'];
				}
				if ($update_manliness_rank == true)
				{
					$return['new_manliness_rank'] = $new_manliness_rank['name'];
				}
				return $return;
			}
			else
			{
				
				$manliness = $user['manliness'] - $monster['manliness_penalty'];
				$richliness = $user['richliness'] - $monster['richliness_penalty'];
				
				if ($manliness < 1)
				{
					$manliness = 1;
				}
				
				if ($richliness < 1)
				{
					$richliness = 1;
				}
				
				if ($manliness < $manliness_rank['requirement'])
				{
					$update_manliness_rank = true;
					
					$new_manliness_rank_count = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_mranks
						WHERE requirement <= :manliness'
					)
					->parameters(array(
						':manliness' => $manliness,
					))
					->execute()->count();

					$new_manliness_rank = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_mranks
						WHERE requirement <= :manliness'
					)
					->parameters(array(
						':manliness' => $manliness,
					))
					->execute();
					
					$new_manliness_rank = $new_manliness_rank[$new_manliness_rank_count-1];
					
					$update_user = DB::query(Database::UPDATE,
						'UPDATE hardcore_users
						SET manliness_rank = :manliness_rank
						WHERE id = :uid'
					)
					->parameters(array(
						':uid' => $user['id'],
						':manliness_rank' => $new_manliness_rank['id'],
					))
					->execute();
				}
				
				if ($richliness < $richliness_rank['requirement'])
				{
					$update_richliness_rank = true;
					
					$new_richliness_rank_count = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_rranks
						WHERE requirement <= :richliness'
					)
					->parameters(array(
						':richliness' => $richliness,
					))
					->execute()->count();

					$new_richliness_rank = DB::query(Database::SELECT,
						'SELECT *
						FROM hardcore_rranks
						WHERE requirement <= :richliness'
					)
					->parameters(array(
						':richliness' => $richliness,
					))
					->execute();
					
					$new_richliness_rank = $new_richliness_rank[$new_richliness_rank_count-1];
					
					$update_user = DB::query(Database::UPDATE,
						'UPDATE hardcore_users
						SET richliness_rank = :richliness_rank
						WHERE id = :uid'
					)
					->parameters(array(
						':uid' => $user['id'],
						':richliness_rank' => $new_richliness_rank['id'],
					))
					->execute();
				}
				
				$update_user = DB::query(Database::UPDATE,
					'UPDATE hardcore_users
					SET manliness = :manliness, richliness = :richliness
					WHERE id = :uid'
				)
				->parameters(array(
					':uid' => $user['id'],
					':manliness' => $manliness,
					':richliness' => $richliness,
				))
				->execute();
				
				$progress = $user_func->progress($user_func->hardcore_data($user['id']));
				
				$return = array(
					'success' => false,
					'update_richliness_rank' => $update_richliness_rank,
					'update_manliness_rank' => $update_manliness_rank,
					'manliness_progress' => $progress['manliness'],
					'richliness_progress' => $progress['richliness'],
				);
				if ($update_richliness_rank == true)
				{
					$return['new_richliness_rank'] = $new_richliness_rank['name'];
				}
				if ($update_manliness_rank == true)
				{
					$return['new_manliness_rank'] = $new_manliness_rank['name'];
				}
				return $return;
			}
		}
	}
?>