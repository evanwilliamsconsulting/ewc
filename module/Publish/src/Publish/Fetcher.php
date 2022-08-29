<?php

namespace Publish;

use Zend\Http\Client;
use Zend\Http\Request;
/*
 https://sourcemaking.com/design_patterns/singleton/php/1
*/
class Fetcher
{
    protected static $fetcher;
    protected static $initialized;
    protected static $baseURI;
    protected static $frag;
    protected static $urlPart;

   private function __construct()
   {
   		  self::$frag = array();
	      self::$frag[] ="";
	      self::$urlPart = "";
   } 
    static function retrieveFetcher() 
    { 
        if (FALSE == self::$initialized)
        { 
            if (NULL == self::$fetcher)
            { 
                self::$fetcher = new Fetcher(); 
            } 
            self::$initialized = TRUE; 
            return self::$fetcher; 
        } 
        else 
        { 
            return self::$fetcher;
        } 
    }
   public function getSnapshot()
   {
	      return $this->snapshot;
   }
    public function fetch()
    {
        $base = $this->getBaseURI();
        $frag = $this->getFrag();
        $urlPart = self::$urlPart;

        $uri = $base . $urlPart . '/json';
		$this->uri =$uri;
        
        $request = new Request();
        $request->setUri($uri);
		
        $client = new Client();
		
        $client->setMethod(REQUEST::METHOD_GET);
        $client->setOptions(array('timeout'=>120));
		
        $response = $client->send($request);

        $this->snapshot = $response->getBody();
		
        return TRUE;
    }
    public function setBaseURI($uri)
    {
      	self::$baseURI = $uri;
    }
    public function getBaseURI()
    {
        return self::$baseURI;
    }
    public function addFrag($frag)
    {
    	self::$frag = array();
    	//
    	//
    	self::$urlPart = "";
	    self::$frag[] = $frag;
	    self::$urlPart = implode(self::$frag,'/');
    }
    public function pushFrag($frag)
    {
    	self::$frag[] = $frag;
    	self::$urlPart = implode(self::$frag,'/');
    	
    }
    public function popFrag()
    {
    	$fragArray = self::$frag;
  		$lastElement = $fragArray[count($fragArray)-1];
    	$fragArray = array_slice($fragArray,0,-1);
    	self::$frag = $fragArray;
    	return $lastElement;
    }
    public function getFrag()
    {
	        return self::$frag;
    }
    public function clearFrags()
    {
    		self::$frag = array();
    		self::$urlPart = "";
    }
}
