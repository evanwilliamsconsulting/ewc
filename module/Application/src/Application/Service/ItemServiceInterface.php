<?php
//  http://framework.zend.com/manual/current/en/in-depth-guide/services-and-servicemanager.html

 namespace Application\Service;

 use Application\Model\Item;

 interface ItemServiceInterface
 {
 	 /**
      * {@inheritDoc}
      */
     /**
      * Should return a set of all Wordage Items that we can iterate over. Single entries of the array are supposed to be
      * implementing \Application\Model\Item
      *
      * @return array|Items[]
      */
     public function findAllItems();

     /**
      * Should return a single Item
      *
      * @param  int $id Identifier of the Item that should be returned
      * @return Item
      */
     public function findItems($id);
 
}