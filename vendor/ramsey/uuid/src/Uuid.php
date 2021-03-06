<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Tests\Loader;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Loader\CsvFileLoader;
use Symfony\Component\Config\Resource\FileResource;

class CsvFileLoaderTest extends TestCase
{
    public function testLoad()
    {
        $loader = new CsvFileLoader();
        $resource = __DIR__.'/../fixtures/resources.csv';
        $catalogue = $loader->load($resource, 'en', 'domain1');

        $this->assertEquals(array('foo' => 'bar'), $catalogue->all('domain1'));
        $this->assertEquals('en', $catalogue->getLocale());
        $this->assertEquals(array(new FileResource($resource)), $catalogue->getResources());
    }

    public function testLoadDoesNothingIfEmpty()
    {
        $loader = new CsvFileLoader();
        $resource = __DIR__.'/../fixtures/empty.csv';
        $catalogue = $loader->load($resource, 'en', 'domain1');

        $this->assertEquals(array(), $catalogue->all('domain1'));
        $this->assertEquals('en', $catalogue->getLocale());
        $this->assertEquals(array(new FileResource($resource)), $catalogue->getResources());
    }

    /**
     * @expectedException \Symfony\Component\Translation\Exception\NotFoundResourceException
     */
    public function testLoadNonExistingResource()
    {
        $loader = new CsvFileLoader();
        $resource = __DIR__.'/../fixtures/not-exists.csv';
        $loader->load($resource, 'en', 'domain1');
    }

