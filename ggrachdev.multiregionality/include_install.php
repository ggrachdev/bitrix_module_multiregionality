<?

$pathPrefix = '/local/modules/ggrachdev.multiregionality/';

\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    // Utils
    "\GGrach\Multiregionality\Utils\UrlNormalizer" => $pathPrefix . "classes/general/Multiregionality/Utils/UrlNormalizer.php",
    "\GGrach\Multiregionality\Utils\UrlParser" => $pathPrefix . "classes/general/Multiregionality/Utils/UrlParser.php",
    // Entity
    "\GGrach\Multiregionality\Entity\Region" => $pathPrefix."classes/general/Multiregionality/Entity/Region.php",
    // Facade
    "\GGrach\Multiregionality\Facade\Regions" => $pathPrefix . "classes/general/Multiregionality/Facade/Regions.php",
    // Contracts
    "\GGrach\Multiregionality\Contract\IConfigurator" => $pathPrefix . "classes/general/Multiregionality/Contract/IConfigurator.php",
    "\GGrach\Multiregionality\Contract\IRegionsRepository" => $pathPrefix . "classes/general/Multiregionality/Contract/IRegionsRepository.php",
    "\GGrach\Multiregionality\Contract\IRegionDeterminator" => $pathPrefix . "classes/general/Multiregionality/Contract/IRegionDeterminator.php",
    // Configurator
    "\GGrach\Multiregionality\Configurator\RegionsConfigurator" => $pathPrefix . "classes/general/Multiregionality/Configurator/RegionsConfigurator.php",
    // Repository
    "\GGrach\Multiregionality\Repository\RegionsRepository" => $pathPrefix . "classes/general/Multiregionality/Repository/RegionsRepository.php",
    // Other
    "\GGrach\Multiregionality\RegionsFactory" => $pathPrefix . "classes/general/Multiregionality/RegionsFactory.php",
]);
?>