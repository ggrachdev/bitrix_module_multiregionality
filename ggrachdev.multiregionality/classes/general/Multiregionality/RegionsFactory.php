<?php

namespace GGrach\Multiregionality;

use GGrach\Multiregionality\Facade\Regions;
use GGrach\Multiregionality\Contract\IConfigurator;
use GGrach\Multiregionality\Determinator\RegionDeterminator;
use GGrach\Multiregionality\Repository\RegionsRepository;
use GGrach\Multiregionality\Configurator\RegionsConfigurator;

final class RegionsFactory {

    private function __construct() { }
    
    private static $instances = [];

    public static function getInstance(string $url = null, IConfigurator $configurator = null): Regions {
        if ($url === null) {
            $url = $_SERVER['SERVER_NAME'];
        }

        if ($configurator === null) {
            $configurator = new RegionsConfigurator();
        }

        $key = $url . \spl_object_hash($configurator);
        
        if (!isset(self::$instances[$key])) {
            $repository = new RegionsRepository($configurator);
            $determinator = new RegionDeterminator();

            self::$instances[$key] = new Regions($url, $configurator, $repository, $determinator);
        }

        return self::$instances[$key];
    }

}
