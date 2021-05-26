<?php

namespace GGrach\Multiregionality\Facade;

use GGrach\Multiregionality\Contract\IConfigurator;
use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Contract\IRegionDeterminator;
use GGrach\Multiregionality\Entity\Region;

/**
 * Description of Regions
 *
 * @author ggrachdev
 */
class Regions {
    
    private $repository;
    private $configurator;
    private $determinator;
    
    public function __construct(string $url, IConfigurator $configurator, IRegionsRepository $repository, IRegionDeterminator $determinator) {
        $this->repository = $repository;
        $this->configurator = $configurator;
        $this->determinator = $determinator;
    }
    
    public function getNowRegionData(): Region {
        $nowRegion = new Region();
        
        return $nowRegion;
    }
    
    public function getRegionsData(): array {
        return $this->repository->getList();
    }
    
    public function getConfigurator(): IConfigurator {
        return $this->configurator;
    }
}
