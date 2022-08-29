<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class IssueToolbar extends AbstractHelper
{
    public function __invoke()
    {
    	$retval = "<div id='issuetoolbar'>";
	$retval .= "<ul class='itemlist'>";
	$retval .= "<li class='itemtab'><a href='/issue/index?new=issue'>New Issue</a></li>";
	$retval .= "</ul>";
	$retval .= "</div>";
        return $retval;
    }
}
?>
