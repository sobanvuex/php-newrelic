<?php

/**
 * PHP NewRelic library.
 *
 * @copyright 2014 Alex Soban. See LICENSE for information.
 * @license   http://opensource.org/licenses/MIT
 * @author    Alex Soban <me@soban.co>
 */

namespace NewRelic;

use Guzzle\Http\Curl\CurlVersion;
use Guzzle\Common\Version as GuzzleVersion;

/**
 * Class Version
 *
 * @package NewRelic
 */
class Version
{

    const VERSION = '1.0.0';

    /**
     * @return string Indicate current SDK version.
     */
    public static function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return bool|float|string Indicate cURL's version.
     */
    public static function getCurlVersion()
    {
        return CurlVersion::getInstance()->get('version');
    }

    /**
     * @return string Indicate Guzzle's version.
     */
    public static function getGuzzleVersion()
    {
        return GuzzleVersion::VERSION;
    }

}
