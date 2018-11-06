   *
     * @return ConfigCacheFactoryInterface $configCacheFactory
     */
    private function getConfigCacheFactory()
    {
        if (null === $this->configCacheFactory) {
            $this->configCacheFactory = new ConfigCacheFactory($this->options['debug']);
        }

        return $this->configCacheFactory;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process;

/**
 * An executable finder specifically designed for the PHP executable.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class PhpExecutableFinder
{
    private $executableFinder;

    public function __construct()
    {
        $this->executableFinder = new ExecutableFinder();
    }

    /**
     * Finds The PHP executable.
     *
     * @param bool $includeArgs Whether or not include command arguments
     *
     * @return string|false The PHP executable path or false if it cannot be found
     */
    public function find($includeArgs = true)
    {
        $args = $this->findArguments();
        $args = $includeArgs && $args ? ' '.implode(' ', $args) : '';

        // PHP_BINARY return the current sapi executable
        if (PHP_BINARY && in_array(PHP_SAPI, array('cli', 'cli-server', 'phpdbg')) && is_file(PHP_BINARY)) {
            return PHP_BINARY.$args;
        }

        if ($php = getenv('PHP_PATH')) {
            if (!is_executable($php)) {
                return false;
            }

            return $php;
        }

        if ($php = getenv('PHP_PEAR_PHP_BIN')) {
            if (is_executable($php)) {
                return $php;
            }
        }

        if (is_executable($php = PHP_BINDIR.('\\' === DIRECTORY_SEPARATOR ? '\\php.exe' : '/php'))) {
            return $php;
        }

        $dirs = array(PHP_BINDIR);
        if ('\\' === DIRECTORY_SEPARATOR) {
            $dirs[] = 'C:\xampp\php\\';
        }

        return $this->executableFinder->find('php', false, $dirs);
    }

    /**
     * Finds the PHP executable arguments.
     *
     * @return array The PHP executable arguments
     */
    public function findArguments()
    {
        $arguments = array();
        if ('phpdbg' === PHP_SAPI) {
            $arguments[] = '-qrr';
        }

        return $arguments;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   INDX( 	                 (   �	  �      �   x �              ��     ` N     ��     z�b����Ѵ���b�z�b�                        B u n d l e   ��     p Z     ��     (��b����Ѵ���b� ��b�                        C a c h e C l e a r e r       ��     h X     ��     ���b����Ѵ��
�b����b�                        C a c h e W a r m e r ��     p ^     ��     ��b����Ѵ�+(�b���b�        �               C l i e n t T e s t . p h p   ��     ` N     ��    � �5�b����Ѵ�ψ�b�|5�b�                        C o n f i g   ��     h V     ��     ޓ�b����Ѵ���b�ܓ�b�                       
 C o n t r o l l e r   ��     x f     ��     ���b����Ѵ�pO�b����b�                        C o n t r o l l e r M e t a d a t a   �     p \     ��     ]�b����Ѵ��{�b�]�b�                        D a t a C o l l e c t o r     �     ` L     ��     ���b����Ѵ���b����b�                        D e b u g     �    � x h     ��     q�b����Ѵ����b�p�b�                        D e p e n d e n c y I n j e c t i o n �     ` L     ��     L��b����Ѵ�H�b�J��b�                        E v e n t     �     p \     ��     �T�b����Ѵ����b��T�b�                        E v e n t L i s t e n e r     -�     h T     ��     ���b����Ѵ����b����b�                       	 E x c e p t i o n     >�     h R     ��     O �b����Ѵ�a)�b�J �b�                        F i � t u r e s       y�     h R     ��     z)�b����Ѵ��*�b�r)�b�                        F r a g m e n t       ��     h T     ��     g*�b����Ѵ��f+�b�f*�b�                       	 H t t p C a c h e     ��     x f     ��     �n+�b����Ѵ���+�b��n+�b� @      j7               H t t p K e r n e l T e s t . p h p   ��     p ^     ��     j�+�b����Ѵ�|�+�b�h�+�b� `      �X               K e r n e l T e s t . p h p   ��     X H     ��     Y�+�b����Ѵ��,�b�X�+�b�                         L o g ��     h V     ��     J,�b����Ѵ�_0,�b�B,�b�                     
 L o g g e r . p h p   ��     h R     ��     U=,�b����Ѵ���,�b�N=,�b�                        P r o f i l e r       ��     x f     ��     h�,�b����Ѵ�r�,�b�`�,�b�       �               T e s t H t t p K e r n e l . p h p   ��     x d     ��     ��,�b����Ѵ���,�b���,�b�       >	               U r i S i g n e r T e s t . p h p                                 �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               � <?php

