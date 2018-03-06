<?php
namespace Kwf\KwcNativeMenuBundle\Service;

class Components
{
    protected $_returnedLevels;

    public function setReturnedLevels($returnedLevels)
    {
        $this->_returnedLevels = $returnedLevels;
    }

    public function getDataForComponentId($componentId, $userRow)
    {
        $component = \Kwf_Component_Data_Root::getInstance()->getComponentById($componentId);
        return $this->_getPageDataRecursive($component, $this->_returnedLevels, $userRow);
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
        if (\Kwc_Abstract::hasSetting($page->componentClass, 'nativeMenuConfig')) {
            $nativeMenuConfig = \Kwc_Abstract::getSetting($page->componentClass, 'nativeMenuConfig');
            $configObject = new $nativeMenuConfig();
            $configObject->modifyDataForNativeMenu($page, $ret, $userRow);
        }
        $select = new \Kwf_Component_Select();
        $select->whereFlag('addToNativeMenu', true);
        foreach ($page->getRecursiveChildComponents($select) as $childComponent) {
            if (\Kwc_Abstract::hasSetting($childComponent->componentClass, 'nativeMenuConfig')) {
                $nativeMenuConfig = \Kwc_Abstract::getSetting($childComponent->componentClass, 'nativeMenuConfig');
                $configObject = new $nativeMenuConfig();
                $configObject->modifyDataForNativeMenu($childComponent, $ret, $userRow);
            }
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
