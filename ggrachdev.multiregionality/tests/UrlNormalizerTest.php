<?php

use PHPUnit\Framework\TestCase;


class UrlNormalizerTest extends TestCase {

    public function testNotice() {
        $url = GGrach\Multiregionality\Utils\UrlNormalizer::normalize('test');
        $this->assertSame($url, 'test');
    }

}
