<?php

/**
 * This file is part of the PHP New Relic package.
 *
 * (c) Alex Soban <me@soban.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SobanVuex\NewRelic\Provider\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use SobanVuex\NewRelic\Agent;

/**
 * Service provider for the New Relic Agent Wrapper.
 */
class AgentProvider implements ServiceProviderInterface
{
    /**
     * Register the Wrapper Service with Pimple.
     *
     * @param \Pimple\Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['newrelic'] = function () {
            return new Agent();
        };
    }
}
