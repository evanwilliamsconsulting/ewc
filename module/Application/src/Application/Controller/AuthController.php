<?php
/**
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Panel\LoginForm;
use Application\Entity\Correspondent;
use Application\View\Helper\Welcome as Welcome;
use Zend\Session\Container;
use Zend\Db\Adapter;


use Zend\View\Model\JsonModel;
use Application\Entity\Wordage;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\WordageForm;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

use Application\Form\RegistrationForm;

class AuthController extends AbstractActionController
{
    protected $form;
    protected $storage;
    protected $authservice;
    protected $log;
    protected $em;
 
    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }
        return $this->authservice;
    }
    public function getSessionStorage()
    {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('Application\Storage\Login');
        }
        return $this->storage;
    }
    public function getForm()
    {
        if (! $this->form)
        {
	    $this->form = new LoginForm();
        }
	return $this->form;
    }
    public function registerAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
    }
    public function signupAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;

	$em = $this->getEntityManager()	;
		
		
	$form = new RegistrationForm();
	$messages = Array();

	// Check if user has submitted the form
        if ($this->getRequest()->isPost())
        {
		// Fill in the form with POST data
		$data = $this->params()->fromPost();

		$form->setData($data);

		// Validate Form
		if ($form->isValid()) {

			$username = $data['username'];

			$correspondent = $em->getRepository('Application\Entity\Correspondent')->findOneBy(['username' => $username]);

			// Check if username is available
			if (is_null($correspondent))
			{
				// Get filtered and validated data
				$data = $form->getData();
/*
				print_r($data);
Array ( [username] => testtest [email] => test@test.com [first_name] => Test [middle_i] => A [last_name] => Test [passphrase] => fordham [password] => test123 [confirm_password] => test123 [submit] => Register! ) 
*/

				// Redirect to Review page.
				return $this->redirect()->toRoute('auth',['action'=>'register']);
			}
			else
			{
				$messages['username_taken'] = "Username is taken, please choose another!";
			}
			
		}
	}
	$viewModel = new ViewModel([
		'form' => $form,
		'messages' => $messages
	]);

	$viewModel->setTerminal(true);
	
	return $viewModel;
    }
    public function loginAction()
    {
	$this->log = $this->getServiceLocator()->get('log');
        $log = $this->log;
	//$this->_helper->layout()->disableLayout();
	//$this->_helper->viewRenderer->setNoRender(true);
    	$view = new ViewModel();

/*
	if ($this->getAuthService()->hasIdentity())
        {
               // Set Logged In and Username attributes in helpers
               $log->info("Set Logged In and Username attributes in Helpers");
               $layout = $this->layout();
               foreach($layout->getVariables() as $child)
               {
                       $log->info(print_r($child,true));
                       $child->setLoggedIn(true);
                       $child->setUserName($username);
               }
               return $this->redirect()->toRoute('correspondant');
        }
*/



        $form = $this->getForm();
	$form->setAttribute('action','/auth/authenticate');

	$view->setTerminal(true);
	$view->form = $form;
	$view->messages = $this->flashmessenger()->getMessages();
		

	return $view;
    }
    public function authenticateAction()
    {
//	$this->log = $this->getServiceLocator()->get('log');
 //       $log = $this->log;

        $form = $this->getForm();
        $redirect = 'home';
   
        $request = $this->getRequest();
        if ($request->isPost()) {
            //check authentication
	    // Were both the username and password supplied?
	    // Please supply username and or password
	    $usernameEntry = $request->getPost('username');
	    $passwordEntry = $request->getPost('password');
	    if ($usernameEntry == "" || $passwordEntry == "")
	    {
		$messageEntry = "Please enter username and/or password";
		$this->flashmessenger()->addMessage($messageEntry);
	    }
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getAuthService()->getAdapter()
                	->setIdentity($request->getPost('username'))
                       	->setCredential($request->getPost('password'));
                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                	{
                    $this->flashmessenger()->addMessage($message);
                }
                if ($result->isValid()) {
		    	$userSession = new Container('user');
                    	$userSession->loggedin = 'true';
                    	$username = $request->getPost('username');
                    	$userSession->username = $username;
		    	$welcome = new Welcome();
                    	$redirect = 'correspondant';
                    	// Check if it has rememberMe
/*
                    	$this->getSessionStorage()
                        	 ->setRememberMe(1);
*/
                    	// set storage again
                	$this->getAuthService()->getStorage()->write($request->getPost('username'));
		   	// Set Logged In and Username attributes in helpers
		    	$layout = $this->layout();
		    	foreach($layout->getVariables() as $child)
		    	{
				$child->setLoggedIn(true);
				$child->setUserName($username);
		    	}
                }
	    	else {
			// Clear the Identity and Start over!
			$this->getAuthService()->clearIdentity();
			// Set Logged In and Username attributes in helpers
			$layout = $this->layout();
		    	foreach($layout->getVariables() as $child)
		    	{
				$child->setLoggedIn(false);
				$child->setUserName("");
		    	}
	    	}
            }
	}
        return $this->redirect()->toRoute($redirect);
    }
    public function logoutAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
	$userSession = new Container('user');
	$userSession->offsetUnset('loggedin');
  
        $this->flashmessenger()->addMessage("You've been logged out!");
        return $this->redirect()->toRoute('home');
    }
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
}
