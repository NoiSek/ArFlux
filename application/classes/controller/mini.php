<?php defined('SYSPATH') OR die('No Direct Script Access');

/*
 * Include MyBB integrator, as session.php
 * Located in /game/inc/session.php
 * Var called $MyBBI is the default value.
 */
;

require_once '/home/arflux-rpg/public_html/game/inc/session.php';
$forum = $MyBBI->getUser(0);


Class Controller_Mini extends Controller_Template
{
    public $template = 'mini';
 
    public function action_index()
    {
        $this->template->username = $forum['username'];
		$this->template->manliness = $mini['manliness'];
		$this->template->money = $mini['money'];
		$this->template->dead = ($mini['dead'] ? true : false);
    }
}