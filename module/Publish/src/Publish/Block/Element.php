<?php
namespace Publish\Block;

use Zend\View\Helper\AbstractHelper;
use Publish\BlockHelper as BlockHelper;

class Element extends BlockHelper
{
	public $view;
	public $output;
	public $results_top;
	public $results_left;
	public $emptyArray;
	public $broadsheet;
	public $name;
	public $position;
	public $items;
	public $container;
	public $frag;
	public $testHeadline = false;
	public $element;
	public $top;
	public $left;
	public $width;
	public $height;
	public $resetY;
	public $resetX;
	public $glueY;
	public $glueX;
	public $fleft;
	public $ftop;
	public $style;
	public $content;

	public function setName($name)
	{
		parent::pushFrag($name);
	}
	public function getStyle()
	{
		return $this->style;
	}
	public function setStyle($style)
	{
		$this->style = $style;
	}
	public function getTop()
	{
		return $this->top;
	}
	public function isHeadline()
	{
		return $this->testHeadline;
		
	}
	public function getResetY()
	{
		return $this->resetY;
	}
	public function getLeft()
	{
			return $this->left;
	}
	public function getFutureLeft()
	{
		return $this->fleft;
	}
	public function getFutureTop()
	{
		return $this->ftop + $this->top;
	}
	public function getWidth()
	{
		return $this->width -100;
	}
	public function getHeight()
	{
		return $this->height;
	}
	public function getGlueY()
	{
		return $this->glueY;
	}
	public function fetch()
	{
		parent::fetch();
		$element = json_decode(parent::getSnapshot());
		$this->element = $element;
	}
	public function getElement()
	{
		return $this->element;
	}
	public function getBaseURI()
	{
		return parent::getBaseURI();
	}
	public function popLastFragment()
	{
		parent::popLastFragment();
	}
	public function toHTML()
	{
		$this->fetch();
	
		$returnHTML = "<div>";
		$element = $this->element;
		$returnHTML .= print_r($element,true);
		$uri = parent::getBaseURI();
		$returnHTML .= print_r($uri,true);
		$returnHTML .= "</div>";
		
		return $returnHTML;
	}
	public function setElement($element)
	{
		$this->element=$element;
		$logger=Zend_Registry::get("logger");
		$logger->info("Element Helper");
		$logger->info($element);
		$details=$element['elements'];
		$this->resetX = $details['resetX'];
		$this->glueX = $details['glueX'];
		$this->glueY = $details['glueY'];
		$this->resetY = $details['resetY'];
		$logger->info($details);
		$width = $details['width'];
		$height = $details['height'];
		$logger->info("Width");
		$logger->info($width);
		$this->width=$width;
		$this->height=$height;
		$this->testHeadline=false;
		if (isset($element['attributes']))
		{
			$details = print_r($element['attributes'],true);
			$attributes= $element['attributes'];
			if (isset($attributes['Headline']))
			{
				$headlineHelper = new NHP_Helper_Headline();
				$headlineHelper->setView($this->view);
				$fontSize = $attributes['Fontsize'];
				$width = strlen($headline)*$fontSize*100;
				$headlineHelper->headline($attributes['Headline']);	
				$this->height+=$fontSize;
				$headline=$attributes['Headline'];
				$this->testHeadline=true;
				$this->isHeadline=true;
				$details=$headlineHelper->getContent();
			}
			if (isset($attributes['pixpath']))
			{
				$pixHelper = new NHP_Helper_Pix();
				$pixHelper->setView($this->view);
				$width=$attributes['width'];
				$height=$attributes['height'];
				$this->height=$height;
				$details = $pixHelper->pix($attributes['pixpath'],$attributes['caption'],$width,$height);
				$this->height=$attributes['height'];
				$width=$attributes['width'];
				if ($width > $this->width)
				{
					$this->width=$width;
				}
				$this->isHeadline=false;
			}
		}
		if (isset($element['lines']))
		{
			$charsPerLine=$element['charsPerLine'];
			$width=5.5*$charsPerLine;
			$this->top=$top;
			$this->width=$width;
			if (isset($element["TextColumn"]))
			{
				$articleHelper = new NHP_Helper_Text();
			} else {
				$articleHelper = new NHP_Helper_Rich();
			}
			$articleHelper->setView($this->view);
			$details = $articleHelper->rich($element['lines'],$element['elements']);
			$numberOfLines=count($element['lines']);
			$displayNumberOfLines = 'Number Of Lines: ' . $numberOfLines;
			$logger->info($displayNumberOfLines);
			
				$this->height= 30 * $numberOfLines;
				$this->width = $width;
		}
		$logger->info($details);
		$this->view->element=$details;
		$style="position:relative;";

		$style.="background-color:white;vertical-align:bottom;";

		$style.="margin:10px;padding:10px;";
		$logger->info($style);
		$this->view->style=$style;

		$this->content=$this->view->partial('partial/element.xhtml');
	}
	public function getContent()
	{
		return $this->content;
	}
}

?>
