<?php
namespace Kwf\KwcNativeMenuBundle\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Kwf_Component_Data_Root;

class ContentController
{
    public function __construct()
    {
    }

    public function dataAction(Request $request)
    {
        if (!$request->get('url')) {
            throw new FileNotFoundException();
        }

        $url = $request->get('url');
        if (!is_string($url)) {
            throw new Kwf_Exception_NotFound();
        }
        if (substr($url, 0, 1) == '/') {
            $url = 'http://'.$request->getHttpHost().$url;
        }
        $page = Kwf_Component_Data_Root::getInstance()->getPageByUrl($url, null);

        $data = \Kwf_Component_ApiContent_Helper::getContent($page);

        return View::create(array(
            'data'=>$data
        ), 200);
    }
}
