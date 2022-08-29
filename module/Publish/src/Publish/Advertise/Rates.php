<?php

class NHP_Advertise_Rates extends Zend_View_Helper_Abstract
{
	public $view;
	public $output;
	public $results_top;
	public $container;
	public $results_left;
	public $emptyArray;

	public function render()
	{
		$logger = Zend_Registry::get('logger');
		return $this->view->partial('partial/rates.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
