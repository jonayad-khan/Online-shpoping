<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use Psy\Exception\FatalErrorException;

/**
 * Validate that the user did not use the call-time pass-by-reference that causes a fatal error.
 *
 * As of PHP 5.4.0, call-time pass-by-reference was removed, so using it will raise a fatal error.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class CallTimePassByReferencePass extends CodeCleanerPass
{
    const EXCEPTION_MESSAGE = 'Call-time pass-by-reference has been removed';

    /**
     * Validate of use call-time pass-by-reference.
     *
     * @throws RuntimeException if the user used call-time pass-by-reference in PHP >= 5.4.0
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (version_compare(PHP_VERSION, '5.4', '<')) {
            return;
        }

        if (!$node instanceof FuncCall && !$node instanceof MethodCall && !$node instanceof StaticCall) {
            return;
        }

        foreach ($node->args as $arg) {
            if ($arg->byRef) {
                throw new FatalErrorException(self::EXCEPTION_MESSAGE, 0, E_ERROR, null, $node->getLine());
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Faker\Provider\en_GB;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = array(
        '+44(0)##########',
        '+44(0)#### ######',
        '+44(0)#########',
        '+44(0)#### #####',
        '0##########',
        '0#########',
        '0#### ######',
        '0#### #####',
        '0### ### ####',
        '0### #######',
        '(0####) ######',
        '(0####) #####',
        '(0###) ### ####',
        '(0###) #######',
    );

    /**
     * An array of en_GB mobile (cell) phone number formats
     * @var array
     */
    protected static $mobileFormats = array(
      // Local
      '07#########',
      '07### ######',
      '07### ### ###'
    );

    /**
     * Return a en_GB mobile phone number
     * @return string
     */
    public static function mobileNumber()
    {
        return static::numerify(static::randomElement(static::$mobileFormats));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  