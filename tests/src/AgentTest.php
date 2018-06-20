<?php

/*
 * This file is part of the PHP New Relic package.
 *
 * (c) Alex Soban <me@soban.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SobanVuex\NewRelic\Tests;

use PHPUnit\Framework\TestCase;
use SobanVuex\NewRelic\Agent;

/**
 * @requires extension newrelic
 */
final class AgentTest extends TestCase
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

    /**
     * @covers Agent::isLoaded
     */
    public function testIsLoaded()
    {
        $expected = extension_loaded('newrelic');
        $actual = $this->agent->isLoaded();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Agent::addCustomParameter
     */
    public function testAddCustomParameter()
    {
        $this->assertExtensionMethod(__FUNCTION__, '4.4.5.35');
    }

    /**
     * @covers Agent::addCustomTracer
     */
    public function testAddCustomTracer()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::backgroundJob
     */
    public function testBackgroundJob()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::captureParams
     */
    public function testCaptureParams()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::customMetric
     */
    public function testCustomMetric()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::disableAutorum
     */
    public function testDisableAutorum()
    {
        $this->assertExtensionMethod(__FUNCTION__, '2.6.5.41');
    }

    /**
     * @covers Agent::endOfTransaction
     */
    public function testEndOfTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::endTransaction
     */
    public function testEndTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__, '3.0.5.95');
    }

    /**
     * @covers Agent::getBrowserTimingFooter
     */
    public function testGetBrowserTimingFooter()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::getBrowserTimingHeader
     */
    public function testGetBrowserTimingHeader()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::ignoreApdex
     */
    public function testIgnoreApdex()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::ignoreTransaction
     */
    public function testIgnoreTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::nameTransaction
     */
    public function testNameTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::noticeError
     */
    public function testNoticeError()
    {
        $this->assertExtensionMethod(__FUNCTION__, '2.6');
    }

    /**
     * @covers Agent::recordCustomEvent
     */
    public function testRecordCustomEvent()
    {
        $this->assertExtensionMethod(__FUNCTION__, '4.18.0.89');
    }

    /**
     * @covers Agent::recordDatastoreSegment
     */
    public function testRecordDatastoreSegment()
    {
        $this->assertExtensionMethod(__FUNCTION__, '7.5.0.199');
    }

    /**
     * @covers Agent::setAppname
     */
    public function testSetAppname()
    {
        $this->assertExtensionMethod(__FUNCTION__);
    }

    /**
     * @covers Agent::setUserAttributes
     */
    public function testSetUserAttributes()
    {
        $this->assertExtensionMethod(__FUNCTION__, '3.1.5.111');
    }

    /**
     * @covers Agent::startTransaction
     */
    public function testStartTransaction()
    {
        $this->assertExtensionMethod(__FUNCTION__, '3.0.5.95');
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
}
