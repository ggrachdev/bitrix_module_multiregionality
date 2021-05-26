<?php

namespace GGrach\Multiregionality\Determinator;

use GGrach\Multiregionality\Contract\IRegionDeterminator;
use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Entity\Region;
use GGrach\Multiregionality\Utils\UrlParser;

class RegionDeterminator implements IRegionDeterminator {

    public function determinate(string $url, IRegionsRepository $repository): Region {
        $emptyRegion = new Region();

        $urlData = UrlParser::parse($url);

        if (!empty($urlData['host'])) {
            $arRegions = $repository->getList();
            if (!empty($arRegions)) {
                foreach ($arRegions as $region) {

                    $urlItemData = UrlParser::parse($region->getUrl());

                    if (
                        !empty($urlItemData['host']) &&
                        strcasecmp(trim($urlItemData['host']), trim($urlData['host'])) === 0
                    ) {
                        return $region;
                    }
                }

                // Если регион не установлен, то ставим регион по умолчанию как определенный
                foreach ($arRegions as $region) {
                    if($region->isDefaultRegion())
                    {
                        return $region;
                    }
                }
            }
        }

        return $emptyRegion;
    }

}
