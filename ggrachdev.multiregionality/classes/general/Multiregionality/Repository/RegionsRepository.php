<?php

namespace GGrach\Multiregionality\Repository;

use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Contract\IConfigurator;
use GGrach\Multiregionality\Entity\Region;

class RegionsRepository implements IRegionsRepository {
    
    private $configurator;

    public function __construct(IConfigurator $configurator) {
        $this->configurator = $configurator;
    }

    public function create(): bool {
        $resultCreate = false;

        if(\Bitrix\Main\Loader::includeModule('iblock'))
        {
            
        }
        
        return $resultCreate;
    }

    public function getFilteredList(array $arFilter): array {
        $arList = [];
        
        return $arList;
    }

    public function getList(): array {
        $arList = [];
        
        return $arList;
    }

}
