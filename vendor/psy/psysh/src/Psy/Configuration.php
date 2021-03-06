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
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;

class ExitPass extends CodeCleanerPass
{
    /**
     * Converts exit calls to BreakExceptions.
     *
     * @param \PhpParser\Node $node
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Exit_) {
            return new StaticCall(new FullyQualifiedName('Psy\Exception\BreakException'), 'exitShell');
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Faker\Provider\en_HK;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = array('2#######', '3#######', '5#######', '6#######', '9#######');
    protected static $mobileFormats = array('5#######', '6#######', '9#######');
    protected static $landlineFormats = array('2#######', '3#######');
    protected static $faxFormats = array('7#######');

    /**
     * Return an en_HK mobile phone number
     * @return string
     */
    public static function mobileNumber()
    {
        return static::numerify(static::randomElement(static::$mobileFormats));
    }

    /**
     * Return an en_HK landline number
     * @return string
     */
    public static function landlineNumber()
    {
        return static::numerify(static::randomElement(static::$landlineFormats));
    }

    /**
     * Return an en_HK fax number
     * @return string
     */
    public static function faxNumber()
    {
        return static::numerify(static::randomElement(static::$faxFormats));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace Mockery\Generator;

use Mockery\Generator\StringManipulation\Pass\Pass;
use Mockery\Generator\StringManipulation\Pass\RemoveDestructorPass;
use Mockery\Generator\StringManipulation\Pass\CallTypeHintPass;
use Mockery\Generator\StringManipulation\Pass\MagicMethodTypeHintsPass;
use Mockery\Generator\StringManipulation\Pass\ClassNamePass;
use Mockery\Generator\StringManipulation\Pass\ClassPass;
use Mockery\Generator\StringManipulation\Pass\TraitPass;
use Mockery\Generator\StringManipulation\Pass\InstanceMockPass;
use Mockery\Generator\StringManipulation\Pass\InterfacePass;
use Mockery\Generator\StringManipulation\Pass\MethodDefinitionPass;
use Mockery\Generator\StringManipulation\Pass\RemoveBuiltinMethodsThatAreFinalPass;
use Mockery\Generator\StringManipulation\Pass\RemoveUnserializeForInternalSerializableClassesPass;

class StringManipulationGenerator implements Generator
{
    protected $passes = array();

    /**
     * Creates a new StringManipulationGenerator with the default passes
     *
     * @return StringManipulationGenerator
     */
    public static function withDefaultPasses()
    {
        return new static([
            new CallTypeHintPass(),
            new MagicMethodTypeHintsPass(),
            new ClassPass(),
            new TraitPass(),
            new ClassNamePass(),
            new InstanceMockPass(),
            new InterfacePass(),
            new MethodDefinitionPass(),
            new RemoveUnserializeForInternalSerializableClassesPass(),
            new RemoveBuiltinMethodsThatAreFinalPass(),
            new RemoveDestructorPass(),
        ]);
    }

    public function __construct(array $passes)
    {
        $this->passes = $passes;
    }

    public function generate(MockConfiguration $config)
    {
        $code = file_get_contents(__DIR__ . '/../Mock.php');
        $className = $config->getName() ?: $config->generateName();

        $namedConfig = $config->rename($className);

        foreach ($this->passes as $pass) {
            $code = $pass->apply($code, $namedConfig);
        }

        return new MockDefinition($namedConfig, $code);
    }

    public function addPass(Pass $pass)
    {
        $this->passes[] = $pass;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 --TEST--
\PHPUnit\Framework\MockObject\Generator::generate('Foo', [], 'MockFoo', true, true)
--FILE--
<?php
class Foo
{
    public function bar(Foo $foo)
    {
    }

    public function baz(Foo $foo)
    {
    }
}

require __DIR__ . '/../../vendor/autoload.php';

$generator = new \PHPUnit\Framework\MockObject\Generator;

$mock = $generator->generate(
    'Foo',
    [],
    'MockFoo',
    true,
    true
);

print $mock['code'];
?>
--EXPECT--
class MockFoo extends Foo implements PHPUnit\Framework\MockObject\MockObject
{
    private $__phpunit_invocationMocker;
    private $__phpunit_originalObject;
    private $__phpunit_configurable = ['bar', 'baz'];

    public function __clone()
    {
        $this->__phpunit_invocationMocker = clone $this->__phpunit_getInvocationMocker();
    }

    public function bar(Foo $foo)
    {
        $arguments = [$foo];
        $count     = func_num_args();

        if ($count > 1) {
            $_arguments = func_get_args();

            for ($i = 1; $i < $count; $i++) {
                $arguments[] = $_arguments[$i];
            }
        }

        $result = $this->__phpunit_getInvocationMocker()->invoke(
            new \PHPUnit\Framework\MockObject\Invocation\ObjectInvocation(
                'Foo', 'bar', $arguments, '', $this, true
            )
        );

        return $result;
    }

    public function baz(Foo $foo)
    {
        $arguments = [$foo];
        $count     = func_num_args();

        if ($count > 1) {
            $_arguments = func_get_args();

            for ($i = 1; $i < $count; $i++) {
                $arguments[] = $_arguments[$i];
            }
        }

        $result = $this->__phpunit_getInvocationMocker()->invoke(
            new \PHPUnit\Framework\MockObject\Invocation\ObjectInvocation(
                'Foo', 'baz', $arguments, '', $this, true
            )
        );

        return $result;
    }

    public function expects(\PHPUnit\Framework\MockObject\Matcher\Invocation $matcher)
    {
        return $this->__phpunit_getInvocationMocker()->expects($matcher);
    }

    public function method()
    {
        $any     = new \PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount;
        $expects = $this->expects($any);

        return call_user_func_array([$expects, 'method'], func_get_args());
    }

    public function __phpunit_setOriginalObject($originalObject)
    {
        $this->__phpunit_originalObject = $originalObject;
    }

    public function __phpunit_getInvocationMocker()
    {
        if ($this->__phpunit_invocationMocker === null) {
            $this->__phpunit_invocationMocker = new \PHPUnit\Framework\MockObject\InvocationMocker($this->__phpunit_configurable);
        }

        return $this->__phpunit_invocationMocker;
    }

    public function __phpunit_hasMatchers()
    {
        return $this->__phpunit_getInvocationMocker()->hasMatchers();
    }

    public function __phpunit_verify($unsetInvocationMocker = true)
    {
        $this->__phpunit_getInvocationMocker()->verify();

        if ($unsetInvocationMocker) {
            $this->__phpunit_invocationMocker = null;
        }
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @media (min-width: 768px) and (max-width: 980px) {
    /*-*/
    .prd-row .action {
        right: 25px;
    }

    .hr-menu .brand{
        width: 100%;
    }

    .hr-menu .horizontal-menu {
        margin: 10px 0;
    }

    .hr-menu .hr-top-nav {
        margin-top: 10px;
        float: right;
    }
    .media-gal .item {
        width: 100%;
    }

    .media-filter {
        margin: 25px 0;
    }
}

@media (min-width: 480px) and (max-width: 767px) {
  .header{
    position: relative! important;
    margin-top: 80px ! important;
}
    .merge-header{
        margin-right: 0px !important;
    }
.brand{
    width: 100%;
    float: none;
    position: fixed;
    top: 0px;
    z-index: 1005;
}
    .sidebar-toggle-box{
        right: 10px;
    }
    .top-nav{
        margin-bottom: 20px;
    }
    .top-menu{
        margin-right: 10px;
    }
    .wrapper{
        margin-top: 0px;
    }
    ul.sidebar-menu {
        margin-top: 0px;
    }
    #sidebar{
        position: fixed !important;
        z-index: 1002;
        top: 80px;
    }
    #main-content{
        margin-left: 0px;
    }
    /*calendar*/
    .fc-button-inner {
        padding: 0;
    }
    /*-*/
    .prd-row .action {
        right: 25px;
    }

    .weather-full-info ul li {
        width: 15.8%;
    }

    .today-status {
        margin-bottom: 10px;
    }

    .hr-toggle {
        background: #32D2C9;
        color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        -webkit-border-radius: 50%;
        height: 30px;
        line-height: 0;
        margin-top: -58px;
        position: fixed;
        right: 10px;
        width: 30px;
        z-index: 10000;
    }

    .hr-top-nav {
        display: inline-block;
        float: right;
        margin: 10px 0;
    }

    .horizontal-menu {
        width: 100%;
    }

    .horizontal-menu .navbar-nav > li {
        margin-bottom: 10px;
    }
    .lock-wrapper {
        padding: 0 20px;
    }

    .lock-wrapper img {
        width: 140px;
        height: 140px;
        margin-top: 10px;
    }

    .lock-pwd input {
        width: 70%;
    }

    #time {
        font-size: 100px;
    }
    .media-gal .item {
        width: 100%;
    }
    .media-filter {
        margin: 25px 0;
    }

    .media-filter + .pull-right, .media-filter + .pull-right + .btn  {
        float: left !important;
    }


}
@media (max-width:767px){

    .fixed-width #container, .fixed-width #container .header {
        width: 100%;
    }

    #sidebar{
        margin-left:-240px;
        -webkit-transition:all .3s ease-in-out;
        -moz-transition:all .3s ease-in-out;
        -o-transition:all .3s ease-in-out;
        transition:all .3s ease-in-out;
    }
    .hide-left-bar {
        margin-left:0px!important;
    }
    ul.sidebar-menu{
        padding-top: 0px;
    }
    /*-*/
    .prd-row .action {
        right: 25px;
    }
    .lock-wrapper {
        padding: 0 20px;
    }
    .lock-wrapper img {
        width: 140px;
        height: 140px;
        margin-top: 10px;
    }
    .lock-pwd input {
        width: 70%;
    }

    #time {
        font-size: 100px;
    }

