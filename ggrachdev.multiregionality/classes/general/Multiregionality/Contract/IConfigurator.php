<?php

namespace GGrach\Multiregionality\Contract;

interface IConfigurator {
    public function getCodeIblockRegionsApi(): string;
    
    public function __toString(): string;
    
    public function getCodeIblockRegionsCode(): string;
    
    public function getCodePropertyIsDefaultRegion(): string;
    
    public function getCodeTypeIblockRegionsCode(): string;

    public function getNameCookieNowRegion(): string;

    public function getCodePropertyUrlRegion(): string;
    
    public function getCodePropertyFormName1(): string;
    
    public function getCodePropertyFormName2(): string;
    
    public function getCodePropertyFormName3(): string;
    
    public function getCodePropertyFormName4(): string;
    
    public function getCodePropertyFormName5(): string;
    
    public function getCodePropertyFormName6(): string;
    
    public function getCodePropertyLocations(): string;
    
    public function getCodePropertyTypesPrice(): string;
}
