<?php

namespace GGrach\Multiregionality\Utils;

use GGrach\Multiregionality\Utils\UrlNormalizer;

class UrlParser {
    public static function parse(string $url): array
    {
        $url = UrlNormalizer::normalize($url);
        return parse_url($url);
    }
}
