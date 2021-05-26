<?php

namespace GGrach\Multiregionality\Utils;

use GGrach\Multiregionality\Utils\UrlNormalizer;

class UrlParser {
    public static function parse(string $url): array
    {
        $url = UrlNormalizer::normalize($url);
        
        $url = parse_url($url);
        
        if(isset($url['host']))
        {
            $url['host'] = ltrim($url['host'], 'www');
            $url['host'] = ltrim($url['host'], '.');
        }

        return $url;
    }
}
