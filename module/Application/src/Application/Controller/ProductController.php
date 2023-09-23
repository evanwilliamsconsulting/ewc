<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @divnk      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @divcense   http://framework.zend.com/divcense/new-bsd New BSD License
 */
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Entity\Product;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\ProductForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\Session\Container;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class ProductController extends AbstractActionController
{
    protected $em;
    protected $authservice;
    protected $username;
    protected $log;
 
    public function __construct()
    {
    }
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function indexAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	// Initiadivze the View
    	$view = new ViewModel();

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$username = $this->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($username);
		}
	}
	else
	{
	       	return $this->redirect()->toUrl($rooturl);
	}

	/* See that! */
        $em = $this->getEntityManager();
	$products = $em->getRepository('Application\Entity\Product')->findAll();

	$product_items = Array();

	foreach ($products as $key => $product)
	{
		$product_item = Array();
		$id = $product->getId();
		$binder_id = $product->getBinderId();
		$title = $product->getTitle();
		$name = $product->getName();
		$description = $product->getDescription();
		$sku = $product->getSku();
		$price = $product->getPrice();
		$product_item[] = $id;
		$product_item[] = $binder_id;
		$product_item[] = $title;
		$product_item[] = $name;
		$product_item[] = $description;
		$product_item[] = $sku;
		$product_item[] = $price;
		$product_items[] = $product_item;
	}
	$html = "<div class='product_table'>";
	$html .=  "<ul class='product_row'>";
	$html .= "<li class='product_id_col'>";
	$html .= "Id";
	$html .= "</li>";
	$html .= "<li class='product_binder_id_col'>";
	$html .= "Binder Id"; 
	$html .= "</li>";
	$html .= "<li class='product_title_col'>";
	$html .= "Title";
	$html .= "</li>";
	$html .= "<li class='product_text_col'>";
	$html .= "Name";
	$html .= "</li>";
	$html .= "<li class='product_text_col'>";
	$html .= "Description";
	$html .= "</li>";
	$html .= "<li class='product_text_col'>";
	$html .= "Sku";
	$html .= "</li>";
	$html .= "<li class='product_text_col'>";
	$html .= "Price";
	$html .= "</li>";
	$html .= "</ul>";
	$html .= "<br/>";
	foreach ($product_items as $key => $item)
	{
		$id = $item[0];
		$binder_id = $item[1];
		$title = strip_tags($item[2]);
		$product_text = strip_tags($item[3]);
		$html .= "<ul class='product_row'>";	
		$html .= "<li class='product_id_col'>";
		$html .= $id;
		$html .= "</li>";
		$html .= "<li class='product_binder_id_col'>";
		$html .= $binder_id;
		$html .= "</li >";
		$html .= "<li class='product_title_col'>";
		$html .= $title;
		$html .= "</li>";
		$html .= "<li class='product_text_col'>";
		$html .= substr($name,0,40);
		$html .= "</li >";
		$html .= "<li class='product_text_col'>";
		$html .= substr($description,0,40);
		$html .= "</li >";
		$html .= "<li class='product_title_col'>";
		$html .= $sku;
		$html .= "</li>";
		$html .= "<li class='product_title_col'>";
		$html .= $price;
		$html .= "</li>";
		$html .= "</ul>";
		$html .= "<br/>";
	}
	$html .= "</div>";

	$view->content = $html;

	return $view;
    }
    public function deleteAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

	// Initiadivze the View
    	$view = new ViewModel();
	$view->setTerminal(true);
	// Retreive the parameters
	$id = $this->params()->fromRoute('item');

	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($username);
		}
	}
	else
	{
	       	return $this->redirect()->toUrl($rooturl);
	}
		
	$em = $this->getEntityManager()	;
	$product = $em->getRepository('Application\Entity\Product')->find($id);
	$em->remove($product);
	$em->flush();
		
	$variables = array("status" => "200",'id'=>$theId);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }

    public function viewAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$userSession = new Container('user'); // Talk about confdivcting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
		}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}
	// Initiadivze the View
    	$view = new ViewModel();
	// Retreive the parameters

	$id = $this->params()->fromQuery("id");

	if (is_null($id))
	{
		$id = 22;
	}
		
	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$username = $this->username;
		$loggedIn = $userSession->loggedin;
		if ($loggedIn)
		{
			// Set the Helpers
			$layout = $this->layout();
			foreach($layout->getVariables() as $child)
			{
				$child->setLoggedIn(true);
				$child->setUserName($username);
			}
		}
		else
		{
	       		return $this->redirect()->toUrl($rooturl);
		}
		
		$em = $this->getEntityManager()	;
		$product = $em->getRepository('Application\Entity\Product')->find($id);
		
		$name = $product->getName();
		$title = $product->getTitle();
		$description = $product->getDescription();
		$sku = $product->getSku();
		$price = $product->getPrice();
		
		$view->name = $name;
		$view->title = $title;
		$view->description = $description;
		$view->sku = $sku;
		$view->price = $price;
		$view->id =$id;
	return $view;
    }
    public function changeAction()
    {

	$changedtext = $this->params()->fromPost('thetext');

	$id = $this->params()->fromRoute('item');
	//$theId = substr($productid,strpos('product-',$productid)+8,strlen($productid));
	$theArray = array('id' => $id);

	$em = $this->getEntityManager();
	$product = $em->getRepository('Application\Entity\Product')->findOneBy($theArray);

	$product->setProduct($changedtext);
	$em->persist($product);
	$em->flush();

	$variables = array("status" => "200",'id'=>$theId,'product'=>print_r($product,true));
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
    public function saveAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$userSession = new Container('user'); // Talk about confdivcting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
		}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}
	// Initialize the View
	$view = new ViewModel();

