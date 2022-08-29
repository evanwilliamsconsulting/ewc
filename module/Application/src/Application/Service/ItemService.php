<?php
namespace Application\Service;

use Application\Model\Item as Item;

class ItemService implements ItemServiceInterface
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
     public function findAllItems()
     {
     	$this->em = $this->getEntityManager();
         // TODO: Implement findAllItems() method.
        $item = new Item($em);
        //$em = $this->getEntityManager();
		
		//$wordage= $em->getRepository('Application\Entity\Wordage')->findAll();
		
		//return $wordage;
		return $item->toArray();

     /**
      * {@inheritDoc}
      */
     public function findItems($id)
     {
         // TODO: Implement findItems() method.
     }
}
