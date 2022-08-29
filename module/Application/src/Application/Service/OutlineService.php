<?php
namespace Application\Service;

use Application\Entity\Outline;

class OutlineService implements OutlineServiceInterface
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
     public function findAllOutline()
     {
         // TODO: Implement findAllWordage() method.
        $em = $this->getEntityManager();
		
		$outline = $em->getRepository('Application\Entity\Outline')->findAll();
		
		return $outline;
     }

     /**
      * {@inheritDoc}
      */
     public function findOutline($id)
     {
         // TODO: Implement findWordage() method.
     }
}
