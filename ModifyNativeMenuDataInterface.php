<?php
namespace Kwf\KwcNativeMenuBundle;

interface ModifyNativeMenuDataInterface
{
    public function modifyDataForNativeMenu(\Kwf_User_Row $userRow);
}
