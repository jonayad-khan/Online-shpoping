<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops\Handler;

use SimpleXMLElement;
use Whoops\Exception\Formatter;

/**
 * Catches an exception and converts it to an XML
 * response. Additionally can also return exception
 * frames for consumption by an API.
 */
class XmlResponseHandler extends Handler
{
    /**
     * @var bool
     */
    private $returnFrames = false;

    /**
     * @param  bool|null  $returnFrames
     * @return bool|$this
     */
    public function addTraceToOutput($returnFrames = null)
    {
        if (func_num_args() == 0) {
            return $this->returnFrames;
        }

        $this->returnFrames = (bool) $returnFrames;
        return $this;
    }

    /**
     * @return int
     */
    public function handle()
    {
        $response = [
            'error' => Formatter::formatExceptionAsDataArray(
                $this->getInspector(),
                $this->addTraceToOutput()
            ),
        ];

        echo $this->toXml($response);

        return Handler::QUIT;
    }

    /**
     * @return string
     */
    public function contentType()
    {
        return 'application/xml';
    }

    /**
     * @param  SimpleXMLElement  $node Node to append data to, will be modified in place
     * @param  array|\Traversable $data
     * @return SimpleXMLElement  The modified node, for chaining
     */
    private static function addDataToNode(\SimpleXMLElement $node, $data)
    {
        assert('is_array($data) || $node instanceof Traversable');

        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                // Convert the key to a valid string
                $key = "unknownNode_". (string) $key;
            }

            // Delete any char not allowed in XML element names
            $key = preg_replace('/[^a-z0-9\-\_\.\:]/i', '', $key);

            if (is_array($value)) {
                $child = $node->addChild($key);
                self::addDataToNode($child, $value);
            } else {
                $value = str_replace('&', '&amp;', print_r($value, true));
                $node->addChild($key, $value);
            }
        }

        return $node;
    }

    /**
     * The main function for converting to an XML document.
     *
     * @param  array|\Traversable $data
     * @return string            XML
     */
    private static function toXml($data)
    {
        assert('is_array($data) || $node instanceof Traversable');

        $node = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><root />");

        return self::addDataToNode($node, $data)->asXML();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Contracts\Queue;

interface Job
{
    /**
     * Get the job identifier.
     *
     * @return string
     */
    public function getJobId();

    /**
     * Get the decoded body of the job.
     *
     * @return array
     */
    public function payload();

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire();

    /**
     * Release the job back into the queue.
     *
     * @param  int   $delay
     * @return mixed
     */
    public function release($delay = 0);

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete();

    /**
     * Determine if the job has been deleted.
     *
     * @return bool
     */
    public function isDeleted();

    /**
     * Determine if the job has been deleted or released.
     *
     * @return bool
     */
    public function isDeletedOrReleased();

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts();

    /**
     * Process an exception that caused the job to fail.
     *
     * @param  \Throwable  $e
     * @return void
     */
    public function failed($e);

    /**
     * Get the number of times to attempt a job.
     *
     * @return int|null
     */
    public function maxTries();

    /**
     * Get the number of seconds the job can run.
     *
     * @return int|null
     */
    public function timeout();

    /**
     * Get the timestamp indicating when the job should timeout.
     *
     * @return int|null
     */
    public function timeoutAt();

    /**
     * Get the name of the queued job class.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the resolved name of the queued job class.
     *
     * Resolves the name of "wrapped" jobs such as class-based handlers.
     *
     * @return string
     */
    public function resolveName();

    /**
     * Get the name of the connection the job belongs to.
     *
     * @return string
     */
    public function getConnectionName();

    /**
     * Get the name of the queue the job belongs to.
     *
     * @return string
     */
    public function getQueue();

    /**
     * Get the raw body string for the job.
     *
     * @return string
     */
    public function getRawBody();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->name('.php_cs')
    ->name('build-manual')
    ->name('build-phar')
    ->exclude('build-vendor');

$header = <<<EOF
This file is part of Psy Shell.

(c) 2012-2017 Justin Hileman

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@Symfony' => true,
        'array_syntax' => array('syntax' => 'long'),
        'binary_operator_spaces' => false,
        'concat_space' => array('spacing' => 'one'),
        'header_comment' => array('header' => $header),
        'increment_style' => array('style' => 'post'),
        'method_argument_space' => array('keep_multiple_spaces_after_comma' => true),
        'ordered_imports' => true,
        'pre_increment' => false,
        'yoda_style' => false,
    ))
    ->setFinder($finder);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/*
 * This file is part of the phpunit-mock-objects package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\MockObject\Matcher\Invocation;

/**
 * Interface for all mock objects which are generated by
 * MockBuilder.
 *
 * @method InvocationMocker method($constraint)
 */
interface PHPUnit_Framework_MockObject_MockObject /*extends Verifiable*/
{
    /**
     * @param mixed $originalObject
     *
     * @return InvocationMocker
     */
    public function __phpunit_setOriginalObject($originalObject);

    /**
     * @return InvocationMocker
     */
    public function __phpunit_getInvocationMocker();

    /**
     * Verifies that the current expectation is valid. If everything is OK the
     * code should just return, if not it must throw an exception.
     *
     * @throws ExpectationFailedException
     */
    public function __phpunit_verify();

    /**
     * @return bool
     */
    public function __phpunit_hasMatchers();

    /**
     * Registers a new expectation in the mock object and returns the match
     * object which can be infused with further details.
     *
     * @param Invocation $matcher
     *
     * @return InvocationMocker
     */
    public function expects(Invocation $matcher);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    