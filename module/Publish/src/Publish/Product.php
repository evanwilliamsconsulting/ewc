<?php

class NHP_Product
{
	public $type;
	public $id;
	
	public function setType($typeName)
	{
		$this->type=$typeName;
	}
	public function getType()
	{
		return $this->type;
	}
	public function getProduct($id,$typename,$uriNhpress)
	{
	    $clientURI = "http://nhpress.net/";
	    $clientURI .= $uriNhpress;
	    $clientURI .= '/schema';
	    $client = new Zend_Http_Client($clientURI);
	    $response = $client->request('GET');	
	    $jsonResponse = json_decode($response->getBody());
	    $schema=$jsonResponse->schema;
	    $article = Array();
	    $issueArray=Array();
	    foreach ($issues as $key => $issue)
	    {
		$issueArray[$key]=$issue;
	    }
	    ksort($issueArray);
	    $this->libraryIssues= $issueArray;
	}
	public function getLibraryIssues()
	{
	    return $this->libraryIssues;
	}
	public function getLatestIssue()
	{
	    $issueArray = $this->libraryIssues;
	    foreach ($issueArray as $key => $issue)
	    {
	        $latestIssue = $issue;
	    }
	    return $latestIssue;
	}
}
