<?php

/**
 * This file is part of the PHP New Relic package.
 *
 * (c) Alex Soban <me@soban.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SobanVuex\NewRelic\Tests;

use SobanVuex\NewRelic\Agent;

/**
 * @requires extension newrelic
 */
class AgentTest extends \PHPUnit_Framework_TestCase
{
    protected $agent;

    protected function setUp()
    {
        $this->agent = new Agent();
    }

    protected function tearDown()
    {
        $this->agent = null;
    }

    protected function parseMethodName($function)
    {
        return 'newrelic' . substr(strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $function)), 4);
    }

    protected function assertExtensionVersion($version, $method)
    {
        if (version_compare(phpversion('newrelic'), $version) < 1) {
            $this->markTestSkipped(sprintf(
                '`%s` requires `newrelic` version %s',
                $method,
                $version
            ));
        }
    }

    protected function assertExtensionMethod($function, $version = 0)
    {
        $method = $this->parseMethodName($function);
        $this->assertExtensionVersion($version, $method);
        $this->assertTrue(function_exists($method));
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::isLoaded
     */
    public function testIsLoaded()
    {
        $expected = extension_loaded('newrelic');
        $actual = $this->agent->isLoaded();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::addCustomParameter
     */
    public function testAddCustomParameter()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::addCustomTracer
     */
    public function testAddCustomTracer()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::backgroundJob
     */
    public function testBackgroundJob()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::captureParams
     */
    public function testCaptureParams()
    {
        $this->assertExtensionMethod(__FUNCTION__, 2.1);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::customMetric
     */
    public function testCustomMetric()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::disableAutorum
     */
    public function testDisableAutorum()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::endOfTransaction
     */
    public function testEndOfTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__, 3.0);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::endTransaction
     */
    public function testEndTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::getBrowserTimingFooter
     */
    public function testGetBrowserTimingFooter()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::getBrowserTimingHeader
     */
    public function testGetBrowserTimingHeader()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::ignoreApdex
     */
    public function testIgnoreApdex()
    {
        $this->assertExtensionMethod(__FUNCTION__, 2.3);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::ignoreTransaction
     */
    public function testIgnoreTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::nameTransaction
     */
    public function testNameTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::noticeError
     */
    public function testNoticeError()
    {
        $this->assertExtensionMethod(__FUNCTION__, 2.6);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::recordCustomEvent
     */
    public function testRecordCustomEvent()
    {
        $this->assertExtensionMethod(__FUNCTION__, 4.18);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::setAppname
     */
    public function testSetAppname()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::setUserAttributes
     */
    public function testSetUserAttributes()
    {
        $this->assertExtensionMethod(__FUNCTION__, 3.1);
    }

    /**
     * @covers SobanVuex\NewRelic\Agent::startTransaction
     */
    public function testStartTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__, 3.0);
    }
}
