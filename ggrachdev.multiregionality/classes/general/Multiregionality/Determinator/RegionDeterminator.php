<?php

namespace GGrach\Multiregionality\Determinator;

use GGrach\Multiregionality\Contract\IRegionDeterminator;
use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Entity\Region;
use GGrach\Multiregionality\Utils\UrlParser;
use GGrach\Multiregionality\Cache\RuntimeCache;

class RegionDeterminator implements IRegionDeterminator {

    public function determinate(string $url, IRegionsRepository $repository): Region {

        $keyCache = $url . ' ' . \spl_object_hash($repository);
        
        if (RuntimeCache::has($keyCache)) {
            return RuntimeCache::get($keyCache);
        }

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
                        RuntimeCache::set($keyCache, $region);
                        return $region;
                    }
                }

                // Если регион не установлен, то ставим регион по умолчанию как определенный
                foreach ($arRegions as $region) {
                    if ($region->isDefaultRegion()) {
                        RuntimeCache::set($keyCache, $region);
                        return $region;
                    }
                }
            }
        }

        RuntimeCache::set($keyCache, $emptyRegion);
        return $emptyRegion;
    }

}
