<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
 
class Welcome extends AbstractHelper
{
    protected static $state;

    public function __invoke()
    {
	$userSession = new Container('user');
        if (!isset($userSession->loggedin))
        {
            return "<a href='http://dev.newhollandpress.com/auth/login'>Login</a>";
	}
        else
        {
	    $username = $userSession->username;
	    $retval = "Welcome&nbsp;" . $username;
	    $retval .= "&nbsp;<a href='http://dev.newhollandpress.com/auth/login/logout'>Logout</a>";
	    return $retval;
        }
    }
}
?>
