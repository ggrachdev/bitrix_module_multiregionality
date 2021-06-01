<?php

namespace GGrach\Multiregionality\Event;

use GGrach\Multiregionality\Property\PriceTypeProperty;
use GGrach\Multiregionality\Property\StoreProperty;
    
class OnIBlockPropertyBuildList {
    
    public static function initialize() {
        AddEventHandler("iblock", "OnIBlockPropertyBuildList", array(PriceTypeProperty::class, "GetUserTypeDescription"));
        AddEventHandler("iblock", "OnIBlockPropertyBuildList", array(StoreProperty::class, "GetUserTypeDescription"));
    }

}
