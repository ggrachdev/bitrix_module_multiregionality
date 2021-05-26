<?php

use PHPUnit\Framework\TestCase;


class UrlParserTest extends TestCase {

    public function testNotice() {
        $url = GGrach\Multiregionality\Utils\UrlNormalizer::normalize('test');
        $this->assertSame($url, 'test');
    }

}