    /**
     * @expectedException \Symfony\Component\Translation\Exception\InvalidResourceException
     */
    public function testLoadNonLocalResource()
    {
        $loader = new CsvFileLoader();
        $resource = 'http://example.com/resources.csv';
        $loader->load($resource, 'en', 'domain1');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
final class SessionBagProxy implements SessionBagInterface
{
    private $bag;
    private $data;
    private $usageIndex;

    public function __construct(SessionBagInterface $bag, array &$data, &$usageIndex)
    {
        $this->bag = $bag;
        $this->data = &$data;
        $this->usageIndex = &$usageIndex;
    }

    /**
     * @return SessionBagInterface
     */
    public function getBag()
    {
        ++$this->usageIndex;

        return $this->bag;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        ++$this->usageIndex;

        return empty($this->data[$this->bag->getStorageKey()]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->bag->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array &$array)
    {
        ++$this->usageIndex;
        $this->data[$this->bag->getStorageKey()] = &$array;

        $this->bag->initialize($array);
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageKey()
    {
        return $this->bag->getStorageKey();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        ++$this->usageIndex;

        return $this->bag->clear();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           �n��w�o=��yT�9
n��_�b|��C|Gc|x��E�W�6ش5:90���	_Q��"6��j/��=�.&	Z�����G���<g�p��hL�b�Lg�����{��1�Y�wР^�\�[�i�����l�!�3W�h�E��'����رNCW�A� �u$ܟomG�|��I0��au�qp�G#�n�r���
����p�S?��� ��ht ZG�c}!�{�@_�Ӕ����S)I�s.�z�x�{���R� O/��(����A)P���M��+1�����M�iy�q)�s��19�x�)����!��EJ+s*H�� ��,��کyM��#/�ަ�qg���S��<���Ⱥ�;���s��G���X 1�͡e���  �i�&��F��pO���w/.I���c�w��b������� �S� ��hya�X�~Z�f���(����R�LM��4*cJ��jQi:��9α�Ō�����F�ƾ��݉f �]�Ŀmz�m���H��<>Ś��~�F|��M7��vw�{�#�Y73���9����e�B�V����ES;*� )�3^>����fr�\'�v-��y�Fh���R���`Бz���&�l��hh�/�Nk�b���N5�?�R=��/�(���0"�O���x��XO(�7�}a���2�O��0������������xi*����3<�B=��A�JK���������B'��V��6��/l�#���7�PoIC���L�jn���h ��L��,ޅ��Ӫ��#
��!M�����f=�\ �ϐ�5�e~�`�TS�_�r���O����f-���?��Hؑ�< �-�s�NTRty<hdbv�S�+��1w��S��4E@��+�b19yOW�ӇC�/�<(������/kfte%���6$DK��zZ�k�|Z��������������������������������������O���-؏���|����Z_�@��Ы�ZXU��T��S|hƽM�;'��^M�,�]������	[�S�fF�b�?���|{����{p�{���������y��� �����������l�y��n�;��[����2�E|\I���K$���!o��7 �N8�5_���������%�(����	%�q(	�Gw��-�}iu�����b�&�;s��~��Ę%�H�^�������k_���G�QP֞�ݚ��-a�$��;�{�޷�.��W8�C�B����+�/$eGw��fnU��	�����	����y�3�ݧת����1��%��0�ud�����)��M��w�� *u�x�Zb�z���ꧡQJ��u���UDBG~��QJ��uSШ�mh:�Y�����=ɋrj�_
:	 ��8N"�ږq N>�ͩ�*1�T��w������gu�O����"�mM��D�d���(o�뿀�u�\�k/l��dsB�c��V,dƬ���!MC�q, $d�"�8�'W��� ��u�p),�[���$���ǣ:0�� ��! �\MR�1D	4��xd�A��u��pB���z��9f��[m�(�/��xz왢��������:�c�1 �_�D�ؐ3��6��?�y~bG��,���p� �v�o��C
��1�ߜu_��,q� 33k������x2�^6�� &n�>y��o��ӵͿ�0z�G��#���> �&���壢
��⿝Qa�	j	.=�7Bm����D���]�hA�Eq/]���� 	��G�}u)�t�V�~�&Sjۼ�#OןTw����b�t��M����$=�M҆)7K�| �<Sq��RhrØ������mV��uo����Lh�U�Ob��[>�7�\��]��x	"�v����y��E`/�є���!�C��U��� �"BNXG���
�V�X�V�a���5���B=c�@�ji���HTl'R=��y�z�Q	̎X�+V�U��uoΆ�nۋ�-�v�S��"�;x�\�sQL0�����O{e@9[^����T9[M���{�����ʇ+i�D=����mW����L�ǒf��wg�L jХ+���	�.�f2���I�v2�����W3ȍ��/0{���  @��[&�Ɖ ��ӜN[}��0뉞"��s'��_�hs��>w��q��+#ue��H�#��=) wfrW��"ao��5Ժi����
ӱ�G>�_��0o�Z��A 7Ml�7j���|�6²�S�?�X��E�������l�v_��s2e�߾:�nt7��j�R9]����k�+%�d��� ��1NZ��Ɯ��-g@|����6�Q2b)�����%�{�Ŷg���x\|G�����)� ������̍3 �l��#�_J6,��큲�Y%nq�Ϥ7b���=���`�����t����=�o��yx��O�= �� ��2�<E��9�&ڃ/��܈�)���3<EKs�m~o٬[�sǡ�*�Y�������~}o���� ?��tdu:{���`#�	/*d��;MX`~��d�x!@�#>�������Al�ZP1{�3J���D;3nꓰ���2�	����L���	�n�����ժ8E�!ZN�6��=�o�w�9����S��o�x�x<*��dL�Hܗ!?��П̇'+I֭�Gy��Bb1J�n���ny����ȹܳl�R?nxL�#�,�D�2��w�^����|��ס~���}c�
��7�?��pmf$Uڏ�2eO���ضz��nn���_��g���:!��#��% �@Cu�	�E\�4Ʈ��
ۛ���ݶn=���MȞ�~�UG��
��>�~��&�r5+t�z��tѕ�Њ��<����ʹ��'�?�3g��!�|��������3/��D���yH�
!��L�17{���㏨c�� 2�������M�8���J ��٢��=2�uik�nɑ�_ lO����3w�'F2S�vi�E6���'a\ �,��y�x[d��} ���j�;���}��}��}��}��}��}��}��}��������������|z��E+kA�OB��������4�<?�:f@��efϛr��p��%����=8 ���{�� F-L#H�����@�L�
=�MQ"��&��g�xxv+&� a�u�#ɾ��Jo��o������mQ�?~8�'� ~��l�n�}`��-��a/��.*,J[�j�8��۰ � �ǣ��1H����,��@�xMTL�m����� �JT\��%���#	L�y:#�����j��?�D��N���>�T��0(t^^$�)g���:OɌ<�o��|Y�3Ш�mh:��*)[Z���a�%��OU�}�~�j����������\������^Y37����M����V�d����`��		MJ+�L�3�Q_��[:�^����^:�iĦ����|�݅�=*=�	ç�M=d�����l%�PG�5�܄��1�븵�6v�T`�MCĺYduq���&����
���;iv}�_�Ȉa�gQ ZhН����M��?�ڿ}����o��GH��̽�?���`��B}�~�w?�q�η�3��NU��`�m�����A�8���m��w�ڛh�U�B�������D3��舔DIm��bUW���0�͝"+i���L5�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u��@a���f�a8�^�8�F4�� 1y#�*�e���e+n�Zj�.s�߇�@r����8����Ĝ.f�� �u�pW�Ɖy�r��9��~&@���}�����N�e��}/���Ú��*��$���\,C�)��"��N�s�&�CM��x�)H�(V��%�$w�` f�7Y1�ϒ?N���n�x�^��_B��[���+�I��0=E�vc
���KTMؐ�O��m����� X�ခK�%/���\�Cn��5��q�L`�oX�2�v��>�e�`�8 �2���hj�wYX�?��(�`n���dX܈�,v~~�@�-S!lJq&� �,�;A��}<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This code is partially based on the Rack-Cache library by Ryan Tomayko,
 * which is released under the MIT license.
 * (based on commit 02d2b48d75bcb63cf1c0c7149c077ad256542801)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\HttpCache;

