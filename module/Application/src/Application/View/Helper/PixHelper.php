<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\View\Renderer\RendererInterface as Renderer;

use Zend\View\Model\ViewModel as ViewModel;
 
class PixHelper extends AbstractHelper
{
    protected static $state;
	protected $pixObject;
	protected $username;
	protected $itemId;
	public $view;

    public function setView(Renderer $view)
	{
		$this->view = $view;
	}
	public function setPixObject($pixObject)
	{
		$this->pixObject = $pixObject;
	}
	public function setUsername($username)
	{
		$this->username = $username;
	}
	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
	}
    public function __invoke()
    {
    	$view = $this->view;
    	$pixObject = $this->pixObject;
		$id = $pixObject->getId();
		$title = $pixObject->getTitle();
		$pixname = $pixObject->getPicture();
		$filepix = "/usr/local/apache2/html/uploads/";
		$filepix .= $this->username;
		$filepix .= "/pix/";
		$pix = $filepix . $pixname;
		// Check to see that the thumbnail exists.
		$thumbPixName = "large_" . $pixname;
		$thumbPix = $filepix . $thumbPixName;
		if (!file_exists($thumbPix)) 
		{
			$img = imagecreatefromjpeg($pix);
			$width = imagesx($img);
			$height = imagesy($img);
			$whlog = "width: " . $width . " height " . $height;
				
			//determine which side is the longest to use in calculating length of the shorter side, since the longest will be the max size for whichever side is longest.    
			if ($height > $width) 
			{   
				$ratio = 160 / $height;  
				$newheight = 160;
				$newwidth = $width * $ratio; 
			}
			else 		
			{
				$ratio = 160 / $width;   
				$newwidth = 160;  
				$newheight = $height * $ratio;   
			}


			$whlog = "newwidth: " . $newwidth . " newheight " . $newheight;
			//create new image resource to hold the resized image
			$newimg = imagecreatetruecolor($newwidth,$newheight); 
			

			$palsize = ImageColorsTotal($img);  //Get palette size for original image
			for ($i = 0; $i < $palsize; $i++) //Assign color palette to new image
			{ 
				$colors = ImageColorsForIndex($img, $i);   
				ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
			} 

			//copy original image into new image at new size.
			imagecopyresized($newimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


			imagejpeg($newimg,$thumbPix); //$output file is the path/filename where you wish to save the file.
			
		}
		$base = 'https://dev.newhollandpress.com/pix/view/';
		$base .= urlencode($id);
		
		return $view->partial("/items/pix.phtml");
		
		/*
    	$output = "<div id='" . $this->itemId . "' class='itemHelper_Wide'>";
		$output .= "<ul>";
		$output .= "<li>";
		$output .= "<span>Pix</span>";
		$output .= "</li>";
		$output .= "<li>";
		$output .= "<a href='" . $base . "'>" . $id . "</a>";
		$output .= "</li>";
		$output .= "<li>";
		$output .= $pixObject->getPicture();
		$output .= "</li>";
		$output .= "<li>";
		$output .= "<img src='https://dev.newhollandpress.com/uploads/";
		$output .= $this->username;
		$output .= "/pix/";
		$output .= $thumbPixName;
		$output .= "'>";
		$output .= "</li>";
		$output .= "</ul>";
		$output .= "</div>";
		
		return $output;
		 * 
		 */
    }
}
?>