/*
	$view->setTerminal(true);
*/

	$id = $this->params()->fromQuery("id");
	$from = $this->params()->fromQuery("from");


	if (is_null($from))
	{
		$from = "product";
	}

	$name = $this->getRequest()->getPost('name',null);
	$title = $this->getRequest()->getPost('title',null);
	$description = $this->getRequest()->getPost('description',null);
	$sku = $this->getRequest()->getPost('sku',null);
	$price = $this->getRequest()->getPost('price',null);

	$view->name= $name;
	$view->title = $title;
	$view->description = $description;
	$view->sku= $sku;
	$view->price = $price;

	$em = $this->getEntityManager();
	$product = $em->getRepository('Application\Entity\Product')->find($id);
		
	$product->setName($name);
	$product->setTitle($title);
	$product->setDescription($description);
	$product->setSku($sku);
	$product->setPrice($price);
	$em->persist($product);
	$em->flush();
		
	$view->id =$id;
	
	if (0 == strcmp($from,"correspondant"))
	{
	   return $this->redirect()->toUrl('/correspondant/index');
	}
	else if (0 == strcmp($from,"product"))
	{
	   return $this->redirect()->toUrl('/product/index');
	}
	else
	{
		return $view;
	}
    }
    public function editAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$userSession = new Container('user'); // Talk about confdivcting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
		}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}
	// Initialize the View
	// Retreive the parameters
	$view = new ViewModel();
/*
	$view->setTerminal(true);
*/

	$id = $this->params()->fromQuery("id");
	$from = $this->params()->fromQuery("from");


	if (is_null($from))
	{
		$from = "product";
	}

	$em = $this->getEntityManager();
	$product = $em->getRepository('Application\Entity\Product')->find($id);
	$title = $product->getTitle();
	$name = $product->getName();
	$description = $product->getDescription();
	$sku = $product->getSku();
	$price = $product->getPrice();
		
	$view->title = $title;
	$view->name = $name;
	$view->description = $description;
	$view->sku = $sku;
	$view->price = $price;
	$view->id =$id;
	$view->from = $from;
	return $view;
    }
    public function jsonAction()
    {

	// Retrieve Custom Config
	$config = $this->getServiceLocator()->get('config');
	$settings = $config['settings'];
	$SITEROOT = $settings['SITE_ROOT'];
	$rooturl = 'https://' . $SITEROOT . '/';

    	$userSession = new Container('user'); // Talk about confdivcting names!
	$this->username = $userSession->username;
	$loggedIn = $userSession->loggedin;
	if ($loggedIn)
	{
		// Set the Helpers
		$layout = $this->layout();
		foreach($layout->getVariables() as $child)
		{
			$child->setLoggedIn(true);
			$child->setUserName($this->username);
		}
	}
	else
	{
	       return $this->redirect()->toUrl($rooturl);
	}
	// Initiadivze the View
    	$view = new ViewModel();
	// Retreive the parameters

	$productid = $this->params()->fromQuery("id");

	if (is_null($productid))
	{
		$productid = 1;
	}
		
	// 2Do: Check to see that user is logged in

 	$persistent = $this->getAuthService()->getStorage();
	$namespace = $persistent->getNamespace();

    	// 2Do: Populate username with user's username
    	$userSession = new Container('user');
		$this->username = $userSession->username;
		$username = $this->username;
		$loggedIn = $userSession->loggedin;
		if ($loggedIn)
		{
			// Set the Helpers
			$layout = $this->layout();
			foreach($layout->getVariables() as $child)
			{
				$child->setLoggedIn(true);
				$child->setUserName($username);
			}
		}
		else
		{
	       		return $this->redirect()->toUrl($rooturl);
		}


	$id = $this->params()->fromQuery("id");

	if (is_null($id))
	{
		$id = 1;
	}
		

		$em = $this->getEntityManager()	;
		$product = $em->getRepository('Application\Entity\Product')->find($id);
		
		$name = $product->getName();
		$title = $product->getTitle();
		$description = $product->getDescription();
		$sku = $product->getSku();
		$price = $product->getPrice();
		
	$variables = array("id" => $id,"name" => $name,"title" => $title,'description' => $description, 'sku' => $sku,'price' => $price);
	$jsonModel = new JsonModel($variables);
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent(json_encode($variables));
	return $response;
    }
}
