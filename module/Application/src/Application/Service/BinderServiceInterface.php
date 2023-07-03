<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Entity\Binder;

 interface BinderServiceInterface
 {
     /**
      * Should return a set of all Binder Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Entity\Binder
      *
      * @return array|Binder[]
      */
     public function findAllBinder();

     /**
      * Should return a single Binder 
      *
      * @param  int $id Identifier of the Binder that should be returned
      * @return Binder 
      */
     public function findBinder($id);
 }
