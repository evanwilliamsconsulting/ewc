<?php

class NHP_Issue
{
	public $issueName;
	public $libraryName;
	public $libraryPages;
	
	public function setLibraryName($libraryName)
	{
		$this->libraryName=$libraryName;
	}
	public function setIssueName($issueName)
	{
		$this->issueName = $issueName;
	}
	public function retrievePages()
	{
	    $clientURI = "http://nhpress.net/";
	    $clientURI .= $this->libraryName;
	    $clientURI .= '/';
	    $clientURI .= $this->issueName;
	    $clientURI .= '/json';
	    $client = new Zend_Http_Client($clientURI);
	    $response = $client->request('GET');	
	    $jsonResponse = json_decode($response->getBody());
	    $pages=$jsonResponse->Pages;
	    $pagesArray=Array();
	    foreach ($pages as $key => $issue)
	    {
		$pagesArray[$key]=$issue;
	    }
	    asort($pagesArray);
	    $this->libraryPages = $pagesArray;
	}
	public function getLibraryPages()
	{
	    return $this->libraryPages;
	}
}
