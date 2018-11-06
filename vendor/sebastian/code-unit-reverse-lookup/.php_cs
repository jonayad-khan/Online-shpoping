<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops;

use InvalidArgumentException;
use Whoops\Exception\ErrorException;
use Whoops\Handler\HandlerInterface;

interface RunInterface
{
    const EXCEPTION_HANDLER = "handleException";
    const ERROR_HANDLER     = "handleError";
    const SHUTDOWN_HANDLER  = "handleShutdown";

    /**
     * Pushes a handler to the end of the stack
     *
     * @throws InvalidArgumentException  If argument is not callable or instance of HandlerInterface
     * @param  Callable|HandlerInterface $handler
     * @return Run
     */
    public function pushHandler($handler);

    /**
     * Removes the last handler in the stack and returns it.
     * Returns null if there"s nothing else to pop.
     *
     * @return null|HandlerInterface
     */
    public function popHandler();

    /**
     * Returns an array with all handlers, in the
     * order they were added to the stack.
     *
     * @return array
     */
    public function getHandlers();

    /**
     * Clears all handlers in the handlerStack, including
     * the default PrettyPage handler.
     *
     * @return Run
     */
    public function clearHandlers();

    /**
     * Registers this instance as an error handler.
     *
     * @return Run
     */
    public function register();

    /**
     * Unregisters all handlers registered by this Whoops\Run instance
     *
     * @return Run
     */
    public function unregister();

    /**
     * Should Whoops allow Handlers to force the script to quit?
     *
     * @param  bool|int $exit
     * @return bool
     */
    public function allowQuit($exit = null);

    /**
     * Silence particular errors in particular files
     *
     * @param  array|string $patterns List or a single regex pattern to match
     * @param  int          $levels   Defaults to E_STRICT | E_DEPRECATED
     * @return \Who