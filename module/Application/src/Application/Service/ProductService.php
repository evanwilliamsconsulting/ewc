<?php
namespace Application\Service;

use Application\Entity\Product;

class ProductService implements ProductServiceInterface
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
     public function findAllProduct()
     {
         // TODO: Implement findAllProduct() method.
        $em = $this->getEntityManager();
		
		$product = $em->getRepository('Application\Entity\Product')->findAll();
	
		return $product;
     }

     /**
      * {@inheritDoc}
      */
     public function findProduct($id)
     {
         // TODO: Implement findProduct() method.
     }
}
