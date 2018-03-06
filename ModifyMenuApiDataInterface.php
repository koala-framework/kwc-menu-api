<?php
namespace Kwc\MenuApiBundle;

interface ModifyMenuApiDataInterface
{
    public function modifyDataForMenuApi(\Kwf_Component_Data $componentData, array &$menuApiData);
}
