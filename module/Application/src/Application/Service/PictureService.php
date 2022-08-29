<?php
namespace Application\Service;

use Application\Entity\Picture;

class PictureService implements PictureServiceInterface
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
    public function findAllPicture()
    {
         // TODO: Implement findAllPicture() method.
        $em = $this->getEntityManager();
		
        $picture = $em->getRepository('Application\Entity\Picture')->findAll();
		
        return $picture;
     }

     /**
      * {@inheritDoc}
      */
     public function findPicture($id)
     {
         // TODO: Implement findPicture() method.
     }
}
