<?php

namespace GGrach\Multiregionality\Configurator;

use GGrach\Multiregionality\Contract\IConfigurator;

class RegionsConfigurator implements IConfigurator {

    public function getCodeIblockRegionsApi(): string {
        return 'regionsMultiregionalityApiCode';
    }

    public function getCodePropertyUrlRegion(): string {
        return 'URL';
    }

    public function getNameCookieNowRegion(): string {
        return 'GGRACH_MULTIREGIONALITY_NOW_REGION';
    }

}
