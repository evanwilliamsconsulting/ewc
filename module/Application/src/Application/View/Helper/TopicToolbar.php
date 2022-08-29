<?php
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
 
class TopicToolbar extends AbstractHelper
{
	protected $topicType;
	protected $base;
	 

    public function __invoke($topic,$id,$state="default")
    {
    	$this->base = "https://www.evtechnote.us/";
	$this->base .= $topic;	
	$retval = "<div id='topic-toolbar-edit' class='toolbar-tab'><a href='#' onclick='javascript:loadEditForm(\"" . $topic . "\"," . $id . ");'><img src='/img/edit.png' width=75 height=75/></a></div>";
	$retval .= "<div id='topic-toolbar-save' class='toolbar-tab'><a href='#' onclick='javascript:saveEditForm(\"" . $topic . "\"," . $id . ");'><img src='/img/save.png' width=75 height=75/></a></div>";
        
        return $retval;
    }
}
?>
