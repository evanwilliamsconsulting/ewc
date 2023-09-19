<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class ActionToolbar extends AbstractHelper
{
    protected static $state;
    protected $loggedIn = false;
    protected $username;

    public function __invoke()
    {
    	// This top id is rendered separately
    	// we can rename it and keep it going!
    	//$actionToolbarHTML = "<div id='site_toolbar' class='toolbar'>";
	//$actionToolbarHTML = "<ul class='sitelist'>";
	if (!($this->loggedIn))
	{
		$actionToolbarHTML = "<li class='action_item light'></li>";
	}
	else
	{
		$actionToolbarHTML = "<li class='action_item light'><a href='#' onclick='showFileSub();'>File</a></li>";
		$actionToolbarHTML .= $this->fileSubMenu();
		$actionToolbarHTML .= "<li class='action_item light'><a href='#' onclick='showEditSub();'>Edit</a></li>";
		$actionToolbarHTML .= "<li class='action_item light'><a href='#' onclick='showViewSub();'>View</a></li>";
		$actionToolbarHTML .= "<li class='action_item light'><a href='#' onclick='showToolsSub();'>Tools</a></li>";
		$actionToolbarHTML .= "<li class='action_item light'><a href='#' onclick='showHelpSub();'>Help</a></li>";
	}
	return $actionToolbarHTML;
    }
    public function fileSubMenu()
    {
	$subMenu = "<div id='file_sub' class='hidden'>";
	$subMenu .= "<span id='file_new_wordage_menu' class='action_item'><a href='/correspondant/add?type=Wordage'>New Wordage</a></span>";
	$subMenu .= "<br/>";
	$subMenu .= "<span id='file_new_outline_menu' class='action_item'><a href='/correspondant/add?type=Outline'>New Outline</a></span>";
	$subMenu .= "<br/>";
	$subMenu .= "<span id='file_new_outline_menu' class='action_item'><a href='/correspondant/add?type=Picture'>New Picture</a></span>";
	$subMenu .= "</div>";
	return $subMenu;
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
