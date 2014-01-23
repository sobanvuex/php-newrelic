<?php

/**
 * PHP NewRelic library.
 *
 * @copyright 2014 Alex Soban. See LICENSE for information.
 * @license   http://opensource.org/licenses/MIT
 * @author    Alex Soban <me@soban.co>
 */

namespace NewRelic;

/**
 * Wrapper for the New Relic Agent API
 *
 * @method  boolean setAppname(string $name, string $license = 'newrelic.license', boolean $xmit = false)
 * @method  void    noticeError(string|null $message, Exception|string $exception)
 * @method  void    nameTransaction(string $name)
 * @method  void    endOfTransaction()
 * @method  void    endTransaction(boolean $ignore = false)
 * @method  void    startTransaction(string $appname, string $license = 'newrelic.license')
 * @method  void    ignoreTransaction()
 * @method  void    ignoreApdex()
 * @method  void    backgroundJob(boolean $flag = true)
 * @method  void    captureParams(string $enable = 'on')
 * @method  void    customMetric(string $metric, float $value)
 * @method  void    addCustomParameter(string $parameter, string $value)
 * @method  void    addCustomTracer(string $callable)
 * @method  string  getBrowserTimingHeader(boolean $flag = true)
 * @method  string  getBrowserTimingFooter(boolean $flag = true)
 * @method  void    disableAutorum()
 * @method  void    setUserAttributes(string $user, string $account, string $product)
 * @package NewRelic
 */
class NewRelicAgent
{

    /**
     * Local class instnace
     *
     * @var null|NewRelicAgent
     */
    protected static $_instance = null;

    /**
     * Cache the result of extension_loaded()
     *
     * @var boolean
     */
    protected $_loaded = false;

    /**
     * Construct a new `NewRelicAgent` object. Optionally set the application name
     * from the configuration data `name` parameter
     *
     * @param array $config Configuration data
     */
    public function __construct($config = array())
    {
        $this->_loaded = extension_loaded('newrelic') && function_exists('newrelic_set_appname');

        if ($this->_loaded && !empty($config['name'])) {
            $this->setAppname($config['name']);
        }
    }

    /**
     * Magic method used to call the New Relic Agent API
     *
     * @param string $method    Name of the command to call
     * @param array  $arguments Arguments to pass to the command
     */
    public function __call($method, $arguments)
    {
        if ($this->_loaded && function_exists($method = $this->_method($method))) {
            return call_user_func_array($method, $arguments);
        }

        return false;
    }

    /**
     * Static magic method wrapper
     *
     * @param string $method    Name of the command to call
     * @param array  $arguments Arguments to pass to the command
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array(array(static::_object(), $method), $arguments);
    }

    /**
     * Convert command name from cameCase to undesr_score
     *
     * @param string $name Name of the command
     * @return string API function name
     */
    protected function _method($name)
    {
        return 'newrelic_' . strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
    }

    /**
     * Returns an instance of `NewRelicAgent`. Used when called staticaly
     *
     * @return NewRelicAgent
     */
    protected static function &_object()
    {
        if (empty(static::$_instance) && $class = get_called_class()) {
            static::$_instance = new $class();
        }

        return static::$_instance;
    }

}
