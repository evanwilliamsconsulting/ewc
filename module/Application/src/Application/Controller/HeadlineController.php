<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Headline;
use Hex\View\Helper\CustomHelper;
use Doctrine\ORM\EntityManager;
use Application\Form\Entity\HeadlineForm;

class HeadlineController extends AbstractActionController
{
    protected $em;
 
    public function getEntityManager()
    {
        if (null == $this->em)
        {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
	}
	return $this->em;
    }
    public function indexAction()
    {
	$view = new ViewModel();

	$articleView = new ViewModel(array('article' => $article));
        $articleView->setTemplate('content/article');

	$view->content = $this->content();

        return $view;
    }
    public function content()
    {
	return "content";
    }
    public function viewAction()
    {
        $em = $this->getEntityManager();

	$headline = new Headline;

        $headline->setHeadline("Times Are Good Again");
	$headline->setWidth(800);
	$headline->setGluex(TRUE);
	$headline->setGluey(TRUE);
	$headline->setOffsetx(TRUE);
	$headline->setOffsety(TRUE);
	$headline->setPrevx(TRUE);
	$headline->setPrevy(TRUE);
	$headline->setResetx(TRUE);
	$headline->setResety(TRUE);
	$headline->setDrift(TRUE);
	$headline->setGravity(TRUE);
	$headline->setTopline(TRUE);
	$headline->setUsetopline(TRUE);
        $headline->setHeight(899);
	$headline->setFontsize(24);
	$headline->setHeadlineclass('test');
	$headline->setItalic(TRUE);

	$em->persist($headline);
	$em->flush();

	$view = new ViewModel();
	$view->content = "Times Are Good Again!";

	return $view;
    }
    public function getForm()
    {
        $form = new HeadlineForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $headline = new Headline();
        }
	return $form;
    }
    public function newAction()
    {
	$view = new ViewModel();
	$form = $this->getForm();
	$view->form = $form;
	return $view;
    }
}
