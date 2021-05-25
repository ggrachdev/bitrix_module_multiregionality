<?

\Bitrix\Main\Loader::registerAutoLoadClasses('ggrachdev.multiregionality', [
    // Utils
    "\GGrach\Multiregionality\Utils\UrlNormalizer" => "classes/general/Multiregionality/Utils/UrlNormalizer.php",
    "\GGrach\Multiregionality\Utils\UrlParser" => "classes/general/Multiregionality/Utils/UrlParser.php",
    "\GGrach\Multiregionality\Facade\Regions" => "classes/general/Multiregionality/Facade/Regions.php",
    // Contracts
    "\GGrach\Multiregionality\Contract\IConfigurator" => "classes/general/Multiregionality/Contract/IConfigurator.php",
    "\GGrach\Multiregionality\Contract\IConfigurator" => "classes/general/Multiregionality/Contract/IRegionsRepository.php",
    // Configurator
    "\GGrach\Multiregionality\Configurator\RegionsConfigurator" => "classes/general/Multiregionality/Configurator/RegionsConfigurator.php",
    // Repository
    "\GGrach\Multiregionality\Repository\RegionsRepository" => "classes/general/Multiregionality/Repository/RegionsRepository.php",
]);
?>