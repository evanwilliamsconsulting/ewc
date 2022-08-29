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
		$actionToolbarHTML = "";
	}
	else
	{
		$actionToolbarHTML = "<div id='action_menu'>";
		$actionToolbarHTML .= "<span class='action_item'><a href='#' onclick='showFileSub();'>File</a></span>";
		$actionToolbarHTML .= $this->fileSubMenu();
		$actionToolbarHTML .= "<br/>";
		$actionToolbarHTML .= "<span class='action_item'><a href='#' onclick='showEditSub();'>Edit</a></span>";
		$actionToolbarHTML .= "<br/>";
		$actionToolbarHTML .= "<span class='action_item'><a href='#' onclick='showViewSub();'>View</a></span>";
		$actionToolbarHTML .= "<br/>";
		$actionToolbarHTML .= "<span class='action_item'><a href='#' onclick='showToolsSub();'>Tools</a></span>";
		$actionToolbarHTML .= "<br/>";
		$actionToolbarHTML .= "<span class='action_item'><a href='#' onclick='showHelpSub();'>Help</a></span>";
		$actionToolbarHTML .= "</div>";
	}
	return $actionToolbarHTML;
    }
    public function fileSubMenu()
    {
	$subMenu = "<div id='file_sub' class='hidden'>";
	$subMenu .= "<span id='file_new_wordage_menu' class='action_item'><a href='/correspondant/add?type=Wordage'>New Wordage</a></span>";
	$subMenu .= "<br/>";
	$subMenu .= "<span id='file_new_outline_menu' class='action_item'><a href='/correspondant/add?type=Outline'>New Outline</a></span>";
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
