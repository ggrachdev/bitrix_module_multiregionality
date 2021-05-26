<?php

namespace GGrach\Multiregionality;

use GGrach\Multiregionality\Facade\Regions;
use GGrach\Multiregionality\Contract\IConfigurator;
use GGrach\Multiregionality\Configurator;

class RegionsFactory {

    private static $instances = [];

    /**
     * Одиночки не должны быть восстанавливаемыми из строк.
     */
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(string $url = null, IConfigurator $configurator = null): Regions {
        if ($url === null) {
            $url = $_SERVER['DOCUMENT_URI'];
        }

        if ($configurator === null) {
            $url = new Configurator();
        }

        $key = $url . $configurator;
        if (!isset(self::$instances[$key])) {
            self::$instances[$key] = new Regions();
        }

        return self::$instances[$cls];
    }

}
