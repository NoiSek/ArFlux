<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_Mini extends Controller_Template
{
    public $template = 'mini';
 
    public function action_index()
    {
    	/*
		 * Include MyBB integrator, as session.php
		 * Located in /game/inc/session.php
		 * Var called $MyBBI is the default value.
		*/
		
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';
		$forum = $MyBBI->getUser();
		
		if (!(DB::select('id')->from('mini_users')->where('id', '=', $forum['uid'])->execute()))
		{
			$insert = DB::insert('mini_users')
			    ->columns(array('id', 'username'))
			    ->values(array($forum['uid'], $forum['username']));
		}
		
		$user_manliness = DB::select('manliness')->from('mini_users')->where('id', '=', $forum['uid'])->execute();
		
		$temp_monsters = DB::select('*')->from('mini_monsters')->where($user_manliness, '>=', 'manliness')->execute();
		$temp_users = DB::select('*')->from('mini_users')->where('id', '=', $rand)->execute();
		//Pass variables to template
		$this->template->username = $forum['username'];
		$this->template->manliness = $forum['manliness'];
		$this->template->money = $forum['money'];
		$this->template->dead = ($forum['dead'] ? true : false);
		$this->template->hardcore_unlocked = $forum['hardcore_unlocked'];
		$this->template->users = $temp_users;
    }
}

	/*
	//Choose random ids
	$usermax = DB::select('count($temp_users)');
	$monstermax = DB::select('count($temp_monsters)');
	$count = 0;
	while ($count <= $max;)
	{
		$table = (rand(0,1) ? "mini_monsters" : "mini_users");
		$rand = (rand(0,100));
		$results = DB::select()->from($table)->where('id', '=', $rand)->execute();
		if ($results)
		{
			$count++;
		}
	} 
	*/ 
