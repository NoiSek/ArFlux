<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_Main extends Controller_Template
{
    public $template = 'main';
 
    public function action_index()
    {
    	/*
		 * Include MyBB integrator, as session.php
		 * Located in /game/inc/session.php
		 * Var called $MyBBI is the default value.
		*/
		require_once '/home/arflux-rpg/public_html/game/inc/session.php';

		$forum = $MyBBI->getUser();
        $this->template->username = $forum['username'];
    }
}