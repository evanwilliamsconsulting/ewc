<?php
namespace Publish\Block\Element;

use Zend\View\Helper\AbstractHelper;
use Publish\Block\Element as Element;

class Headline extends Element
{
	protected $headline;
	protected $isItalic;
	protected $fontSize;
	protected $attributes;
	
	public function toHTML()
	{
		parent::fetch();
	
		$element = parent::getElement();
		$this->attributes = $element->attributes;
		$this->headline = $this->attributes->Headline;
		$this->isItalic = $this->attributes->italic;
		$this->fontSize = $this->attributes->Fontsize;
		$returnHTML = "<div style='>";
		$returnHTML .= "font-size:";
		$returnHTML .= $this->fontSize;
		$returnHTML .= ";color:black;font-weight:bold;";
		if ($this->isItalic)
		{
			$returnHTML .= "font-style:italic;";
		} else {
			$returnHTML .= "font-style:normal;";
		}
		$returnHTML .= "'>";
		$returnHTML .= $this->headline;
		//$returnHTML .= print_r($this->attributes,true);
		$returnHTML .= "</div>";
	
		return $returnHTML;
	}
	
}