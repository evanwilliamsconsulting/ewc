<?php

class NHP_Advertise_Items extends Zend_View_Helper_Abstract
{
	public $view;
	public $output;
	public $results_top;
	public $container;
	public $results_left;
	public $emptyArray;

	public function advertise($ads)
	{
		$logger = Zend_Registry::get('logger');
		$logger->info($ads);
		$output = Array();
		foreach ($ads as $key => $value)
		{
			$pixHelper = new NHP_Helper_Pix($value);
			$pixHelper->setView($this->view);
			$attributes=$value['attributes'];
			$width=$attributes['width'];
			$height=$attributes['height'];
			$content = $pixHelper->pix($attributes['pixpath'],$key,$width,$height);
			
			$style = "border-style:none;border-color:yellow;border-width:3px;position:relative;float:right;";
			$output[]=new NHP_Helper_Basic($style,$content);
		}
		$this->output=$output;
	}
	public function gotIt() {
		$this->view->output = $this->output;
		return $this->view->partial('partial/advertise.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
