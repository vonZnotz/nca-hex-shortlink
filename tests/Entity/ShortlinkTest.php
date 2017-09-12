<?php

use Nca\Shortlink\Entity\Shortlink;
use PHPUnit\Framework\TestCase;

class ShortlinkTest extends TestCase
{
    const SOURCE_TESTVALUE = 'testomat';

    public function testAllowsSettingSource()
    {
        $shortlink = new Shortlink();
        $shortlink->setSource(self::SOURCE_TESTVALUE);
        $this->assertEquals(self::SOURCE_TESTVALUE, $shortlink->getSource());
    }
}
