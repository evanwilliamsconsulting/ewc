<?php

class NHP_Helper_PageTurn extends Zend_View_Helper_Abstract
{
	public $view;
	public $currentPage;
	public $availablePages;
	public $issue;
	public $baseUrl;

	public function page()
	{
		$logger=Zend_Registry::get("logger");
		$logger->info("Page Turner Helper");
		$availablePages=$this->availablePages;
		$this->view->currentPage=$availablePages[$this->currentPage];
		$this->view->availablePages = $this->availablePages;
		$this->view->issue=$this->issue;
		$this->view->baseUrl = $this->baseUrl;
		$this->view->currentPageNo = $this->currentPage;
		return $this->view->partial('partial/pageturn.xhtml');
	}
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
	public function setCurrentPage($currentPage)
	{
		$this->currentPage = $currentPage;
	}
	public function setAvailablePages($pages)
	{
		$availablePages=Array();
		foreach ($pages as $pagename => $pageno)
		{
			$availablePages[$pageno]=$pagename;
		}
		$this->availablePages=$availablePages;
	}
	public function setIssue($issue)
	{
		$this->issue = $issue;
	}
	public function setBaseUrl($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}
}

?>
