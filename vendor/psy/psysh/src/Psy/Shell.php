
[30;42m                                                                                                                        [39;49m
[30;42m [OK] Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore    [39;49m
[30;42m      magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo    [39;49m
[30;42m      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. [39;49m
[30;42m      Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum     [39;49m
[30;42m                                                                                                                        [39;49m

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Standard factory for creating CharacterReaders.
 *
 * @author Chris Corbyn
 */
class Swift_CharacterReaderFactory_SimpleCharacterReaderFactory implements Swift_CharacterReaderFactory
{
    /**
     * A map of charset patterns to their implementation classes.
     *
     * @var array
     */
    private static $map = [];

    /**
     * Factories which have already been loaded.
     *
     * @var Swift_CharacterReaderFactory[]
     */
    private static $loaded = [];

    /**
     * Creates a new CharacterReaderFactory.
     */
    public function __construct()
    {
        $this->init();
    }

    public function __wakeup()
    {
        $this->init();
    }

    public function init()
    {
        if (count(self::$map) > 0) {
            return;
        }

        $prefix = 'Swift_CharacterReader_';

        $singleByte = [
            'class' => $prefix.'GenericFixedWidthReader',
            'constructor' => [1],
            ];

        $doubleByte = [
            'class' => $prefix.'GenericFixedWidthReader',
            'constructor' => [2],
            ];

        $fourBytes = [
            'class' => $prefix.'GenericFixedWidthReader',
            'constructor' => [4],
            ];

        // Utf-8
        self::$map['utf-?8'] = [
            'class' => $prefix.'Utf8Reader',
            'constructor' => [],
            ];

        //7-8 bit charsets
        self::$map['(us-)?ascii'] = $singleByte;
        self::$map['(iso|iec)-?8859-?[0-9]+'] = $singleByte;
        self::$map['windows-?125[0-9]'] = $singleByte;
        self::$map['cp-?[0-9]+'] = $singleByte;
        self::$map['ansi'] = $singleByte;
        self::$map['macintosh'] = $singleByte;
        self::$map['koi-?7'] = $singleByte;
        self::$map['koi-?8-?.+'] = $singleByte;
        self::$map['mik'] = $singleByte;
        self::$map['(cork|t1)'] = $singleByte;
        self::$map['v?iscii'] = $singleByte;

        //16 bits
        self::$map['(ucs-?2|utf-?16)'] = $doubleByte;

        //32 bits
        self::$map['(ucs-?4|utf-?32)'] = $fourBytes;

        // Fallback
        self::$map['.*'] = $singleByte;
    }

    /**
     * Returns a CharacterReader suitable for the charset applied.
     *
     * @param string $charset
     *
     * @return Swift_CharacterReader
     */
    public function getReaderFor($charset)
    {
        $charset = strtolower(trim($charset));
        foreach (self::$map as $pattern => $spec) {
            $re = '/^'.$pattern.'$/D';
            if (preg_match($re, $charset)) {
                if (!array_key_exists($pattern, self::$loaded)) {
                    $reflector = new ReflectionClass($spec['class']);
                    if ($reflector->getConstructor()) {
                        $reader = $reflector->newInstanceArgs($spec['constructor']);
                    } else {
                        $reader = $reflector->newInstance();
                    }
                    self::$loaded[$pattern] = $reader;
                }

                return self::$loaded[$pattern];
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

class Swift_Transport_Esmtp_Auth_PlainAuthenticatorTest extends \SwiftMailerTestCase
{
    private $agent;

    protected function setUp()
    {
        $this->agent = $this->getMockery('Swift_Transport_SmtpAgent')->shouldIgnoreMissing();
    }

    public function testKeywordIsPlain()
    {
        /* -- RFC 4616, 1.
        The name associated with this mechanism is "PLAIN".
        */

        $login = $this->getAuthenticator();
        $this->assertEquals('PLAIN', $login->getAuthKeyword());
    }

    public function testSuccessfulAuthentication()
    {
        /* -- RFC 4616, 2.
        The client presents the authorization identity (identity to act as),
        followed by a NUL (U+0000) character, followed by the authentication
        identity (identity whose password will be used), followed by a NUL
        (U+0000) character, followed by the clear-text password.
        */

        $plain = $this->getAuthenticator();

        $this->agent->shouldReceive('executeCommand')
             ->once()
             ->with('AUTH PLAIN '.base64_encode(
                        'jack'.chr(0).'jack'.chr(0).'pass'
                    )."\r\n", [235]);

        $this->assertTrue($plain->authenticate($this->agent, 'jack', 'pass'),
            '%s: The buffer accepted all commands authentication should succeed'
            );
    }

    /**
     * @expectedException Swift_TransportException
     */
    public function testAuthenticationFailureSendRset()
    {
        $plain = $this->getAuthenticator();

        $this->agent->shouldReceive('executeCommand')
             ->once()
             ->with('AUTH PLAIN '.base64_encode(
                        'jack'.chr(0).'jack'.chr(0).'pass'
                    )."\r\n", [235])
             ->andThrow(new Swift_TransportException(''));
        $this->agent->shouldReceive('executeCommand')
             ->once()
             ->with("RSET\r\n", [250]);

        $plain->authenticate($this->agent, 'jack', 'pass');
    }

    private function getAuthenticator()
    {
        return new Swift_Transport_Esmtp_Auth_PlainAuthenticator();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\TestCase;
use Monolog\Logger;
use InvalidArgumentException;

function mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null)
{
    $GLOBALS['mail'][] = func_get_args();
}

class NativeMailerHandlerTest extends TestCase
{
    protected function setUp()
    {
        $GLOBALS['mail'] = array();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorHeaderInjection()
    {
        $mailer = new NativeMailerHandler('spammer@example.org', 'dear victim', "receiver@example.org\r\nFrom: faked@attacker.org");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetterHeaderInjection()
    {
        $mailer = new NativeMailerHandler('spammer@example.org', 'dear victim', 'receiver@example.org');
        $mailer->addHeader("Content-Type: text/html\r\nFrom: faked@attacker.org");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetterArrayHeaderInjection()
    {
        $mailer = new NativeMailerHandler('spammer@example.org', 'dear victim', 'receiver@example.org');
        $mailer->addHeader(array("Content-Type: text/html\r\nFrom: faked@attacker.org"));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetterContentTypeInjection()
    {
        $mailer = new NativeMailerHandler('spammer@example.org', 'dear victim', 'receiver@example.org');
        $mailer->setContentType("text/html\r\nFrom: faked@attacker.org");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetterEncodingInjection()
    {
        $mailer = new NativeMailerHandler('spammer@example.org', 'dear victim', 'receiver@example.org');
        $mailer->setEncoding("utf-8\r\nFrom: faked@attacker.org");
    }

    public function testSend()
    {
        $to = 'spammer@example.org';
        $subject = 'dear victim';
        $from = 'receiver@example.org';

        $mailer = new NativeMailerHandler($to, $subject, $from);
        $mailer->handleBatch(array());

        // batch is empty, nothing sent
        $this->assertEmpty($GLOBALS['mail']);

        // non-empty batch
        $mailer->handle($this->getRecord(Logger::ERROR, "Foo\nBar\r\n\r\nBaz"));
        $this->assertNotEmpty($GLOBALS['mail']);
        $this->assertInternalType('array', $GLOBALS['mail']);
        $this->assertArrayHasKey('0', $GLOBALS['mail']);
        $params = $GLOBALS['mail'][0];
        $this->assertCount(5, $params);
        $this->assertSame($to, $params[0]);
        $this->assertSame($subject, $params[1]);
        $this->assertStringEndsWith(" test.ERROR: Foo Bar  Baz [] []\n", $params[2]);
        $this->assertSame("From: $from\r\nContent-type: text/plain; charset=utf-8\r\n", $params[3]);
        $this->assertSame('', $params[4]);
    }

    public function testMessageSubjectFormatting()
    {
        $mailer = new NativeMailerHandler('to@example.org', 'Alert: %level_name% %message%', 'from@example.org');
        $mailer->handle($this->getRecord(Logger::ERROR, "Foo\nBar\r\n\r\nBaz"));
        $this->assertNotEmpty($GLOBALS['mail']);
        $this->assertInternalType('array', $GLOBALS['mail']);
        $this->assertArrayHasKey('0', $GLOBALS['mail']);
        $params = $GLOBALS['mail'][0];
        $this->assertCount(5, $params);
        $this->assertSame('Alert: ERROR Foo Bar  Baz', $params[1]);
    }
}
                                                                                                                                                                                                                                                                                                                                                                        <?php

namespace Illuminate\Database\Connectors;

use PDOException;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\SqlServerConnection;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;

class ConnectionFactory
{
    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * Create a new connection factory instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Establish a PDO connection based on the configuration.
     *
     * @param  array   $config
     * @param  string  $name
     * @return \Illuminate\Database\Connection
     */
    public function make(array $config, $name = null)
    {
        $config = $this->parseConfig($config, $name);

        if (isset($config['read'])) {
            return $this->createReadWriteConnection($config);
        }

        return $this->createSingleConnection($config);
    }

    /**
     * Parse and prepare the database configuration.
     *
     * @param  array   $config
     * @param  string  $name
     * @return array
     */
    protected function parseConfig(array $config, $name)
    {
        return Arr::add(Arr::add($config, 'prefix', ''), 'name', $name);
    }

    /**
     * Create a single database connection instance.
     *
     * @param  array  $config
     * @return \Illuminate\Database\Connection
     */
    protected function createSingleConnection(array $config)
    {
        $pdo = $this->createPdoResolver($config);

        return $this->createConnection(
            $config['driver'], $pdo, $config['database'], $config['prefix'], $config
        );
    }

    /**
     * Create a single database connection instance.
     *
     * @param  array  $config
     * @return \Illuminate\Database\Connection
     */
    protected function createReadWriteConnection(array $config)
    {
        $connection = $this->createSingleConnection($this->getWriteConfig($config));

        return $connection->setReadPdo($this->createReadPdo($config));
    }

    /**
     * Create a new PDO instance for reading.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createReadPdo(array $config)
    {
        return $this->createPdoResolver($this->getReadConfig($config));
    }

    /**
     * Get the read configuration for a read / write connection.
     *
     * @param  array  $config
     * @return array
     */
    protected function getReadConfig(array $config)
    {
        return $this->mergeReadWriteConfig(
            $config, $this->getReadWriteConfig($config, 'read')
        );
    }

    /**
     * Get the read configuration for a read / write connection.
     *
     * @param  array  $config
     * @return array
     */
    protected function getWriteConfig(array $config)
    {
        return $this->mergeReadWriteConfig(
            $config, $this->getReadWriteConfig($config, 'write')
        );
    }

    /**
     * Get a read / write level configuration.
     *
     * @param  array   $config
     * @param  string  $type
     * @return array
     */
    protected function getReadWriteConfig(array $config, $type)
    {
        return isset($config[$type][0])
                        ? Arr::random($config[$type])
                        : $config[$type];
    }

    /**
     * Merge a configuration for a read / write connection.
     *
     * @param  array  $config
     * @param  array  $merge
     * @return array
     */
    protected function mergeReadWriteConfig(array $config, array $merge)
    {
        return Arr::except(array_merge($config, $merge), ['read', 'write']);
    }

    /**
     * Create a new Closure that resolves to a PDO instance.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createPdoResolver(array $config)
    {
        return array_key_exists('host', $config)
                            ? $this->createPdoResolverWithHosts($config)
                            : $this->createPdoResolverWithoutHosts($config);
    }

    /**
     * Create a new Closure that resolves to a PDO instance with a specific host or an array of hosts.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createPdoResolverWithHosts(array $config)
    {
        return function () use ($config) {
            foreach (Arr::shuffle($hosts = $this->parseHosts($config)) as $key => $host) {
                $config['host'] = $host;

                try {
                    return $this->createConnector($config)->connect($config);
                } catch (PDOException $e) {
                    if (count($hosts) - 1 === $key && $this->container->bound(ExceptionHandler::class)) {
                        $this->container->make(ExceptionHandler::class)->report($e);
                    }
                }
            }

            throw $e;
        };
    }

    /**
     * Parse the hosts configuration item into an array.
     *
     * @param  array  $config
     * @return array
     */
    protected function parseHosts(array $config)
    {
        $hosts = Arr::wrap($config['host']);

        if (empty($hosts)) {
            throw new InvalidArgumentException('Database hosts array is empty.');
        }

        return $hosts;
    }

    /**
     * Create a new Closure that resolves to a PDO instance where there is no configured host.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createPdoResolverWithoutHosts(array $config)
    {
        return function () use ($config) {
            return $this->createConnector($config)->connect($config);
        };
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param  array  $config
     * @return \Illuminate\Database\Connectors\ConnectorInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createConnector(array $config)
    {
        if (! isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }

        if ($this->container->bound($key = "db.connector.{$config['driver']}")) {
            return $this->container->make($key);
        }

        switch ($config['driver']) {
            case 'mysql':
                return new MySqlConnector;
            case 'pgsql':
                return new PostgresConnector;
            case 'sqlite':
                return new SQLiteConnector;
            case 'sqlsrv':
                return new SqlServerConnector;
        }

        throw new InvalidArgumentException("Unsupported driver [{$config['driver']}]");
    }

    /**
     * Create a new connection instance.
     *
     * @param  string   $driver
     * @param  \PDO|\Closure     $connection
     * @param  string   $database
     * @param  string   $prefix
     * @param  array    $config
     * @return \Illuminate\Database\Connection
     *
     * @throws \InvalidArgumentException
     */
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = [])
    {
        if ($resolver = Connection::getResolver($driver)) {
            return $resolver($connection, $database, $prefix, $config);
        }

        switch ($driver) {
            case 'mysql':
                return new MySqlConnection($connection, $database, $prefix, $config);
            case 'pgsql':
                return new PostgresConnection($connection, $database, $prefix, $config);
            case 'sqlite':
                return new SQLiteConnection($connection, $database, $prefix, $config);
            case 'sqlsrv':
                return new SqlServerConnection($connection, $database, $prefix, $config);
        }

        throw new InvalidArgumentException("Unsupported driver [{$driver}]");
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Mail\Transport;

use Swift_Transport;
use Swift_Events_SendEvent;
use Swift_Mime_SimpleMessage;
use Swift_Events_EventListener;

abstract class Transport implements Swift_Transport
{
    /**
     * The plug-ins registered with the transport.
     *
     * @var array
     */
    public $plugins = [];

    /**
     * {@inheritdoc}
     */
    public function isStarted()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function start()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function stop()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function ping()
    {
        return true;
    }

    /**