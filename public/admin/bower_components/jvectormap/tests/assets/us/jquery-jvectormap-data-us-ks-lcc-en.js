<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Debug\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\Exception\OutOfMemoryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

require_once __DIR__.'/HeaderMock.php';

class ExceptionHandlerTest extends TestCase
{
    protected function setUp()
    {
        testHeader();
    }

    protected function tearDown()
    {
        testHeader();
    }

    public function testDebug()
    {
        $handler = new ExceptionHandler(false);

        ob_start();
        $handler->sendPhpResponse(new \RuntimeException('Foo'));
        $response = ob_get_clean();

        $this->assertContains('Whoops, looks like something went wrong.', $response);
        $this->assertNotContains('<div class="trace trace-as-html">', $response);

        $handler = new ExceptionHandler(true);

        ob_start();
        $handler->sendPhpResponse(new \RuntimeException('Foo'));
        $response = ob_get_clean();

        $this->assertContains('Whoops, looks like something went wrong.', $response);
        $this->assertContains('<div class="trace trace-as-html">', $response);
    }

    public function testStatusCode()
    {
        $handler = new ExceptionHandler(false, 'iso8859-1');

        ob_start();
        $handler->sendPhpResponse(new NotFoundHttpException('Foo'));
        $response = ob_get_clean();

        $this->assertContains('Sorry, the page you are looking for could not be found.', $response);

        $expectedHeaders = array(
            array('HTTP/1.0 404', true, null),
            array('Content-Type: text/html; charset=iso8859-1', true, null),
        );

        $this->assertSame($expectedHeaders, testHeader());
    }

    public function testHeaders()
    {
        $handler = new ExceptionHandler(false, 'iso8859-1');

        ob_start();
        $handler->sendPhpResponse(new MethodNotAllowedHttpException(array('POST')));
        $response = ob_get_clean();

        $expectedHeaders = array(
            array('HTTP/1.0 405', true, null),
            array('Allow: POST', false, null),
            array('Content-Type: text/html; charset=iso8859-1', true, null),
        );

        $this->assertSame($expectedHeaders, testHeader());
    }

    public function testNestedExceptions()
    {
        $handler = new ExceptionHandler(true);
        ob_start();
        $handler->sendPhpResponse(new \RuntimeException('Foo', 0, new \RuntimeException('Bar')));
        $response = ob_get_clean();

        $this->assertStringMatchesFormat('%A<p class="break-long-words trace-message">Foo</p>%A<p class="break-long-words trace-message">Bar</p>%A', $response);
    }

    public function testHandle()
    {
        $exception = new \Exception('foo');

        $handler = $this->getMockBuilder('Symfony\Component\Debug\ExceptionHandler')->setMethods(array('sendPhpResponse'))->getMock();
        $handler
            ->expects($this->exactly(2))
            ->method('sendPhpResponse');

        $handler->handle($exception);

        $handler->setHandler(function ($e) use ($exception) {
            $this->assertSame($exception, $e);
        });

        $handler->handle($exception);
    }

