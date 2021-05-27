<?php

namespace GGrach\Multiregionality\Configurator;

use GGrach\Multiregionality\Contract\IConfigurator;

final class RegionsConfigurator implements IConfigurator {
    
    public function getCodePropertyUrlRegion(): string {
        return 'URL';
    }

    public function getNameCookieNowRegion(): string {
        return 'GGRACH_MULTIREGIONALITY_NOW_REGION';
    }

    public function getCodeIblockRegionsApi(): string {
        return 'regionsMultiregionalityApiCode';
    }

    public function getCodeTypeIblockRegionsCode(): string {
        return 'multiregionalityIblockType';
    }

    public function getCodeIblockRegionsCode(): string {
        return 'regionsMultiregionalityCode';
    }

    public function getCodePropertyFormName1(): string {
        return 'NAME_FORM_1';
    }

    public function getCodePropertyFormName2(): string {
        return 'NAME_FORM_2';
    }

    public function getCodePropertyFormName3(): string {
        return 'NAME_FORM_3';
    }

    public function getCodePropertyFormName4(): string {
        return 'NAME_FORM_4';
    }

    public function getCodePropertyFormName5(): string {
        return 'NAME_FORM_5';
    }
    
    public function getCodePropertyFormName6(): string {
        return 'NAME_FORM_6';
    }

    public function getCodePropertyIsDefaultRegion(): string {
        return 'IS_DEFAULT_REGION';
    }

}
