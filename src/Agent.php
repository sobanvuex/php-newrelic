<?php

/**
 * This file is part of the PHP New Relic package.
 *
 * (c) Alex Soban <me@soban.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SobanVuex\NewRelic;

use Exception;

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
     * @param string|array $appname
     * @param string       $license
     */
    public function __construct($appname = null, $license = null)
    {
        $this->loaded = extension_loaded('newrelic');

        if ($appname) {
            $this->setAppname($appname, $license);
        }
    }

    /**
     * Check if the New Relic extension is loaded.
     *
     * @return bool
     */
    public function isLoaded()
    {
        return $this->loaded;
    }

    /**
     * Add a custom parameter to the current web transaction with the specified value.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-param
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function addCustomParameter($key, $value)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_add_custom_parameter($key, $value);
    }

    /**
     * Add user-defined functions or methods to the list to be instrumented.
     * Internal PHP functions cannot have custom tracing.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-tracer
     *
     * @param string $callable
     *
     * @return bool
     */
    public function addCustomTracer($callable)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_add_custom_tracer($callable);
    }

    /**
     * Mark a transaction as a background job.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-bg
     *
     * @param bool $flag
     */
    public function backgroundJob($flag = true)
    {
        if ($this->isLoaded()) {
            newrelic_background_job($flag);
        }
    }

    /**
     * Enable/disable the capturing of URL parameters for displaying in transaction traces.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-capture-params
     *
     * @param bool $enable
     */
    public function captureParams($enable = true)
    {
        if ($this->isLoaded()) {
            newrelic_capture_params($enable);
        }
    }

    /**
     * Add custom metric with the specified $name and $value, which is of type double. Values saved are assumed to be
     * milliseconds.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-custom-metric
     *
     * @param string $metric
     * @param float  $value
     *
     * @return bool
     */
    public function customMetric($metric, $value)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_custom_metric($metric, $value);
    }

    /**
     * Disable the insertion of the JavaScript for page load timing (RUM) for the current transaction.
     * The return value can be different from `true` if the extension is not loaded.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-rum-disable
     *
     * @param bool $return
     *
     * @return bool
     */
    public function disableAutorum($return = true)
    {
        if (!$this->isLoaded()) {
            return $return;
        }

        return newrelic_disable_autorum();
    }

    /**
     * Stop recording the current transaction. The metrics gathered are send to the daemon when the PHP engine
     * determines the script is done and is shutting down. Useful with file downloads, streaming, etc.
     *
     * Added in New Relic Agent 3.0.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-eot
     */
    public function endOfTransaction()
    {
        if ($this->isLoaded()) {
            newrelic_end_of_transaction();
        }
    }

    /**
     * Stop recording the current transaction and send all of the metrics gathered thus far to the daemon, unless
     * $ignore is set to `true`. Useful with queue processing where more than one transactions can occur over the
     * execution of the script.
     *
     * Added in New Relic Agent 2.3.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-end-txn
     * @see  startTransaction
     *
     * @param bool $ignore
     *
     * @return bool
     */
    public function endTransaction($ignore = false)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_end_transaction($ignore);
    }

    /**
     * Get the JavaScript for page load timing (RUM) which is to be inserted at the end of the HTML output.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-rum-footer
     *
     * @param bool $tags Wrap with a `<script>` tag when set to `true`
     *
     * @return string
     */
    public function getBrowserTimingFooter($tags = true)
    {
        if (!$this->isLoaded()) {
            return '';
        }

        return newrelic_get_browser_timing_footer($tags);
    }

    /**
     * Get the JavaScript for page load timing (RUM) which is to be inserted at the beginning of the HTML output.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-rum-header
     *
     * @param bool $tags Wrap with a `<script>` tag when set to `true`
     *
     * @return string
     */
    public function getBrowserTimingHeader($tags = true)
    {
        if (!$this->isLoaded()) {
            return '';
        }

        return newrelic_get_browser_timing_header($tags);
    }

    /**
     * Do not generate Apdex metrics for this transaction. This is useful when you have either very short or very long
     * transactions (such as file downloads) that can skew your Apdex score.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-ignore-apdex
     */
    public function ignoreApdex()
    {
        if ($this->isLoaded()) {
            newrelic_ignore_apdex();
        }
    }

    /**
     * Do not generate metrics for this transaction. This is useful when you have transactions that are particularly
     * slow for known reasons and you do not want them always being reported as the transaction trace or skewing your
     * site averages.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-ignore-transaction
     */
    public function ignoreTransaction()
    {
        if ($this->isLoaded()) {
            newrelic_ignore_transaction();
        }
    }

    /**
     * Sets the name of the transaction to the specified name. This can be useful if you have implemented your own
     * dispatching scheme and want to name transactions according to their purpose rather than their URL.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-name-wt
     *
     * @param string $name
     *
     * @return bool
     */
    public function nameTransaction($name)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_name_transaction($name);
    }

    /**
     * Report an error at this line of code, with a complete stack trace.
     *
     * Added in New Relic Agent 2.6.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-notice-error
     *
     * @param string    $message
     * @param Exception $exception
     */
    public function noticeError($message, Exception $exception = null)
    {
        if ($this->isLoaded()) {
            newrelic_notice_error($message, $exception);
        }
    }

    /**
     * Records a New Relic Insights custom event.
     *
     * Added in New Relic Agent 4.18.
     *
     * @link  https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-record-custom-event
     *
     * @param string $name
     * @param array  $attributes
     *
     * @since 2.0.0
     */
    public function recordCustomEvent($name, array $attributes)
    {
        if ($this->isLoaded()) {
            newrelic_record_custom_event($name, $attributes);
        }
    }

    /**
     * Sets the name of the application to name. You can set multiple application names by using `newrelic.appname`
     * format - "App1;App2" or passing an array - ['App1', 'App2'].
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-set-appname
     *
     * @param string|array $name
     * @param string       $license
     * @param bool         $xmit
     *
     * @return bool
     */
    public function setAppname($name, $license = null, $xmit = false)
    {
        if (!$this->isLoaded()) {
            return false;
        }
        if (is_array($name)) {
            $name = implode(';', $name);
        }

        return newrelic_set_appname($name, $license ?: ini_get('newrelic.license'), $xmit);
    }

    /**
     * Added New Relic Agent 3.1.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-set-user-attributes
     *
     * @param string $user
     * @param string $account
     * @param string $product
     *
     * @return bool
     */
    public function setUserAttributes($user, $account, $product)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_set_user_attributes($user, $account, $product);
    }

    /**
     * If you have ended a transaction before your script terminates (perhaps due to it just having finished a task in
     * a job queue manager) and you want to start a new transaction, use this call.
     *
     * Added in New Relic Agent 3.0.
     *
     * @link https://docs.newrelic.com/docs/agents/php-agent/configuration/php-agent-api#api-start-txn
     * @see  endTransaction
     *
     * @param string $appname
     * @param string $license
     *
     * @return bool
     */
    public function startTransaction($appname, $license = null)
    {
        if (!$this->isLoaded()) {
            return false;
        }

        return newrelic_start_transaction($appname, $license ?: ini_get('newrelic.license'));
    }
}
