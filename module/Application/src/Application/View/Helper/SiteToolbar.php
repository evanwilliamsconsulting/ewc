<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class SiteToolbar extends AbstractHelper
{
    protected static $state;
    protected $loggedIn;
    protected $username;

    public function __invoke()
    {
    	// This top id is rendered separately
    	// we can rename it and keep it going!
    	//$siteToolbarHTML = "<div id='site_toolbar' class='toolbar'>";
		//$siteToolbarHTML = "<ul class='sitelist'>";
		$siteToolbarHTML = "";
		$siteToolbarHTML .= "<li class='sitetab bright'><a href='/index/index'>Home</a></li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'><a href='/index/products'>Products</a></li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'><a href='/index/services'>Services</a></li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'><a href='/index/contact'>Contact</a></li>\n";
		$siteToolbarHTML .= "<li class='sitetab bright'><a href='/auth/signup'>Sign Up!</a></li>\n";
		return $siteToolbarHTML;
    }
    public function setState()
    {
        $this->state = true;
    }
    public function clearState()
    {
        $this->state = false;
    } 
    public function setLoggedIn($loggedIn)
    {
	$this->loggedIn = $loggedIn;
    }
    public function setUserName($username)
    {
	$this->username=$username;
    }
}
?>
