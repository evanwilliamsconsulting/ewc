<?php

class NHP_Helper_Item
{
	public $view;

	public function item($item)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("HELPER");
		$details=print_r($item,true);
		$logger->info($details);
		return "TEST";
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
