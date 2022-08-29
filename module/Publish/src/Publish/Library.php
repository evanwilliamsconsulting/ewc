<?php

class NHP_Library
{
	public $libraryName;
	public $libraryIssues;
	
	public function setLibraryName($libraryName)
	{
		$this->libraryName=$libraryName;
	}
	public function getLibraryName()
	{
		return $this->libraryName;
	}
	public function retrieveIssues()
	{
	    $clientURI = "http://nhpress.net/Summer2014";
	    $cacheHandle = $this->libraryName;
	    $cacheHandle .= "A";
	    $clientURI .= '/json';
	    $cache = Zend_Registry::get('cache');
	    $logger = Zend_Registry::get('logger');
	    $logger->info($cacheHandle);
	    $logger->info($clientURI);
	    return;
	    if (!$responseBody = $cache->load($cacheHandle))
	    {
		    $client = new Zend_Http_Client($clientURI);
		    $client->setConfig(array('timeout' => '120'));
		    $logger->info($clientURI);
		    $response = $client->request('GET');	
		    $responseBody = $response->getBody();
		    $cache->save($responseBody,$cacheHandle);
	    }
	    else
	    {
		    $logger->info('Cache Handle');
	    }
	    $jsonResponse = json_decode($responseBody);
	    $issues=$jsonResponse->Issues;
		$logger->info($issues);
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
