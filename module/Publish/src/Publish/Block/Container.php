<?php
namespace Publish\Block;

use Zend\View\Helper\AbstractHelper;
use Publish\BlockHelper as BlockHelper;
use Publish\Block\Element\RichColumn as RichColumn;
use Publish\Block\Element\Headline as Headline;
use Publish\Block\Element\Pix as Pix;
use Publish\Block\Element\PixLink as PixLink;
use Publish\Block\Element\TextColumn as TextColumn;

class Container extends BlockHelper
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
	
	public function __construct()
	{
	    //$this->frag = $frag;
	    //parent::setFrag($frag);
	}
	public function setName($name)
	{
	    parent::setFrag($name);
	}
	public function getTop()
	{
		return $this->top;
	}
	public function getLeft()
	{
		return $this->left;
	}
	public function getHeight()
	{
		return $this->height;
	}
	public function getWidth()
	{
		return $this->width;
	}
	public function fetch()
	{
		parent::fetch();
		$container = json_decode(parent::getSnapshot());
		$this->container = $container->containers;
	}
	public function toHTML()
	{
		$this->fetch();
		
		$returnHTML = "<div>";
		$items = $this->container;
		foreach ($items as  $key => $item)
		{
			$returnHTML .= "<div>";
			$name = $item->name;
			$type = $item->type;
			//$returnHTML .= $name;
			$uri = parent::getBaseURI();
			switch ( $type )
			{
				case "RichColumn";
					$element = new RichColumn();
					break;
				case "TextColumn":
					$element = new TextColumn();
					break;
				case "Pix":
					$element = new Pix();
					break;
				case "PixLink":
					$element = new PixLink();
					break;
				case "Headline":
					$element = new Headline();
					break;
				default:
					$element = new Element();
			}
			$element->setName($name);
			//$returnHTML .= "<br/>ELEMENT BEGINS";
		    $returnHTML .= $element->toHTML();
		    //$returnHTML .= "ELEMENT ENDS<br/>";
		    //$returnHTML .= print_r($uri,true);
		    $returnHTML .= "</div>";
		}
		$returnHTML .= "</div>";
		return $returnHTML;
	}
	
}

?>
