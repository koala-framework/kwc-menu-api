<?php
namespace Kwf\KwcNativeMenuBundle;

interface ModifyNativeMenuDataInterface
{
    public function modifyDataForNativeMenu(\Kwf_Component_Data $componentData, array &$nativeMenuData, \Kwf_User_Row $userRow = null);
}
