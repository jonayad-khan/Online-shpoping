ionClass = 'MongoCollection';
        if (phpversion('mongodb')) {
            $collectionClass = 'MongoDB\Collection';
        }

        $collection = $this->getMockBuilder($collectionClass)
            ->disableOriginalConstructor()
            ->getMock();

        return $collection;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * HttpKernelInterface handles a Request to convert it to a Response.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface HttpKernelInterface
{
    const MASTER_REQUEST = 1;
    const SUB_REQUEST = 2;

    /**
     * Handles a Request to convert it to a Response.
     *
     * When $catch is true, the implementation must catch all exceptions
     * and do its best to convert them to a Response instance.
     *
     * @param Request $request A Request instance
     * @param int     $type    The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool    $catch   Whether to catch exceptions or not
     *
     * @return Response A Response instance
     *
     * @throws \Exception When an Exception occurs during processing
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            INDX( 	                 (   �  �      (                       ��     � l     ��     	4��b��3nպ��G��b� 4��b�       �               a u t o l o a d _ c l a s s m a p . p h p     ��     x f     ��     ,T��b��3nպ��j��b�,T��b�       0               a u t o l o a d _ f i l e s . p h p   ��     � p     ��     �F��b��3nպ��ꗖb��F��b�       s               a u t o l o a d _ n a m e s p a c e s . p h p ��     x d     ��     ����b��3nպ��&��b�����b�       e    (          a u t o l o a d _ p s r 4 . p h p     ��     x d     ��     v��b��3nպ�r���b�
v��b�                      a u t o l o a d _ r e a l . p h p     ��     p `     ��     ���b��3nպ�u���b����b� @      �0               C l a s s L o a d e r . p h p ��     p ^     ��     pb��b��lպ� :��b�nb��b�      H              i n s t a l l e d . j s o n   ��     ` P     ��     ྪ�b��3nպ��ݪ�b����b� P      �N               L I C E N S E                     (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               (                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ( INDX( 	                 (     �      #  �                  �    h V     �    X>O�b��t=:���X�b�V>O�b�                       
 a c c e p t a n c e   �    � x     �    �O�b��t=:��,O�b��O�b�                      a c c e p t a n c e . c o n f . p h p . d e f a u l t     p \     �    �Y�b��t=:�*Y�b��Y�b�       �               b o o t s t r a p . p h p         X H     �    $=Y�b��t=:���\�b� =Y�b�                        b u g *   # h R     �    m�\�b��t=:��]�b�d�\�b�                        f i x t u r e s       �    � |     �    X�I�b��t=:���I�b�T�I�b�       �               I d e n t i c a l B i n a r y C o n s t r a i n t . p h p     -    ` L     �    V�]�b��t=:�l�_�b�T�]�b�                        s m o k e     ,    � n     �    ��]�b��t=:���]�b���]�b�                      s m o k e . c o n f . p h p . d e f a u l t   �    x h     �    ��I�b��t=:�(�I�b# ��I�b��       �                S t r e a m C o l l e c t o r . p h p �    � z     �    ��I�b��t=:���I�b���I�b�       �               S w i f t M a i l e r S m o k e T e s t C a s e . p h p       �    � p     �    ��I�b��t=:��I�b���I�b�       {               S w i f t M a i l e r T e s t C a s e . p h p 4    ` J     �    ¤_�b��t=:��!p�b���_�b�                        u n i t       �    h R     �    ��I�b��t=:��O�b���I�b�              #         _ s a m p l e s                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               #                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               # <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Aws\Sdk;
use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Monolog\Formatter\ScalarFormatter;
use Monolog\Logger;

/**
 * Amazon DynamoDB handler (http://aws.amazon.com/dynamodb/)
 *
 * @link https://github.com/aws/aws-sdk-php/
 * @author Andrew Lawson <adlawson@gmail.com>
 */
class DynamoDbHandler extends AbstractProcessingHandler
{
    const DATE_FORMAT = 'Y-m-d\TH:i:s.uO';

    /**
     * @var DynamoDbClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var int
     */
    protected $version;

    /**
     * @var Marshaler
     */
    protected $marshaler;

    /**
     * @param DynamoDbClient $client
     * @param string         $table
     * @param int            $level
     * @param bool           $bubble
     */
    public function __construct(DynamoDbClient $client, $table, $level = Logger::DEBUG, $bubble = true)
    {
        if (defined('Aws\Sdk::VERSION') && version_compare(Sdk::VERSION, '3.0', '>=')) {
            $this->version = 3;
            $this->marshaler = new Marshaler;
        } else {
            $this->version = 2;
        }

        $this->client = $client;
        $this->table = $table;

        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        $filtered = $this->filterEmptyFields($record['formatted']);
        if ($this->version === 3) {
            $formatted = $this->marshaler->marshalItem($filtered);
        } else {
            $formatted = $this->client->formatAttributes($filtered);
        }

        $this->client->putItem(array(
            'TableName' => $this->table,
            'Item' => $formatted,
        ));
    }

    /**
     * @param  array $record
     * @return array
     */
    protected function filterEmptyFields(array $record)
    {
        return array_filter($record, function ($value) {
            return !empty($value) || false === $value || 0 === $value;
        });
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultFormatter()
    {
        return new ScalarFormatter(self::DATE_FORMAT);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

namespace Illuminate\Console\Scheduling;

use Closure;
use Cron\CronExpression;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Contracts\Mail\Mailer;
use Symfony\Component\Process\Process;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Container\Container;

class Event
{
    use Macroable, ManagesFrequencies;

    /**
     * The command string.
     *
     * @var string
     */
    public $command;

    /**
     * The cron expression representing the event's frequency.
     *
     * @var string
     */
    public $expression = '* * * * *';

    /**
     * The timezone the date should be evaluated on.
     *
     * @var \DateTimeZone|string
     */
    public $timezone;

    /**
     * The user the command should run as.
     *
     * @var string
     */
    public $user;

    /**
     * The list of environments the command should run under.
     *
     * @var array
     */
    public $environments = [];

    /**
     * Indicates if the command should run in maintenance mode.
     *
     * @var bool
     */
    public $evenInMaintenanceMode = false;

    /**
     * Indicates if the command should not overlap itself.
     *
     * @var bool
     */
    public $withoutOverlapping = false;

    /**
     * Indicates if the command should only be allowed to run on one server for each cron expression.
     *
     * @var bool
     */
    public $onOneServer = false;

    /**
     * The amount of time the mutex should be valid.
     *
     * @var int
     */
    public $expiresAt = 1440;

    /**
     * Indicates if the command should run in background.
     *
     * @var bool
     */
    public $runInBackground = false;

    /**
     * The array of filter callbacks.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * The array of reject callbacks.
     *
     * @var array
     */
    protected $rejects = [];

    /**
     * The location that output should be sent to.
     *
     * @var string
     */
    public $output = '/dev/null';

    /**
     * Indicates whether output should be appended.
     *
     * @var bool
     */
    public $shouldAppendOutput = false;

    /**
     * The array of callbacks to be run before the event is started.
     *
     * @var array
     */
    protected $beforeCallbacks = [];

    /**
     * The array of callbacks to be run after the event is finished.
     *
     * @var array
     */
    protected $afterCallbacks = [];

    /**
     * The human readable description of the event.
     *
     * @var string
     */
    public $description;

    /**
     * The event mutex implementation.
     *
     * @var \Illuminate\Console\Scheduling\EventMutex
     */
    public $mutex;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Console\Scheduling\Mutex  $mutex
     * @param  string  $command
     * @return void
     */
    public function __construct(EventMutex $mutex, $command)
    {
        $this->mutex = $mutex;
        $this->command = $command;
        $this->output = $this->getDefaultOutput();
    }

    /**
     * Get the default output depending on the OS.
     *
     * @return string
     */
    public function getDefaultOutput()
    {
        return (DIRECTORY_SEPARATOR == '\\') ? 'NUL' : '/dev/null';
    }

    /**
     * Run the given event.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function run(Container $container)
    {
        if ($this->withoutOverlapping &&
            ! $this->mutex->create($this)) {
            return;
        }

        $this->runInBackground
                    ? $this->runCommandInBackground($container)
                    : $this->runCommandInForeground($container);
    }

    /**
     * Get the mutex name for the scheduled command.
     *
     * @return string
     */
    public function mutexName()
    {
        return 'framework'.DIRECTORY_SEPARATOR.'schedule-'.sha1($this->expression.$this->command);
    }

    /**
     * Run the command in the foreground.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    protected function runCommandInForeground(Container $container)
    {
        $this->callBeforeCallbacks($container);

        (new Process(
            $this->buildCommand(), base_path(), null, null, null
        ))->run();

        $this->callAfterCallbacks($container);
    }

    /**
     * Run the command in the background.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    protected function runCommandInBackground(Container $container)
    {
        $this->callBeforeCallbacks($container);

        (new Process(
            $this->buildCommand(), base_path(), null, null, null
        ))->run();
    }

    /**
     * Call all of the "before" callbacks for the event.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function callBeforeCallbacks(Container $container)
    {
        foreach ($this->beforeCallbacks as $callback) {
            $container->call($callback);
        }
    }

    /**
     * Call all of the "after" callbacks for the event.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function callAfterCallbacks(Container $container)
    {
        foreach ($this->afterCallbacks as $callback) {
            $container->call($callback);
        }
    }

    /**
     * Build the command string.
     *
     * @return string
     */
    public function buildCommand()
    {
        return (new CommandBuilder)->buildCommand($this);
    }

    /**
     * Determine if the given event should run based on the Cron expression.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return bool
     */
    public function isDue($app)
    {
        if (! $this->runsInMaintenanceMode() && $app->isDownForMaintenance()) {
            return false;
        }

        return $this->expressionPasses() &&
               $this->runsInEnvironment($app->environment());
    }

    /**
     * Determine if the event runs in maintenance mode.
     *
     * @return bool
     */
    public function runsInMaintenanceMode()
    {
        return $this->evenInMaintenanceMode;
    }

    /**
     * Determine if the Cron expression passes.
     *
     * @return bool
     */
    protected function expressionPasses()
    {
        $date = Carbon::now();

        if ($this->timezone) {
            $date->setTimezone($this->timezone);
        }

        return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
    }

    /**
     * Determine if the event runs in the given environment.
     *
     * @param  string  $environment
     * @return bool
     */
    public function runsInEnvironment($environment)
    {
        return empty($this->environments) || in_array($environment, $this->environments);
    }

    /**
     * Determine if the filters pass for the event.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return bool
     */
    public function filtersPass($app)
    {
        foreach ($this->filters as $callback) {
            if (! $app->call($callback)) {
                return false;
            }
        }

        foreach ($this->rejects as $callback) {
            if ($app->call($callback)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Send the output of the command to a given location.
     *
     * @param  string  $location
     * @param  bool  $append
     * @return $this
     */
    public function sendOutputTo($location, $append = false)
    {
        $this->output = $location;

        $this->shouldAppendOutput = $append;

        return $this;
    }

    /**
     * Append the output of the command to a given location.
     *
     * @param  string  $location
     * @return $this
     */
    public function appendOutputTo($location)
    {
        return $this->sendOutputTo($location, true);
    }

    /**
     * E-mail the results of the scheduled operation.
     *
     * @param  array|mixed  $addresses
     * @param  bool  $onlyIfOutputExists
     * @return $this
     *
     * @throws \LogicException
     */
    public function emailOutputTo($addresses, $onlyIfOutputExists = false)
    {
        $this->ensureOutputIsBeingCapturedForEmail();

        $addresses = is_array($addresses) ? $addresses : [$addresses];

        return $this->then(function (Mailer $mailer) use ($addresses, $onlyIfOutputExists) {
            $this->emailOutput($mailer, $addresses, $onlyIfOutputExists);
        });
    }

    /**
     * E-mail the results of the scheduled operation if it produces output.
     *
     * @param  array|mixed  $addresses
     * @return $this
     *
     * @throws \LogicException
     */
    public function emailWrittenOutputTo($addresses)
    {
        return $this->emailOutputTo($addresses, true);
    }

    /**
     * Ensure that output is being captured for email.
     *
     * @return void
     */
    protected function ensureOutputIsBeingCapturedForEmail()
    {
        if (is_null($this->output) || $this->output == $this->getDefaultOutput()) {
            $this->sendOutputTo(storage_path('logs/schedule-'.sha1($this->mutexName()).'.log'));
        }
    }

    /**
     * E-mail the output of the event to the recipients.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @param  array  $addresses
     * @param  bool  $onlyIfOutputExists
     * @return void
     */
    protected function emailOutput(Mailer $mailer, $addresses, $onlyIfOutputExists = false)
    {
        $text = file_exists($this->output) ? file_get_contents($this->output) : '';

        if ($onlyIfOutputExists && empty($text)) {
            return;
        }

        $mailer->raw($text, function ($m) use ($addresses) {
            $m->to($addresses)->subject($this->getEmailSubject());
        });
    }

    /**
     * Get the e-mail subject line for output results.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
        if ($this->description) {
            return $this->description;
        }

        return "Scheduled Job Output For [{$this->command}]";
    }

    /**
     * Register a callback to ping a given URL before the job runs.
     *
     * @param  string  $url
     * @return $this
     */
    public function pingBefore($url)
    {
        return $this->before(function () use ($url) {
            (new HttpClient)->get($url);
        });
    }

    /**
     * Register a callback to ping a given URL after the job runs.
     *
     * @param  string  $url
     * @return $this
     */
    public function thenPing($url)
    {
        return $this->then(function () use ($url) {
            (new HttpClient)->get($url);
        });
    }

    /**
     * State that the command should run in background.
     *
     * @return $this
     */
    public function runInBackground()
    {
        $this->runInBackground = true;

        return $this;
    }

    /**
     * Set which user the command should run as.
     *
     * @param  string  $user
     * @return $this
     */
    public function user($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Limit the environments the command should run in.
     *
     * @param  array|mixed  $environments
     * @return $this
     */
    public function environments($environments)
    {
        $this->environments = is_array($environments) ? $environments : func_get_args();

        return $this;
    }

    /**
     * State that the command should run even in maintenance mode.
     *
     * @return $this
     */
    public function evenInMaintenanceMode()
    {
        $this->evenInMaintenanceMode = true;

        return $this;
    }

    /**
     * Do not allow the event to overlap each other.
     *
     * @param  int  $expiresAt
     * @return $this
     */
    public function withoutOverlapping($expiresAt = 1440)
    {
        $this->withoutOverlapping = true;

        $this->expiresAt = $expiresAt;

        return $this->then(function () {
            $this->mutex->forget($this);
        })->skip(function () {
            return $this->mutex->exists($this);
        });
    }

    /**
     * Allow the event to only run on one server for each cron expression.
     *
     * @return $this
     */
    public function onOneServer()
    {
        $this->onOneServer = true;

        return $this;
    }

    /**
     * Register a callback to further filter the schedule.
     *
     * @param  \Closure|bool  $callback
     * @return $this
     */
    public function when($callback)
    {
        $this->filters[] = is_callable($callback) ? $callback : function () use ($callback) {
            return $callback;
        };

        return $this;
    }

    /**
     * Register a callback to further filter the schedule.
     *
     * @param  \Closure|bool  $callback
     * @return $this
     */
    public function skip($callback)
    {
        $this->rejects[] = is_callable($callback) ? $callback : function () use ($callback) {
            return $callback;
        };

        return $this;
    }

    /**
     * Register a callback to be called before the operation.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function before(Closure $callback)
    {
        $this->beforeCallbacks[] = $callback;

        return $this;
    }

    /**
     * Register a callback to be called after the operation.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function after(Closure $callback)
    {
        return $this->then($callback);
    }

    /**
     * Register a callback to be called after the operation.
     *
     * @param  \Closure  $callback
     * @return $this
     */
    public function then(Closure $callback)
    {
        $this->afterCallbacks[] = $callback;

        return $this;
    }

    /**
     * Set the human-friendly description of the event.
     *
     * @param  string  $description
     * @return $this
     */
    public function name($description)
    {
        return $this->description($description);
    }

    /**
     * Set the human-friendly description of the event.
     *
     * @param  string  $description
     * @return $this
     */
    public function description($description)
    {
        $this->description = $description;

        return $this;
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

        return $this->buildCommand();
    }

    /**
     * Determine the next due date for an event.
     *
     * @param  \DateTime|string  $currentTime
     * @param  int  $nth
     * @param  bool  $allowCurrentDate
     * @return \Illuminate\Support\Carbon
     */
    public function nextRunDate($currentTime = 'now', $nth = 0, $allowCurrentDate = false)
    {
        return Carbon::instance(CronExpression::factory(
            $this->getExpression()
        )->getNextRunDate($currentTime, $nth, $allowCurrentDate));
    }

    /**
     * Get the Cron expression for the event.
     *
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Set the event mutex implementation to be used.
     *
     * @param  \Illuminate\Console\Scheduling\EventMutex  $mutex
     * @return $this
     */
    public function preventOverlapsUsing(EventMutex $mutex)
    {
        $this->mutex = $mutex;

        return $this;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Faker\Provider\ar_JO;

class Company extends \Faker\Provider\Company
{
    protected static $formats = array(
        '{{lastName}} {{companySuffix}}',
        '{{companyPrefix}} {{lastName}} {{companySuffix}}',
        '{{companyPrefix}} {{lastName}}',
    );

    protected static $bsWords = array(
        array()
    );

    protected static $catchPhraseWords = array(
        array('الخدمات','الحلول','الانظمة'),
        array(
            'الذهبية','الذكية','المتطورة','المتقدمة', 'الدولية', 'المتخصصه', 'السريعة',
            'المثلى', 'الابداعية', 'المتكاملة', 'المتغيرة', 'المثالية'
            ),
    );

    protected static $companyPrefix = array('شركة','مؤسسة','مجموعة','مكتب','أكاديمية','معرض');

    protected static $companySuffix = array('وأولاده', 'للمساهمة المحدودة', ' ذ.م.م', 'مساهمة عامة', 'وشركائه');

    /**
     * @example 'مؤسسة'
     * @return string
     */
    public function companyPrefix()
    {
        return static::randomElement(self::$companyPrefix);
    }

    /**
     * @example 'Robust full-range hub'
     */
    public function catchPhrase()
    {
        $result = array();
        foreach (static::$catchPhraseWords as &$word) {
            $result[] = static::randomElement($word);
        }

        return join($result, ' ');
    }

    /**
     * @example 'integrate extensible convergence'
     */
    public function bs()
    {
        $result = array();
        foreach (static::$bsWords as &$word) {
            $result[] = static::randomElement($word);
        }

        return join($result, ' ');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       INDX( 	                 (   �  �      i                      �    h X     �    �o�b� ��F���!o�b�zo�b� 0      m(               A d d r e s s . p h p �    h T     �    �,o�b� ��F��Bo�b��,o�b�       l              	 C o l o r . p h p     �    h X     �    �Lo�b� ��F���co�b��Lo�b�        )               C o m p a n y . p h p �    p Z     �    ]no�b� ��F��v�o�b�Tno�b�                       I n t e r n e t . p h p       �    h X     �   i �o�b� ��F����o�b���o�b�                       P a y m e n t . p h p �    h V     �    ��o�b� ��F����o�b���o�b�        w              
 P e r s o n . p h p   �    p `     �    g�o�b� ��F����o�b�`�o�b�       @               P h o n e N u m b e r . p h p �    h R     �    z�o�b� ��F��|�p�b�v�o�b� �     K�              T e x t . p h p                                                                                                                   i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               i .. index::
    single: Mockery; Gotchas

Gotchas!
========

Mocking objects in PHP has its limitations and gotchas. Some functionality
can't be mocked or can't be mocked YET! If you locate such a circumstance,
please please (pretty please with sugar on top) create a new issue on GitHub
so it can be documented and resolved where possible. Here is a list to note:

1. Classes containing public ``__wakeup()`` methods can be mocked but the
   mocked ``__wakeup()`` method will perform no actions and cannot have
   expectations set for it. This is necessary since Mockery must serialize and
   unserialize objects to avoid some ``__construct()`` insanity and attempting
   to mock a ``__wakeup()`` method as normal leads to a
   ``BadMethodCallException`` been thrown.

2. Classes using non-real methods, i.e. where a method call triggers a
   ``__call()`` method, will throw an exception that the non-real method does
   not exist unless you first define at least one expectation (a simple
   ``shouldReceive()`` call would suffice). This is necessary since there is
   no other way for Mockery to be aware of the method name.

3. Mockery has two scenarios where real classes are replaced: Instance mocks
   and alias mocks. Both will generate PHP fatal errors if the real class is
   loaded, usually via a require or include statement. Only use these two mock
   types where autoloading is in place and where classes are not explicitly
   loaded on a per-file basis using ``require()``, ``require_once()``, etc.

4. Internal PHP classes are not entirely capable of being fully analysed using
   ``Reflection``. For example, ``Reflection`` cannot reveal details of
   expected parameters to the methods of such internal classes. As a result,
   there will be problems where a method parameter is defined to accept a
   value by reference (Mockery cannot detect this condition and will assume a
   pass by value on scalars and arrays). If references as internal class
   method parameters are needed, you should use the
   ``\Mockery\Configuration::setInternalClassMethodParamMap()`` method.

5. Creating a mock implementing a certain interface with incorrect case in the
   interface name, and then creating a second mock implementing the same
   interface, but this time with the correct case, will have undefined behavior
   due to PHP's ``class_exists`` and related functions being case insensitive.
   Using the ``::class`` keyword in PHP can help you avoid these mistakes.

The gotchas noted above are largely down to PHP's architecture and are assumed
to be unavoidable. But - if you figure out a solution (or a better one than
what may exist), let us know!
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        INDX( 	                 (   �  �                            �    p ^     �    ��b� ��>)�����b���b�                       . g i t a t t r i b u t e s   �    h V     �    ���b� ��>)��[��b����b�0       .               
 . g i t i g n o r e   �    p \     �    ��b� ��>)��g�b���b�       �               c o m p o s e r . j s o n     �    ` P     �    ���b� ��>)��u��b����b�                      L I C E N S E �    h T     �    e��b� ��>)��O��b�b��b��      �              	 R E A D M E . m d     �    X H     �    n%�b� ��>)��S��b�f%�b�                        s r c                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Runner\Filter;

use PHPUnit\Framework\TestSuite;
use RecursiveFilterIterator;
use RecursiveIterator;

abstract class GroupFilterIterator extends RecursiveFilterIterator
{
    /**
     * @var array
     */
    protected $groupTests = [];

    /**
     * @param RecursiveIterator $iterator
     * @param array             $groups
     * @param TestSuite         $suite
     */
    public function __construct(RecursiveIterator $iterator, array $groups, TestSuite $suite)
    {
        parent::__construct($iterator);

        foreach ($suite->getGroupDetails() as $group => $tests) {
            if (\in_array($group, $groups)) {
                $testHashes = \array_map(
                    function ($test) {
                        return \spl_object_hash($test);
                    },
                    $tests
                );

                $this->groupTests = \array_merge($this->groupTests, $testHashes);
            }
        }
    }

    /**
     * @return bool
     */
    public function accept(): bool
    {
        $test = $this->getInnerIterator()->current();

        if ($test instanceof TestSuite) {
            return true;
        }

        return $this->doAccept(\spl_object_hash($test));
    }

    abstract protected function doAccept($hash);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ���� JFIF   d d  �� Ducky     <  �� Adobe d�   �� � 		



��  � � �� �            	                !1AQ"aq�2���B�R#r3C��b��Ѳ�s$4         !1AQ"aq��   ? �#�|f��ݥq4w�{�ȼF7����si�%�{�QRm=��Ȗ1"��5D���O������a$�ĥ	�����3D�62c߭Q�%�(����@�IH(�����g:-�M����"'�WpE$!�ݿ��pZ�e>U��5�r3�F�����I$�#+N����`1��l'��R�ș��[�Spצ3��1�*�YN�M� V��r�����y�tX�g�/gM����J'��<c��?)�\�׽2d����ި����f;eA���H�Y��֖�K2�*�E��I-����c���²H�����m���$~�n����s�O�̣i]A���*~Mc��c�~��6�aE"|�>QK�����|l,A�k��f� ��$��'�yeĝ��E����>!ɳF� �z���,�L�I֕��,Y�c`;l	�(��GjEф�.�t=mJ�t��<t�ǥ����U��Z���J|sHA޺&���tt2ujSa��ރ���`�Oc�����b������,�(y:/��x1�1%��M�I/��4Oh���d)�peq�z,�?��lo4d��&f_��-,�z�aK~�t5Id�;�$��hkQ���g&�q��M&�(�_�k\��(�7�f�����(Hfŷ+It�4p�Wc���ѥ~1�7!�$eܪt��([�E� � �#F/�Ӓ�7���|�v��c�Y0�a��5�ih-��b�-�)%�?��c�*/�h����&/�
��$����?��|�Df%�:��������!PuJ�`d�%�ž����RՌ(0���q����Y�,?v濻��	�S�eapo �R�X�z�[KT����a�h�[��zD/�xo}��H��M�_���2�+	mmOSPO����G�C��TT��D�H'��Zn�R;C.;5��p23/+iV�t�jM(�t�23ΈM�A#y�B��t�L�<�Vi#�M�z#7����L5�Ub���.����Sv@�N��f�zEZ6��z�B�/�� [�n�ȋ�	>R� �u��� �^g?��y��l�� �T��  �ĲyU ���cOш���LA%���7q��%�EA�I�փ�w|���	UM/K�~����zmk`O�ys����ҝI:e�����>H�6</,zFϼ��g+6o�o$���Xx�����\��7��l<'7� ������)�'�K�R��*�Z��ɛq�G>Sl��ݫ��:�x��݇z��W��1 �ڙV2�#��c�bk0���92��X޲/?9��ٷ��y��G�s1]�����Ow�O�sm(�Yd���_z{GqY������}��Y��1���[��Rd�AJ�$7SB�����Ʌɓ2c��^F
 ���b�+���ϷX(b��y�l�S-��"�Չ��~��ϋ�_���A�顆%�cTX﵉&�֫J���&gR!��<���'!��:h�E쀼�����8\ �/�1�mI� a�X���� fz��$�����y�3��\~��ʷ���x?�|r|�?�q�d�z�m� ��EJ� �����;����U"Q��z�d��c�Ȳ��/И��\������-X?y_��K��|s�?އ���Z������<�̈́��� �^�y��b�3��w���3��t(�$;�-����GS��ߏ���E� ��G�	ԉգ7��G��Q���x<��a�S��u��4St#+��Ȍ�1��o�+CK����@�x.N	dyq�X��qCkQ^leH�y�V�E7���2�Ld�/?~8.I�iz����\vC�M���~�+����Ѵ���.tv�1��Ś��`�E<�� җFH{/ʸ/���/��HG�8��_�S�j��]aB�/��O�1��0׌��m$����HLo��2rܼ�ng��2C��b�~GJW�2�L��T�4��JCsr�n1���4���O��@S�8������������ǐr2��K�����2���^�G��?�̓y?���qz�O���7�fo�*-���A�K����3"}�8�'���G����?�(<����(��W�A��(���~y���O��i_���h����#sc؊O��������'lo=������lG�ˁ@�ʊ\iI��R�O�M�6�$<dܰG%����ٜ�����.qUOm��N�i~E~h#��~vV�\ j��h��M'�����n{'&�j�K��`}�U�v�"W�_ �Ù����?,~iC.q�P������Zk���-�'�	�h�X~�=�j��pC���#��~����h6��N7�E��ο�w4��.���F/�YOAB��@��3/�(��7�[�ﷶ� �*��[G:s�;��K?�G$y�-<���vW�aڞ�8%3�'���"�A�Jj�?��~������h�s�\|�.�ʋ"߹�y}�|#�œ�nk:�f���ж�B��o�}Q�� �������eD#ǈcr��f�l:W7��K��_�������r0dF�DIc`]��7��� U�k^%Ķ6�@7����g��"a�ۭ�MREr�����##�
��5�k�+^C��6&>6N>D2&Y���
�$qzE'��9��)�.>d�W�if]G�R�4�o;�����h���jh,��/3�pv/����ZV �� :��!^�f���q0C��1����k�:�h��K��?��DH�o�E�l���·�l��L���1���",	��� j�e�/�&q�O8KfNe�k�;����&��	�4N錂%��Z�\B�� ����Z�݅�K��q����K.�7j٨WX�s|�T�!���T�<$��]�UU�';�(�a����k%��C������cœ���Йе������[�DS���������O�o� �R(C�g-�)0���0���F6�w��T�k4��!~��C���t͹1r��}U���h+��'q��� ;�!�f�����2��1�}׵�s�:�g��F�)B�lF��֕"m�xXI{?ͭl	��c}��pd�Ӏ��0�/C63���J.���~�w�N�L^5�Ƞv�V�dv	R	���B~�_	��x�E�I�6<�3*�E]����x�L>=q���K3����r� B� �0�*�n��M9���,��ҥOYDC������S�Ws1Yѻ3jMSu0�y�Y�&P�۽OpduO���h�)���G��`���=I�zI_63���@�J�L�����q֮�� �X��Ac�уS<�D2�JۆC��ަ��ʀ�����Sc�rO����o���1!&1�� M�o;�q�ϼ�#���d��.b��Л_�ߗx�|��_��z�L'���8�0��,N��מ�p�gt�x����Y䍀�Q��t��d�`�N��1�n5�茄P�Ҋ��� [��_����9S��`�G�d�~���t�1<q��#$ŕ��,�F��2� PK�p^�8���O���YI�_κ�3����WXղz
QG�`A3d@v�ƗDhF_ !*��h�A��"K���50�Cr,P=Ƨ�$��&ȳ��r/c�,�����@[[����'M>��	��@�JޅNbJ��z�fN 
�R$�o���(7�9����|B���P���X��;ȳr�i$bc'���N�uv��_���/�� q~���F���#�����"\�OQ˙Q*9]/z���I��[�X��da������U=�^�*�-�� ��������_/��"$�]�����y��/^��[�� �O
HN��ޱD*;1�2����P:�4FBg���ә�r5��z��y4�p/����u:G.���j��5I��+�>6�Gavi���]NgzM>dx��-���~��2h�)C1[Ѩ��%�H>Cg�.A
:T�T1�#	6�7�5:�RPV_	>F1`F�\)����Ϝ�t�q"�*H:UpD͗�Ýq̌���j��Dn$�ȻE�顩�����Q�9�O(�2BL���7��U�H��Qce�ңo��h�sF<�믡��7�Ǐ?�gn{R�}>_?�p���K�_ux�^S�9l�\㴃h�S��(��,��������޺e�F�#I0��=qGM���yCP	�N���<������x��Sk�k���M�Ŭ�,�B���*Ʌ��X.�Jd#+���qX�r�i"�J�Զ��H���Rd�r,腭���Mj�4������s��C�5�&��o�SO?��	�x����
�H:��>��^�X�x�H���F�%L�L�b����]3��T�J���J��:)D��5R�m���1�<n��,t��i`e���\��rE������O%?�Ɔ]�v�zTԖl;#�M�`�4X_ 7=��M���\6F&L3;8gl��%&N�_
�:�(� �"5�=�|y<� y��֤��/�2,:����I�y�C/#���M�\�y�{�)���O��9N?��x�W�ȉ�dN�m6�U�-N}#��i�t�N�O�$p�<h��,��X��{�=*w���v����2M�#
0KL�{Z�;|���1+#�l	��WT�&���T�:�vF.�==)����2	�z����GZy�s�h�$����$d�kuO�1mɧx��o���G�{��ҟ�'�����cf�o͎O�@��.4E=$p3qbt��N�K!k��f�q���$+aMd�)�0Y�RV�ZZ���y8�� �ԕi~�g|�n�ǔ�{kj���@��f?�Z�	/���"�[��T��݈�UspK<QO�YC��s�cv�\�I�^�0%����E#AbC��!u�����z�jf>nYq�di��b׵�h��>zO+�K"�ffv=v�m�)��oLh�e��l���}+��������n�@��6~^;2�+F��@t'�)\&2��G��&L_0f�D6��k�������>��P�&��O�J����s���$*���.1��cY6� ���I�n3�؂��p5����B��$��NF):bc|RJ�H ���i�S�o�,����q��b��,�o��,JnZ��Q̯aY��e�b����Xȱ�t�aO��y��ami@�i��u��D�S���3!�8ڗC�7���1[\t4�N���2r%%[J��n����#��i��a�|�#����%G#+&�y�L�H���ފ`d~*�8�^���!L�,��7I`�Mjm��s��C{���}��y��(�0&Tl�h�H,z(�h��-�T`y���jڒ5�V�AP����f����M8�|�D�PR����:>���;�z� ��u����A�m{G� Q;�{��];�E������5��Y\F�H����jE�����aB�����EI� 2�GB�Ɩ2W���yi�.?�Ȗ5�Ów�PY\^���E��TvG����1�xQ#��8�H����t�zv��"n���I�|)$�E��E[ Kt��ye==f�";��賂��!��]Uź���[O�g�C�F[,��W�����)��r>r8��nGqM�N�c�I�V�u~n5��}Em6���̱��Һ:��g���g`CZ&L����с{�����?�I�~c��]hS2E����$���{���C�v�c8d�ۻp [��JW+��%��C�����M�vg�י���~L�H��������aM�2ea��y\������.	|$�l�n^�t�>����0t�9"�t�A?��e�V�ŝN��=��V*��*iY�&������S!+��|��yO��w zS �,��බ�},h����!��2M��5�$��4��v�֕�)+N��)�q���Y08�h0�C��Cm�G�N����oY�J�O�� ��3>P�n?8��p��)��OѴS�.>��>K��I�*��12�G6�mݣ�R��|���x��&�*X��z�+KT�'R����I��-����P݈��n�cdP�!*����0:56���ްǙ���T�J�g>��q��i��WU�.��,<.c	ղ\��.(`�^�����������{'&l�5�ym]�l4��=��-���H'1� D���*yD��]|ru۹4�I��X���� :��~'����n��D��g�IƜ��҆O1��>d{I�uƱ�3qLL�B}�� 
���L،�N�;@��Ɇ�T1g[دj\qd���=����n�]����[��G��~W�y��A��Y�n�+*�I=��������^7���4�(�)\�1����g��񡜖����~O������Z^'728�\�|M���:OE΁��r�/���!��k�Aҵ-Byz�dF?��� ���c�h����7\^��'��������(y֏��x�h����+�vk�
�||�J?����Licc���&��� ��Uz#�z� ��?7��h[�K@П[�te;�xߐ@��|GS��6�(�`�X�%�}E\�a^g<R�m�X-�Jd��oXRk^?�F7�$�Z\)$�f^nF"b��q�S��֌��&F<Q|q����tP9��B>F��Ҷ��)&�Cf���KPt��@��[�R߉?�C�����""�1���n�~HdZ-�{u�G��ce��cu�f"��0'!����2s(���!f���E>��.fDBh�~=m��ۑ\���v\�G�-$��Q(��m�(�*M�K����x?�f�ng5CdJ ?:��� Z�|��+>@,�@�o����L�ß��y2b}��LX�b���"��,ͻc~�_
I�g��Ԡ���e�s��/?�y�L��yX��']UӮ�?V�M����d�Ѓ�i�n�ҭ���;�㋶��8�q8��'=�y,
�{�P��������I�w�K���i�ҝ=$�C$�	o�b����S������ګk��Ȕn?�c����+��rd�f��Ļ���)XQ!��!&�Bz~���|��0H��ޗFREϟ4���F��O;{&� �)l�?��d�lSdC(E� �u?Έ���R1�o��'<��jįnߪߍ��>~�˅V�������\l�y�-*�˥��Xr���o+���q���&��S�\�xtDiпh>�� �aY��'+2��uE���շ�w��ҳ#f��c��z�t̐�2~'��m)e�FS����-��'�2@L�q9xW����5Jz�p�xR?a{��w�ZIW��ac{�t��9�?��?�yرD�cO:,������� �:��Nȕq�ҳ�?s�I�c����p�Ғ���L�]H�>H�$�D\Tm:��V5y��wv�~I_kX{{� �U2���tW7n�`�±�c�dRAұ��AYjO���5?F4�eNC7�j�z8"�$�m���dP������c�P��]��:��9Le��::d#C���;����߅:`����6R.U��А;--XT���yߏB���ǎēS#�+���J�]P��x��ܨ��p�R:{��M�/����1r�6.J���j��"�V��]/�br~?�[��3���2u(�/O=�uy{�i��v<��#&B�|gR[o�R��L���gd�x�,�vFô$� �ý�$�x�2p�C#H#=K}(<B�~[��<��^*L�XD�Ϻ2n��P��<��щ�G�~�7Ca�N�7�t�j��6��Þ��}��nk+?���j�� ,xI��"Ď�J���ϳ܇�`a���������F$,
�{M�7�����y�+x���ה��f$�&�˗���O�h������ַ�Ζ��s|�(��Scbcĥ��/��z�*��f�㬜u

��A�� M���sC��8�:�mҊ@Ў3�\��[�G��z��M4���~u���>��Z:a��~����S���ݍ2@lK�65�� �/�۠����%�����+�an���Z8C�1H&Iۥ�P/B�2t߅�>1�q����!�֘ر���N�-�f����NDΰB:9���QQ7%[7�׎�'��F,UX����k:aR�y����q�ȗ�ң^ߍef��҅�?�c������U&��R�x1t=I�t�}�G����"Y���,N�}*M�-"�w?��s��S^1�A�V�i�0�(�3y��w�����BgY�}���?I��ƪ@7�}tΌR	�?y33e�,�V.=ʧn�{jM2�+�͛
lL��-��p������+��4�(�V7i6�O�G6�ߖ!a�v�� n����9������~�{P��rq;"�tL��t*�=����I
J�����[
��Q�f��ݫ�Ļ�����:�',� h����L�"�����Xf>��z��B����|O�r&�!ۍ��Ƨ�5;i}+���׍�'D�')κ��T�cp5'�zHF�b~[�k�|�%^|�
 +p�T����D�F��K��J�4�H�a���w�|.�T��bp�؜2��͐��Qڧ	�G���K�o���X�E�#�U*��kN�U����)"I���0�����Rcpdp<���h�!|x�î����q	T�Wٿ$� �r�f����M6�OA��6�-�x|zL��F]�:j^���pi���?-�9l��� ���z�Fw��_!�ИX�K�ҍ-��~��@帨�M�h�,�M� Z�^<5��rYG�=w�m�aM��<�i��A�i���e�#�Z)��k)�z8r�3�����DI�H#�c>FZ�`����"�pbu$��1Ν$ 1� �:��e�P\h����m�ٓ���A�6Gf��AWN��V���2J�2���S~ ��K�796�1�8��X���Gk�S�;eN|��v�Vg���I���+����	�N�Lq8�2K��#�I �C�oA��P&ns�#9k�������?��'KZ�(�������M����/Bժq:ƪ�dQ��{��4HcfI��1R;���
x�䜌���|�xA$+� Zl�of'CL D3?o��Z3M���xH#�.S�ku�4��ƍr�X���� 0B�/֧M�(Fg�y�������AwK�ju<V9/8����]��^�\^���P{GV5���xnO'�P{іg8
�;I4MQ`��00e�hz��H��~����h�74�G׵s���3������k��H��=� �:`b[#u��J̐�X�F����驦���y9+(�jKtܚ %���:#�x�lH}�J�4��O�R��1_�����GM��� 1��+ �ܮF�4x�%'��JHJz�Z�VfB�r�ְA�[��c	.��6��K�J9k�zX$�'?���!oi��(f��^U�Y>f�>��]ku�S��9d�;@�ҷa��ŝ�9H��zӥ��D�c�}�0-�i�
� f�J�X*`M���Fmw^��.�Hx��^#$�XЏ�q�U�8�k�4�Ѝ������QB�K�G��z8c�nE��l0��v�����6=;Ӏ"I�$!�6�����a@--κۡ�0۝���u$N�Q�fo�֨��	I ����z]���j8c��>�@��ց���n�ހO"����I��t�V<��R7�~z��`2Þ���ҝ����ؗ�ނ���9D���[���B>|F��5�i��m!y�6���){;�ּ� o'/����.H�)~�E���+�ǿj�&Ɲ��i� ������2`�*�;[��f;����QlR�`oҐ(��`�k�5��ڰF�	~�S%�^�1pqH�����i�X4������`�����@�u5�|�c���(Z��m1��0Ea�����f�|���l������ NeRK�n�4��M�?�0�N��SK��ys�uhԛn���Lk	�/
lL'���\t=�J��-1�;��vd��v/�3��QIP[r���%�]OT�)~�YC7��GEV��j:
��p �=������44�6��H��GM�]i��RE��[@-PM�29��`r�c~�P#�GM�e[�ފ �Sa�CLa�T�&��N�+i�@�:�kPmoj;$��J~X� �A��6./.8��]4�2`y\F\�Wh���[<.#M���I���+�⢅UUw����M��{�0���7�Y�oZN������O�߉�l�k��H� �}j���p�	$��F�I�j�"*��H2��7v.R!�R��v>\�i4�?#��6��,@�(hOM��5�#2 n�SCm�(�.�kht�����ǖ���C��e�Pu�7`a�j��ƛL�O�qEP�����z �JV�	�%�n�'`�ܐ�J��Cb7=��0�>\؛nR��E7�Oh�����ڙ=2���]E����+�r���)\�F1x �"F$��ҩz'fƏ��Vh_ɀ���=wW�.S�j�� J��X�oe���FYmڙ=��T f�i��$ X�}��ԃY�Jq\��zޙv@l�0Au�K�����+m��jߨ��?1"%��޲�L.ø��l�$'V-�S�6�T���b,tkiRSLn�V$�y2*c�F �Ԟծ�4H7���2��i��i9�>&5����L#�n����+o�:!�����b ���w7C���1���5R� ����"㟫'�����A�[����;_r��
WAPOp_ny�q^7�3�GMT7Z:� ������BGC��G����\\�2�m�Zo$/�'�P�#�z�&��F�6�cƉKV0�1��E��U~�x���q�~YL-&8����[~b��#��3��fI��wc��R��ZX��A���:�"l�@}j�Em"<��U�	-l~`�Ƿ֕}�����:
ƑS��'҄�B�a�UC�Զ�LLJ��w@)|�����@���<�..?	�7[�.L�TF� 	��{��8�cı�-�/����|�MJ�7�^�k8u��'�3���:�	BE��(F`k�Ty�|lq����s}�/[Ps�퀹�K�<+��m�	:u&�|����*{����SE�;2;����9J�E�'�W��	v�q�t8��s$$��u��he��� ۖ\�^3�c"�f��'��E��=�k�<�qql�(`�s���
/ɰͤ�'��9�!�\��Ge��@����ͧ�J�L��2(���a=]���z>yʰ�����r���!Z�!�K~��j]��q��>?��� _ ��C��I���W#� �é�:d��G��[i]0E�d<�s�U�	����+��-z��0s�B@i�V�g񩿣���~ݿ
���r;,q���w�l(�����n(�����X0�	Pr�hy���Mo/���'���c��(�CM��R1����B�����m+�k^��zk�n���'���B�|��5�� �G���]=f���PT������#����ʄ�X��� �,(��{��2�5�)�3�a�/3�3���~f+�T(���P�ӆt��gK�������ra�s.��o64:��=�3�r��`?!T�B5�f��,��LV?�úg���{y�I:O��c����P��r2�>�}��N����                                                                                                                                                                                                                                                                                                                                  <?php

namespace Faker\ORM\Propel;

use \Faker\Provider\Base;
use \ColumnMap;

/**
 * Service class for populating a table through a Propel ActiveRecord class.
 */
class EntityPopulator
{
    protected $class;
    protected $columnFormatters = array();
    protected $modifiers = array();

    /**
     * Class constructor.
     *
     * @param string $class A Propel ActiveRecord classname
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    public function setColumnFormatters($columnFormatters)
    {
        $this->columnFormatters = $columnFormatters;
    }

    /**
     * @return array
     */
    public function getColumnFormatters()
    {
        return $this->columnFormatters;
    }

    public function mergeColumnFormattersWith($columnFormatters)
    {
        $this->columnFormatters = array_merge($this->columnFormatters, $columnFormatters);
    }

    /**
     * @param \Faker\Generator $generator
     * @return array
     */
    public function guessColumnFormatters(\Faker\Generator $generator)
    {
        $formatters = array();
        $class = $this->class;
        $peerClass = $class::PEER;
        $tableMap = $peerClass::getTableMap();
        $nameGuesser = new \Faker\Guesser\Name($generator);
        $columnTypeGuesser = new \Faker\ORM\Propel\ColumnTypeGuesser($generator);
        foreach ($tableMap->getColumns() as $columnMap) {
            // skip behavior columns, handled by modifiers
            if ($this->isColumnBehavior($columnMap)) {
                continue;
            }
            if ($columnMap->isForeignKey()) {
                $relatedClass = $columnMap->getRelation()->getForeignTable()->getClassname();
                $formatters[$columnMap->getPhpName()] = function ($inserted) use ($relatedClass) {
                    return isset($inserted[$relatedClass]) ? $inserted[$relatedClass][mt_rand(0, count($inserted[$relatedClass]) - 1)] : null;
                };
                continue;
            }
            if ($columnMap->isPrimaryKey()) {
                continue;
            }
            if ($formatter = $nameGuesser->guessFormat($columnMap->getPhpName(), $columnMap->getSize())) {
                $formatters[$columnMap->getPhpName()] = $formatter;
                continue;
            }
            if ($formatter = $columnTypeGuesser->guessFormat($columnMap)) {
                $formatters[$columnMap->getPhpName()] = $formatter;
                continue;
            }
        }

        return $formatters;
    }

    /**
     * @param ColumnMap $columnMap
     * @return bool
     */
    protected function isColumnBehavior(ColumnMap $columnMap)
    {
        foreach ($columnMap->getTable()->getBehaviors() as $name => $params) {
            $columnName = Base::toLower($columnMap->getName());
            switch ($name) {
                case 'nested_set':
                    $columnNames = array($params['left_column'], $params['right_column'], $params['level_column']);
                    if (in_array($columnName, $columnNames)) {
                        return true;
                    }
                    break;
                case 'timestampable':
                    $columnNames = array($params['create_column'], $params['update_column']);
                    if (in_array($columnName, $columnNames)) {
                        return true;
                    }
                    break;
            }
        }

        return false;
    }

    public function setModifiers($modifiers)
    {
        $this->modifiers = $modifiers;
    }

    /**
     * @return array
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    public function mergeModifiersWith($modifiers)
    {
        $this->modifiers = array_merge($this->modifiers, $modifiers);
    }

    /**
     * @param \Faker\Generator $generator
     * @return array
     */
    public function guessModifiers(\Faker\Generator $generator)
    {
        $modifiers = array();
        $class = $this->class;
        $peerClass = $class::PEER;
        $tableMap = $peerClass::getTableMap();
        foreach ($tableMap->getBehaviors() as $name => $params) {
            switch ($name) {
                case 'nested_set':
                    $modifiers['nested_set'] = function ($obj, $inserted) use ($class, $generator) {
                        if (isset($inserted[$class])) {
                            $queryClass = $class . 'Query';
                            $parent = $queryClass::create()->findPk($generator->randomElement($inserted[$class]));
                            $obj->insertAsLastChildOf($parent);
                        } else {
                            $obj->makeRoot();
                        }
                    };
                    break;
                case 'sortable':
                    $modifiers['sortable'] = function ($obj, $inserted) use ($class) {
                        $maxRank = isset($inserted[$class]) ? count($inserted[$class]) : 0;
                        $obj->insertAtRank(mt_rand(1, $maxRank + 1));
                    };
                    break;
            }
        }

        return $modifiers;
    }

    /**
     * Insert one new record using the Entity class.
     */
    public function execute($con, $insertedEntities)
    {
        $obj = new $this->class();
        foreach ($this->getColumnFormatters() as $column => $format) {
            if (null !== $format) {
                $obj->setByName($column, is_callable($format) ? $format($insertedEntities, $obj) : $format);
            }
        }
        foreach ($this->getModifiers() as $modifier) {
            $modifier($obj, $insertedEntities);
        }
        $obj->save($con);

        return $obj->getPrimaryKey();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php
namespace Hamcrest\Core;

class PhpForm
{
    public function __toString()
    {
        return 'php';
    }
}

class JavaForm
{
    public function toString()
    {
        return 'java';
    }
}

class BothForms
{
    public function __toString()
    {
        return 'php';
    }

    public function toString()
    {
        return 'java';
    }
}

class HasToStringTest extends \Hamcrest\AbstractMatcherTest
{

    protected function createMatcher()
    {
        return \Hamcrest\Core\HasToString::hasToString('foo');
    }

    public function testMatchesWhenToStringMatches()
    {
        $this->assertMatches(
            hasToString(equalTo('php')),
            new \Hamcrest\Core\PhpForm(),
            'correct __toString'
        );
        $this->assertMatches(
            hasToString(equalTo('java')),
            new \Hamcrest\Core\JavaForm(),
            'correct toString'
        );
    }

    public function testPicksJavaOverPhpToString()
    {
        $this->assertMatches(
            hasToString(equalTo('java')),
            new \Hamcrest\Core\BothForms(),
            'correct toString'
        );
    }

    public function testDoesNotMatchWhenToStringDoesNotMatch()
    {
        $this->assertDoesNotMatch(
            hasToString(equalTo('mismatch')),
            new \Hamcrest\Core\PhpForm(),
            'incorrect __toString'
        );
        $this->assertDoesNotMatch(
            hasToString(equalTo('mismatch')),
            new \Hamcrest\Core\JavaForm(),
            'incorrect toString'
        );
        $this->assertDoesNotMatch(
            hasToString(equalTo('mismatch')),
            new \Hamcrest\Core\BothForms(),
            'incorrect __toString'
        );
    }

    public function testDoesNotMatchNull()
    {
        $this->assertDoesNotMatch(
            hasToString(equalTo('a')),
            null,
            'should not match null'
        );
    }

    public function testProvidesConvenientShortcutForTraversableWithSizeEqualTo()
    {
        $this->assertMatches(
            hasToString(equalTo('php')),
            new \Hamcrest\Core\PhpForm(),
            'correct __toString'
        );
    }

    public function testHasAReadableDescription()
    {
        $this->assertDescription(
            'an object with toString() "php"',
            hasToString(equalTo('php'))
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  INDX( 	                 (      �                             �    � �     �    暤�b�J�b=�}���b�䚤�b�        �               D a t a b a s e M i g r a t i o n R e p o s i t o r y . p h p �    p \     �    �ˤ�b�J�b=�줝b��ˤ�b�x      q               M i g r a t i o n . p h p     �    � j     �    w���b�J�b=�Q ��b�n���b�                       M i g r a t i o n C r e a t o r . p h p       �    � �     �    ,1��b�J�b=��O��b�*1��b�      a                M i g r a t i o n R e p o s i t o r y I n t e r f a c e . p h p       �    p Z     �    m_��b�J�b=����b�j_��b� P      $@               M i g r a t o r . p h p       �    ` L     �    枥�b��i�b=�U���b�䞥�b�                        s t u b s                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Queue\Jobs;

use Illuminate\Support\InteractsWithTime;

abstract class Job
{
    use InteractsWithTime;

    /**
     * The job handler instance.
     *
     * @var mixed
     */
    protected $instance;

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * Indicates if the job has been deleted.
     *
     * @var bool
     */
    protected $deleted = false;

    /**
     * Indicates if the job has been released.
     *
     * @var bool
     */
    protected $released = false;

    /**
     * Indicates if the job has failed.
     *
     * @var bool
     */
    protected $failed = false;

    /**
     * The name of the connection the job belongs to.
     */
    protected $connectionName;

    /**
     * The name of the queue the job belongs to.
     *
     * @var string
     */
    protected $queue;

    /**
     * Get the raw body of the job.
     *
     * @return string
     */
    abstract public function getRawBody();

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        $payload = $this->payload();

        list($class, $method) = JobName::parse($payload['job']);

        ($this->instance = $this->resolve($class))->{$method}($this, $payload['data']);
    }

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete()
    {
        $this->deleted = true;
    }

    /**
     * Determine if the job has been deleted.
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Release the job back into the queue.
     *
     * @param  int   $delay
     * @return void
     */
    public function release($delay = 0)
    {
        $this->released = true;
    }

    /**
     * Determine if the job was released back into the queue.
     *
     * @return bool
     */
    public function isReleased()
    {
        return $this->released;
    }

    /**
     * Determine if the job has been deleted or released.
     *
     * @return bool
     */
    public function isDeletedOrReleased()
    {
        return $this->isDeleted() || $this->isReleased();
    }

    /**
     * Determine if the job has been marked as a failure.
     *
     * @return bool
     */
    public function hasFailed()
    {
        return $this->failed;
    }

    /**
     * Mark the job as "failed".
     *
     * @return void
     */
    public function markAsFailed()
    {
        $this->failed = true;
    }

    /**
     * Process an exception that caused the job to fail.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function failed($e)
    {
        $this->markAsFailed();

        $payload = $this->payload();

        list($class, $method) = JobName::parse($payload['job']);

        if (method_exists($this->instance = $this->resolve($class), 'failed')) {
            $this->instance->failed($payload['data'], $e);
        }
    }

    /**
     * Resolve the given class.
     *
     * @param  string  $class
     * @return mixed
     */
    protected function resolve($class)
    {
        return $this->container->make($class);
    }

    /**
     * Get the decoded body of the job.
     *
     * @return array
     */
    public function payload()
    {
        return json_decode($this->getRawBody(), true);
    }

    /**
     * Get the number of times to attempt a job.
     *
     * @return int|null
     */
    public function maxTries()
    {
        return $this->payload()['maxTries'] ?? null;
    }

    /**
     * Get the number of seconds the job can run.
     *
     * @return int|null
     */
    public function timeout()
    {
        return $this->payload()['timeout'] ?? null;
    }

    /**
     * Get the timestamp indicating when the job should timeout.
     *
     * @return int|null
     */
    public function timeoutAt()
    {
        return $this->payload()['timeoutAt'] ?? null;
    }

    /**
     * Get the name of the queued job class.
     *
     * @return string
     */
    public function getName()
    {
        return $this->payload()['job'];
    }

    /**
     * Get the resolved name of the queued job class.
     *
     * Resolves the name of "wrapped" jobs such as class-based handlers.
     *
     * @return string
     */
    public function resolveName()
    {
        return JobName::resolve($this->getName(), $this->payload());
    }

    /**
     * Get the name of the connection the job belongs to.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return $this->connectionName;
    }

    /**
     * Get the name of the queue the job belongs to.
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Get the service container instance.
     *
     * @return \Illuminate\Container\Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    �PNG

   IHDR  �  �   N�`�   sRGB ���   gAMA  ���a   	pHYs  �  ��o�d  6NIDATx^��۫g�}?�)-�a�����BK�#B/ze(��C;��QA
�Q�Bo4�z5r��X�T�n<D��:�jH5�s��4�χ����=;��Y����g����<k�^�Fٳ���Y������	   d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+�\z�0 PB�I�@tV��I� (!׃�~ :+�t�񫯾� Ѩ (�: V�h���b����_J�hT �d+����J1U�t��'�8�� �e+����J1]a��/$@���Ԝ��E��� Za`��*V4* J��� Za`���0~���  %YĊu �0�R�F+ %YĊu �0�R�F+ %YĊu �0�RLW?��3	�
���b�:�VX)F���
���b�:�VX)�+��~���F@I��b@+��QŊF@I��b@+��QŊF@I��b@+���O>�DD��$�X��V�ѨbE��$�X��V��
��,�QP�u@�X�
+�hT��QP�u@�X�
+�hT��QP�u@�X�
+�t��>� Ѩ (�: V�h���b4�XѨ (�: V�h���b����J�hT �d+����J1U�hT �d+����J1�7�[o�u�m۶�����_��W��Z�F@IQ������o';w���~~�ӟf��F�h���b����4�W^yeE��{�۶�
��"����s?k���5�3J�:�VX)&b�Zo���kE����'���zv��QPR�u�������?�\�=�Z�
+�t�����o*�����k�]j.�������<��#��i! %E[̫��9sfr�%�L�7���^�ݾ}��m�~�ӧO�خT�h���b�5����_�^�s�UWM{�i�������B4* J���W�����ߗ�}��ۥ<��S�mSr�m�X�
+�t����k*�F�K����t�С��E�F@I���������,m�sr���?Ӛ�7�|3�ݢc@+��Q�'o����2��ym�9E�F@I�����r�|����.>u�Tv�E�:�VX)&R�Zo�M��T���ѭD���H�y�������s3߳�X�
+�t�1=䠕�r�-�����p����zkّ��~����
��"�j�����g��;�'O��n��X�
+�DjT�ɹ�V���p��~��hT �eP��GY?X�
+�t�1�#�B�G@���ʥw������'��z�hT �eP����7��^���$�]�X�
+�DiT�Iz�5�\3m(w�u׊m�}-���Mg3Ѩ ()�:�f���s�r�X�
+�DhT�M�h�\���n���?L��h4* J�����g�յ~�R��V��
�3g��?��?�5�ӧOg�K���|�}���v�QPR�u@����ꫧ?/���n[2����J1�z2�X��B��R�x�e���m�hT �T{P��GVS�h���b�.����|Yc�H.���ɱcǲ?7Z4* J��(���eĻv�Z�sz��5b@+�S�Q�77�|���DjFkE����뀒��׿��䢋.�~owYqn�Z��V��ݨ֓��Ѝ������hѨ (��:�d�=���+� Za`���0��9���[�`�=��n6��w����o�>��/��.R4* J��(���ۧ\q���'Of��� Za`����j��_.���~7�M./��ҲK����v��QPR�u@��>;�n���� Za`���0�rG̋/���)=�����rI��ٳg����'��F�F@I��%�{nX��&Z�h���bj5����l��BG��n�Zf��Fb�hT �Tk����裏.����� Za`��Z�j=�=���f3{7z�Ҩ (��:`����+��X�
+�t�1��;Z���wY3������vk����˚V:�{�����QPR�u������Ս&=��g�Y�{��u �0�RL�F���{��汕As�qm�1��F@I5����7�tӲ�o4V87+�t�1]>)�ҝ�/�x�<��_�%��z2��.���w�嶭�
��J���ӽ����w�_�L�����Og�E�:�VX)�t����QP�u@�X�
+�t�1�"��QP�u@�X�
+�hT��QP�u@�X�
+�hT��QP�u@�X�
+�t��ԩS  %YĊu �0�R�F+ %YĊu �0�RLWO�<)�QP�u@�X�
+�hT��QP�u@�X�
+�hT��QP�u@�X�
+�t��ĉ  %YĊu �0�R�F+ %YĊu �0�RLW�?.�QP�u@�X�
+�hT��QP�u@�X�
+�hT��QP�u@�X�
+�t��رc  %YĊu �0�R�F+ %YĊu �0�RLW�=*�QP�u@�X�
+�hT��QP�u@�X�
+�hT��QP�u@�X�
+�t��ȑ#  %YĊu �0�R�F+ %YĊu �0�RLW>,�QP�u@�X�
+�hT��QP�u@�X�
+�t���^� Ѩ (�: V�h���b4�XѨ (�: V�h���b��X2�v��ܹ3�k�����Ϛ��EG���\Zt��� �3�RL�H.:�w�d۶m�;vd=Bҟ-��oߞ��EG���\ZtRome��,�__t����JU��vۊB9������RH����&B���sϞ=�mJ JY�: �Ԯ��^��&B���s��Kn���h�T��F�o��o���=�M�D��@)���u ���JU�{���7-�����&b��o�f����o|c�!�͢�QPR�m5���^�zjꭹm"&�Y��˿���g�Yt����ʠ�9sfz���ݻ�~��]v�ҟ=�7|���g�
 �G��=�����뮛�^}�ճ_�q3�2�I�'�B�����7�� ���ih��a0�2�jwT2�imU:�ڝ%NGZ�s���4�v�4���X��{�.��!\Bs�С�����~�� @�<0�<��v9x�g`�y�&��}(��� �4ԃ�i���������0>V���@v�<�e_ ���LdT�u���fXiV�I��D�����$ `��"�;+MK�J�[��~_ ���?lq�뀤[��fXi���W:�K� `#����sIk����YV�3�Kc<| ��PB�++M��s=|�1�mC|�����<��~���J3���w<|�1J��v�j�5h��~��1����,������ ��{8��=������4����O`,\]�R�)���0dV�����Yg Ơ���t{��>ca`%4GT���� �>��4�v��|_/�f`%,XO`�\I�>�?1tVB�Q���˙h �d�rW��?��L4Cc`%G
7�}, ��Wl�+�*+����鷛�> ��UC���Cd`%��,���n��� ���+��Z��1������Т�������7{�����X	�}�}���;� ��̙3�+�v��}��l�+�+�y��b8c@���2Vg�'���W�X�2+U9�8  ���5�ie~�&�X�&P��X��qw@�����-,��Hq�-2�RMw��S��Yl "r���t_p���,6-2�R��+˲(  S�r�-3�R\��O.����A j���v�r�Ob����X)ʙ��\@mn	�ǙmZd`�E�>�P�[��s��X)"F.C�����!�k���T�۳h����sV/�tT�kT{��=�U X��ʚ��������VNA��%A ������OL�,��ǖήv?& 0o���-�}tOl��CTV��6xr0 ���1����':+�����o �U<���c����H��]x�a������ ̓�����̕�u�JG��F��* ���'�D��$"+sտWE�k��� lE�*+W�)]׭�<ۂ�̍{U���U 6�UV���h�̅3s��?��Q�x�g[���-KM�Vݫ2������w}��;o|�&+[��p�F���jT �������&��+���ʦ97|���Z����������``e��O���rt��t�zǎK�!�f�ܟLMV6���E�`V���4���j��W����4+��8yr0 2��uj1��!�)uê'�K��{��ˁ��J��t�"�ݻg�R��[�Hy"�8iT ��?p�a|��*�}�����kt�O�����*;:βS���uq�"}�ħ#� ���r3�X9'���xx�9NhP���5�䃵tG�=�`��}��Z�J��y�+��߫�zrRc�{��r��sI1�ִ����E0���/>��Z�+ ä��^i_I�I��2oVVpy�Ľ'��M�O���x���
n�g3<9`8�מQ�F����Z �Z�``eO~e+�? �S��
��f`eʥ̃�� �r�[�z�[˘'+K�� z"0[���� ��;���i-�ΰ�})��V�.�芊� 2�)����̛}�y1��\�l�#`̓K���N�[���u���,B���kT����H����f3�#�)n�`?��{��"Y�֑�@Jq�@Lnݠ$g��,�����RcJ*�s�P_:�խ�YVX4��,�Ȥ���FI�=��w��}���x���}��2��HjP�LM.?��Y.jsv��2��Hנ<��<9��!���HhPD��Ϝ9s�� ,��D�=�:�ڔ�XG�ߠ<�\�PV����hE��5�N�����䂨ҙU^ X�4t��C��l���:`ѥ}4�)� 0i ��E"K�h�^��;r���O+\ �8i��.��,���:@�!����x���y�"-��޿�ٯ��u�4(Z���'l��WhQT��փB�X�#�i�+ �#��n-���'^�e`GSi�'lM����Vu�Ӿ� 6ցp�:C����xr0���R���/�g`��!�UOf\- �q���8C���8G�*OX��3,�L��?������ڸ��T������ �*�!�c`m�3P�+ ��I���w���r�����K����{����ڠ���U��3�)��+PW]����1�S�X�� ���'��5�K$��:�U�a`m�#K���d����Z�r����_�qp���X��}�,Q�>� cӿE"�0F��k#<~Ǖ�X9�����+���� G�`9�6`l����*4��҇�V=~ϓ��1q;�urv���1P���g�<V�_}�r `��ۂ�E��Ґ����q��0X�J6�����2����O�Uhx�A�����@��-�ϭB�e`�#ؘ4��/h]z}]w��mA�>�H&k0>h�9.��mA�y݉�'~����K`k҃��ϐ���_i�δ��J�k��|�A�Z=9hM:`�հt �8W)��5 *�/��-�_%� ؚ�}��a�����'��u�<9h�+�`�|����Z�3A�iH��`��,�����Z�,�#�@\����X+�ߧ���8�	"s����.k��@Y������TsX�t����d`-�}*P�#�@$޽�Y����Z�#;PG��j���PK�u����\��kA��@]iH횔w�58x�y�L[���߿��p�
���*P��ݻ��O�C�L+P��u���Z@�(N\��4)���{�Nk�+��>W?����`��@L���@ĔnJ�KW=�e`]�t_�'�A\��%�^���@�+����@�����&,Z�+ݰ�aoS����>sb1�.�37��I`��6��z�����/����D`���z�"8xmq�yL�9��C�|v�y�:;h��2�c`݂�ҁ�Z��Y�@{r���ޙ���������A�rWGX�c`݂nq�vj���0t)}��C���Ra`5��@Z�:xmK����ϭ�1�nA�ʚ�~�C` f�T�|�O�w����@��'��繻r�z�<�&u����;���eо���w������Vݿ;x훽b�z��&u��tGRSҍ٩A��t�� �H��t�Y�w�Д����X��ˀ�Y�z��iA��� ����ߓ�����X7�����=�ܳ�T���K��B;��>ǩ��u�����`Xr�[o�u��끲��Нy��?������鲝8��鲁tY!І�yMM���L�Κtq��_��2[/��=����~���(���	�_���K:ڒ���oڕ>��2�ٳ&]������إz���оs��<@�M�=��cM�� Ò>��CT���?@b= �`=P��u����|�[�Z����9�����g�e@@=��o�z F }������z��b륗^:��ܹs�}���_��_f��@)������}���˃r��b���~(����?����#�����~���~(����?��Ȋ�_}��H;'âĊ@-jA�����J5�����_J���s2,j@��ԢĊZ@ij@��P�#M��q���i�x≳[0j@��ԢĊZ@ij@��P��_|�H���v�~`QԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j@����?� ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�X?��3	�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�X?��S	�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j@���O>� ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j@���?� ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�X?��#	�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�X?��C	�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�X{y��'۶m�P�?��ɯ~���ϋ�vN����Vn���lH�я~����Q��f-(�����Nv�ܙ��?��O��S:j�լkeQ}>zh�X?��������ݙ֓���~nĴ�s2,-Ԁټ��+�6�\����eNĨ�R�����i�����PZ�0�E��V�@5����VYJKCk;'��B�g�#�k��/�����ٟ)j �Ԭ%��f~�UƤf�g�}��:�B(>�����a��SOMw����j��[oe������_���������m#����ai����k��v��:e�����/�8��BP��f-Xt�?s���K.Y���w߽b�}��-ۦf�P(�fHYt�o��P��l�����ȏ<�Hv�Hia�dXZ�)�d���o�1�]���R�,����@:��/d�K��YRr�Q(�fHYt�o��P����^�<���&��o��fv�\�;ځs�DJ;'��B�]�n��6�C�e��5�ZjւE��w�yg�Y����f6����?ϼ�PZ���>�bh�X{�J#���VX)z�m2�ҜS�Ne�]-o����ˀ"�5�ZjւE���Bx�����ԜyD-��Z5�D�o��P��X5('z�=꺞����k�fF���R��X׻�����;j�ժ%�|�u��P|`M7:G��~���x�WN�x��v��r�-����O~��&RZ�9��5�����p:*����g�J� j�Y�����'-TO�<��n�Q(�V���kׁj�����6�����[vd�F��hZ�9i��ݻ'���|���g�����]ȶ5�Zjւh}�_wn���6��Z@i�j@�>_��P�����md�K�������?���t�5�]���s_�7����;��޽{����{R����Kj��5�ZjւH}�7��Ͳ�k��J�Q���u��``����6�ti�s�=������I|i8MCjV���뮻ni��\�}l��(�u�]��5�Zjւ(}~v���yQ(�F���ԁj�����4����-윴#]�.ޱcǲ��e�]6y�����\�j �Ԭ���"��o���jԀh}>Rh�X���I9ݎ�٤{[�?������.r~�E$�)Qk@��e���R���A1Lݾ��/��}���ޚ\}���~��?�ݶT�J�Q"��hu��``�%��t;N:-����v��~ 6�5��.�f�Eg���ak��5f�b��}/�_.:5�|�a5E-��5 J�w�js���x�<���ӝ�+�XzRn�\��?�c����Ce���vN��ꫯ.ݻ���{[���1�?�N�T��@�����vC�@-5kA�>��K۵kצ��Q(�F���ցj�����4�ٝp��_:-윴����K��v�~J�����o_����5��on��;���R�������']t���ҽj�>�lv�Q(�V���#ׁj�����4����.�;v,�]���s_z�R�ϧ��\���Y�k@��F2{��;��nW;j �Ԭ��|��[����Z@i�j@�>��P������y�Ǧ;Sjd����V�}�ݷlg<z�hv�ia���ݻw�x�ͬ�5 ݏ�?{�Pn�s套^Zv���nW;j �Ԭ%�|���~%�PZ�P�ϷPZ��^���f/5�ؘ���s2,-Ԁٳ'�9��JP��f-(��g����w��E�Z@i5k@�>�Jh�X�i��y��G��'N��n�K����&픹������ai����ˎ�n��kH�wܑ�.B� j�YJ���"5�]���V����-Ձj�����4��n�iَ�.�m%-�K5 e�����9r$�m?��~6RCJG����`�}~v1}XMQ(�fHYt�o��P��l���q����L;'��BHIOݳgϲ��Z��٣�)靳���/Vl)j �Ԭ��󳵣��@�Z@i5k@�"�|�u��P|`M/�#"�Iځ�y��Ϗ�vN����%=�!���5 �V�,��o�gתj�լ]��[�-� k/[���%����hia�dXZ�����{����r��O�?��YѢPK�Z��>?{��Fc`e,jր�̻ϷXZ���t�<j<��yΕ���)�~fԴ�s2,-ԀՒ.��⋳�������5�ZjւE��t��w�����7i����Og�"�PZ��Z���[�-� �H���ɰ���P�Z+j����B(>��kƥ~Z�95 V� jQbE-�45 VZ�֑����aQbE�� V�JSb��``iZ�95 V� jQbE-�45 VZ���tC��O;'âĊ@-jA�����J5��:Ҵ�s2,j@��ԢĊZ@ij@��P��'O�� ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�XO�8!���ɰ���P�Z+j����B0��4-��+j ����P�+-Ԁ�����%@Z�95 V� jQbE-�45 VZ�֑����aQbE�� V�JSb��``iZ�95 V� jQbE-�45 VZ���cǎI���s2,j@��ԢĊZ@ij@��P�#M;'âĊ@-jA�����J5���z��Q	�vN�E�5�ZԂXQ(M��j��u�ia�dXԀXQ�E-����ԀXi�XG�vN�E�5�ZԂXQ(M��j@��ȑ# -��+j ����P�+-� �H���ɰ���P�Z+j����B(>�>|X����aQbE�� V�JSb��``iZ�95 V� jQbE-�45 VZ����^{M����aQbE�� V�JSb��``iZ�95 V� jQbE-�45 VZ��V���;'Ò���~� J�퇭fǎ�]�ve��������~"� ��y�dXr��ԏ@i�����ٟ��d۶m�?��?��ܹ3�MKQ(%��I�D��֜�n�m���(I����Z�gϞ��5���&�����ݮ�@I����U�JR�jh����?^V����o~s�������Z�d=/�TX8 �m�d�r��ԋ@-������?���������'�'�}��e�k!j���C�+ � �9sf�{���e·�~��믿>�� l�� `�<89����$�C��� 6��
 0g���޽{�g[���:g[6��
 � ��j:˚��t�5�}`��  ��g�ζ^v�eK��pnV �^}�եa�;ۺ�����j�  �A�{(Ӯ]��Y ��  �y��X *�
��X *�
��X �
���  �x��X ��
��1� �8��X �
`��  �
`��  ��
`l�  ��
`,�  ��
`��  �
`��  �8�X �+p��1� �W� Ca`  �����
 0`^����
 0^����
 0^����
 02^����
 0B^����
 0b^�Df` 9���2� ��+p�h�  ,�8@V  V�
 +  ��
�&+  k�
�+  ��8@iV  ��+p���  l�W� %X �4����
 ��x�(V  ��+p�y3� 07^�̓� ���
`�  ,�W� [e` `���,+  Ex�QV  ��
`#�  �8�zX ��+p�s1� P�W� �1� P�W� 9V  ��
���
 @8^�$V  B�
��
 @h^��e`  <���q2� ����q1� �����0� �$����3� �4����2� �<���a2� 0^��b` `P����
 � y���
 �`y���
 ��y���
 �hx���
 ��x���
 �(y�g` `�6�
�-�c` `���
��R�x��W�E2� ����W�A�j��3� @Ϲ^���wM��.��
  ��'��0{��]��1� �*V{N��t	1�8V  8��W�<��K��ҝy���
  kH_J��{&��ַ��jw/kz-�V  XE�G�P�|�ߜ���Ѳ���`k�  ��4��a4=�)ݷ�]<�t��?+  U]z�M����ϗ^{�}�����O�������"0� PUnXj)���Ν;�� V  ������J��J$V  ���/��R��J$V  �2��J��q���i�x≳[P�� ����/�� ��>Ґ��`` �*k�X���
 @U݀���K�X���
 @U�X1��� ����b`%+  Uu�g�}&b`%+  UXc��J$V  ���O?�T��J$V  �2�Ɗ��H�  Te`�+�X ���>��	+�X ���+V"1� PU7 }��� V"1� P��5V�Db` �*k�X���
 @U݀��GI�X���
 @U�X1��� �����?� 1��� ����b`%+  UEXo���ɶm۲�я~�����駟��Ϝg�Db` ��n@�����W^��ܹ3;P���}/�srY�Ͼ�{��_*V"1� PU��u�3�k��/�����ٟ�e��p͡��J$V  ������J�}��ɵ�^�bh�ꪫ&o��֊�_~���gZO�>�b۔���G�ms�̙�%�\��6�b`%+  U�X��۷lP\mP����߿��n����vO=��t���?��/d��lW�y����H�  T�H��^�̞-M��o���6��К��C�-��w�yg�z��w/���<���m�Y�S�Ne�[d�Db` ��Z��0������^v)o:+�گ����h+X ����:{v�\g?WK�,�fF��֍��W�Db` ��n@J�p�́��a:�����g�+�t�l�l����v����H�  TUk`��[���W^9y�7�ەHxN���ە���H�  T�H��RI��^s�5���v������]wݕ��R1��� ��j�����工���߿����l�Db` �*�ʤ{j�{���.:V"1� PU7 �9s�X����kn����3����g��n��X���
 @U��'=)�ꫯ��������v����H�  T�H�AD��.ɝs����?>�sugYs�-*V"1� PU��5��o��W\q��ԩS��J���_��ڵk�g{衇��-*V"1� PU��u^g2g���y���֛ٟg`e��  T�H��͒9}���3�i��mw����K��.�h�s|���v�M���?�n��m4V"1� PU��5�Y�\09z�hv��2{i�ɓ'����c�m�����۷O~��_f�[T�Db` ��n@J�΋/����h8O�8��6�G}t��)w�qǲ_����li��s�����o��3�X���
 @U5֔�n�i: ��3�G��n�O�LYm����s���� \"V"1� PU�5=�wϞ=�!��j���P��.���/~�b����m��x�1��� ���)=l�V�}���u=I�3�<���]f/>W�Y�Çg֢c`%+  UEX��{��r�\~���Ǐg�l�;�n�g."V"1� PU7 �Ks�$]�{��gʔ����[O<���iP=v�X�{J��J$V  ��8��9V"1� PU7 ��H�~�Db` �*k�X���
 @U�X1��� ����ԩS V"1� P��5V�Db` ��n@:y����H�  Te`�+�X ���+V"1� PU7 �8qB��J$V  �2�Ɗ��H�  T�HǏ� 1��� ����b`%+  UXc��J$V  ���cǎI�X���
 @U�X1��� �����ѣ V"1� P��5V�Db` �*k�X���
 @U݀t��	+�X ���+V"1� PU7 >|X��J$V  �2�Ɗ��H�  T�H�������H�  Te`�+�X ���$V�D`` ��ܰ$�c`%+  ��v�m+&����
 @8�x��  �s��	+�X  ��
  @HV   B2�  ��  ���   �d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+   !X  ��
  @HV   B2�  ��  ���   �d`   $+   M&�X&N��k�6    IEND�B`�                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       There (mostly) can't be statements outside of namespaces
-----
<?php
echo 1;
echo 2;
namespace A;
-----
Namespace declaration statement has to be the very first statement in the script on line 4
array(
    0: Stmt_Echo(
        exprs: array(
            0: Scalar_LNumber(
                value: 1
            )
        )
    )
    1: Stmt_Echo(
        exprs: array(
            0: Scalar_LNumber(
                value: 2
            )
        )
    )
    2: Stmt_Namespace(
        name: Name(
            parts: array(
                0: A
            )
        )
        stmts: array(
        )
    )
)
-----
<?php
namespace A {}
echo 1;
-----
No code may exist outside of namespace {} from 3:1 to 3:7
array(
    0: Stmt_Namespace(
        name: Name(
            parts: array(
                0: A
            )
        )
        stmts: array(
        )
    )
    1: Stmt_Echo(
        exprs: array(
            0: Scalar_LNumber(
                value: 1
            )
        )
    )
)
-----
<?php
namespace A {}
declare(ticks=1);
foo();
namespace B {}
-----
No code may exist outside of namespace {} from 3:1 to 3:17
array(
    0: Stmt_Namespace(
        name: Name(
            parts: array(
                0: A
            )
        )
        stmts: array(
        )
    )
    1: Stmt_Declare(
        declares: array(
            0: Stmt_DeclareDeclare(
                key: ticks
                value: Scalar_LNumber(
                    value: 1
                )
            )
        )
        stmts: null
    )
    2: Expr_FuncCall(
        name: Name(
            parts: array(
                0: foo
            )
        )
        args: array(
        )
    )
    3: Stmt_Namespace(
        name: Name(
            parts: array(
                0: B
            )
        )
        stmts: array(
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util\PHP;

use __PHP_Incomplete_Class;
use ErrorException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\SyntheticError;
use PHPUnit\Util\InvalidArgumentHelper;
use SebastianBergmann\Environment\Runtime;

/**
 * Utility methods for PHP sub-processes.
 */
abstract class AbstractPhpProcess
{
    /**
     * @var Runtime
     */
    protected $runtime;

    /**
     * @var bool
     */
    protected $stderrRedirection = false;

    /**
     * @var string
     */
    protected $stdin = '';

    /**
     * @var string
     */
    protected $args = '';

    /**
     * @var array<string, string>
     */
    protected $env = [];

    /**
     * @var int
     */
    protected $timeout = 0;

    /**
     * Creates internal Runtime instance.
     */
    public function __construct()
    {
        $this->runtime = new Runtime();
    }

    /**
     * Defines if should use STDERR redirection or not.
     *
     * Then $stderrRedirection is TRUE, STDERR is redirected to STDOUT.
     *
     * @throws Exception
     *
     * @param bool $stderrRedirection
     */
    public function setUseStderrRedirection($stderrRedirection)
    {
        if (!\is_bool($stderrRedirection)) {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stderrRedirection = $stderrRedirection;
    }

    /**
     * Returns TRUE if uses STDERR redirection or FALSE if not.
     *
     * @return bool
     */
    public function useStderrRedirection()
    {
        return $this->stderrRedirection;
    }

    /**
     * Sets the input string to be sent via STDIN
     *
     * @param string $stdin
     */
    public function setStdin($stdin)
    {
        $this->stdin = (string) $stdin;
    }

    /**
     * Returns the input string to be sent via STDIN
     *
     * @return string
     */
    public function getStdin()
    {
        return $this->stdin;
    }

    /**
     * Sets the string of arguments to pass to the php job
     *
     * @param string $args
     */
    public function setArgs($args)
    {
        $this->args = (string) $args;
    }

    /**
     * Returns the string of arguments to pass to the php job
     *
     * @retrun string
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Sets the array of environment variables to start the child process with
     *
     * @param array<string, string> $env
     */
    public function setEnv(array $env)
    {
        $this->env = $env;
    }

    /**
     * Returns the array of environment variables to start the child process with
     *
     * @return array<string, string>
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * Sets the amount of seconds to wait before timing out
     *
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int) $timeout;
    }

    /**
     * Returns the amount of seconds to wait before timing out
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @return AbstractPhpProcess
     */
    public static function factory()
    {
        if (DIRECTORY_SEPARATOR == '\\') {
            return new WindowsPhpProcess;
        }

        return new DefaultPhpProcess;
    }

    /**
     * Runs a single test in a separate PHP process.
     *
     * @param string     $job
     * @param Test       $test
     * @param TestResult $result
     *
     * @throws Exception
     */
    public function runTestJob($job, Test $test, TestResult $result)
    {
        $result->startTest($test);

        $_result = $this->runJob($job);

        $this->processChildResult(
            $test,
            $result,
            $_result['stdout'],
            $_result['stderr']
        );
    }

    /**
     * Returns the command based into the configurations.
     *
     * @param array       $settings
     * @param string|null $file
     *
     * @return string
     */
    public function getCommand(array $settings, $file = null)
    {
        $command = $this->runtime->getBinary();
        $command .= $this->settingsToParameters($settings);

        if ('phpdbg' === PHP_SAPI) {
            $command .= ' -qrr ';

            if ($file) {
                $command .= '-e ' . \escapeshellarg($file);
            } else {
                $command .= \escapeshellarg(__DIR__ . '/eval-stdin.php');
            }
        } elseif ($file) {
            $command .= ' -f ' . \escapeshellarg($file);
        }

        if ($this->args) {
            $command .= ' -- ' . $this->args;
        }

        if (true === $this->stderrRedirection) {
            $command .= ' 2>&1';
        }

        return $command;
    }

    /**
     * Runs a single job (PHP code) using a separate PHP process.
     *
     * @param string $job
     * @param array  $settings
     *
     * @return array
     *
     * @throws Exception
     */
    abstract public function runJob($job, array $settings = []);

    /**
     * @param array $settings
     *
     * @return string
     */
    protected function settingsToParameters(array $settings)
    {
        $buffer = '';

        foreach ($settings as $setting) {
            $buffer .= ' -d ' . $setting;
        }

        return $buffer;
    }

    /**
     * Processes the TestResult object from an isolated process.
     *
     * @param Test       $test
     * @param TestResult $result
     * @param string     $stdout
     * @param string     $stderr
     */
    private function processChildResult(Test $test, TestResult $result, $stdout, $stderr)
    {
        $time = 0;

        if (!empty($stderr)) {
            $result->addError(
                $test,
                new Exception(\trim($stderr)),
                $time
            );
        } else {
            \set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
            });
            try {
                if (\strpos($stdout, "#!/usr/bin/env php\n") === 0) {
                    $stdout = \substr($stdout, 19);
                }

                $childResult = \unserialize(\str_replace("#!/usr/bin/env php\n", '', $stdout));
                \restore_error_handler();
            } catch (ErrorException $e) {
                \restore_error_handler();
                $childResult = false;

                $result->addError(
                    $test,
                    new Exception(\trim($stdout), 0, $e),
                    $time
                );
            }

            if ($childResult !== false) {
                if (!empty($childResult['output'])) {
                    $output = $childResult['output'];
                }

                $test->setResult($childResult['testResult']);
                $test->addToAssertionCount($childResult['numAssertions']);

                /** @var TestResult $childResult */
                $childResult = $childResult['result'];

                if ($result->getCollectCodeCoverageInformation()) {
                    $result->getCodeCoverage()->merge(
                        $childResult->getCodeCoverage()
                    );
                }

                $time           = $childResult->time();
                $notImplemented = $childResult->notImplemented();
                $risky          = $childResult->risky();
                $skipped        = $childResult->skipped();
                $errors         = $childResult->errors();
                $warnings       = $childResult->warnings();
                $failures       = $childResult->failures();

                if (!empty($notImplemented)) {
                    $result->addError(
                        $test,
                        $this->getException($notImplemented[0]),
                        $time
                    );
                } elseif (!empty($risky)) {
                    $result->addError(
                        $test,
                        $this->getException($risky[0]),
                        $time
                    );
                } elseif (!empty($skipped)) {
                    $result->addError(
                        $test,
                        $this->getException($skipped[0]),
                        $time
                    );
                } elseif (!empty($errors)) {
                    $result->addError(
                        $test,
                        $this->getException($errors[0]),
                        $time
                    );
                } elseif (!empty($warnings)) {
                    $result->addWarning(
                        $test,
                        $this->getException($warnings[0]),
                        $time
                    );
                } elseif (!empty($failures)) {
                    $result->addFailure(
                        $test,
                        $this->getException($failures[0]),
                        $time
                    );
                }
            }
        }

        $result->endTest($test, $time);

        if (!empty($output)) {
            print $output;
        }
    }

    /**
     * Gets the thrown exception from a PHPUnit\Framework\TestFailure.
     *
     * @param TestFailure $error
     *
     * @return Exception
     *
     * @see    https://github.com/sebastianbergmann/phpunit/issues/74
     */
    private function getException(TestFailure $error)
    {
        $exception = $error->thrownException();

        if ($exception instanceof __PHP_Incomplete_Class) {
            $exceptionArray = [];
            foreach ((array) $exception as $key => $value) {
                $key                  = \substr($key, \strrpos($key, "\0") + 1);
                $exceptionArray[$key] = $value;
            }

            $exception = new SyntheticError(
                \sprintf(
                    '%s: %s',
                    $exceptionArray['_PHP_Incomplete_Class_Name'],
                    $exceptionArray['message']
                ),
                $exceptionArray['code'],
                $exceptionArray['file'],
                $exceptionArray['line'],
                $exceptionArray['trace']
            );
        }

        return $exception;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

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
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\Debug\ErrorHandler;

class DebugClassLoaderTest extends TestCase
{
    /**
     * @var int Error reporting level before running tests
     */
    private $errorReporting;

    private $loader;

    protected function setUp()
    {
        $this->errorReporting = error_reporting(E_ALL);
        $this->loader = new ClassLoader();
        spl_autoload_register(array($this->loader, 'loadClass'), true, true);
        DebugClassLoader::enable();
    }

    protected function tearDown()
    {
        DebugClassLoader::disable();
        spl_autoload_unregister(array($this->loader, 'loadClass'));
        error_reporting($this->errorReporting);
    }

    public function testIdempotence()
    {
        DebugClassLoader::enable();

        $functions = spl_autoload_functions();
        foreach ($functions as $function) {
            if (is_array($function) && $function[0] instanceof DebugClassLoader) {
                $reflClass = new \ReflectionClass($function[0]);
                $reflProp = $reflClass->getProperty('classLoader');
                $reflProp->setAccessible(true);

                $this->assertNotInstanceOf('Symfony\Component\Debug\DebugClassLoader', $reflProp->getValue($function[0]));

                return;
            }
        }

        $this->fail('DebugClassLoader did not register');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage boo
     */
    public function testThrowingClass()
    {
        try {
            class_exists(__NAMESPACE__.'\Fixtures\Throwing');
            $this->fail('Exception expected');
        } catch (\Exception $e) {
            $this->assertSame('boo', $e->getMessage());
        }

        // the second call also should throw
        class_exists(__NAMESPACE__.'\Fixtures\Throwing');
    }

    public function testUnsilencing()
    {
        if (\PHP_VERSION_ID >= 70000) {
            $this->markTestSkipped('PHP7 throws exceptions, unsilencing is not required anymore.');
        }
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('HHVM is not handled in this test case.');
        }

        ob_start();

        $this->iniSet('log_errors', 0);
        $this->iniSet('display_errors', 1);

        // See below: this will fail with parse error
        // but this should not be @-silenced.
        @class_exists(__NAMESPACE__.'\TestingUnsilencing', true);

        $output = ob_get_clean();

        $this->assertStringMatchesFormat('%aParse error%a', $output);
    }

    public function testStacking()
    {
        // the ContextErrorException must not be loaded to test the workaround
        // for https://bugs.php.net/65322.
        if (class_exists('Symfony\Component\Debug\Exception\ContextErrorException', false)) {
            $this->markTestSkipped('The ContextErrorException class is already loaded.');
        }
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('HHVM is not handled in this test case.');
        }

        ErrorHandler::register();

        try {
            // Trigger autoloading + E_STRICT at compile time
            // which in turn triggers $errorHandler->handle()
            // that again triggers autoloading for ContextErrorException.
            // Error stacking works around the bug above and everything is fine.

            eval('
                namespace '.__NAMESPACE__.';
                class ChildTestingStacking extends TestingStacking { function foo($bar) {} }
            ');
            $this->fail('ContextErrorException expected');
        } catch (\ErrorException $exception) {
            // if an exception is thrown, the test passed
            $this->assertStringStartsWith(__FILE__, $exception->getFile());
            if (\PHP_VERSION_ID < 70000) {
                $this->assertRegExp('/^Runtime Notice: Declaration/', $exception->getMessage());
                $this->assertEquals(E_STRICT, $exception->getSeverity());
            } else {
                $this->assertRegExp('/^Warning: Declaration/', $exception->getMessage());
                $this->assertEquals(E_WARNING, $exception->getSeverity());
            }
        } finally {
            restore_error_handler();
            restore_exception_handler();
        }
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Case mismatch between loaded and declared class names
     */
    public function testNameCaseMismatch()
    {
        class_exists(__NAMESPACE__.'\TestingCaseMismatch', true);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Case mismatch between class and real file names
     */
    public function testFileCaseMismatch()
    {
        if (!file_exists(__DIR__.'/Fixtures/CaseMismatch.php')) {
            $this->markTestSkipped('Can only be run on case insensitive filesystems');
        }

        class_exists(__NAMESPACE__.'\Fixtures\CaseMismatch', true);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Case mismatch between loaded and declared class names
     */
    public function testPsr4CaseMismatch()
    {
        class_exists(__NAMESPACE__.'\Fixtures\Psr4CaseMismatch', true);
    }

    public function testNotPsr0()
    {
        $this->assertTrue(class_exists(__NAMESPACE__.'\Fixtures\NotPSR0', true));
    }

    public function testNotPsr0Bis()
    {
        $this->assertTrue(class_exists(__NAMESPACE__.'\Fixtures\NotPSR0bis', true));
    }

    public function testClassAlias()
    {
        $this->assertTrue(class_exists(__NAMESPACE__.'\Fixtures\ClassAlias', true));
    }

    /**
     * @dataProvider provideDeprecatedSuper
     */
    public function testDeprecatedSuper($class, $super, $type)
    {
        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_DEPRECATED);

        class_exists('Test\\'.__NAMESPACE__.'\\'.$class, true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_DEPRECATED,
            'message' => 'The "Test\Symfony\Component\Debug\Tests\\'.$class.'" class '.$type.' "Symfony\Component\Debug\Tests\Fixtures\\'.$super.'" that is deprecated but this is a test deprecation notice.',
        );

        $this->assertSame($xError, $lastError);
    }

    public function provideDeprecatedSuper()
    {
        return array(
            array('DeprecatedInterfaceClass', 'DeprecatedInterface', 'implements'),
            array('DeprecatedParentClass', 'DeprecatedClass', 'extends'),
        );
    }

    public function testInterfaceExtendsDeprecatedInterface()
    {
        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_NOTICE);

        class_exists('Test\\'.__NAMESPACE__.'\\NonDeprecatedInterfaceClass', true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_NOTICE,
            'message' => '',
        );

        $this->assertSame($xError, $lastError);
    }

    public function testDeprecatedSuperInSameNamespace()
    {
        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_NOTICE);

        class_exists('Symfony\Bridge\Debug\Tests\Fixtures\ExtendsDeprecatedParent', true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_NOTICE,
            'message' => '',
        );

        $this->assertSame($xError, $lastError);
    }

    public function testReservedForPhp7()
    {
        if (\PHP_VERSION_ID >= 70000) {
            $this->markTestSkipped('PHP7 already prevents using reserved names.');
        }

        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_NOTICE);

        class_exists('Test\\'.__NAMESPACE__.'\\Float', true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_DEPRECATED,
            'message' => 'The "Test\Symfony\Component\Debug\Tests\Float" class uses the reserved name "Float", it will break on PHP 7 and higher',
        );

        $this->assertSame($xError, $lastError);
    }

    public function testExtendedFinalClass()
    {
        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_NOTICE);

        class_exists('Test\\'.__NAMESPACE__.'\\ExtendsFinalClass', true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_DEPRECATED,
            'message' => 'The "Symfony\Component\Debug\Tests\Fixtures\FinalClass" class is considered final since version 3.3. It may change without further notice as of its next major version. You should not extend it from "Test\Symfony\Component\Debug\Tests\ExtendsFinalClass".',
        );

        $this->assertSame($xError, $lastError);
    }

    public function testExtendedFinalMethod()
    {
        set_error_handler(function () { return false; });
        $e = error_reporting(0);
        trigger_error('', E_USER_NOTICE);

        class_exists(__NAMESPACE__.'\\Fixtures\\ExtendedFinalMethod', true);

        error_reporting($e);
        restore_error_handler();

        $lastError = error_get_last();
        unset($lastError['file'], $lastError['line']);

        $xError = array(
            'type' => E_USER_DEPRECATED,
            'message' => 'The "Symfony\Component\Debug\Tests\Fixtures\FinalMethod::finalMethod()" method is considered final since version 3.3. It may change without further notice as of its next major version. You should not extend it from "Symfony\Component\Debug\Tests\Fixtures\ExtendedFinalMethod".',
        );

        $this->assertSame($xError, $lastError);
    }
}

class ClassLoader
{
    public function loadClass($class)
    {
    }

    public function getClassMap()
    {
        return array(__NAMESPACE__.'\Fixtures\NotPSR0bis' => __DIR__.'/Fixtures/notPsr0Bis.php');
    }

    public function findFile($class)
    {
        $fixtureDir = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR;

        if (__NAMESPACE__.'\TestingUnsilencing' === $class) {
            eval('-- parse error --');
        } elseif (__NAMESPACE__.'\TestingStacking' === $class) {
            eval('namespace '.__NAMESPACE__.'; class TestingStacking { function foo() {} }');
        } elseif (__NAMESPACE__.'\TestingCaseMismatch' === $class) {
            eval('namespace '.__NAMESPACE__.'; class TestingCaseMisMatch {}');
        } elseif (__NAMESPACE__.'\Fixtures\CaseMismatch' === $class) {
            return $fixtureDir.'CaseMismatch.php';
        } elseif (__NAMESPACE__.'\Fixtures\Psr4CaseMismatch' === $class) {
            return $fixtureDir.'psr4'.DIRECTORY_SEPARATOR.'Psr4CaseMismatch.php';
        } elseif (__NAMESPACE__.'\Fixtures\NotPSR0' === $class) {
            return $fixtureDir.'reallyNotPsr0.php';
        } elseif (__NAMESPACE__.'\Fixtures\NotPSR0bis' === $class) {
            return $fixtureDir.'notPsr0Bis.php';
        } elseif (__NAMESPACE__.'\Fixtures\DeprecatedInterface' === $class) {
            return $fixtureDir.'DeprecatedInterface.php';
        } elseif (__NAMESPACE__.'\Fixtures\FinalClass' === $class) {
            return $fixtureDir.'FinalClass.php';
        } elseif (__NAMESPACE__.'\Fixtures\FinalMethod' === $class) {
            return $fixtureDir.'FinalMethod.php';
        } elseif (__NAMESPACE__.'\Fixtures\ExtendedFinalMethod' === $class) {
            return $fixtureDir.'ExtendedFinalMethod.php';
        } elseif ('Symfony\Bridge\Debug\Tests\Fixtures\ExtendsDeprecatedParent' === $class) {
            eval('namespace Symfony\Bridge\Debug\Tests\Fixtures; class ExtendsDeprecatedParent extends \\'.__NAMESPACE__.'\Fixtures\DeprecatedClass {}');
        } elseif ('Test\\'.__NAMESPACE__.'\DeprecatedParentClass' === $class) {
            eval('namespace Test\\'.__NAMESPACE__.'; class DeprecatedParentClass extends \\'.__NAMESPACE__.'\Fixtures\DeprecatedClass {}');
        } elseif ('Test\\'.__NAMESPACE__.'\DeprecatedInterfaceClass' === $class) {
            eval('namespace Test\\'.__NAMESPACE__.'; class DeprecatedInterfaceClass implements \\'.__NAMESPACE__.'\Fixtures\DeprecatedInterface {}');
        } elseif ('Test\\'.__NAMESPACE__.'\NonDeprecatedInterfaceClass' === $class) {
            eval('namespace Test\\'.__NAMESPACE__.'; class NonDeprecatedInterfaceClass implements \\'.__NAMESPACE__.'\Fixtures\NonDeprecatedInterface {}');
        } elseif ('Test\\'.__NAMESPACE__.'\Float' === $class) {
            eval('namespace Test\\'.__NAMESPACE__.'; class Float {}');
        } elseif ('Test\\'.__NAMESPACE__.'\ExtendsFinalClass' === $class) {
            eval('namespace Test\\'.__NAMESPACE__.'; class ExtendsFinalClass extends \\'.__NAMESPACE__.'\Fixtures\FinalClass {}');
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 