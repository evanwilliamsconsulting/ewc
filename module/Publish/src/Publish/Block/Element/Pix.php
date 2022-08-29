<?php
namespace Publish\Block\Element;

use Zend\View\Helper\AbstractHelper;
use Publish\Block\Element as Element;

class Pix extends Element
{
	protected $pixpath;
	protected $attributes;
	
	
	public function toHTML()
	{
		parent::fetch();
		
		$element = parent::getElement();
		$this->attributes = $element->attributes;
		$this->pixpath = $this->attributes->pixpath;
		$returnHTML = "<div>";
		$returnHTML .= "<img src='";
		$returnHTML .= $this->pixpath;
		$returnHTML .= "'/>";
		//$returnHTML .= print_r($this->attributes,true);
		$returnHTML .= "</div>";
		
		return $returnHTML;
	}
}