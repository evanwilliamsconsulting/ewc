<?php

class NHP_Consulting_Links extends Zend_View_Helper_Abstract
{
	protected $_logout;
	protected $_login;
	public function linkHelper()
	{
	    $html="<div>";
	    if (!$this->_login)
		{
		    if ($this->_logout)
		    {
		        $html = "<a class='loginlink' href='/index/login'>Login</a>";
		    }
		    else
		    {
		        $html = "<a class='loginlink' href='/index/index'>Logout</a>";
	            }
		}
	    $html .= "</div>";
	    return $html;
	}
	public function logout($logout)
	{
		$this->_logout=$logout;
	}
	public function login($login)
	{
		$this->_login=$login;
	}
}

?>
