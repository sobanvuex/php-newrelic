<?php

/**
 * PHP NewRelic library.
 *
 * @copyright 2015 Alex Soban. See LICENSE for information.
 * @license   http://opensource.org/licenses/MIT
 * @author    Alex Soban <me@soban.co>
 */

namespace SobanVuex\NewRelic\Provider\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use SobanVuex\NewRelic\Agent;

/**
 * NewRelic Agent Provider for Pimple
 */
class AgentProvider implements ServiceProviderInterface
{
    /**
     * Register the New Relic Agent service to Pimple
     *
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['newrelic'] = function () {
            return new Agent;
        };
    }
}
