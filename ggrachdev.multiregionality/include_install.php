<?

$pathPrefix = '/local/modules/ggrachdev.multiregionality/';

\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    // Utils
    "\GGrach\Multiregionality\Utils\UrlNormalizer" => $pathPrefix . "classes/general/Multiregionality/Utils/UrlNormalizer.php",
    "\GGrach\Multiregionality\Utils\UrlParser" => $pathPrefix . "classes/general/Multiregionality/Utils/UrlParser.php",
    "\GGrach\Multiregionality\Facade\Regions" => $pathPrefix . "classes/general/Multiregionality/Facade/Regions.php",
    // Contracts
    "\GGrach\Multiregionality\Contract\IConfigurator" => $pathPrefix . "classes/general/Multiregionality/Contract/IConfigurator.php",
    "\GGrach\Multiregionality\Contract\IRegionsRepository" => $pathPrefix . "classes/general/Multiregionality/Contract/IRegionsRepository.php",
    // Configurator
    "\GGrach\Multiregionality\Configurator\RegionsConfigurator" => $pathPrefix . "classes/general/Multiregionality/Configurator/RegionsConfigurator.php",
    // Repository
    "\GGrach\Multiregionality\Repository\RegionsRepository" => $pathPrefix . "classes/general/Multiregionality/Repository/RegionsRepository.php",
]);
?>