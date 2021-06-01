<?

\Bitrix\Main\Loader::registerAutoLoadClasses('ggrachdev.multiregionality', [
    // Utils
    "\GGrach\Multiregionality\Utils\UrlNormalizer" => "classes/general/Multiregionality/Utils/UrlNormalizer.php",
    "\GGrach\Multiregionality\Utils\UrlParser" => "classes/general/Multiregionality/Utils/UrlParser.php",
    "\GGrach\Multiregionality\Utils\RegionChunksTextCorrector" => "classes/general/Multiregionality/Utils/RegionChunksTextCorrector.php",
    // Facade
    "\GGrach\Multiregionality\Facade\Regions" => "classes/general/Multiregionality/Facade/Regions.php",
    // Events
    "\GGrach\Multiregionality\Event\OnEndBufferContent" => "classes/general/Multiregionality/Event/OnEndBufferContent.php",
    "\GGrach\Multiregionality\Event\OnIBlockPropertyBuildList" => "classes/general/Multiregionality/Event/OnIBlockPropertyBuildList.php",
    // Entity
    "\GGrach\Multiregionality\Entity\Region" => "classes/general/Multiregionality/Entity/Region.php",
    // Contracts
    "\GGrach\Multiregionality\Contract\IConfigurator" => "classes/general/Multiregionality/Contract/IConfigurator.php",
    "\GGrach\Multiregionality\Contract\IRegionsRepository" => "classes/general/Multiregionality/Contract/IRegionsRepository.php",
    "\GGrach\Multiregionality\Contract\IRegionDeterminator" => "classes/general/Multiregionality/Contract/IRegionDeterminator.php",
    // Configurator
    "\GGrach\Multiregionality\Configurator\RegionsConfigurator" => "classes/general/Multiregionality/Configurator/RegionsConfigurator.php",
    // Determinator
    "\GGrach\Multiregionality\Determinator\RegionDeterminator" => "classes/general/Multiregionality/Determinator/RegionDeterminator.php",
    // Repository
    "\GGrach\Multiregionality\Repository\RegionsRepository" => "classes/general/Multiregionality/Repository/RegionsRepository.php",
    // Other
    "\GGrach\Multiregionality\RegionsFactory" => "classes/general/Multiregionality/RegionsFactory.php",
    // Cache
    "\GGrach\Multiregionality\Cache\RuntimeCache" => "classes/general/Multiregionality/Cache/RuntimeCache.php",
    // Properties
    "\GGrach\Multiregionality\Property\StoreProperty" => "classes/general/Multiregionality/Property/StoreProperty.php",
    "\GGrach\Multiregionality\Property\PriceTypeProperty" => "classes/general/Multiregionality/Property/PriceTypeProperty.php",
]);

\GGrach\Multiregionality\Event\OnIBlockPropertyBuildList::initialize();

function MRG() {
    return \GGrach\Multiregionality\RegionsFactory::getInstance();
}

if (!\CSite::InDir('/bitrix')) {

    \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        "main",
        "OnEndBufferContent",
        [
            "\\GGrach\\Multiregionality\\Event\\OnEndBufferContent",
            "listen"
        ]
    );
}
?>