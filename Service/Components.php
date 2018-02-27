<?php
namespace Kwf\KwcNativeMenuBundle\Service;

class Components
{
    public function getDataForComponentId($componentId, $userRow)
    {
        $component = \Kwf_Component_Data_Root::getInstance()->getComponentById($componentId);
        return $this->_getPageDataRecursive($component, 2, $userRow);
    }

    public function getDataForPage($page, $userRow)
    {
        $isRoot = \Kwc_Abstract::getFlag($page->componentClass, 'subroot') || $page->componentId == 'root';
        $ret = array(
            'id' => $page->componentId,
            'title' => $page->name,
            'type' => $isRoot ? 'root' : 'webview',
            'url' => $page->getAbsoluteUrl()
        );
        if (method_exists($page->componentClass, 'getJsonVars')) {
            $ret = array_merge($ret, $page->getComponent()->getJsonVars($userRow));
        }
        return $ret;
    }

    protected function _getPageDataRecursive($parentPage, $levels, $userRow)
    {
        $ret = $this->getDataForPage($parentPage, $userRow);
        $ret['hasChildren'] = false;
        $ret['children'] = array();
        foreach ($parentPage->getChildPages(array('showInMenu'=>true)) as $page) {
            $ret['hasChildren'] = true;
            if ($levels > 0) {
                $ret['children'][] = $this->_getPageDataRecursive($page, $levels-1, $userRow);
            } else {
                break;
            }
        }
        return $ret;
    }
}
