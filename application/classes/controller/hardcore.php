<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_Hardcore extends Controller_Template
{
	public $template;
	
	public function before()
	{
		$this->template = new stdClass;
	}
		
    public function action_index()
    {
    	/*
		 * Include MyBB integrator, as session.php
		 * Located in /game/inc/session.php
		 * Var called $MyBBI is the default value.
		*/
		
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';
		$forum = $MyBBI->getUser();
		
    	$this->template = View::factory('hardcore');
		
		$user_exists = DB::query(Database::SELECT, 
				'SELECT * FROM hardcore_users WHERE id = :uid')
			->parameters(array(
				':uid' => $forum['uid'],
			))->execute()->count();
		
		if ($user_exists == 0)
		{
            list($insert_id, $num_rows) = DB::query(Database::INSERT,
                    'INSERT INTO hardcore_users (
                         id, username
                     ) VALUES (
                         :uid, :username
                     )')
                ->parameters(array(
                    ':uid' => $forum['uid'],
                    ':username' => $forum['username'],
                    ))
                ->execute();
		}
		
        $user = DB::query(Database::SELECT,
                'SELECT *
                 FROM hardcore_users
                 WHERE id = :uid')
            ->parameters(array(
                ':uid' => $forum['uid'],
                ))
            ->execute()->current();
				
		$richliness_rank = DB::query(Database::SELECT,
			   'SELECT name 
				FROM hardcore_ranks
				WHERE id = :id')
			->parameters(array(
				':id' => $user['richliness_rank'],
				))
			->execute()->current();
		
		$manliness_rank = DB::query(Database::SELECT,
			   'SELECT name 
				FROM hardcore_ranks
				WHERE id = :id')
			->parameters(array(
				':id' => $user['manliness_rank'],
				))
			->execute()->current();
				
		//Pass variables to template
		$this->template->username = $forum['username'];
		$this->template->manliness = $user['manliness'];
		$this->template->richliness = $user['richliness'];
		$this->template->manliness_rank = $manliness_rank['name'];
		$this->template->richliness_rank = $richliness_rank['name'];
		$this->template->dead = $user['dead'];
		$this->template->hardcore_unlocked = $forum['hardcore_unlocked'];
    }

	public function action_submit()
	{
		/*
		 * Include MyBB integrator, as session.php
		 * Located in /game/inc/session.php
		 * Var called $MyBBI is the default value.
		*/
		
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';
		$forum = $MyBBI->getUser();
		
    	$this->template = View::factory('hardcore_enemy_submit');
		$this->template->username = $forum['username'];
	}
}
