<?php
namespace Kwf\KwcNativeMenuBundle;

interface ModifyNativeMenuDataInterface
{
    public function modifyDataForNativeMenu(\Kwf_Component_Data $componentData, array &$nativeMenuData);
}
