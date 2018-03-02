<?php
namespace Kwf\KwcNativeMenuBundle\Controller;

use Kwf\KwcNativeMenuBundle\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MenuController extends Controller
{
    protected $_componentsService;
    protected $_tokenStorage;

    public function __construct(\Kwf\KwcNativeMenuBundle\Service\Components $componentsService, TokenStorage $tokenStorage)
    {
        $this->_componentsService = $componentsService;
        $this->_tokenStorage = $tokenStorage;
    }

    public function getComponentsAction()
    {
        $userRow = $this->_tokenStorage->getToken()->getUser()->getKwfUser();
        return View::create(array('data'=>$this->_componentService->getDataForComponentId('root-nativeApp', $userRow)), 200);
    }

    public function getComponentAction($componentId)
    {
        $userRow = $this->_tokenStorage->getToken()->getUser()->getKwfUser();
        return View::create(array('data'=>$this->_componentsService->getDataForComponentId($componentId, $userRow)), 200);
    }
}
