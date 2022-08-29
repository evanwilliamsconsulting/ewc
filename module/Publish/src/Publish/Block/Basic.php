<?php

class NHP_Helper_Basic extends Zend_View_Helper_Abstract
{

	public $content;
	public $style;

	public function __construct($style,$content)
	{
		$this->style = $style;
		$this->content = $content;
	}
	public function getStyle()
	{
		return $this->style;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function setContent($content)
	{
		$this->content = $content;
	}
	public function setStyle($style)
	{
		$this->style = $style;
	}
}
