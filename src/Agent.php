<?php

/**
 * PHP NewRelic library.
 *
 * @copyright 2015 Alex Soban. See LICENSE for information.
 * @license   http://opensource.org/licenses/MIT
 * @author    Alex Soban <me@soban.co>
 */

namespace SobanVuex\NewRelic;

/**
 * Wrapper for the newrelic extension
 */
class Agent
{
    /**
     * Extension status
     *
     * @var boolean
     */
    protected $loaded;

    /**
     * Construct a new `Agent`
     */
    public function __construct()
    {
        $this->loaded = extension_loaded('newrelic');
    }

    /**
     * Check if the New Relic extension is loaded.
     *
     * @return boolean
     */
    public function isLoaded()
    {
        return $this->loaded;
    }
}
