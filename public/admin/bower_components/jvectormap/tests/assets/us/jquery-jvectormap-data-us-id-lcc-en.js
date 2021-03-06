    $process->expects($this->once())
            ->method('getExitCode')
            ->will($this->returnValue($exitCode));

        $process->expects($this->once())
            ->method('getExitCodeText')
            ->will($this->returnValue($exitText));

        $process->expects($this->once())
            ->method('isOutputDisabled')
            ->will($this->returnValue(true));

        $process->expects($this->once())
            ->method('getWorkingDirectory')
            ->will($this->returnValue($workingDirectory));

        $exception = new ProcessFailedException($process);

        $this->assertEquals(
            "The command \"$cmd\" failed.\n\nExit Code: $exitCode($exitText)\n\nWorking directory: {$workingDirectory}",
            $exception->getMessage()
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Config\Resource\FileResource;

class YamlFileLoaderTest extends TestCase
{
    public function testSupports()
    {
        $loader = new YamlFileLoader($this->getMockBuilder('Symfony\Component\Config\FileLocator')->getMock());

        $this->assertTrue($loader->supports('foo.yml'), '->supports() returns true if the resource is loadable');
        $this->assertTrue($loader->supports('foo.yaml'), '->supports() returns true if the resource is loadable');
        $this->assertFalse($loader->supports('foo.foo'), '->supports() returns true if the resource is loadable');

        $this->assertTrue($loader->supports('foo.yml', 'yaml'), '->supports() checks the resource type if specified');
        $this->assertTrue($loader->supports('foo.yaml', 'yaml'), '->supports() checks the resource type if specified');
        $this->assertFalse($loader->supports('foo.yml', 'foo'), '->supports() checks the resource type if specified');
    }

    public function testLoadDoesNothingIfEmpty()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures')));
        $collection = $loader->load('empty.yml');

        $this->assertEquals(array(), $collection->all());
        $this->assertEquals(array(new FileResource(realpath(__DIR__.'/../Fixtures/empty.yml'))), $collection->getResources());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider getPathsToInvalidFiles
     */
    public function testLoadThrowsExceptionWithInvalidFile($filePath)
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures')));
        $loader->load($filePath);
    }

    public function getPathsToInvalidFiles()
    {
        return array(
            array('nonvalid.yml'),
            array('nonvalid2.yml'),
            array('incomplete.yml'),
            array('nonvalidkeys.yml'),
            array('nonesense_resource_plus_path.yml'),
            array('nonesense_type_without_resource.yml'),
            array('bad_format.yml'),
        );
    }

    public function testLoadSpecialRouteName()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures')));
        $routeCollection = $loader->load('special_route_name.yml');
        $route = $routeCollection->get('#$péß^a|');

        $this->assertInstanceOf('Symfony\Component\Routing\Route', $route);
        $this->assertSame('/true', $route->getPath());
    }

    public function testLoadWithRoute()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures')));
        $routeCollection = $loader->load('validpattern.yml');
        $route = $routeCollection->get('blog_show');

        $this->assertInstanceOf('Symfony\Component\Routing\Route', $route);
        $this->assertSame('/blog/{slug}', $route->getPath());
        $this->assertSame('{locale}.example.com', $route->getHost());
        $this->assertSame('MyBundle:Blog:show', $route->getDefault('_controller'));
        $this->assertSame('\w+', $route->getRequirement('locale'));
        $this->assertSame('RouteCompiler', $route->getOption('compiler_class'));
        $this->assertEquals(array('GET', 'POST', 'PUT', 'OPTIONS'), $route->getMethods());
        $this->assertEquals(array('https'), $route->getSchemes());
        $this->assertEquals('context.getMethod() == "GET"', $route->getCondition());
    }

    public function testLoadWithResource()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures')));
        $routeCollection = $loader->load('validresource.yml');
        $routes = $routeCollection->all();

        $this->assertCount(2, $routes, 'Two routes are loaded');
        $this->assertContainsOnly('Symfony\Component\Routing\Route', $routes);

        foreach ($routes as $route) {
            $this->assertSame('/{foo}/blog/{slug}', $route->getPath());
            $this->assertSame('123', $route->getDefault('foo'));
            $this->assertSame('\d+', $route->getRequirement('foo'));
            $this->assertSame('bar', $route->getOption('foo'));
            $this->assertSame('', $route->getHost());
            $this->assertSame('context.getMethod() == "POST"', $route->getCondition());
        }
    }

    public function testLoadRouteWithControllerAttribute()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $routeCollection = $loader->load('routing.yml');

        $route = $routeCollection->get('app_homepage');

        $this->assertSame('AppBundle:Homepage:show', $route->getDefault('_controller'));
    }

    public function testLoadRouteWithoutControllerAttribute()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $routeCollection = $loader->load('routing.yml');

        $route = $routeCollection->get('app_logout');

        $this->assertNull($route->getDefault('_controller'));
    }

    public function testLoadRouteWithControllerSetInDefaults()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $routeCollection = $loader->load('routing.yml');

        $route = $routeCollection->get('app_blog');

        $this->assertSame('AppBundle:Blog:list', $route->getDefault('_controller'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /The routing file "[^"]*" must not specify both the "controller" key and the defaults key "_controller" for "app_blog"/
     */
    public function testOverrideControllerInDefaults()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $loader->load('override_defaults.yml');
    }

    /**
     * @dataProvider provideFilesImportingRoutesWithControllers
     */
    public function testImportRouteWithController($file)
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $routeCollection = $loader->load($file);

        $route = $routeCollection->get('app_homepage');
        $this->assertSame('FrameworkBundle:Template:template', $route->getDefault('_controller'));

        $route = $routeCollection->get('app_blog');
        $this->assertSame('FrameworkBundle:Template:template', $route->getDefault('_controller'));

        $route = $routeCollection->get('app_logout');
        $this->assertSame('FrameworkBundle:Template:template', $route->getDefault('_controller'));
    }

    public function provideFilesImportingRoutesWithControllers()
    {
        yield array('import_controller.yml');
        yield array('import__controller.yml');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /The routing file "[^"]*" must not specify both the "controller" key and the defaults key "_controller" for "_static"/
     */
    public function testImportWithOverriddenController()
    {
        $loader = new YamlFileLoader(new FileLocator(array(__DIR__.'/../Fixtures/controller')));
        $loader->load('import_override_defaults.yml');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This code is partially based on the Rack-Cache library by Ryan Tomayko,
 * which is released under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface implemented by HTTP cache stores.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface StoreInterface
{
    /**
     * Locates a cached Response for the Request provided.
     *
     * @return Response|null A Response instance, or null if no cache entry was found
     */
    public function lookup(Request $request);

    /**
     * Writes a cache entry to the store for the given Request and Response.
     *
     * Existing entries are read and any that match the response are removed. This
     * method calls write with the new list of cache entries.
     *
     * @return string The key under which the response is stored
     */
    public function write(Request $request, Response $response);

    /**
     * Invalidates all cache entries that match the request.
     */
    public function invalidate(Request $request);

    /**
     * Locks the cache for a given Request.
     *
     * @return bool|string true if the lock is acquired, the path to the current lock otherwise
     */
    public function lock(Request $request);

    /**
     * Releases the lock for the given Request.
     *
     * @return bool False if the lock file does not exist or cannot be unlocked, true otherwise
     */
    public function unlock(Request $request);

    /**
     * Returns whether or not a lock exists.
     *
     * @return bool true if lock exists, false otherwise
     */
    public function isLocked(Request $request);

    /**
     * Purges data for the given URL.
     *
     * @param string $url A URL
     *
     * @return bool true if the URL exists and has been purged, false otherwise
     */
    public function purge($url);

    /**
     * Cleanups storage.
     */
    public function cleanup();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?xml version="1.0" encoding="UTF-8"?>

<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="http://schema.phpunit.de/4.1/phpunit.xsd"
         backupGlobals="false"
         colors="true"
         bootstrap="vendor/autoload.php"
         failOnRisky="true"
         failOnWarning="true"
>
    <php>
        <ini name="error_reporting" value="-1" />
    </php>

    <testsuites>
        <testsuite name="Symfony Translation Component Test Suite">
            <directory>./Tests/</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>./</directory>
            <exclude>
                <directory>./Tests</directory>
                <directory>./vendor</directory>
            </exclude>
        </whitelist>
    </filter>
</phpunit>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * CouchDB handler
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class CouchDBHandler extends AbstractProcessingHandler
{
    private $options;

    public function __construct(array $options = array(), $level = Logger::DEBUG, $bubble = true)
    {
        $this->options = array_merge(array(
            'host'     => 'localhost',
            'port'     => 5984,
            'dbname'   => 'logger',
            'username' => null,
            'password' => null,
        ), $options);

        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        $basicAuth = null;
        if ($this->options['username']) {
            $basicAuth = sprintf('%s:%s@', $this->options['username'], $this->options['password']);
        }

        $url = 'http://'.$basicAuth.$this->options['host'].':'.$this->options['port'].'/'.$this->options['dbname'];
        $context = stream_context_create(array(
            'http' => array(
                'method'        => 'POST',
                'content'       => $record['formatted'],
                'ignore_errors' => true,
                'max_redirects' => 0,
                'header'        => 'Content-type: application/json',
            ),
        ));

        if (false === @file_get_contents($url, null, $context)) {
            throw new \RuntimeException(sprintf('Could not connect to %s', $url));
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter()
    {
        return new JsonFormatter(JsonFormatter::BATCH_MODE_JSON, false);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Illuminate\Console\Scheduling;

use LogicException;
use InvalidArgumentException;
use Illuminate\Contracts\Container\Container;

class CallbackEvent extends Event
{
    /**
     * The callback to call.
     *
     * @var string
     */
    protected $callback;

    /**
     * The parameters to pass to the method.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Console\Scheduling\EventMutex  $mutex
     * @param  string  $callback
     * @param  array  $parameters
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(EventMutex $mutex, $callback, array $parameters = [])
    {
        if (! is_string($callback) && ! is_callable($callback)) {
            throw new InvalidArgumentException(
                'Invalid scheduled callback event. Must be a string or callable.'
            );
        }

        $this->mutex = $mutex;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }

    /**
     * Run the given event.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return mixed
     *
     * @throws \Exception
     */
    public function run(Container $container)
    {
        if ($this->description && $this->withoutOverlapping &&
            ! $this->mutex->create($this)) {
            return;
        }

        register_shutdown_function(function () {
            $this->removeMutex();
        });

        parent::callBeforeCallbacks($container);

        try {
            $response = $container->call($this->callback, $this->parameters);
        } finally {
            $this->removeMutex();

            parent::callAfterCallbacks($container);
        }

        return $response;
    }

    /**
     * Clear the mutex for the event.
     *
     * @return void
     */
    protected function removeMutex()
    {
        if ($this->description) {
            $this->mutex->forget($this);
        }
    }

    /**
     * Do not allow the event to overlap each other.
     *
     * @param  int  $expiresAt
     * @return $this
     *
     * @throws \LogicException
     */
    public function withoutOverlapping($expiresAt = 1440)
    {
        if (! isset($this->description)) {
            throw new LogicException(
                "A scheduled event name is required to prevent overlapping. Use the 'name' method before 'withoutOverlapping'."
            );
        }

        $this->withoutOverlapping = true;

        $this->expiresAt = $expiresAt;

        return $this->skip(function () {
            return $this->mutex->exists($this);
        });
    }

    /**
     * Allow the event to only run on one server for each cron expression.
     *
     * @return $this
     *
     * @throws \LogicException
     */
    public function onOneServer()
    {
        if (! isset($this->description)) {
            throw new LogicException(
                "A scheduled event name is required to only run on one server. Use the 'name' method before 'onOneServer'."
            );
        }

        $this->onOneServer = true;

        return $this;
    }

    /**
     * Get the mutex name for the scheduled command.
     *
     * @return string
     */
    public function mutexName()
    {
        return 'framework/schedule-'.sha1($this->description);
    }

    /**
     * Get the summary of the event for display.
     *
     * @return string
     */
    public function getSummaryForDisplay()
    {
        if (is_string($this->description)) {
            return $this->description;
        }

        return is_string($this->callback) ? $this->callback : 'Closure';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                  <?php

namespace Illuminate\Foundation\Testing;

use Illuminate\Contracts\Console\Kernel;

trait RefreshDatabase
{
    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function refreshDatabase()
    {
        $this->usingInMemoryDatabase()
                        ? $this->refreshInMemoryDatabase()
                        : $this->refreshTestDatabase();
    }

    /**
     * Determine if an in-memory database is being used.
     *
     * @return bool
     */
    protected function usingInMemoryDatabase()
    {
        return config('database.connections')[
            config('database.default')
        ]['database'] == ':memory:';
    }

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate');

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * Refresh a conventional test database.
     *
     * @return void
     */
    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:fresh');

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }

    /**
     * Begin a database transaction on the testing database.
     *
     * @return void
     */
    public function beginDatabaseTransaction()
    {
        $database = $this->app->make('db');

        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }

        $this->beforeApplicationDestroyed(function () use ($database) {
            foreach ($this->connectionsToTransact() as $name) {
                $connection = $database->connection($name);

                $connection->rollBack();
                $connection->disconnect();
            }
        });
    }

    /**
     * The database connections that should have transactions.
     *
     * @return array
     */
    protected function connectionsToTransact()
    {
        return property_exists($this, 'connectionsToTransact')
                            ? $this->connectionsToTransact : [null];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               PHP 4 style declarations
-----
<?php

class A {
    var $foo;
    function bar() {}
    static abstract function baz() {}
}
-----
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_Property(
                flags: 0
                props: array(
                    0: Stmt_PropertyProperty(
                        name: foo
                        default: null
                    )
                )
            )
            1: Stmt_ClassMethod(
                flags: 0
                byRef: false
                name: bar
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
            2: Stmt_ClassMethod(
                flags: MODIFIER_ABSTRACT | MODIFIER_STATIC (24)
                byRef: false
                name: baz
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

namespace Faker\Provider;

class UserAgent extends Base
{
    protected static $userAgents = array('firefox', 'chrome', 'internetExplorer', 'opera', 'safari');

    protected static $windowsPlatformTokens = array(
        'Windows NT 6.2', 'Windows NT 6.1', 'Windows NT 6.0', 'Windows NT 5.2', 'Windows NT 5.1',
        'Windows NT 5.01', 'Windows NT 5.0', 'Windows NT 4.0', 'Windows 98; Win 9x 4.90', 'Windows 98',
        'Windows 95', 'Windows CE'
    );

    /**
     * Possible processors on Linux
     */
    protected static $linuxProcessor = array('i686', 'x86_64');

    /**
     * Mac processors (it also added U;)
     */
    protected static $macProcessor = array('Intel', 'PPC', 'U; Intel', 'U; PPC');

    /**
     * Add as many languages as you like.
     */
    protected static $lang = array('en-US', 'sl-SI');

    /**
     * Generate mac processor
     *
     * @return string
     */
    public static function macProcessor()
    {
        return static::randomElement(static::$macProcessor);
    }

    /**
     * Generate linux processor
     *
     * @return string
     */
    public static function linuxProcessor()
    {
        return static::randomElement(static::$linuxProcessor);
    }

    /**
     * Generate a random user agent
     *
     * @example 'Mozilla/5.0 (Windows CE) AppleWebKit/5350 (KHTML, like Gecko) Chrome/13.0.888.0 Safari/5350'
     */
    public static function userAgent()
    {
        $userAgentName = static::randomElement(static::$userAgents);

        return static::$userAgentName();
    }

    /**
     * Generate Chrome user agent
     *
     * @example 'Mozilla/5.0 (Macintosh; PPC Mac OS X 10_6_5) AppleWebKit/5312 (KHTML, like Gecko) Chrome/14.0.894.0 Safari/5312'
     */
    public static function chrome()
    {
        $saf = mt_rand(531, 536) . mt_rand(0, 2);

        $platforms = array(
            '(' . static::linuxPlatformToken() . ") AppleWebKit/$saf (KHTML, like Gecko) Chrome/" . mt_rand(36, 40) . '.0.' . mt_rand(800, 899) . ".0 Mobile Safari/$saf",
            '(' . static::windowsPlatformToken() . ") AppleWebKit/$saf (KHTML, like Gecko) Chrome/" . mt_rand(36, 40) . '.0.' . mt_rand(800, 899) . ".0 Mobile Safari/$saf",
            '(' . static::macPlatformToken() . ") AppleWebKit/$saf (KHTML, like Gecko) Chrome/" . mt_rand(36, 40) . '.0.' . mt_rand(800, 899) . ".0 Mobile Safari/$saf"
        );

        return 'Mozilla/5.0 ' . static::randomElement($platforms);
    }

    /**
     * Generate Firefox user agent
     *
     * @example 'Mozilla/5.0 (X11; Linuxi686; rv:7.0) Gecko/20101231 Firefox/3.6'
     */
    public static function firefox()
    {
        $ver = 'Gecko/' . date('Ymd', mt_rand(strtotime('2010-1-1'), time())) . ' Firefox/' . mt_rand(35, 37) . '.0';

        $platforms = array(
            '(' . static::windowsPlatformToken() . '; ' . static::randomElement(static::$lang) . '; rv:1.9.' . mt_rand(0, 2) . '.20) ' . $ver,
            '(' . static::linuxPlatformToken() . '; rv:' . mt_rand(5, 7) . '.0) ' . $ver,
            '(' . static::macPlatformToken() . ' rv:' . mt_rand(2, 6) . '.0) ' . $ver
        );

        return "Mozilla/5.0 " . static::randomElement($platforms);
    }

    /**
     * Generate Safari user agent
     *
     * @example 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_7_1 rv:3.0; en-US) AppleWebKit/534.11.3 (KHTML, like Gecko) Version/4.0 Safari/534.11.3'
     */
    public static function safari()
    {
        $saf = mt_rand(531, 535) . '.' . mt_rand(1, 50) . '.' . mt_rand(1, 7);
        if (mt_rand(0, 1) == 0) {
            $ver = mt_rand(4, 5) . '.' . mt_rand(0, 1);
        } else {
            $ver = mt_rand(4, 5) . '.0.' . mt_rand(1, 5);
        }

        $mobileDevices = array(
            'iPhone; CPU iPhone OS',
            'iPad; CPU OS'
        );

        $platforms = array(
            '(Windows; U; ' . static::windowsPlatformToken() . ") AppleWebKit/$saf (KHTML, like Gecko) Version/$ver Safari/$saf",
            '(' . static::macPlatformToken() . ' rv:' . mt_rand(2, 6) . '.0; ' . static::randomElement(static::$lang) . ") AppleWebKit/$saf (KHTML, like Gecko) Version/$ver Safari/$saf",
            '(' . static::randomElement($mobileDevices) . ' ' . mt_rand(7, 8) . '_' . mt_rand(0, 2) . '_' . mt_rand(1, 2) . ' like Mac OS X; ' . static::randomElement(static::$lang) . ") AppleWebKit/$saf (KHTML, like Gecko) Version/" . mt_rand(3, 4) . ".0.5 Mobile/8B" . mt_rand(111, 119) . " Safari/6$saf",
        );

        return "Mozilla/5.0 " . static::randomElement($platforms);
    }

    /**
     * Generate Opera user agent
     *
     * @example 'Opera/8.25 (Windows NT 5.1; en-US) Presto/2.9.188 Version/10.00'
     */
    public static function opera()
    {
        $platforms = array(
            '(' . static::linuxPlatformToken() . '; ' . static::randomElement(static::$lang) . ') Presto/2.' . mt_rand(8, 12) . '.' . mt_rand(160, 355) . ' Version/' . mt_rand(10, 12) . '.00',
            '(' . static::windowsPlatformToken() . '; ' . static::randomElement(static::$lang) . ') Presto/2.' . mt_rand(8, 12) . '.' . mt_rand(160, 355) . ' Version/' . mt_rand(10, 12) . '.00'
        );

        return "Opera/" . mt_rand(8, 9) . '.' . mt_rand(10, 99) . ' ' . static::randomElement($platforms);
    }

    /**
     * Generate Internet Explorer user agent
     *
     * @example 'Mozilla/5.0 (compatible; MSIE 7.0; Windows 98; Win 9x 4.90; Trident/3.0)'
     */
    public static function internetExplorer()
    {
        return 'Mozilla/5.0 (compatible; MSIE ' . mt_rand(5, 11) . '.0; ' . static::windowsPlatformToken() . '; Trident/' . mt_rand(3, 5) . '.' . mt_rand(0, 1) . ')';
    }

    public static function windowsPlatformToken()
    {
        return static::randomElement(static::$windowsPlatformTokens);
    }

    public static function macPlatformToken()
    {
        return 'Macintosh; ' . static::randomElement(static::$macProcessor) . ' Mac OS X 10_' . mt_rand(5, 8) . '_' . mt_rand(0, 9);
    }

    public static function linuxPlatformToken()
    {
        return 'X11; Linux ' . static::randomElement(static::$linuxProcessor);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Faker\Provider\tr_TR;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = array(
        '050########',
        '053########',
        '054########',
        '055########',
        '0 50# ### ## ##',
        '0 53# ### ## ##',
        '0 54# ### ## ##',
        '0 55# ### ## ##',
        '0 (50#) ### ## ##',
        '0 (53#) ### ## ##',
        '0 (54#) ### ## ##',
        '0 (55#) ### ## ##',
        '+9050########',
        '+9053########',
        '+9054########',
        '+9055########',
        '+90 50# ### ## ##',
        '+90 53# ### ## ##',
        '+90 54# ### ## ##',
        '+90 55# ### ## ##',
        '+90 (50#) ### ## ##',
        '+90 (53#) ### ## ##',
        '+90 (54#) ### ## ##',
        '+90 (55#) ### ## ##'
    );
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 .. index::
    single: Mockery; Configuration

Mockery Global Configuration
============================

To allow for a degree of fine-tuning, Mockery utilises a singleton
configuration object to store a small subset of core behaviours. The three
currently present include:

* Option to allow/disallow the mocking of methods which do not actually exist
* Option to allow/disallow the existence of expectations which are never
  fulfilled (i.e. unused)
* Setter/Getter for added a parameter map for internal PHP class methods
  (``Reflection`` cannot detect these automatically)

By default, the first two behaviours are enabled. Of course, there are
situations where this can lead to unintended consequences. The mocking of
non-existent methods may allow mocks based on real classes/objects to fall out
of sync with the actual implementations, especially when some degree of
integration testing (testing of object wiring) is not being performed.
Allowing unfulfilled expectations means unnecessary mock expectations go
unnoticed, cluttering up test code, and potentially confusing test readers.

You may allow or disallow these behaviours (whether for whole test suites or
just select tests) by using one or both of the following two calls:

.. code-block:: php

    \Mockery::getConfiguration()->allowMockingNonExistentMethods(bool);
    \Mockery::getConfiguration()->allowMockingMethodsUnnecessarily(bool);

Passing a true allows the behaviour, false disallows it. Both take effect
immediately until switched back. In both cases, if either behaviour is
detected when not allowed, it will result in an Exception being thrown at that
point. Note that disallowing these behaviours should be carefully considered
since they necessarily remove at least some of Mockery's flexibility.

The other two methods are:

.. code-block:: php

    \Mockery::getConfiguration()->setInternalClassMethodParamMap($class, $method, array $paramMap)
    \Mockery::getConfiguration()->getInternalClassMethodParamMap($class, $method)

These are used to define parameters (i.e. the signature string of each) for the
methods of internal PHP classes (e.g. SPL, or PECL extension classes like
ext/mongo's MongoCollection. Reflection cannot analyse the parameters of internal
classes. Most of the time, you never need to do this. It's mainly needed where an
internal class method uses pass-by-reference for a parameter - you MUST in such
cases ensure the parameter signature includes the ``&`` symbol correctly as Mockery
won't correctly add it automatically for internal classes.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     {
    "name": "sebastian/code-unit-reverse-lookup",
    "description": "Looks up which function or method a line of code belongs to",
    "homepage": "https://github.com/sebastianbergmann/code-unit-reverse-lookup/",
    "license": "BSD-3-Clause",
    "authors": [
        {
            "name": "Sebastian Bergmann",
            "email": "sebastian@phpunit.de"
        }
    ],
    "require": {
        "php": "^5.6 || ^7.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^5.7 || ^6.0"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "extra": {
        "branch-alias": {
            "dev-master": "1.0.x-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework;

use AssertionError;
use Countable;
use Error;
use PHPUnit\Framework\MockObject\Exception as MockObjectException;
use PHPUnit\Util\Blacklist;
use PHPUnit\Util\ErrorHandler;
use PHPUnit\Util\Printer;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\CoveredCodeNotExecutedException as OriginalCoveredCodeNotExecutedException;
use SebastianBergmann\CodeCoverage\Exception as OriginalCodeCoverageException;
use SebastianBergmann\CodeCoverage\MissingCoversAnnotationException as OriginalMissingCoversAnnotationException;
use SebastianBergmann\CodeCoverage\UnintentionallyCoveredCodeException;
use SebastianBergmann\Invoker\Invoker;
use SebastianBergmann\Invoker\TimeoutException;
use SebastianBergmann\ResourceOperations\ResourceOperations;
use SebastianBergmann\Timer\Timer;
use Throwable;

/**
 * A TestResult collects the results of executing a test case.
 */
class TestResult implements Countable
{
    /**
     * @var array
     */
    protected $passed = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $failures = [];

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $notImplemented = [];

    /**
     * @var array
     */
    protected $risky = [];

    /**
     * @var array
     */
    protected $skipped = [];

    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * @var int
     */
    protected $runTests = 0;

    /**
     * @var float
     */
    protected $time = 0;

    /**
     * @var TestSuite
     */
    protected $topTestSuite;

    /**
     * Code Coverage information.
     *
     * @var CodeCoverage
     */
    protected $codeCoverage;

    /**
     * @var bool
     */
    protected $convertErrorsToExceptions = true;

    /**
     * @var bool
     */
    protected $stop = false;

    /**
     * @var bool
     */
    protected $stopOnError = false;

    /**
     * @var bool
     */
    protected $stopOnFailure = false;

    /**
     * @var bool
     */
    protected $stopOnWarning = false;

    /**
     * @var bool
     */
    protected $beStrictAboutTestsThatDoNotTestAnything = true;

    /**
     * @var bool
     */
    protected $beStrictAboutOutputDuringTests = false;

    /**
     * @var bool
     */
    protected $beStrictAboutTodoAnnotatedTests = false;

    /**
     * @var bool
     */
    protected $beStrictAboutResourceUsageDuringSmallTests = false;

    /**
     * @var bool
     */
    protected $enforceTimeLimit = false;

    /**
     * @var int
     */
    protected $timeoutForSmallTests = 1;

    /**
     * @var int
     */
    protected $timeoutForMediumTests = 10;

    /**
     * @var int
     */
    protected $timeoutForLargeTests = 60;

    /**
     * @var bool
     */
    protected $stopOnRisky = false;

    /**
     * @var bool
     */
    protected $stopOnIncomplete = false;

    /**
     * @var bool
     */
    protected $stopOnSkipped = false;

    /**
     * @var bool
     */
    protected $lastTestFailed = false;

    /**
     * @var bool
     */
    private $registerMockObjectsFromTestArgumentsRecursively = false;

    /**
     * Registers a TestListener.
     *
     * @param TestListener $listener
     */
    public function addListener(TestListener $listener): void
    {
        $this->listeners[] = $listener;
    }

    /**
     * Unregisters a TestListener.
     *
     * @param TestListener $listener
     */
    public function removeListener(TestListener $listener): void
    {
        foreach ($this->listeners as $key => $_listener) {
            if ($listener === $_listener) {
                unset($this->listeners[$key]);
            }
        }
    }

    /**
     * Flushes all flushable TestListeners.
     */
    public function flushListeners(): void
    {
        foreach ($this->listeners as $listener) {
            if ($listener instanceof Printer) {
                $listener->flush();
            }
        }
    }

    /**
     * Adds an error to the list of errors.
     *
     * @param Test      $test
     * @param Throwable $t
     * @param float     $time
     */
    public function addError(Test $test, Throwable $t, $time): void
    {
        if ($t instanceof RiskyTest) {
            $this->risky[] = new TestFailure($test, $t);
            $notifyMethod  = 'addRiskyTest';

            if ($test instanceof TestCase) {
                $test->markAsRisky();
            }

            if ($this->stopOnRisky) {
                $this->stop();
            }
        } elseif ($t instanceof IncompleteTest) {
            $this->notImplemented[] = new TestFailure($test, $t);
            $notifyMethod           = 'addIncompleteTest';

            if ($this->stopOnIncomplete) {
                $this->stop();
            }
        } elseif ($t instanceof SkippedTest) {
            $this->skipped[] = new TestFailure($test, $t);
            $notifyMethod    = 'addSkippedTest';

            if ($this->stopOnSkipped) {
                $this->stop();
            }
        } else {
            $this->errors[] = new TestFailure($test, $t);
            $notifyMethod   = 'addError';

            if ($this->stopOnError || $this->stopOnFailure) {
                $this->stop();
            }
        }

        // @see https://github.com/sebastianbergmann/phpunit/issues/1953
        if ($t instanceof Error) {
            $t = new ExceptionWrapper($t);
        }

        foreach ($this->listeners as $listener) {
            $listener->$notifyMethod($test, $t, $time);
        }

        $this->lastTestFailed = true;
        $this->time += $time;
    }

    /**
     * Adds a warning to the list of warnings.
     * The passed in exception caused the warning.
     *
     * @param Test    $test
     * @param Warning $e
     * @param float   $time
     */
    public function addWarning(Test $test, Warning $e, $time): void
    {
        if ($this->stopOnWarning) {
            $this->stop();
        }

        $this->warnings[] = new TestFailure($test, $e);

        foreach ($this->listeners as $listener) {
            $listener->addWarning($test, $e, $time);
        }

        $this->time += $time;
    }

    /**
     * Adds a failure to the list of failures.
     * The passed in exception caused the failure.
     *
     * @param Test                 $test
     * @param AssertionFailedError $e
     * @param float                $time
     */
    public function addFailure(Test $test, AssertionFailedError $e, $time): void
    {
        if ($e instanceof RiskyTest || $e instanceof OutputError) {
            $this->risky[] = new TestFailure($test, $e);
            $notifyMethod  = 'addRiskyTest';

            if ($test instanceof TestCase) {
                $test->markAsRisky();
            }

            if ($this->stopOnRisky) {
                $this->stop();
            }
        } elseif ($e instanceof IncompleteTest) {
            $this->notImplemented[] = new TestFailure($test, $e);
            $notifyMethod           = 'addIncompleteTest';

            if ($this->stopOnIncomplete) {
                $this->stop();
            }
        } elseif ($e instanceof SkippedTest) {
            $this->skipped[] = new TestFailure($test, $e);
            $notifyMethod    = 'addSkippedTest';

            if ($this->stopOnSkipped) {
                $this->stop();
            }
        } else {
            $this->failures[] = new TestFailure($test, $e);
            $notifyMethod     = 'addFailure';

            if ($this->stopOnFailure) {
                $this->stop();
            }
        }

        foreach ($this->listeners as $listener) {
            $listener->$notifyMethod($test, $e, $time);
        }

        $this->lastTestFailed = true;
        $this->time += $time;
    }

    /**
     * Informs the result that a test suite will be started.
     *
     * @param TestSuite $suite
     */
    public function startTestSuite(TestSuite $suite): void
    {
        if ($this->topTestSuite === null) {
            $this->topTestSuite = $suite;
        }

        foreach ($this->listeners as $listener) {
            $listener->startTestSuite($suite);
        }
    }

    /**
     * Informs the result that a test suite was completed.
     *
     * @param TestSuite $suite
     */
    public function endTestSuite(TestSuite $suite): void
    {
        foreach ($this->listeners as $listener) {
            $listener->endTestSuite($suite);
        }
    }

    /**
     * Informs the result that a test will be started.
     *
     * @param Test $test
     */
    public function startTest(Test $test): void
    {
        $this->lastTestFailed = false;
        $this->runTests += \count($test);

        foreach ($this->listeners as $listener) {
            $listener->startTest($test);
        }
    }

    /**
     * Informs the result that a test was completed.
     *
     * @param Test  $test
     * @param float $time
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function endTest(Test $test, $time): void
    {
        foreach ($this->listeners as $listener) {
            $listener->endTest($test, $time);
        }

        if (!$this->lastTestFailed && $test instanceof TestCase) {
            $class = \get_class($test);
            $key   = $class . '::' . $test->getName();

            $this->passed[$key] = [
                'result' => $test->getResult(),
                'size'   => \PHPUnit\Util\Test::getSize(
                    $class,
                    $test->getName(false)
                )
            ];

            $this->time += $time;
        }
    }

    /**
     * Returns true if no risky test occurred.
     *
     * @return bool
     */
    public function allHarmless(): bool
    {
        return $this->riskyCount() == 0;
    }

    /**
     * Gets the number of risky tests.
     *
     * @return int
     */
    public function riskyCount(): int
    {
        return \count($this->risky);
    }

    /**
     * Returns true if no incomplete test occurred.
     *
     * @return bool
     */
    public function allCompletelyImplemented(): bool
    {
        return $this->notImplementedCount() == 0;
    }

    /**
     * Gets the number of incomplete tests.
     *
     * @return int
     */
    public function notImplementedCount(): int
    {
        return \count($this->notImplemented);
    }

    /**
     * Returns an Enumeration for the risky tests.
     *
     * @return array
     */
    public function risky(): array
    {
        return $this->risky;
    }

    /**
     * Returns an Enumeration for the incomplete tests.
     *
     * @return array
     */
    public function notImplemented(): array
    {
        return $this->notImplemented;
    }

    /**
     * Returns true if no test has been skipped.
     *
     * @return bool
     */
    public function noneSkipped(): bool
    {
        return $this->skippedCount() == 0;
    }

    /**
     * Gets the number of skipped tests.
     *
     * @return int
     */
    public function skippedCount(): int
    {
        return \count($this->skipped);
    }

    /**
     * Returns an Enumeration for the skipped tests.
     *
     * @return array
     */
    public function skipped(): array
    {
        return $this->skipped;
    }

    /**
     * Gets the number of detected errors.
     *
     * @return int
     */
    public function errorCount(): int
    {
        return \count($this->errors);
    }

    /**
     * Returns an Enumeration for the errors.
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Gets the number of detected failures.
     *
     * @return int
     */
    public function failureCount(): int
    {
        return \count($this->failures);
    }

    /**
     * Returns an Enumeration for the failures.
     *
     * @return array
     */
    public function failures(): array
    {
        return $this->failures;
    }

    /**
     * Gets the number of detected warnings.
     *
     * @return int
     */
    public function warningCount(): int
    {
        return \count($this->warnings);
    }

    /**
     * Returns an Enumeration for the warnings.
     *
     * @return array
     */
    public function warnings(): array
    {
        return $this->warnings;
    }

    /**
     * Returns the names of the tests that have passed.
     *
     * @return array
     */
    public function passed(): array
    {
        return $this->passed;
    }

    /**
     * Returns the (top) test suite.
     *
     * @return TestSuite
     */
    public function topTestSuite(): TestSuite
    {
        return $this->topTestSuite;
    }

    /**
     * Returns whether code coverage information should be collected.
     *
     * @return bool If code coverage should be collected
     */
    public function getCollectCodeCoverageInformation(): bool
    {
        return $this->codeCoverage !== null;
    }

    /**
     * Runs a TestCase.
     *
     * @param Test $test
     *
     * @throws CodeCoverageException
     * @throws OriginalCoveredCodeNotExecutedException
     * @throws OriginalMissingCoversAnnotationException
     * @throws UnintentionallyCoveredCodeException
     * @throws \ReflectionException
     * @throws \SebastianBergmann\CodeCoverage\InvalidArgumentException
     * @throws \SebastianBergmann\CodeCoverage\RuntimeException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function run(Test $test): void
    {
        Assert::resetCount();

        $coversNothing = false;

        if ($test instanceof TestCase) {
            $test->setRegisterMockObjectsFromTestArgumentsRecursively(
                $this->registerMockObjectsFromTestArgumentsRecursively
            );

            $annotations = $test->getAnnotations();

            if (isset($annotations['class']['coversNothing']) || isset($annotations['method']['coversNothing'])) {
                $coversNothing = true;
            }
        }

        $error      = false;
        $failure    = false;
        $warning    = false;
        $incomplete = false;
        $risky      = false;
        $skipped    = false;

        $this->startTest($test);

        $errorHandlerSet = false;

        if ($this->convertErrorsToExceptions) {
            $oldErrorHandler = \set_error_handler(
                [ErrorHandler::class, 'handleError'],
                E_ALL | E_STRICT
            );

            if ($oldErrorHandler === null) {
                $errorHandlerSet = true;
            } else {
                \restore_error_handler();
            }
        }

        $collectCodeCoverage = $this->codeCoverage !== null &&
                               !$test instanceof WarningTestCase &&
                               !$coversNothing;

        if ($collectCodeCoverage) {
            $this->codeCoverage->start($test);
        }

        $monitorFunctions = $this->beStrictAboutResourceUsageDuringSmallTests &&
            !$test instanceof WarningTestCase &&
            $test->getSize() == \PHPUnit\Util\Test::SMALL &&
            \function_exists('xdebug_start_function_monitor');

        if ($monitorFunctions) {
            \xdebug_start_function_monitor(ResourceOperations::getFunctions());
        }

        Timer::start();

        try {
            if (!$test instanceof WarningTestCase &&
                $test->getSize() != \PHPUnit\Util\Test::UNKNOWN &&
                $this->enforceTimeLimit &&
                \extension_loaded('pcntl') && \class_exists(Invoker::class)) {
                switch ($test->getSize()) {
                    case \PHPUnit\Util\Test::SMALL:
                        $_timeout = $this->timeoutForSmallTests;

                        break;

                    case \PHPUnit\Util\Test::MEDIUM:
                        $_timeout = $this->timeoutForMediumTests;

                        break;

                    case \PHPUnit\Util\Test::LARGE:
                        $_timeout = $this->timeoutForLargeTests;

                        break;
                }

                $invoker = new Invoker;
                $invoker->invoke([$test, 'runBare'], [], $_timeout);
            } else {
                $test->runBare();
            }
        } catch (TimeoutException $e) {
            $this->addFailure(
                $test,
                new RiskyTestError(
                    $e->getMessage()
                ),
                $_timeout
            );

            $risky = true;
        } catch (MockObjectException $e) {
            $e = new Warning(
                $e->getMessage()
            );

            $warning = true;
        } catch (AssertionFailedError $e) {
            $failure = true;

            if ($e instanceof RiskyTestError) {
                $risky = true;
            } elseif ($e instanceof IncompleteTestError) {
                $incomplete = true;
            } elseif ($e instanceof SkippedTestError) {
                $skipped = true;
            }
        } catch (AssertionError $e) {
            $test->addToAssertionCount(1);

            $failure = true;
            $frame   = $e->getTrace()[0];

            $e = new AssertionFailedError(
                \sprintf(
                    '%s in %s:%s',
                    $e->getMessage(),
                    $frame['file'],
                    $frame['line']
                )
            );
        } catch (Warning $e) {
            $warning = true;
        } catch (Exception $e) {
            $error = true;
        } catch (Throwable $e) {
            $e     = new ExceptionWrapper($e);
            $error = true;
        }

        $time = Timer::stop();
        $test->addToAssertionCount(Assert::getCount());

        if ($monitorFunctions) {
            $blacklist = new Blacklist;
            $functions = \xdebug_get_monitored_functions();
            \xdebug_stop_function_monitor();

            foreach ($functions as $function) {
                if (!$blacklist->isBlacklisted($function['filename'])) {
                    $this->addFailure(
                        $test,
                        new RiskyTestError(
                            \sprintf(
                                '%s() used in %s:%s',
                                $function['function'],
                                $function['filename'],
                                $function['lineno']
                            )
                        ),
                        $time
                    );
                }
            }
        }

        if ($this->beStrictAboutTestsThatDoNotTestAnything &&
            $test->getNumAssertions() == 0) {
            $risky = true;
        }

        if ($collectCodeCoverage) {
            $append           = !$risky && !$incomplete && !$skipped;
            $linesToBeCovered = [];
            $linesToBeUsed    = [];

            if ($append && $test instanceof TestCase) {
                try {
                    $linesToBeCovered = \PHPUnit\Util\Test::getLinesToBeCovered(
                        \get_class($test),
                        $test->getName(false)
                    );

                    $linesToBeUsed = \PHPUnit\Util\Test::getLinesToBeUsed(
                        \get_class($test),
                        $test->getName(false)
                    );
                } catch (InvalidCoversTargetException $cce) {
                    $this->addWarning(
                        $test,
                        new Warning(
                            $cce->getMessage()
                        ),
                        $time
                    );
                }
            }

            try {
                $this->codeCoverage->stop(
                    $append,
                    $linesToBeCovered,
                    $linesToBeUsed
                );
            } catch (UnintentionallyCoveredCodeException $cce) {
                $this->addFailure(
                    $test,
                    new UnintentionallyCoveredCodeError(
                        'This test executed code that is not listed as code to be covered or used:' .
                        PHP_EOL . $cce->getMessage()
                    ),
                    $time
                );
            } catch (OriginalCoveredCodeNotExecutedException $cce) {
                $this->addFailure(
                    $test,
                    new CoveredCodeNotExecutedException(
                        'This test did not execute all the code that is listed as code to be covered:' .
                        PHP_EOL . $cce->getMessage()
                    ),
                    $time
                );
            } catch (OriginalMissingCoversAnnotationException $cce) {
                if ($linesToBeCovered !== false) {
                    $this->addFailure(
                        $test,
                        new MissingCoversAnnotationException(
                            'This test does not have a @covers annotation but is expected to have one'
                        ),
                        $time
                    );
                }
            } catch (OriginalCodeCoverageException $cce) {
                $error = true;

                if (!isset($e)) {
                    $e = $cce;
                }
            }
        }

        if ($errorHandlerSet === true) {
            \restore_error_handler();
        }

        if ($error === true) {
            $this->addError($test, $e, $time);
        } elseif ($failure === true) {
            $this->addFailure($test, $e, $time);
        } elseif ($warning === true) {
            $this->addWarning($test, $e, $time);
        } elseif ($this->beStrictAboutTestsThatDoNotTestAnything &&
            !$test->doesNotPerformAssertions() &&
            $test->getNumAssertions() == 0) {
            $this->addFailure(
                $test,
                new RiskyTestError(
                    'This test did not perform any assertions'
                ),
                $time
            );
        } elseif ($this->beStrictAboutOutputDuringTests && $test->hasOutput()) {
            $this->addFailure(
                $test,
                new OutputError(
                    \sprintf(
                        'This test printed output: %s',
                        $test->getActualOutput()
                    )
                ),
                $time
            );
        } elseif ($this->beStrictAboutTodoAnnotatedTests && $test instanceof TestCase) {
            $annotations = $test->getAnnotations();

            if (isset($annotations['method']['todo'])) {
                $this->addFailure(
                    $test,
                    new RiskyTestError(
                        'Test method is annotated with @todo'
                    ),
                    $time
                );
            }
        }

        $this->endTest($test, $time);
    }

    /**
     * Gets the number of run tests.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->runTests;
    }

    /**
     * Checks whether the test run should stop.
     *
     * @return bool
     */
    public function shouldStop(): bool
    {
        return $this->stop;
    }

    /**
     * Marks that the test run should stop.
     */
    public function stop(): void
    {
        $this->stop = true;
    }

    /**
     * Returns the code coverage object.
     *
     * @return CodeCoverage
     */
    public function getCodeCoverage(): ?CodeCoverage
    {
        return $this->codeCoverage;
    }

    /**
     * Sets the code coverage object.
     *
     * @param CodeCoverage $codeCoverage
     */
    public function setCodeCoverage(CodeCoverage $codeCoverage): void
    {
        $this->codeCoverage = $codeCoverage;
    }

    /**
     * Enables or disables the error-to-exception conversion.
     *
     * @param bool $flag
     */
    public function convertErrorsToExceptions(bool $flag): void
    {
        $this->convertErrorsToExceptions = $flag;
    }

    /**
     * Returns the error-to-exception conversion setting.
     */
    public function getConvertErrorsToExceptions(): bool
    {
        return $this->convertErrorsToExceptions;
    }

    /**
     * Enables or disables the stopping when an error occurs.
     *
     * @param bool $flag
     */
    public function stopOnError(bool $flag): void
    {
        $this->stopOnError = $flag;
    }

    /**
     * Enables or disables the stopping when a failure occurs.
     *
     * @param bool $flag
     */
    public function stopOnFailure(bool $flag): void
    {
        $this->stopOnFailure = $flag;
    }

    /**
     * Enables or disables the stopping when a warning occurs.
     *
     * @param bool $flag
     */
    public function stopOnWarning(bool $flag): void
    {
        $this->stopOnWarning = $flag;
    }

    /**
     * @param bool $flag
     */
    public function beStrictAboutTestsThatDoNotTestAnything(bool $flag): void
    {
        $this->beStrictAboutTestsThatDoNotTestAnything = $flag;
    }

    /**
     * @return bool
     */
    public function isStrictAboutTestsThatDoNotTestAnything(): bool
    {
        return $this->beStrictAboutTestsThatDoNotTestAnything;
    }

    /**
     * @param bool $flag
     */
    public function beStrictAboutOutputDuringTests(bool $flag): void
    {
        $this->beStrictAboutOutputDuringTests = $flag;
    }

    /**
     * @return bool
     */
    public function isStrictAboutOutputDuringTests(): bool
    {
        return $this->beStrictAboutOutputDuringTests;
    }

    /**
     * @param bool $flag
     */
    public function beStrictAboutResourceUsageDuringSmallTests(bool $flag): void
    {
        $this->beStrictAboutResourceUsageDuringSmallTests = $flag;
    }

    /**
     * @return bool
     */
    public function isStrictAboutResourceUsageDuringSmallTests(): bool
    {
        return $this->beStrictAboutResourceUsageDuringSmallTests;
    }

    /**
     * @param bool $flag
     */
    public function enforceTimeLimit(bool $flag): void
    {
        $this->enforceTimeLimit = $flag;
    }

    /**
     * @return bool
     */
    public function enforcesTimeLimit(): bool
    {
        return $this->enforceTimeLimit;
    }

    /**
     * @param bool $flag
     */
    public function beStrictAboutTodoAnnotatedTests(bool $flag): void
    {
        $this->beStrictAboutTodoAnnotatedTests = $flag;
    }

    /**
     * @return bool
     */
    public function isStrictAboutTodoAnnotatedTests(): bool
    {
        return $this->beStrictAboutTodoAnnotatedTests;
    }

    /**
     * Enables or disables the stopping for risky tests.
     *
     * @param bool $flag
     */
    public function stopOnRisky(bool $flag): void
    {
        $this->stopOnRisky = $flag;
    }

    /**
     * Enables or disables the stopping for incomplete tests.
     *
     * @param bool $flag
     */
    public function stopOnIncomplete(bool $flag): void
    {
        $this->stopOnIncomplete = $flag;
    }

    /**
     * Enables or disables the stopping for skipped tests.
     *
     * @param bool $flag
     */
    public function stopOnSkipped(bool $flag): void
    {
        $this->stopOnSkipped = $flag;
    }

    /**
     * Returns the time spent running the tests.
     *
     * @return float
     */
    public function time(): float
    {
        return $this->time;
    }

    /**
     * Returns whether the entire test was successful or not.
     *
     * @return bool
     */
    public function wasSuccessful(): bool
    {
        return empty($this->errors) && empty($this->failures) && empty($this->warnings);
    }

    /**
     * Sets the timeout for small tests.
     *
     * @param int $timeout
     */
    public function setTimeoutForSmallTests(int $timeout): void
    {
        $this->timeoutForSmallTests = $timeout;
    }

    /**
     * Sets the timeout for medium tests.
     *
     * @param int $timeout
     */
    public function setTimeoutForMediumTests(int $timeout): void
    {
        $this->timeoutForMediumTests = $timeout;
    }

    /**
     * Sets the timeout for large tests.
     *
     * @param int $timeout
     */
    public function setTimeoutForLargeTests(int $timeout): void
    {
        $this->timeoutForLargeTests = $timeout;
    }

    /**
     * Returns the set timeout for large tests.
     *
     * @return int
     */
    public function getTimeoutForLargeTests(): int
    {
        return $this->timeoutForLargeTests;
    }

    /**
     * @param bool $flag
     */
    public function setRegisterMockObjectsFromTestArgumentsRecursively(bool $flag): void
    {
        $this->registerMockObjectsFromTestArgumentsRecursively = $flag;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

namespace Illuminate\Queue\Jobs;

use Illuminate\Container\Container;
use Illuminate\Queue\DatabaseQueue;
use Illuminate\Contracts\Queue\Job as JobContract;

class DatabaseJob extends Job implements JobContract
{
    /**
     * The database queue instance.
     *
     * @var \Illuminate\Queue\DatabaseQueue
     */
    protected $database;

    /**
     * The database job payload.
     *
     * @var \stdClass
     */
    protected $job;

    /**
     * Create a new job instance.
     *
     * @param  \Illuminate\Container\Container  $container
     * @param  \Illuminate\Queue\DatabaseQueue  $database
     * @param  \stdClass  $job
     * @param  string  $connectionName
     * @param  string  $queue
   