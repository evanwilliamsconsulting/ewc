<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Entity\Product;

 interface WordageServiceInterface
 {
     /**
      * Should return a set of all Product Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Entity\Product
      *
      * @return array|Product[]
      */
     public function findAllProduct();

     /**
      * Should return a single Product 
      *
      * @param  int $id Identifier of the Product that should be returned
      * @return Wordage
      */
     public function findProduct($id);
 }
