<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_Hardcore extends Controller_Template
{
 
    public function action_index()
    {
    	public $template = 'hardcore';
    	/*
		 * Include MyBB integrator, as session.php
		 * Located in /game/inc/session.php
		 * Var called $MyBBI is the default value.
		*/
		
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';
		$forum = $MyBBI->getUser();
		
		if (!(DB::select('id')->from('hardcore_users')->where('id', '=', $forum['uid'])->execute()))
		{
			$insert = DB::insert('hardcore_users')
			    ->columns(array('id', 'username'))
			    ->values(array($forum['uid'], $forum['username']));
			$insert->execute();
		}
		
		$user_manliness = DB::query(Database::SELECT, 'SELECT manliness FROM hardcore_users WHERE id = :uid');
		$user_manliness->parameters(array(
		    ':uid' => $forum['uid'],
		));
		$user_manliness = $user_manliness->execute()->current();
		
		$temp_users = DB::select('*')->from('hardcore_users')->where('id', '=', $rand)->execute();
		//Pass variables to template
		$this->template->username = $forum['username'];
		$this->template->manliness = $user_manliness;
		$this->template->money = $forum['money'];
		$this->template->dead = ($forum['dead'] ? true : false);
		$this->template->hardcore_unlocked = $forum['hardcore_unlocked'];
		$this->template->users = $temp_users;
    }

	public function action_submit()
	{
		public $template = 'hardcore_enemy_submit';
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';
		$forum = $MyBBI->getUser();
		$this->template->username = $forum['username'];
	}
}
