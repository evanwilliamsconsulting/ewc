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
		$siteToolbarHTML .= "<a href='/index/index'><li class='sitetab bright'>Home</li></a>\n";
		$siteToolbarHTML .= "<a href='/index/products'><li class='sitetab bright'>Products</li></a>\n";
		$siteToolbarHTML .= "<a href='/index/services'><li class='sitetab bright'>Services</li></a>\n";
		$siteToolbarHTML .= "<a href='/index/contact'><li class='sitetab bright'>Contact</li></a>\n";
		$siteToolbarHTML .= "<a href='/auth/signup'><li class='sitetab bright'>Sign Up!</li></a>\n";
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
