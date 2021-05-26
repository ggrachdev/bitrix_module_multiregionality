<?php

namespace GGrach\Multiregionality\Events;

use GGrach\Multiregionality\RegionsFactory;
use GGrach\Multiregionality\Utils\RegionChunksTextCorrector;
    
class OnEndBufferContent {
    
    public function setChunks(&$content) {
        global $USER, $APPLICATION;

        $factory = RegionsFactory::getInstance();
        
        $content = RegionChunksTextCorrector::correct($content, $factory->getNowRegionData());
    }

}
