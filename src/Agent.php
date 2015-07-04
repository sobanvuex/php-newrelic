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
     * Common .ini settings
     *
     * @var array
     */
     protected $settings;

    /**
     * Construct a new `Agent`
     */
    public function __construct(array $settings = [])
    {
        $this->loaded = extension_loaded('newrelic');
        $this->settings = $settings;
        $this->setSettings();
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

    /**
     * Set .ini settings
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-configuration
     * @param array $settings Array of settings to apply
     */
    public function setSettings(array $settings = [])
    {
        $this->settings += $settings;

        foreach ($this->settings as $setting => $value) {
            if (ini_get($setting) != $value) {
                ini_set($setting, $value);
            }
        }
    }

    /**
     * Get .ini settings
     *
     * @param boolean $all
     * @return array
     */
    public function getSettings($all = false, $details = false)
    {
        return $all ? ini_get_all('newrelic', $details) : $this->settings;
    }

    // PHP Agent API //

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-param
     *
     * @param string $key
     * @param mixed $value
     *
     * @return boolean
     */
    public function addCustomParameter($key, $value)
    {
        return $this->isLoaded() ? newrelic_add_custom_parameter($key, $value) : false;
    }

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-tracer
     *
     * @param string $callable
     *
     * @return boolean
     */
    public function addCustomTracer($callable)
    {
        return $this->isLoaded() ? newrelic_add_custom_tracer($callable) : false;
    }

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-bg
     *
     * @param boolean $flag
     */
    public function backgroundJob($flag = true)
    {
        $this->isLoaded() && newrelic_background_job($flag);
    }

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-capture-params
     *
     * @param boolean $enable
     */
    public function captureParams($enable = true)
    {
        $this->isLoaded() && newrelic_capture_params($enable);
    }

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-metric
     *
     * @param string $key
     * @param float $value
     *
     * @return boolean
     */
    public function customMetric($key, $value)
    {
        return $this->isLoaded() ? newrelic_custom_metric($key, $value) : false;
    }

    /**
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-rum-disable
     * The return value can be different from `true` if the extension is not loaded
     *
     * @param boolean $return
     *
     * @return boolean
     */
    public function disableAutorum($return = true)
    {
        return $this->isLoaded() ? newrelic_disable_autorum() : $return;
    }
}
