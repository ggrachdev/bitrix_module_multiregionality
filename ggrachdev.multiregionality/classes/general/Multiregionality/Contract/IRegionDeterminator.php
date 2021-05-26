<?php

namespace GGrach\Multiregionality\Contract;

use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Entity\Region;

interface IRegionDeterminator {
    public function determinate(string $url, IRegionsRepository $repository): Region;
}
