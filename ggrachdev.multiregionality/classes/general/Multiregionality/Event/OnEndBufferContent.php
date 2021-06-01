<?php

namespace GGrach\Multiregionality\Event;

use GGrach\Multiregionality\RegionsFactory;
use GGrach\Multiregionality\Utils\RegionChunksTextCorrector;
    
class OnEndBufferContent {
    
    public function listen(&$content) {
        
        $factory = RegionsFactory::getInstance();
        
        $content = RegionChunksTextCorrector::correct($content, $factory->getNowRegionData());
    }

}
