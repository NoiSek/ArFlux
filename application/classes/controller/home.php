<?php defined('SYSPATH') OR die('No Direct Script Access');
 
Class Controller_Home extends Controller_Template
{
    public $template = 'home';
 
    public function action_index()
    {
        $this->template->username = 'Captain-Lightning!';
    }
}