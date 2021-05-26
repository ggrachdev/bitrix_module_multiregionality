<?php

namespace GGrach\Multiregionality\Determinator;

use GGrach\Multiregionality\Contract\IRegionDeterminator;
use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Entity\Region;

class RegionDeterminator implements IRegionDeterminator {
    
    public function determinate(string $url, IRegionsRepository $repository): Region {
        $region = new Region();
        
        echo '<pre>';
        print_r($url);
        echo '</pre>';
        
        $arRegions = $repository->getList();
        
        echo '<pre>';
        print_r($arRegions);
        echo '</pre>';
        die;
        return $region;
    }
}
