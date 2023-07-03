<?php
namespace Application\Service;

use Application\Entity\Binder;

class BinderService implements BinderServiceInterface
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
     public function findAllBinders()
     {
         // TODO: Implement findAllWordage() method.
        $em = $this->getEntityManager();
		
		$binders = $em->getRepository('Application\Entity\Binders')->findAll();
		
		return $binders;
     }

     /**
      * {@inheritDoc}
      */
     public function findBinder($id)
     {
         // TODO: Implement findBinder() method.
     }
}
