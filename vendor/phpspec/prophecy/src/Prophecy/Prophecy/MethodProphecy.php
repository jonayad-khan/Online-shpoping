             ."(name(.) = 'input' and @type != 'hidden')"
                    ." or name(.) = 'button'"
                    ." or name(.) = 'select'"
                    ." or name(.) = 'textarea'"
                    ." or name(.) = 'keygen'"
                .')'
                .' and not (@disabled or ancestor::fieldset[@disabled])'
            .') or ('
                ."name(.) = 'option' and not("
                    .'@disabled or ancestor::optgroup[@disabled]'
                .')'
            .')'
        );
    }

    /**
     * @return XPathExpr
     *
     * @throws ExpressionErrorException
     */
    public function translateLang(XPathExpr $xpath, FunctionNode $function)
    {
        $arguments = $function->getArguments();
        foreach ($arguments as $token) {
            if (!($token->isString() || $token->isIdentifier())) {
                throw new ExpressionErrorException(
                    'Expected a single string or identifier for :lang(), got '
                    .implode(', ', $arguments)
                );
            }
        }

        return $xpath->addCondition(sprintf(
            'ancestor-or-self::*[@lang][1][starts-with(concat('
            ."translate(@%s, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '-')"
            .', %s)]',
            'lang',
            Translator::getXpathLiteral(strtolower($arguments[0]->getValue()).'-')
        ));
    }

    /**
     * @return XPathExpr
     */
    public function translateSelected(XPathExpr $xpath)
    {
        return $xpath->addCondition("(@selected and name(.) = 'option')");
    }

    /**
     * @return XPathExpr
     */
    public function translateInvalid(XPathExpr $xpath)
    {
        return $xpath->addCondition('0');
    }

    /**
     * @return XPathExpr
     */
    public function translateHover(XPathExpr $xpath)
    {
        return $xpath->addCondition('0');
    }

    /**
     * @return XPathExpr
     */
    public function translateVisited(XPathExpr $xpath)
    {
        return $xpath->addCondition('0');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'html';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         {
    "name": "psr/container",
    "type": "library",
    "description": "Common Container Interface (PHP FIG PSR-11)",
    "keywords": ["psr", "psr-11", "container", "container-interop", "container-interface"],
    "homepage": "https://github.com/php-fig/container",
    "license": "MIT",
    "authors": [
        {
            "name": "PHP-FIG",
            "homepage": "http://www.php-fig.org/"
        }
    ],
    "require": {
        "php": ">=5.3.0"
    },
    "autoload": {
        "psr-4": {
            "Psr\\Container\\": "src/"
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "1.0.x-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use PhpConsole\Connector;
use PhpConsole\Handler;
use PhpConsole\Helper;

/**
 * Monolog handler for Google Chrome extension "PHP Console"
 *
 * Display PHP error/debug log messages in Google Chrome console and notification popups, executes PHP code remotely
 *
 * Usage:
 * 1. Install Google Chrome extension https://chrome.google.com/webstore/detail/php-console/nfhmhhlpfleoednkpnnnkolmclajemef
 * 2. See overview https://github.com/barbushin/php-console#overview
 * 3. Install PHP Console library https://github.com/barbushin/php-console#installation
 * 4. Example (result will looks like http://i.hizliresim.com/vg3Pz4.png)
 *
 *      $logger = new \Monolog\Logger('all', array(new \Monolog\Handler\PHPConsoleHandler()));
 *      \Monolog\ErrorHandler::register($logger);
 *      echo $undefinedVar;
 *      $logger->addDebug('SELECT * FROM users', array('db', 'time' => 0.012));
 *      PC::debug($_SERVER); // PHP Console debugger for any type of vars
 *
 * @author Sergey Barbushin https://www.linkedin.com/in/barbushin
 */
class PHPConsoleHandler extends AbstractProcessingHandler
{
    private $options = array(
        'enabled' => true, // bool Is PHP Console server enabled
        'classesPartialsTraceIgnore' => array('Monolog\\'), // array Hide calls of classes started with...
        'debugTagsKeysInContext' => array(0, 'tag'), // bool Is PHP Console server enabled
        'useOwnErrorsHandler' => false, // bool Enable errors handling
        'useOwnExceptionsHandler' => false, // bool Enable exceptions handling
        'sourcesBasePath' => null, // string Base path of all project sources to strip in errors source paths
        'registerHelper' => true, // bool Register PhpConsole\Helper that allows short debug calls like PC::debug($var, 'ta.g.s')
        'serverEncoding' => null, // string|null Server internal encoding
        'headersLimit' => null, // int|null Set headers size limit for your web-server
        'password' => null, // string|null Protect PHP Console connection by password
        'enableSslOnlyMode' => false, // bool Force connection by SSL for clients with PHP Console installed
        'ipMasks' => array(), // array Set IP masks of clients that will be allowed to connect to PHP Console: array('192.168.*.*', '127.0.0.1')
        'enableEvalListener' => false, // bool Enable eval request to be handled by eval dispatcher(if enabled, 'password' option is also required)
        'dumperDetectCallbacks' => false, // bool Convert callback items in dumper vars to (callback SomeClass::someMethod) strings
        'dumperLevelLimit' => 5, // int Maximum dumped vars array or object nested dump level
        'dumperItemsCountLimit' => 100, // int Maximum dumped var same level array items or object properties number
        'dumperItemSizeLimit' => 5000, // int Maximum length of any string or dumped array item
        'dumperDumpSizeLimit' => 500000, // int Maximum approximate size of dumped vars result formatted in JSON
        'detectDumpTraceAndSource' => false, // bool Autodetect and append trace data to debug
        'dataStorage' => null, // PhpConsole\Storage|null Fixes problem with custom $_SESSION handler(see http://goo.gl/Ne8juJ)
    );

    /** @var Connector */
    private $connector;

    /**
     * @param  array          $options   See \Monolog\Handler\PHPConsoleHandler::$options for more details
     * @param  Connector|null $connector Instance of \PhpConsole\Connector class (optional)
     * @param  int            $level
     * @param  bool           $bubble
     * @throws Exception
     */
    public function __construct(