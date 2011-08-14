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
			$rankname = DB::query(Database::SELECT,
			   'SELECT * 
				FROM hardcore_rranks
				WHERE id = :id')
			->parameters(array(
				':id' => $rank_id,
				))
			->execute()->current();
			return $rankname;
		}
		
		public function manliness_rank($rank_id)
		{
			$rankname = DB::query(Database::SELECT,
			   'SELECT * 
				FROM hardcore_mranks
				WHERE id = :id')
			->parameters(array(
				':id' => $rank_id,
				))
			->execute()->current();
			return $rankname;
		}
		
		public function rank($mrank_id, $rrank_id)
		{
			$mrank = $this->richliness_rank($rrank_id);
			$rrank = $this->manliness_rank($mrank_id);
			$mrank_next = $this->richliness_rank(($rrank_id + 1));
			$rrank_next = $this->manliness_rank(($mrank_id + 1));
			
			$rank = array(
				"manliness" => $mrank,
				"richliness" => $rrank,
				"next_manliness" => $mrank_next,
				"next_richliness" => $rrank_next,
			);
			return $rank;
		}
	}
?>