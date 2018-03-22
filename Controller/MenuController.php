<?php
namespace Kwf\KwcNativeMenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Kwf_Component_Data_Root;
use Kwc_Abstract;

class MenuController extends Controller
{
    protected $_componentsService;
    protected $_menuStartComponentId;

    public function __construct(\Kwf\KwcNativeMenuBundle\Services\Components $componentsService)
    {
        $this->_componentsService = $componentsService;
    }

    public function setMenuStartComponentId($menuStartComponentId)
    {
        $this->_menuStartComponentId = $menuStartComponentId;
    }

    public function getComponentsAction()
    {
        return View::create(array('data'=>$this->_componentsService->getDataForComponentId($this->_menuStartComponentId)), 200);
    }

    public function getComponentAction($componentId)
    {
        return View::create(array('data'=>$this->_componentsService->getDataForComponentId($componentId)), 200);
    }
}
