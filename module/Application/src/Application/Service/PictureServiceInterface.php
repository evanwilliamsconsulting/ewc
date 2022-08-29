<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Entity\Picture;

 interface WordageServiceInterface
 {
     /**
      * Should return a set of all Picture Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Entity\Picture
      *
      * @return array|Picture[]
      */
     public function findAllPicture();

     /**
      * Should return a single Picture 
      *
      * @param  int $id Identifier of the Picture that should be returned
      * @return Picture 
      */
     public function findPicture($id);
 }
