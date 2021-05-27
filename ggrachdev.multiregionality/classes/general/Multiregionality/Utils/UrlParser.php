<?php

namespace GGrach\Multiregionality\Utils;

use GGrach\Multiregionality\Utils\UrlNormalizer;

class UrlParser {
    public static function parse(string $url): array
    {
        $url = UrlNormalizer::normalize($url);
        
        $urlChunks = parse_url($url);
        
        if(isset($urlChunks['host']))
        {
            $urlChunks['host'] = ltrim($urlChunks['host'], 'www');
            $urlChunks['host'] = ltrim($urlChunks['host'], '.');
        }

        return $urlChunks;
    }
}