use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseCacheStrategy knows how to compute the Response cache HTTP header
 * based on the different response cache headers.
 *
 * This implementation changes the master response TTL to the smallest TTL received
 * or force validation if one of the surrogates has validation cache strategy.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ResponseCacheStrategy implements ResponseCacheStrategyInterface
{
    private $cacheable = true;
    private $embeddedResponses = 0;
    private $ttls = array();
    private $maxAges = array();
    private $isNotCacheableResponseEmbedded = false;

    /**
     * {@inheritdoc}
     */
    public function add(Response $response)
    {
        if (!$response->isFresh() || !$response->isCacheable()) {
            $this->cacheable = false;
        } else {
            $maxAge = $response->getMaxAge();
            $this->ttls[] = $response->getTtl();
            $this->maxAges[] = $maxAge;

            if (null === $maxAge) {
                $this->isNotCacheableResponseEmbedded = true;
            }
        }

        ++$this->embeddedResponses;
    }

    /**
     * {@inheritdoc}
     */
    public function update(Response $response)
    {
        // if we have no embedded Response, do nothing
        if (0 === $this->embeddedResponses) {
            return;
        }

        // Remove validation related headers in order to avoid browsers using
        // their own cache, because some of the response content comes from
        // at least one embedded response (which likely has a different caching strategy).
        if ($response->isValidateable()) {
            $response->setEtag(null);
            $response->setLastModified(null);
        }

        if (!$response->isFresh() || !$response->isCacheable()) {
            $this->cacheable = false;
        }

        if (!$this->cacheable) {
            $response->headers->set('Cache-Control', 'no-cache, must-revalidate');

            return;
        }

        $this->ttls[] = $response->getTtl();
        $this->maxAges[] = $response->getMaxAge();

        if ($this->isNotCacheableResponseEmbedded) {
            $response->headers->removeCacheControlDirective('s-maxage');
        } elseif (null !== $maxAge = min($this->maxAges)) {
            $response->setSharedMaxAge($maxAge);
            $response->headers->set('Age', $maxAge - min($this->ttls));
        }
        $response->setMaxAge(0);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Egulias\EmailValidator\Validation;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;

class MultipleValidationWithAnd implements EmailValidation
{
    /**
     * If one of validations gets failure skips all succeeding validation.
     * This means MultipleErrors will only contain a single error which first found.
     */
    const STOP_ON_ERROR = 0;

    /**
     * All of validations will be invoked even if one of them got failure.
     * So MultipleErrors will contain all causes.
     */
    const ALLOW_ALL_ERRORS = 1;

    /**
     * @var EmailValidation[]
     */
    private $validations = [];

    /**
     * @var array
     */
    private $warnings = [];

    /**
     * @var MultipleErrors
     */
    private $error;

    /**
     * @var bool
     */
    private $mode;

    /**
     * @param EmailValidation[] $validations The validations.
     * @param int               $mode        The validation mode (one of the constants).
     */
    public function __construct(array $validations, $mode = self::ALLOW_ALL_ERRORS)
    {
        if (count($validations) == 0) {
            throw new EmptyValidationList();
        }

        $this->validations = $validations;
        $this->mode = $mode;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($email, EmailLexer $emailLexer)
    {
        $result = true;
        $errors = [];
        foreach ($this->validations as $validation) {
            $emailLexer->reset();
            $result = $result && $validation->isValid($email, $emailLexer);
            $this->warnings = array_merge($this->warnings, $validation->getWarnings());
            $errors = $this->addNewError($validation->getError(), $errors);

            if ($this->shouldStop($result)) {
                break;
            }
        }

        if (!empty($errors)) {
            $this->error = new MultipleErrors($errors);
        }

        return $result;
    }

    private function addNewError($possibleError, array $errors)
    {
        if (null !== $possibleError) {
            $errors[] = $possibleError;
        }

        return $errors;
    }

    private function shouldStop($result)
    {
        return !$result && $this->mode === self::STOP_ON_ERROR;
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * {@inheritdoc}
     */
    public function getWarnings()
    {
        return $this->warnings;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

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
use Monolog\Formatter\LineFormatter;
use Monolog\Processor\WebProcessor;

class AbstractHandlerTest extends TestCase
{
    /**
     * @covers Monolog\Handler\AbstractHandler::__construct
     * @covers Monolog\Handler\AbstractHandler::getLevel
     * @covers Monolog\Handler\AbstractHandler::setLevel
     * @covers Monolog\Handler\AbstractHandler::getBubble
     * @covers Monolog\Handler\AbstractHandler::setBubble
     * @covers Monolog\Handler\AbstractHandler::getFormatter
     * @covers Monolog\Handler\AbstractHandler::setFormatter
     */
    public function testConstructAndGetSet()
    {
        $handler = $this->getMockForAbstractClass('Monolog\Handler\AbstractHandler', array(L