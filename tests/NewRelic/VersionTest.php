<?php

namespace NewRelic;

class VersionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetVersion()
    {
        $expected = Version::VERSION;
        $actual = Version::getVersion();
        $this->assertEquals($expected, $actual);
    }

}
