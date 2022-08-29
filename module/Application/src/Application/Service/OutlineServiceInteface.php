<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Entity\Outline;

 interface OutlineServiceInterface
 {
     /**
      * Should return a set of all Outline Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Entity\Outline
      *
      * @return array|Outline[]
      */
     public function findAllOutline();

     /**
      * Should return a single Outline 
      *
      * @param  int $id Identifier of the Outline that should be returned
      * @return Outline 
      */
     public function findOutline($id);
 }
