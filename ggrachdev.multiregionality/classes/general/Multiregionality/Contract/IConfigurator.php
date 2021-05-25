<?php

namespace GGrach\Multiregionality\Contract;

interface IConfigurator {
    public function getCodeIblockRegionsApi(): string;

    public function getNameCookieNowRegion(): string;

    public function getCodePropertyUrlRegion(): string;
}