    public function testHandleOutOfMemoryException()
    {
        $exception = new OutOfMemoryException('foo', 0, E_ERROR, __FILE__, __LINE__);

        $handler = $this->getMockBuilder('Symfony\Component\Debug\ExceptionHandler')->setMethods(array('sendPhpResponse'))->getMock();
        $handler
            ->expects($this->once())
            ->method('sendPhpResponse');

        $handler->setHandler(function ($e) {
            $this->fail('OutOfMemoryException should bypass the handler');
        });

        $handler->handle($exception);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SurrogateInterface
{
    /**
     * Returns surrogate name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns a new cache strategy instance.
     *
     * @return ResponseCacheStrategyInterface A ResponseCacheStrategyInterface instance
     */
    public function createCacheStrategy();

    /**
     * Checks that at least one surrogate has Surrogate capability.
     *
     * @return bool true if one surrogate has Surrogate capability, false otherwise
     */
    public function hasSurrogateCapability(Request $request);

    /**
     * Adds Surrogate-capability to the given Request.
     */
    public function addSurrogateCapability(Request $request);

    /**
     * Adds HTTP headers to specify that the Response needs to be parsed for Surrogate.
     *
     * This method only adds an Surrogate HTTP header if the Response has some Surrogate tags.
     */
    public function addSurrogateControl(Response $response);

    /**
     * Checks that the Response needs to be parsed for Surrogate tags.
     *
     * @return bool true if the Response needs to be parsed, false otherwise
     */
    public function needsParsing(Response $response);

    /**
     * Renders a Surrogate tag.
     *
     * @param string $uri          A URI
     * @param string $alt          An alternate URI
     * @param bool   $ignoreErrors Whether to ignore errors or not
     * @param string $comment      A comment to add as an esi:include tag
     *
     * @return string
     */
    public function renderIncludeTag($uri, $alt = null, $ignoreErrors = true, $comment = '');

    /**
     * Replaces a Response Surrogate tags with the included resource content.
     *
     * @return Response
     */
    public function process(Request $request, Response $response);

    /**
     * Handles a Surrogate from the cache.
     *
     * @param HttpCache $cache        An HttpCache instance
     * @param string    $uri          The main URI
     * @param string    $alt          An alternative URI
     * @param bool      $ignoreErrors Whether to ignore errors or not
     *
     * @return string
     *
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function handle(HttpCache $cache, $uri, $alt, $ignoreErrors);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'phpDocumentor\\Reflection\\' => array($vendorDir . '/phpdocumentor/reflection-common/src', $vendorDir . '/phpdocumentor/type-resolver/src', $vendorDir . '/phpdocumentor/reflection-docblock/src'),
    'XdgBaseDir\\' => array($vendorDir . '/dnoegel/php-xdg-base-dir/src'),
    'Whoops\\' => array($vendorDir . '/filp/whoops/src/Whoops'),
    'Webmozart\\Assert\\' => array($vendorDir . '/webmozart/assert/src'),
    'TijsVerkoyen\\CssToInlineStyles\\' => array($vendorDir . '/tijsverkoyen/css-to-inline-styles/src'),
    'Tests\\' => array($baseDir . '/tests'),
    'Symfony\\Thanks\\' => array($vendorDir . '/symfony/thanks/src'),
    'Symfony\\Polyfill\\Php72\\' => array($vendorDir . '/symfony/polyfill-php72'),
    'Symfony\\Polyfill\\Mbstring\\' => array($vendorDir . '/symfony/polyfill-mbstring'),
    'Symfony\\Component\\VarDumper\\' => array($vendorDir . '/symfony/var-dumper'),
    'Symfony\\Component\\Translation\\' => array($vendorDir . '/symfony/translation'),
    'Symfony\\Component\\Routing\\' => array($vendorDir . '/symfony/routing'),
    'Symfony\\Component\\Process\\' => array($vendorDir . '/symfony/process'),
    'Symfony\\Component\\HttpKernel\\' => array($vendorDir . '/symfony/http-kernel'),
    'Symfony\\Component\\HttpFoundation\\' => array($vendorDir . '/symfony/http-foundation'),
    'Symfony\\Component\\Finder\\' => array($vendorDir . '/symfony/finder'),
    'Symfony\\Component\\EventDispatcher\\' => array($vendorDir . '/symfony/event-dispatcher'),
    'Symfony\\Component\\Debug\\' => array($vendorDir . '/symfony/debug'),
    'Symfony\\Component\\CssSelector\\' => array($vendorDir . '/symfony/css-selector'),
    'Symfony\\Component\\Console\\' => array($vendorDir . '/symfony/console'),
    'Ramsey\\Uuid\\' => array($vendorDir . '/ramsey/uuid/src'),
    'Psy\\' => array($vendorDir . '/psy/psysh/src/Psy'),
    'Psr\\SimpleCache\\' => array($vendorDir . '/psr/simple-cache/src'),
    'Psr\\Log\\' => array($vendorDir . '/psr/log/Psr/Log'),
    'Psr\\Container\\' => array($vendorDir . '/psr/container/src'),
    'PhpParser\\' => array($vendorDir . '/nikic/php-parser/lib/PhpParser'),
    'NunoMaduro\\Collision\\' => array($vendorDir . '/nunomaduro/collision/src'),
    'Monolog\\' => array($vendorDir . '/monolog/monolog/src/Monolog'),
    'League\\Flysystem\\' => array($vendorDir . '/league/flysystem/src'),
    'Laravel\\Tinker\\' => array($vendorDir . '/laravel/tinker/src'),
    'Illuminate\\' => array($vendorDir . '/laravel/framework/src/Illuminate'),
    'Fideloper\\Proxy\\' => array($vendorDir . '/fideloper/proxy/src'),
    'Faker\\' => array($vendorDir . '/fzaninotto/faker/src/Faker'),
    'Egulias\\EmailValidator\\' => array($vendorDir . '/egulias/email-validator/EmailValidator'),
    'Dotenv\\' => array($vendorDir . '/vlucas/phpdotenv/src'),
    'Doctrine\\Instantiator\\' => array($vendorDir . '/doctrine/instantiator/src/Doctrine/Instantiator'),
    'Doctrine\\Common\\Inflector\\' => array($vendorDir . '/doctrine/inflector/lib/Doctrine/Common/Inflector'),
    'DeepCopy\\' => array($vendorDir . '/myclabs/deep-copy/src/DeepCopy'),
    'Cron\\' => array($vendorDir . '/dragonmantank/cron-expression/src/Cron'),
    'Carbon\\' => array($vendorDir . '/nesbot/carbon/src/Carbon'),
    'App\\' => array($baseDir . '/app'),
);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/**
 * Base test for smoke tests.
 *
 * @author Rouven Weßling
 */
class SwiftMailerSmokeTestCase extends SwiftMailerTestCase
{
    protected function setUp()
    {
        if (!defined('SWIFT_SMOKE_TRANSPORT_TYPE')) {
            $this->markTestSkipped(
                'Smoke tests are skipped if tests/smoke.conf.php is not edited'
             );
        }
    }

    protected function getMailer()
    {
        switch (SWIFT_SMOKE_TRANSPORT_TYPE) {
            case 'smtp':
                $transport = Swift_DependencyContainer::getInstance()->lookup('transport.smtp')
                    ->setHost(SWIFT_SMOKE_SMTP_HOST)
                    ->setPort(SWIFT_SMOKE_SMTP_PORT)
                    ->setUsername(SWIFT_SMOKE_SMTP_USER)
                    ->setPassword(SWIFT_SMOKE_SMTP_PASS)
                    ->setEncryption(SWIFT_SMOKE_SMTP_ENCRYPTION)
                    ;
                break;
            case 'sendmail':
                $transport = Swift_DependencyContainer::getInstance()->lookup('transport.sendmail')
                    ->setCommand(SWIFT_SMOKE_SENDMAIL_COMMAND)
                    ;
                break;
            case 'mail':
            case 'nativemail':
                $transport = Swift_DependencyContainer::getInstance()->lookup('transport.mail');
                break;
            default:
                throw new Exception('Undefined transport ['.SWIFT_SMOKE_TRANSPORT_TYPE.']');
        }

        return new Swift_Mailer($transport);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Logger;

/**
 * Simple handler wrapper that deduplicates log records across multiple requests
 *
 * It also includes the BufferHandler functionality and will buffer
 * all messages until the end of the request or flush() is called.
 *
 * This works by storing all log records' messages above $deduplicationLevel
 * to the file specified by $deduplicationStore. When further logs come in at the end of the
 * request (or when flush() is called), all those above $deduplicationLevel are checked
 * against the existing stored logs. If they match and the timestamps in the stored log is
 * not older than $time seconds, the new log record is discarded. If no log record is new, the
 * whole data set is discarded.
 *
 * This is mainly useful in combination with Mail handlers or things like Slack or HipChat handlers
 * that send messages to people, to avoid spamming with the same message over and over in case of
 * a major component failure like a database server being down which makes all requests fail in the
 * same way.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class DeduplicationHandler extends BufferHandler
{
    /**
     * @var string
     */
    protected $deduplicationStore;

    /**
     * @var int
     */
    protected $deduplicationLevel;

    /**
     * @var int
     */
    protected $time;

    /**
     * @var bool
     */
    private $gc = false;

    /**
     * @param HandlerInterface $handler            Handler.
     * @param string           $deduplicationStore The file/path where the deduplication log should be kept
     * @param int              $deduplicationLevel The minimum logging level for log records to be looked at for deduplication purposes
     * @param int              $time               The period (in seconds) during which duplicate entries should be suppressed after a given log is sent through
     * @param Boolean          $bubble             Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(HandlerInterface $handler, $deduplicationStore = null, $deduplicationLevel = Logger::ERROR, $time = 60, $bubble = true)
    {
        parent::__constr