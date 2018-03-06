<?php
namespace Kwf\KwcNativeMenuBundle\Controller;

use Kwf\KwcNativeMenuBundle\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MenuController extends Controller
{
    protected $_componentsService;
    protected $_tokenStorage;
    protected $_menuStartComponentId;

    public function __construct(\Kwf\KwcNativeMenuBundle\Service\Components $componentsService, TokenStorage $tokenStorage)
    {
        $this->_componentsService = $componentsService;
        $this->_tokenStorage = $tokenStorage;
    }

    public function setMenuStartComponentId($menuStartComponentId)
    {
        $this->_menuStartComponentId = $menuStartComponentId;
    }

    private function getUserRow()
    {
        $userRow = null;
        if (!$this->_tokenStorage->getToken() instanceof AnonymousToken) {
            $userRow = $this->_tokenStorage->getToken()->getUser()->getKwfUser();
        }
        return $userRow;
    }

    public function getComponentsAction()
    {
        return View::create(array('data'=>$this->_componentsService->getDataForComponentId($this->_menuStartComponentId, $this->getUserRow())), 200);
    }

    public function getComponentAction($componentId)
    {
        return View::create(array('data'=>$this->_componentsService->getDataForComponentId($componentId, $this->getUserRow())), 200);
    }
}