namespace Psr\Log;

/**
 * This Logger can be used to avoid conditional log calls.
 *
 * Logging should always be optional, and if no logger is provided to your
 * library creating a NullLogger instance to have something to throw logs at
 * is a good way to avoid littering your code with `if ($this->logger) { }`
 * blocks.
 */
class NullLogger extends AbstractLogger
{
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        // noop
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     -----BEGIN CERTIFICATE-----
MIIDFjCCAf4CCQDULaNM+Q+g3DANBgkqhkiG9w0BAQUFADBMMRcwFQYDVQQDDA5T
d2lmdG1haWxlciBDQTEUMBIGA1UECgwLU3dpZnRtYWlsZXIxDjAMBgNVBAcMBVBh
cmlzMQswCQYDVQQGEwJGUjAeFw0xMzExMjcwODM5MTBaFw0xNzExMjYwODM5MTBa
ME4xGTAXBgNVBAMMEFN3aWZ0bWFpbGVyLVVzZXIxFDASBgNVBAoMC1N3aWZ0bWFp
bGVyMQ4wDAYDVQQHDAVQYXJpczELMAkGA1UEBhMCRlIwggEiMA0GCSqGSIb3DQEB
AQUAA4IBDwAwggEKAoIBAQCTe8ZouyjVGgqlljhaswYqLj7icMoHq+Qg13CE+zJg
tl2/UzyPhAd3WWOIvlQ0lu+E/n0bXrS6+q28DrQ3UgJ9BskzzLz15qUO12b92AvG
vLJ+9kKuiM5KXDljOAsXc7/A9UUGwEFA1D0mkeMmkHuiQavAMkzBLha22hGpg/hz
VbE6W9MGna0szd8yh38IY1M5uR+OZ0dG3KbVZb7H3N0OLOP8j8n+4YtAGAW+Onz/
2CGPfZ1kaDMvY/WTZwyGeA4FwCPy1D8tfeswqKnWDB9Sfl8hns5VxnoJ3dqKQHeX
iC4OMfQ0U4CcuM5sVYJZRNNwP7/TeUh3HegnOnuZ1hy9AgMBAAEwDQYJKoZIhvcN
AQEFBQADggEBAAEPjGt98GIK6ecAEat52aG+8UP7TuZaxoH3cbZdhFTafrP8187F
Rk5G3LCPTeA/QIzbHppA4fPAiS07OVSwVCknpTJbtKKn0gmtTZxThacFHF2NlzTH
XxM5bIbkK3jzIF+WattyTSj34UHHfaNAmvmS7Jyq6MhjSDbcQ+/dZ9eo2tF/AmrC
+MBhyH8aUYwKhTOQQh8yC11niziHhGO99FQ4tpuD9AKlun5snHq4uK9AOFe8VhoR
q2CqX5g5v8OAtdlvzhp50IqD4BNOP+JrUxjGLHDG76BZZIK2Ai1eBz+GhRlIQru/
8EhQzd94mdFEPblGbmuD2QXWLFFKLiYOwOc=
-----END CERTIFICATE-----
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

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
use Psr\Log\LoggerInterface;

/**
 * Proxies log messages to an existing PSR-3 compliant logger.
 *
 * @author Michael Moussa <michael.moussa@gmail.com>
 */
class PsrHandler extends AbstractHandler
{
    /**
     * PSR-3 compliant logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger The underlying PSR-3 compliant logger to which messages will be proxied
     * @param int             $level  The minimum logging level at which this handler will be triggered
     * @param Boolean         $bubble Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(LoggerInterface $logger, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);

        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(array $record)
    {
        if (!$this->isHandling($record)) {
            return false;
        }

        $this->logger->log(strtolower($record['level_name']), $record['message'], $record['context']);

        return false === $this->bubble;
    }
}
                                                                                                                                                                                                                                                                                                                           