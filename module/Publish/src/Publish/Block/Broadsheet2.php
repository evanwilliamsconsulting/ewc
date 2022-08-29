<?php

class NHP_Helper_Broadsheet2 extends Zend_View_Helper_Abstract
{
	public $view;

	public function broadsheet($broadsheet)
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Broadshseet Helper");
		$details=print_r($broadsheet,true);
		$logger->info($details);
		$this->view->pagename = $broadsheet['Broadsheet'];
		$items = $broadsheet['Items'];
		$newitems=Array();
		$height=0;
		$top = 0;
		$left = 0;
		$width = 0;
		$t = 0;
		$l = 0;
                $topBounds = 0;
		$leftBounds = 0;
		$widthBounds = 0;
		$heightBounds = 0;
		$ttbird = 0;
		$llbird = 0;
		$ttold = 0;
		$llold = 0;
		$tt = 0;
		$t = 0;
		$ll = 0;
		$l = 0;
		$bTop = $tt;
		$bLeft = $ll;	
		$bWidth = 0;
		$bHeight = $tt;
		$pWidth = 0;
		$pHeight = 0;
		$itemArray = Array();
		foreach ($items as $key => $item)
		{
			$logger->info(print_r($item,true));
			foreach ($item as $key2 => $item2)
			{
			    if (0==strcmp($key2,"Container"))
			    {
				$logger->info("Container");
				$logger->info(print_r($item2,true));
				$containerHelper = new NHP_Helper_Container();
				$containerHelper->setView($this->view);
				$container = $containerHelper->container($item2,$tt,$ll);
				$ttold = $ttbird;
				$llold = $llbird;
				$newitems[]=$container;
				$pWidth = $width;
				$pHeight = $height;
				$height=$containerHelper->getHeight();
				$width=$containerHelper->getWidth();
				$subArray=Array('top'=>$tt,'left'=>$llbird,'height'=>$height,'width'=>$width,'item'=>$item2);
				$tt += $height;
				$itemArray[]=$subArray;
			    }
			}
		}
		$logger->info($newitems);
		$top=10;
		$left=10;
		$style = "position:absolute;";
		$style .= "top:";
		$style .= $top;
		$style .= "px;left:";
		$style .= $left;
		$style .= "px;";
		$this->view->items = $newitems;
		$style2 = "position:absolute;top:60px;left:60px;height:";
		$style2 .= $bHeight;
		$style2 .= "px;width:";
		$style2 .= $bWidth;
		$style2 .= "px;border-style:none;border-width:1px;border-color:blue;";
		$logger->info($style2);
		$this->view->style2 = $style2;
		return $this->view->partial('partial/broadsheet.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}

?>
