<?php defined('SYSPATH') OR die('No Direct Script Access');
	
	class Model_user extends Model
	{
		public function hardcore_data($uid)
		{
			$hardcore = DB::query(Database::SELECT,
	        	'SELECT *
	        	FROM hardcore_users
	        	WHERE id = :uid')
	        ->parameters(array(
	        	':uid' => $uid,
			))
			->execute()->current();
			return $hardcore;
		}
		
		public function user_exists($uid)
		{
			$user_exists = DB::query(Database::SELECT, 
				'SELECT * FROM hardcore_users WHERE id = :uid')
			->parameters(array(
				':uid' => $uid,
			))
			->execute()->count();
			
			if ($user_exists == 0)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		public function create_user($uid, $username)
		{
			list($insert_id, $num_rows) = DB::query(Database::INSERT,
				'INSERT INTO hardcore_users (
					id, username
				)
				VALUES (
					:uid, :username
				)')
			->parameters(array(
				':uid' => $uid,
				':username' => $username,
			))
			->execute();
		}
		
		public function richliness_rank($rank_id)
		{
			$rank_name = DB::query(Database::SELECT,
			   'SELECT * 
				FROM hardcore_rranks
				WHERE id = :id')
			->parameters(array(
				':id' => $rank_id,
				))
			->execute()->current();
			return $rank_name;
		}
		
		public function manliness_rank($rank_id)
		{
			$rank_name = DB::query(Database::SELECT,
			   'SELECT * 
				FROM hardcore_mranks
				WHERE id = :id')
			->parameters(array(
				':id' => $rank_id,
				))
			->execute()->current();
			return $rank_name;
		}
		
		public function progress($user)
		{
			$rrank = $this->richliness_rank($user['richliness_rank']+1);
			$mrank = $this->manliness_rank($user['manliness_rank']+1);
			if (!$rrank)
			{
				$rrank['requirement'] = $user['richliness'];
			}
			if (!$mrank)
			{
				$mrank['requirement'] = $user['manliness'];
			}
			$manliness_progress = ($user['manliness'] / $mrank['requirement']) * 225;
			$richliness_progress = ($user['richliness'] / $rrank['requirement']) * 225;
			
			$return = array(
				'manliness' => $manliness_progress,
				'richliness' => $richliness_progress,
			);
			return $return;
		}
		
		public function rank($mrank_id, $rrank_id, $uid)
		{
			$rrank = $this->richliness_rank($rrank_id);
			$mrank = $this->manliness_rank($mrank_id);
			$rrank_next = $this->richliness_rank(($rrank_id + 1));
			$mrank_next = $this->manliness_rank(($mrank_id + 1));
			$progress = $this->progress($this->hardcore_data($uid));
			
			$rank = array(
				"manliness" => $mrank,
				"richliness" => $rrank,
				"next_manliness" => $mrank_next,
				"next_richliness" => $rrank_next,
				"richliness_progress" => $progress['richliness'],
				"manliness_progress" => $progress['manliness'],
			);
			return $rank;
		}
	}
?>