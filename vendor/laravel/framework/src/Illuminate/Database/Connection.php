<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }

    use App\classes\Login;

    if(isset($_GET['status'])){
        if($_GET['status'] == 'logout') {
            require '../vendor/autoload.php';
            $message = Login::adminLogout();
            $_SESSION['message'] = $message;
        }
    }

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href = "../assets/admin/css/bootstrap.min.css" rel = "stylesheet">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="add-category.php">Add Category<span class="sr-only">(current)</span></a></li>
                <li><a href="view-category.php">Manage Category</a></li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li>
                        <li class="text-center"><a href="?status=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Dumper;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\ContextProvider\ContextProviderInterface;
use Symfony\Component\VarDumper\Server\Connection;

/**
 * ServerDumper forwards serialized Data clones to a server.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
class ServerDumper implements DataDumperInterface
{
    private $connection;
    private $wrappedDumper;

    /**
     * @param string                     $host             The server host
     * @param DataDumperInterface|null   $wrappedDumper    A wrapped instance used whenever we failed contacting the server
     * @param ContextProviderInterface[] $contextProviders Context providers indexed by context name
     */
    public function __construct(string $host, DataDumperInterface $wrappedDumper = null, array $contextProviders = array())
    {
        $this->connection = new Connection($host, $contextProviders);
        $this->wrappedDumper = $wrappedDumper;
    }

    public function getContextProviders(): array
    {
        return $this->connection->getContextProviders();
    }

    /**
     * {@inheritdoc}
     */
    public function dump(Data $data)
    {
        if (!$this->connection->write($data) && $this->wrappedDumper) {
            $this->wrappedDumper->dump($data);
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	                 (      �       o                     z;    � p     y;    b}��b�� !^��O���b�\}��b� 0      �!               F i l e P r o f i l e r S t o r a g e . p h p {;    h X     y;    ���b�� !^���ǣ�b����b�        �               P r o f i l e . p h p |;    p Z     y;    �գ�b�� !^����b��գ�b�        �               P r o f i l e r . p h p       };    � z     y;    f���b�� !^��C��b�^���b�       �               P r o f i l e r S t  r a g e I n t e r f a c e . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	                 (   0	  �      2       �              =    p \     =    H��b��ި����Q3��b�H��b��      �               c o m m a n d _ 0 . p h p     =    p \     =    �B��b��ި����_���b��B��b��      �               c o m m a n d _ 1 . p h p      =    p ^     =    ���b��ި����3��b����b�       �               c o m m a n d _ 1 0 . p h p   !=    p ^     =    G��b��ި�����e��b�G��b�`      _               c o m m a n d _ 1 1 . p h p 2 "=    p ^     =    �t��b��ި��������b��t��b�       s               c o m m a n d _ 1 2 . p h p   #=    p ^     =    0���b��ި����T���b�0���b�       ~               c o m m a n d _ 1 3 . p h p   $=    p ^     =    ����b��ި��������b�����b�       }               c o m m a n d _ 1 4 . p h p   %=    p ^     =    <���b��ި�������b�8���b�       U               c o m m a n d _ 1 5 . p h p   &=    p ^     =    c��b��ި�����6��b�`��b�     2 z               c o m m a n d _ 1 6 . p h p   '=    p ^     =    \D��b��ި����<^��b�ZD��b��      �               c o m m a n d _ 1 7 . p h p   (=    p \     =    xk��b��ި����؄��b�tk��b�8      3               c o m m a n d _ 2 . p h p     )=    p \     =    w���b��ި��������b�p���b��      �               c o m m a n d _ 3 . p h p     *=    p \     =    Ӹ��b��ި����<���b�̸��b�       �               c o m m a n d _ 4 . p h p     +=    � z   2 =    v���b��ި����l���b�r���b�       �               c o m m a n d _ 4 _ w i t h _ i t e r a t o r s . p h p       ,=    p \     =    ���b��ި����s"��b����b�       T               c o m m a n d _ 5 . p h p     -=    p \     =    �/��b��ި����rH��b��/��b�(      $               c o m m a n d _ 6 . p h p     .=    p \     =    iU��b��ި����`p��b�fU��b�       �               c o m m a n d _ 7 . p h p     /=    p \     =    ~��b��ި��������b2 �}��b�       B               c o m m a n d _ 8 . p h p     0=    p \     =    ���b��ި����Ѿ��b����b��      �               c o m m a n d _ 9 . p h p     1=    � t     =    ����b��ި��������b�����b�X      S               i n t e r a c t i v e _ c o m m a n d _ 1 . p h p                                                                                                                                                                                                         2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               2 <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * General utility class in Swift Mailer, not to be instantiated.
 *
 * @author Chris Corbyn
 */
abstract class Swift
{
    const VERSION = '6.1.1';

    public static $initialized = false;
    public static $inits = [];

    /**
     * Registers an initializer callable that will be called the first time
     * a SwiftMailer class is autoloaded.
     *
     * This enables you to tweak the default configuration in a lazy way.
     *
     * @param mixed $callable A valid PHP callable that will be called when autoloading the first Swift class
     */
    public static function init($callable)
    {
        self::$inits[] = $callable;
    }

    /**
     * Internal autoloader for spl_autoload_register().
     *
     * @param string $class
     */
    public static function autoload($class)
    {
        // Don't interfere with other autoloaders
        if (0 !== strpos($class, 'Swift_')) {
            return;
        }

        $path = __DIR__.'/'.str_replace('_', '/', $class).'.php';

        if (!file_exists($path)) {
            return;
        }

        require $path;

        if (self::$inits && !self::$initialized) {
            self::$initialized = true;
            foreach (self::$inits as $init) {
                call_user_func($init);
            }
        }
    }

    /**
     * Configure autoloading using Swift Mailer.
     *
     * This is designed to play nicely with other autoloaders.
     *
     * @param mixed $callable A valid PHP callable that will be called when autoloading the first Swift class
     */
    public static function registerAutoload($callable = null)
    {
        if (null !== $callable) {
            self::$inits[] = $callable;
        }
        spl_autoload_register(['Swift', 'autoload']);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

class Swift_Plugins_ThrottlerPluginTest extends \SwiftMailerTestCase
{
    public function testBytesPerMinuteThrottling()
    {
        $sleeper = $this->createSleeper();
        $timer = $this->createTimer();

        //10MB/min
        $plugin = new Swift_Plugins_ThrottlerPlugin(
            10000000, Swift_Plugins_ThrottlerPlugin::BYTES_PER_MINUTE,
            $sleeper, $timer
            );

        $timer->shouldReceive('getTimestamp')->once()->andReturn(0);
        $timer->shouldReceive('getTimestamp')->once()->andReturn(1); //expected 0.6
        $timer->shouldReceive('getTimestamp')->once()->andReturn(1); //expected 1.2 (sleep 1)
        $timer->shouldReceive('getTimestamp')->once()->andReturn(2); //expected 1.8
        $timer->shouldReceive('getTimestamp')->once()->andReturn(2); //expected 2.4 (sleep 1)
        $sleeper->shouldReceive('sleep')->twice()->with(1);

        //10,000,000 bytes per minute
        //100,000 bytes per email

        // .: (10,000,000/100,000)/60 emails per second = 1.667 emais/sec

        $message = $this->createMessageWithByteCount(100000); //100KB

        $evt = $this->createSendEvent($message);

        for ($i = 0; $i < 5; ++$i) {
            $plugin->beforeSendPerformed($evt);
            $plugin->sendPerformed($evt);
        }
    }

    public function testMessagesPerMinuteThrottling()
    {
        $sleeper = $this->createSleeper();
        $timer = $this->createTimer();

        //60/min
        $plugin = new Swift_Plugins_ThrottlerPlugin(
            60, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE,
            $sleeper, $timer
            );

        $timer->shouldReceive('getTimestamp')->once()->andReturn(0);
        $timer->shouldReceive('getTimestamp')->once()->andReturn(0); //expected 1 (sleep 1)
        $timer->shouldReceive('getTimestamp')->once()->andReturn(2); //expected 2
        $timer->shouldReceive('getTimestamp')->once()->andReturn(2); //expected 3 (sleep 1)
        $timer->shouldReceive('getTimestamp')->once()->andReturn(4); //expected 4
        $sleeper->shouldReceive('sleep')->twice()->with(1);

        //60 messages per minute
        //1 message per second

        $message = $this->createMessageWithByteCount(10);

        $evt = $this->createSendEvent($message);

        for ($i = 0; $i < 5; ++$i) {
            $plugin->beforeSendPerformed($evt);
            $plugin->sendPerformed($evt);
        }
    }

    private function createSleeper()
    {
        return $this->getMockery('Swift_Plugins_Sleeper');
    }

    private function createTimer()
    {
        return $this->getMockery('Swift_Plugins_Timer');
    }

    private function createMessageWithByteCount($bytes)
    {
        $msg = $this->getMockery('Swift_Mime_SimpleMessage');
        $msg->shouldReceive('toByteStream')
            ->zeroOrMoreTimes()
            ->andReturnUsing(function ($is) use ($bytes) {
                for ($i = 0; $i < $bytes; ++$i) {
                    $is->write('x');
                }
            });

        return $msg;
    }

    private function createSendEvent($message)
    {
        $evt = $this->getMockery('Swift_Events_SendEvent');
        $evt->shouldReceive('getMessage')
            ->zeroOrMoreTimes()
            ->andReturn($message);

        return $evt;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Gelf\Message;
use Monolog\TestCase;
use Monolog\Logger;
use Monolog\Formatter\GelfMessageFormatter;

class GelfHandlerLegacyTest extends TestCase
{
    public function setUp()
    {
        if (!class_exists('Gelf\MessagePublisher') || !class_exists('Gelf\Message')) {
            $this->markTestSkipped("mlehner/gelf-php not installed");
        }

        require_once __DIR__ . '/GelfMockMessagePublisher.php';
    }

    /**
     * @covers Monolog\Handler\GelfHandler::__construct
     */
    public function testConstruct()
    {
        $handler = new GelfHandler($this->getMessagePublisher());
        $this->assertInstanceOf('Monolog\Handler\GelfHandler', $handler);
    }

    protected function getHandler($messagePublisher)
    {
        $handler = new GelfHandler($messagePublisher);

        return $handler;
    }

    protected function getMessagePublisher()
    {
        return new GelfMockMessagePublisher('localhost');
    }

    public function testDebug()
    {
        $messagePublisher = $this->getMessagePublisher();
        $handler = $this->getHandler($messagePublisher);

        $record = $this->getRecord(Logger::DEBUG, "A test debug message");
        $handler->handle($record);

        $this->assertEquals(7, $messagePublisher->lastMessage->getLevel());
        $this->assertEquals('test', $messagePublisher->lastMessage->getFacility());
        $this->assertEquals($record['message'], $messagePublisher->lastMessage->getShortMessage());
        $this->assertEquals(null, $messagePublisher->lastMessage->getFullMessage());
    }

    public function testWarning()
    {
        $messagePublisher = $this->getMessagePublisher();
        $handler = $this->getHandler($messagePublisher);

        $record = $this->getRecord(Logger::WARNING, "A test warning message");
        $handler->handle($record);

        $this->assertEquals(4, $messagePublisher->lastMessage->getLevel());
        $this->assertEquals('test', $messagePublisher->lastMessage->getFacility());
        $this->assertEquals($record['message'], $messagePublisher->lastMessage->getShortMessage());
        $this->assertEquals(null, $messagePublisher->lastMessage->getFullMessage());
    }

    public function testInjectedGelfMessageFormatter()
    {
        $messagePublisher = $this->getMessagePublisher();
        $handler = $this->getHandler($messagePublisher);

        $handler->setFormatter(new GelfMessageFormatter('mysystem', 'EXT', 'CTX'));

        $record = $this->getRecord(Logger::WARNING, "A test warning message");
        $record['extra']['blarg'] = 'yep';
        $record['context']['from'] = 'logger';
        $handler->handle($record);

        $this->assertEquals('mysystem', $messagePublisher->lastMessage->getHost());
        $this->assertArrayHasKey('_EXTblarg', $messagePublisher->lastMessage->toArray());
        $this->assertArrayHasKey('_CTXfrom', $messagePublisher->lastMessage->toArray());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Illuminate\Cookie\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;

class EncryptCookies
{
    /**
     * The encrypter instance.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [];

    /**
     * Create a new CookieGuard instance.
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @return void
     */
    public function __construct(EncrypterContract $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * Disable encryption for the given cookie name(s).
     *
     * @param  string|array  $name
     * @return void
     */
    public function disableFor($name)
    {
        $this->except = array_merge($this->except, (array) $name);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        return $this->encrypt($next($this->decrypt($request)));
    }

    /**
     * Decrypt the cookies on the request.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function decrypt(Request $request)
    {
        foreach ($request->cookies as $key => $cookie) {
            if ($this->isDisabled($key)) {
                continue;
            }

            try {
                $request->cookies->set($key, $this->decryptCookie($cookie));
            } catch (DecryptException $e) {
                $request->cookies->set($key, null);
            }
        }

        return $request;
    }

    /**
     * Decrypt the given cookie and return the value.
     *
     * @param  string|array  $cookie
     * @return string|array
     */
    protected function decryptCookie($cookie)
    {
        return is_array($cookie)
                        ? $this->decryptArray($cookie)
   