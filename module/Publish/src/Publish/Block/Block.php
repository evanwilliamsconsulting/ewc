<?php

class NHP_Helper_Block extends Zend_View_Helper_Abstract
{
	public $view;

	public function block($block)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Block Helper");
		$details=print_r($block,true);
		$logger->info($block);
		$blk=$block['Block'];
		$top=$block['top'];
		$left=$block['left'];
		foreach ($blk as $key => $value)
		{
			foreach ($value as $k => $v)
			{
				if (0==strcmp($k,'elements'))
				{
					$pixpath=$v['attributes']['pixpath'];	
				}
			}
		}
		$this->view->left = $left;
		$this->view->top = $top;
		$style = "position:absolute;top:". $top ."px;left:".$left."px;";
		$this->view->style = $style;
		$this->view->adpath=$pixpath;
		return $this->view->partial('partial/block.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
