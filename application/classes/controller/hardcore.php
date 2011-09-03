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
			/*if ($this->forum['username'] != "Captain Lightning")
			{
				die("You're not supposed to be here {$this->forum['username']}!");
			}*/
			
			$this->user = Model::factory('user');
			$this->hardcore = $this->user->hardcore_data($this->forum['uid']);
			
			if (!$this->user->user_exists($this->forum['uid']))
			{
				$this->user->create_user($this->forum['uid'], $this->forum['username']);
			}
			
			$this->rank = $this->user->rank($this->hardcore['manliness_rank'], $this->hardcore['richliness_rank'], $this->hardcore['id']);
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
			$this->template->songs = shuffle(array(
			 		"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m1.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m2.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m4.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m1.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m5.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m6.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m7.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m8.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e1m9.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m1.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m2.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m3.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m4.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m6.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m7.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e2m8.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e3m1.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e3m2.ogg'></a>",
 					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e3m3.ogg'></a>",
  					"<a href='http://arflux-rpg.com/game/inc/sounds/doom/d_e3m8.ogg'></a>",
			));
		}
	
		public function action_submit()
		{	
			require_once '/home/arflux-rpg/public_html/game/inc/session.php';
			$forum = $MyBBI->getUser();
			
			$this->template = View::factory('hardcore_enemy_submit');
			$this->template->username = $forum['username'];
		}
	}