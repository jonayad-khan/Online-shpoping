<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\EventListener;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\EventListener\SaveSessionListener;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class SaveSessionListenerTest extends TestCase
{
    public function testOnlyTriggeredOnMasterRequest()
    {
        $listener = new SaveSessionListener();
        $event = $this->getMockBuilder(FilterResponseEvent::class)->disableOriginalConstructor()->getMock();
        $event->expects($this->once())->method('isMasterRequest')->willReturn(false);
        $event->expects($this->never())->method('getRequest');

        // sub request
        $listener->onKernelResponse($event);
    }

    public function testSessionSaved()
    {
        $listener = new SaveSessionListener();
        $kernel = $this->getMockBuilder(HttpKernelInterface::class)->disableOriginalConstructor()->getMock();

        $session = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $session->expects($this->once())->method('isStarted')->willReturn(true);
        $session->expects($this->once())->method('save');

        $request = new Request();
        $request->setSession($session);
        $response = new Response();
        $listener->onKernelResponse(new FilterResponseEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $response));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops\Util;

class Misc
{
    /**
     * Can we at this point in time send HTTP headers?
     *
     * Currently this checks if we are even serving an HTTP request,
     * as opposed to running from a command line.
     *
     * If we are serving an HTTP request, we check if it's not too late.
     *
     * @return bool
     */
    public static function canSendHeaders()
    {
        return isset($_SERVER["REQUEST_URI"]) && !headers_sent();
    }

    public static function isAjaxRequest()
    {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /**
     * Check, if possible, that this execution was triggered by a command line.
     * @return bool
     */
    public static function isCommandLine()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * Translate ErrorException code into the represented constant.
     *
     * @param int $error_code
     * @return string
     */
    public static function translateErrorCode($error_code)
    {
        $constants = get_defined_constants(true);
        if (array_key_exists('Core', $constants)) {
            foreach ($constan