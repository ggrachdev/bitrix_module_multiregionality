<?php

namespace GGrach\Multiregionality\Contract;

use GGrach\Multiregionality\Contract\IConfigurator;

interface IRegionsRepository {

    public function __construct(IConfigurator $configurator);
    
    public function create(): bool;
    
    /**
     * @return array<GGrach\Multiregionality\Entity\Region>
     */
    public function getList(): array;
    
    /**
     * @param array $arFilter
     * @return array<GGrach\Multiregionality\Entity\Region>
     */
    public function getFilteredList(array $arFilter): array;
}
