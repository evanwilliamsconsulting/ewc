<?php
namespace Publish\Block\Element;

use Zend\View\Helper\AbstractHelper;
use Publish\Block\Element as Element;

class RichColumn extends Element
{
	protected $totalLines;
	protected $lines;
	protected $attributes;
	
	public function toHTML()
	{
		parent::fetch();
	
		$uri = parent::getBaseURI();
		$element = parent::getElement();
		$this->attributes = $element->attributes;
		$this->totalLines = $this->attributes->totalLines;
		$this->lines = $this->attributes->lines;
		$paragraphs = "<div>";
		$paragraphs .= "<span>";
		foreach($this->lines as $line)
		{
			$currentLine = $line;
			$paragraphs .= $currentLine;
/*			if ($currentLine == "BREAK")
			{
				$paragraphs .= "</span>";
				$paragraphs .= "<br/>";
				$paragraphs = "<span>";
			}
			else 
			{
				$paragraphs .= $currentLine;
			}
			*/
		}
		$paragraphs .= "</span>";
		$paragraphs .= "</div>";
		$returnHTML = "<div>";
		$returnHTML .= $paragraphs;
		//$returnHTML .= print_r($this->lines,true);
		$returnHTML .= "</div>";
	
		return $returnHTML;
	}
	
}
