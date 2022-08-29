<?php
namespace Application\Service;

use Application\Entity\Headline;

class HeadlineService implements HeadlineServiceInterface
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
     public function findAllHeadlines()
     {
         // TODO: Implement findAllWordage() method.
        $em = $this->getEntityManager();
		
		$wordage = $em->getRepository('Application\Entity\Headlines')->findAll();
		
		return $wordage;
     }

     /**
      * {@inheritDoc}
      */
     public function findHeadlines($id)
     {
         // TODO: Implement findHeadlines() method.
     }
}
