<?php

namespace GGrach\Multiregionality\Event;

use GGrach\Multiregionality\Property\PriceTypeProperty;
use GGrach\Multiregionality\Property\StoreProperty;
    
class OnIBlockPropertyBuildList {
    
    public static function initialize() {
        \Bitrix\Main\EventManager::getInstance()->addEventHandler(
            "iblock",
            "OnIBlockPropertyBuildList",
            [
                PriceTypeProperty::class, "GetUserTypeDescription"
            ]
        );
        
        \Bitrix\Main\EventManager::getInstance()->addEventHandler(
            "iblock",
            "OnIBlockPropertyBuildList",
            [
                StoreProperty::class, "GetUserTypeDescription"
            ]
        );
    }

}
