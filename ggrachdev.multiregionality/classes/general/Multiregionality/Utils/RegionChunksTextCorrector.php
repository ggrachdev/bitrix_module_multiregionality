<?php

namespace GGrach\Multiregionality\Utils;

use GGrach\Multiregionality\Entity\Region;

class RegionChunksTextCorrector {

    public static function correct(string $text, Region $region): string {
        
        $forms = $region->getNameForms();
        
        $text = \str_replace([
            '#NAME_REGION#',
            '#FORM_NAME_REGION_1#',
            '#FORM_NAME_REGION_2#',
            '#FORM_NAME_REGION_3#',
            '#FORM_NAME_REGION_4#',
            '#FORM_NAME_REGION_5#',
            '#FORM_NAME_REGION_6#'
        ], [
            $region->getName(),
            $forms[0],
            $forms[1],
            $forms[2],
            $forms[3],
            $forms[4],
            $forms[5]
        ], $text);
        
        return $text;
    }

}
