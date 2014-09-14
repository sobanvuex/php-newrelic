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
 * Class Version
 *
 * @package NewRelic
 */
class Version
{

    const VERSION = '1.2.0';

    /**
     * @return string Indicate current SDK version.
     */
    public static function getVersion()
    {
        return static::VERSION;
    }

}
