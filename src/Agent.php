<?php

/*
 * This file is part of the PHP New Relic package.
 *
 * (c) Alex Soban <me@soban.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SobanVuex\NewRelic;

/**
 * OOP Wrapper for the New Relic PHP Agent.
 */
class Agent
{
    /**
     * Extension status.
     *
     * @var bool
     */
    protected $loaded;

    /**
     * Instantiate the agent wrapper.
     *
     * Passing an application name will call the agent api right away.
     *
     * @param string|array $name    (optional) Name(s) of app metrics should be reported under in New Relic
     *                              user interface
     * @param string       $license (optional) Specify a different license key to report metrics to a different
     *                              New Relic account
     */
    public function __construct($name = null, string $license = null)
    {
        $this->loaded = extension_loaded('newrelic');

        if (isset($name, $license)) {
            $this->setAppname($name, $license);
        } elseif (isset($name)) {
            $this->setAppname($name);
        }
    }

    /**
     * Check if the New Relic extension is loaded.
     *
     * @return bool
     */
    public function isLoaded(): bool
    {
        return $this->loaded;
    }

    /**
     * Attaches a custom attribute (key/value pair) to the current transaction.
     *
     * Agent version 4.4.5.35 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_add_custom_parameter
     *
     * @param string $key   The name of the custom attribute. Only the first 255 characters are retained
     * @param mixed  $value The value to associate with this custom attribute
     *
     * @return bool
     */
    public function addCustomParameter(string $key, $value): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_add_custom_parameter($key, $value);
    }

    /**
     * Specify functions or methods for the agent to instrument with custom instrumentation.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_add_custom_tracer
     *
     * @param string $callable The name can be formatted either as function_name for procedural functions,
     *                         or as "ClassName::method" for methods
     *
     * @return bool
     */
    public function addCustomTracer(string $callable): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_add_custom_tracer($callable);
    }

    /**
     * Manually specify that a transaction is a background job or a web transaction.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_background_job
     *
     * @param bool $flag (optional) Defaults to true
     */
    public function backgroundJob(bool $flag = true)
    {
        if ($this->isLoaded()) {
            newrelic_background_job($flag);
        }
    }

    /**
     * Enable or disable the capture of URL parameters.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_capture_params
     *
     * @param bool $enable (optional) Defaults to true
     */
    public function captureParams(bool $enable = true)
    {
        if ($this->isLoaded()) {
            newrelic_capture_params($enable);
        }
    }

    /**
     * Add a custom metric (in milliseconds) to time a component of your app not captured by default.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newreliccustommetric-php-agent-api
     *
     * @param string $metric Name your custom metrics with a Custom/ prefix (for example, Custom/MyMetric)
     * @param float  $value  Records timing in milliseconds. For example: a value of 4 is stored as .004 seconds
     *                       in New Relic's systems
     *
     * @return bool
     */
    public function customMetric(string $metric, float $value): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_custom_metric($metric, $value);
    }

    /**
     * Disable automatic injection of the New Relic Browser snippet on particular pages.
     *
     * Agent version 2.6.5.41 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_disable_autorum
     * @see self::getBrowserTimingFooter
     * @see self::getBrowserTimingHeader
     *
     * @return bool
     */
    public function disableAutorum(): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_disable_autorum();
    }

    /**
     * Stop timing the current transaction, but continue instrumenting it.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_end_of_transaction
     * @see self::endTransaction
     */
    public function endOfTransaction()
    {
        if ($this->isLoaded()) {
            newrelic_end_of_transaction();
        }
    }

    /**
     * Stop instrumenting the current transaction immediately.
     *
     * Agent version 3.0.5.95 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_end_transaction
     * @see self::endOfTransaction
     * @see self::startTransaction
     *
     * @param bool $ignore (optional) Defaults to false
     *
     * @return bool
     */
    public function endTransaction(bool $ignore = false): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_end_transaction($ignore);
    }

    /**
     * Returns a New Relic Browser snippet to inject at the end of the HTML output.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_get_browser_timing_footer
     * @see self::disableAutorum
     * @see self::getBrowserTimingHeader
     *
     * @param bool $tags (optional) Defaults to true. If true or omitted, the string is enclosed in a <script>
     *                   element for easy inclusion in the page's HTML
     *
     * @return string|null
     */
    public function getBrowserTimingFooter(bool $tags = true): ?string
    {
        if (!$this->isLoaded()) {
            return null;
        }

        return newrelic_get_browser_timing_footer($tags);
    }

    /**
     * Returns a New Relic Browser snippet to inject in the head of your HTML output.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_get_browser_timing_header
     * @see self::disableAutorum
     * @see self::getBrowserTimingFooter
     *
     * @param bool $tags (optional) Defaults to true. If true or omitted, the string is enclosed in a <script>
     *                   element for easy inclusion in the page's HTML.
     *
     * @return string|null
     */
    public function getBrowserTimingHeader(bool $tags = true): ?string
    {
        if (!$this->isLoaded()) {
            return null;
        }

        return newrelic_get_browser_timing_header($tags);
    }

    /**
     * Ignore the current transaction when calculating Apdex.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_ignore_apdex
     */
    public function ignoreApdex()
    {
        if ($this->isLoaded()) {
            newrelic_ignore_apdex();
        }
    }

    /**
     * Do not instrument the current transaction.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_ignore_transaction
     */
    public function ignoreTransaction()
    {
        if ($this->isLoaded()) {
            newrelic_ignore_transaction();
        }
    }

    /**
     * Set custom name for current transaction.
     *
     * Compatible with all agent versions.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_name_transaction
     *
     * @param string $name Name of the transaction
     *
     * @return bool
     */
    public function nameTransaction(string $name): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_name_transaction($name);
    }

    /**
     * Use these calls to collect errors that the PHP agent does not collect automatically and to set the callback
     * for your own error and exception handler.
     *
     * Agent version 2.6 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_notice_error
     *
     * @param string|\Throwable|\Exception|int $message|$e|$e|$errno
     * @param \Throwable|\Exception|sring      $e|$e|$errstr         (optional)
     * @param string                           $errfile              (optional)
     * @param int                              $errline              (optional)
     * @param string                           $errcontext           (optional)
     */
    public function noticeError(...$arguments)
    {
        if ($this->isLoaded()) {
            newrelic_notice_error(...$arguments);
        }
    }

    /**
     * Record a custom event with the given name and attributes.
     *
     * Agent version 4.18.0.89 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_record_custom_event
     *
     * @param string $name       Name of the custom event
     * @param array  $attributes Supply custom attributes as an associative array
     *
     * @since 2.0.0
     */
    public function recordCustomEvent(string $name, array $attributes)
    {
        if ($this->isLoaded()) {
            newrelic_record_custom_event($name, $attributes);
        }
    }

    /**
     * Records a datastore segment.
     *
     * Agent version 7.5.0.199 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_record_datastore_segment
     *
     * @param callable $callback   The function that should be timed to create the datastore segment
     * @param array    $parameters An associative array of parameters describing the datastore call
     *
     * @return mixed The return value of $callback is returned. If an error occurs, false is returned, and an error
     *               at the E_WARNING level will be triggered
     *
     * @since 3.0.0
     */
    public function recordDatastoreSegment(callable $callback, array $parameters)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_record_datastore_segment($callback, $parameters);
    }

    /**
     * Sets the New Relic app name, which controls data rollup.
     *
     * Agent version 3.1.5.111 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_set_appname
     *
     * @param string|array $name    Name(s) of app metrics should be reported under in New Relic user interface
     * @param string       $license (optional) Specify a different license key to report metrics to a different
     *                              New Relic account
     * @param bool         $xmit    (optional) Defaults to false
     *
     * @return bool
     */
    public function setAppname($name, string $license = null, bool $xmit = false): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        $name = is_array($name) ? implode(';', $name) : $name;

        if (isset($license)) {
            return newrelic_set_appname($name, $license, $xmit);
        }

        return newrelic_set_appname($name);
    }

    /**
     * Create user-related custom attributes. newrelic_add_custom_parameter is more flexible.
     *
     * Agent version 3.1.5.111 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_set_user_attributes
     * @see self::addCustomParameter
     *
     * @param string $user    Specify a name or username to associate with this page view
     * @param string $account Specify the name of a user account to associate with this page view
     * @param string $product Specify the name of a product to associate with this page view
     *
     * @return bool
     */
    public function setUserAttributes(string $user, string $account, string $product): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_set_user_attributes($user, $account, $product);
    }

    /**
     * Starts a new transaction, usually after manually ending a transaction.
     *
     * Agent version 3.0.5.95 or higher.
     *
     * @see https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_start_transaction
     * @see self::endTransaction
     *
     * @param string $appname The application name to associate with data from this transaction
     * @param string $license (optional) Provide a different license key if you want the transaction to report
     *                        to a different New Relic account
     *
     * @return bool
     */
    public function startTransaction(string $appname, string $license = null): bool
    {
        if (!$this->isLoaded()) {
            return false;
        }

        if (isset($license)) {
            return newrelic_start_transaction($appname, $license);
        }

        return newrelic_start_transaction($appname);
    }
}
