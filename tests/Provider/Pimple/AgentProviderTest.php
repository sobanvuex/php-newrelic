<?php

/**
 * PHP NewRelic library.
 *
 * @copyright 2015 Alex Soban. See LICENSE for information.
 * @license   http://opensource.org/licenses/MIT
 * @author    Alex Soban <me@soban.co>
 */

namespace SobanVuex\NewRelic\tests\Provider\Pimple;

use Pimple\Container;
use SobanVuex\NewRelic\Provider\Pimple\AgentProvider;

class AgentProviderTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    protected function setUp()
    {
        $this->container = new Container;
        $this->container->register(new AgentProvider);
    }

    public function testAgentProvider()
    {
        $this->assertInstanceOf('SobanVuex\NewRelic\Agent', $this->container['newrelic']);
        $this->assertInternalType('boolean', $this->container['newrelic']->isLoaded());
    }

    protected function tearDown()
    {
        $this->container = null;
    }
}
