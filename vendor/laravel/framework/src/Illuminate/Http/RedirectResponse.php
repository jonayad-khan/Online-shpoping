<?php

namespace Illuminate\View\Engines;

use Exception;
use Throwable;
use Illuminate\Contracts\View\Engine;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class PhpEngine implements Engine
{
    /**
     * Get the evaluated contents of the view.
     *
     * @param  string  $path
     * @param  array   $data
     * @return string
     */
    public function get($path, array $data = [])
    {
        return $this->evaluatePath($path, $data);
    }

    /**
     * Get the evaluated contents of the view at the given path.
     *
     * @param  string  $__path
     * @param  array   $__data
     * @return string
     */
    protected function evaluatePath($__path, $__data)
    {
        $obLevel = ob_get_level();

        ob_start();

        extract($__data, EXTR_SKIP);

        // We'll evaluate the contents of the view inside a try/catch block so we can
        // flush out any stray output that might get out before an error occurs or
        // an exception is thrown. This prevents any partial views from leaking.
        try {
            include $__path;
        } catch (Exception $e) {
            $this->handleViewException($e, $obLevel);
        } catch (Throwable $e) {
            $this->handleViewException(new FatalThrowableError($e), $obLevel);
        }

        return ltrim(ob_get_clean());
    }

    /**
     * Handle a view exception.
     *
     * @param  \Exception  $e
     * @param  int  $obLevel
     * @return void
     *
     * @throws \Exception
     */
    protected function handleViewException(Exception $e, $obLevel)
    {
        while (ob_get_level() > $obLevel) {
            ob_end_clean();
        }

        throw $e;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

namespace Faker\Test\Provider;

use Faker\Provider\Miscellaneous;

class MiscellaneousTest extends \PHPUnit_Framework_TestCase
{
    public function testBoolean()
    {
        $this->assertContains(Miscellaneous::boolean(), array(true, false));
    }

    public function testMd5()
    {
        $this->assertRegExp('/^[a-z0-9]{32}$/', Miscellaneous::md5());
    }

    public function testSha1()
    {
        $this->assertRegExp('/^[a-z0-9]{40}$/', Miscellaneous::sha1());
    }

    public function testSha256()
    {
        $this->assertRegExp('/^[a-z0-9]{64}$/', Miscellaneous::sha256());
    }

    public function testLocale()
    {
        $this->assertRegExp('/^[a-z]{2,3}_[A-Z]{2}$/', Miscellaneous::locale());
    }

    public function testCountryCode()
    {
        $this->assertRegExp('/^[A-Z]{2}$/', Miscellaneous::countryCode());
    }

    public function testCountryISOAlpha3()
    {
        $this->assertRegExp('/^[A-Z]{3}$/', Miscellaneous::countryISOAlpha3());
    }

    public function testLanguage()
    {
        $this->assertRegExp('/^[a-z]{2}$/', Miscellaneous::languageCode());
    }

    public function testCurrencyCode()
    {
        $this->assertRegExp('/^[A-Z]{3}$/', Miscellaneous::currencyCode());
    }

    public function testEmoji()
    {
        $this->assertRegExp('/^[\x{1F600}-\x{1F637}]$/u', Miscellaneous::emoji());
    }
}
                                   