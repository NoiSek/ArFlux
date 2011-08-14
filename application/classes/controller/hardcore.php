<?php defined('SYSPATH') OR die('No Direct Script Access');
	
	class user_data
	{
		public $forum;
		public $hardcore;
		public $rank;
		public $user;
		
		public function __construct($bforum)
		{
			$this->forum = $bforum;		
			if ($this->forum['username'] != "Captain Lightning")
			{
				die("You're not supposed to be here {$this->forum['username']}!");
			}
			
			$this->user = Model::factory('user');
			$this->hardcore = $this->user->hardcore_data($this->forum['uid']);
			
			if (!$this->user->user_exists($this->forum['uid']))
			{
				$this->user->create_user($this->forum['uid'], $this->forum['username']);
			}
			
			$this->rank = $this->user->rank($this->hardcore['manliness_rank'], $this->hardcore['richliness_rank']);
		}
	}

	class Controller_Hardcore extends Controller_Template
	{
		public $template;
		
		public function before()
		{
			$this->template = new stdClass;
		}
				
		public function action_index()
		{
			require_once '/home/arflux-rpg/public_html/game/inc/session.php';
			$forum = $MyBBI->getUser();
			$this->template = View::factory('hardcore');
			$this->template->user = new user_data($forum);
		}
	
		public function action_submit()
		{	
			require_once '/home/arflux-rpg/public_html/game/inc/session.php';
			$forum = $MyBBI->getUser();
			
			$this->template = View::factory('hardcore_enemy_submit');
			$this->template->username = $forum['username'];
		}
	}