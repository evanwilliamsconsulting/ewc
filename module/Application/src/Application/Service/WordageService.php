<?php
namespace Application\Service;

use Application\Entity\Wordage;

class WordageService implements WordageServiceInterface
{
     /**
      * {@inheritDoc}
      */
    protected $sm;
	protected $em;
	 
    public function __construct($sm)
	{
		$this->sm = $sm;
	}
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->sm->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	    }
	    return $this->em;
    }
     public function findAllWordage()
     {
         // TODO: Implement findAllWordage() method.
        $em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Wordage')->findAll();
		
		return $wordage;
     }

     /**
      * {@inheritDoc}
      */
     public function findWordage($id)
     {
         // TODO: Implement findWordage() method.
     }
}