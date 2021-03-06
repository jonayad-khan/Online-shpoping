re about is whether or not we
            // can read it at this point. If the PHP environment is going to
            // panic over trying to see if the file can be read in the first
            // place, that is not helpful to us here.

            // See random_bytes_dev_urandom.php
            require_once $RandomCompatDIR . '/random_bytes_dev_urandom.php';
        }
        // Unset variables after use
        $RandomCompat_basedir = null;
    } else {
        $RandomCompatUrandom = false;
    }

    /**
     * mcrypt_create_iv()
     *
     * We only want to use mcypt_create_iv() if:
     *
     * - random_bytes() hasn't already been defined
     * - the mcrypt extensions is loaded
     * - One of these two conditions is true:
     *   - We're on Windows (DIRECTORY_SEPARATOR !== '/')
     *   - We're not on Windows and /dev/urandom is readabale
     *     (i.e. we're not in a chroot jail)
     * - Special case:
     *   - If we're not on Windows, but the PHP version is between
     *     5.6.10 and 5.6.12, we don't want to use mcrypt. It will
     *     hang indefinitely. This is bad.
     *   - If we're on Windows, we want to use PHP >= 5.3.7 or else
     *     we get insufficient entropy errors.
     */
    if (
        !is_callable('random_bytes')
        &&
        // Windows on PHP < 5.3.7 is broken, but non-Windows is not known to be.
        (DIRECTORY_SEPARATOR === '/' || PHP_VERSION_ID >= 50307)
        &&
        // Prevent this code from hanging indefinitely on non-Windows;
        // see https://bugs.php.net/bug.php?id=69833
        (
            DIRECTORY_SEPARATOR !== '/' ||
            (PHP_VERSION_ID <= 50609 || PHP_VERSION_ID >= 50613)
        )
        &&
        extension_loaded('mcrypt')
    ) {
        // See random_bytes_mcrypt.php
        require_once $RandomCompatDIR . '/random_bytes_mcrypt.php';
    }
    $RandomCompatUrandom = null;

    /**
     * This is a Windows-specific fallback, for when the mcrypt extension
     * isn't loaded.
     */
    if (
        !is_callable('random_bytes')
        &&
        extension_loaded('com_dotnet')
        &&
        class_exists('COM')
    ) {
        $RandomCompat_disabled_classes = preg_split(
            '#\s*,\s*#',
            strtolower(ini_get('disable_classes'))
        );

        if (!in_array('com', $RandomCompat_disabled_classes)) {
            try {
                $RandomCompatCOMtest = new COM('CAPICOM.Utilities.1');
                if (method_exists($RandomCompatCOMtest, 'GetRandom')) {
                    // See random_bytes_com_dotnet.php
                    require_once $RandomCompatDIR . '/random_bytes_com_dotnet.php';
                }
            } catch (com_exception $e) {
                // Don't try to use it.
            }
        }
        $RandomCompat_disabled_classes = null;
        $RandomCompatCOMtest = null;
    }

    /**
     * throw new Exception
     */
    if (!is_callable('random_bytes')) {
        /**
         * We don't have any more options, so let's throw an exception right now
         * and hope the developer won't let it fail silently.
         *
         * @param mixed $length
         * @return void
         * @throws Exception
         */
        function random_bytes($length)
        {
            unset($length); // Suppress "variable not used" warnings.
            throw new Exception(
                'There is no suitable CSPRNG installed on your system'
            );
        }
    }
}

if (!is_callable('random_int')) {
    require_once $RandomCompatDIR . '/random_int.php';
}

$RandomCompatDIR = null;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\ExecutionLoop;

use Psy\Configuration;
use Psy\Exception\BreakException;
use Psy\Exception\ErrorException;
use Psy\Exception\ThrowUpException;
use Psy