    .media-gal .item {
        width: 100%;
    }
    .media-filter {
        margin: 25px 0;
    }

    .media-filter + .pull-right, .media-filter + .pull-right + .btn  {
        float: left !important;
    }

}
@media (max-width: 479px) {
    body{
        margin-top:80px !important;
    }
    .header{
        position: relative !important;

    }
    .merge-header{
        margin-right: 0px !important;
    }
    .brand{
        width: 100%;
        float: none;
        position: fixed;
        top: 0px;
        z-index: 1005;
    }
    .sidebar-toggle-box{
        right: 10px;
    }
    .top-nav{
        margin-bottom: 20px;
    }
    .top-menu{
        margin-right: 10px;
    }
    .wrapper{
        margin-top: 0px;
    }
    ul.sidebar-menu {
        margin-top: 0px;
    }
    #sidebar{
        position: fixed !important;
        z-index: 1002;
        top: 80px;
    }
    #main-content{
        margin-left: 0px;
    }
    .notify-row{
        float: none;
    }
    /*calendar*/
    .fc-button-inner, .fc-button-content {
        padding: 0;
    }
    .fc-header-title h2 {
        font-size: 12px!important;
    }
    .fc .fc-header-space {
        padding-left: 0;
    }
    .fc-state-active, .fc-state-active .fc-button-inner, .fc-state-active, .fc-button-today .fc-button-inner, .fc-state-hover, .fc-state-hover .fc-button-inner {
        background: none repeat scroll 0 0 #FFFFFF !important;
        color: #32323A !important;
    }
    .fc-state-default, .fc-state-default .fc-button-inner {
        background: none repeat scroll 0 0 #FFFFFF !important;
    }

    /*-*/
    .prd-row .action {
        right: 25px;
    }

    .weather-full-info ul li {
        width: 30%;
        margin-bottom: 10px;
    }

    .today-status {
        margin-bottom: 10px;
    }

    .hr-toggle {
        background: #32D2C9;
        color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        -webkit-border-radius: 50%;
        height: 30px;
        line-height: 0;
        margin-top: -58px;
        position: fixed;
        right: 10px;
        width: 30px;
        z-index: 10000;
    }

    .hr-top-nav {
        display: inline-block;
        float: right;
        margin: 10px 0;
    }
    .horizontal-menu {
        width: 100%;
    }

    .horizontal-menu .navbar-nav > li {
        margin-bottom: 10px;
    }

    .lock-wrapper {
        padding: 0 20px;
    }
    .lock-wrapper img {
        width: 100px;
        height: 100px;
        margin-top: -25px;
    }

    .lock-pwd input {
        width: 70%;
    }

    #time {
        font-size: 50px;
    }

    .lock-pwd {
        padding: 0;
    }

    .media-gal .item {
        width: 100%;
    }

    .media-filter {
        margin: 5px 0;
    }

    .media-filter + .pull-right, .media-filter + .pull-right + .btn  {
        float: left !important;
    }

    .media-filter li a {
        margin-bottom: 10px;
        display: inline-block;
    }
}


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;

class ConfigCacheCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'config:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a cache file for faster configuration loading';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new config cache command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('config:clear');

        $config = $this->getFreshConfiguration();

        $this->files->put(
            $this->laravel->getCachedConfigPath(), '<?php return '.var_export($config, true).';'.PHP_EOL
        );

        $this->info('Configuration cached successfully!');
    }

    /**
     * Boot a fresh copy of the application configuration.
     *
     * @return array
     */
    protected function getFreshConfiguration()
    {
        $app = require $this->laravel->bootstrapPath().'/app.php';

        $app->make(ConsoleKernelContract::class)->bootstrap();

        return $app['config']->all();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Session;

use SessionHandlerInterface;
use Illuminate\Support\InteractsWithTime;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Contracts\Cookie\QueueingFactory as CookieJar;

class CookieSessionHandler implements SessionHandlerInterface
{
    use InteractsWithTime;

    /**
     * The cookie jar instance.
     *
     * @var \Illuminate\Contracts\Cookie\Factory
     */
    protected $cookie;

    /**
     * The request instance.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * The number of minutes the session should be valid.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new cookie driven handler instance.
     *
     * @param  \Illuminate\Contracts\Cookie\QueueingFactory  $cookie
     * @param  int  $minutes
     * @return void
     */
    public function __construct(CookieJar $cookie, $minutes)
    {
        $this->cookie = $cookie;
        $this->minutes = $minutes;
    }

    /**
     * {@inheritdoc}
     */
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function read($sessionId)
    {
        $value = $this->request->cookies->get($sessionId) ?: '';

        if (! is_null($decoded = json_decode($value, true)) && is_array($decoded)) {
            if (isset($decoded['expires']) && $this->currentTime() <= $decoded['expires']) {
                return $decoded['data'];
            }
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function write($sessionId, $data)
    {
        $this->cookie->queue($sessionId, json_encode([
            'data' => $data,
            'expires' => $this->availableAt($this->minutes * 60),
        ]), $this->minutes);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function destroy($sessionId)
    {
        $this->cookie->queue($this->cookie->forget($sessionId));

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function gc($lifetime)
    {
        return true;
    }

    /**
     * Set the request instance.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @return void
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'year' => ':count năm',
    'y' => ':count năm',
    'month' => ':count tháng',
    'm' => ':count tháng',
    'week' => ':count tuần',
    'w' => ':count tuần',
    'day' => ':count ngày',
    'd' => ':count ngày',
    'hour' => ':count giờ',
    'h' => ':count giờ',
    'minute' => ':count phút',
    'min' => ':count phút',
    'second' => ':count giây',
    's' => ':count giây',
    'ago' => ':time trước',
    'from_now' => ':time từ bây giờ',
    'after' => ':time sau',
    'before' => ':time trước',
);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        