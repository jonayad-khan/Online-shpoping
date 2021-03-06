Copyright (c) 2014 Daniel Nögel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

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
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Trait_;
use Psy\Exception\ErrorException;

/**
 * The called class pass throws warnings for get_class() and get_called_class()
 * outside a class context.
 */
class CalledClassPass extends CodeCleanerPass
{
    private $inClass;

    /**
     * @param array $nodes
     */
    public function beforeTraverse(array $nodes)
    {
        $this->inClass = false;
    }

    /**
     * @throws ErrorException if get_class or get_called_class is called without an object from outside a class
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Class_ || $node instanceof Trait_) {
            $this->inClass = true;
        } elseif ($node instanceof FuncCall && !$this->inClass) {
            // We'll give any args at all (besides null) a pass.
            // Technically we should be checking whether the args are objects, but this will do for now.
            //
            // @todo switch this to actually validate args when we get context-aware code cleaner passes.
            if (!empty($node->args) && !$this->isNull($node->args[0])) {
                return;
            }

            // We'll ignore name expressions as well (things like `$foo()`)
            if (!($node->name instanceof Name)) {
                return;
            }

            $name = strtolower($node->name);
            if (in_array($name, array('get_class', 'get_called_class'))) {
                $msg = sprintf('%s() called without object from outside a class', $name);
                throw new ErrorException($msg, 0, E_USER_WARNING, null, $node->getLine());
            }
        }
    }

    /**
     * @param Node $node
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Class_) {
            $this->inClass = false;
        }
    }

    private function isNull(Node $node)
    {
        return $node->value instanceof ConstFetch && strtolower($node->value->name) === 'null';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Faker\Provider\en_HK;

class Address extends \Faker\Provider\Address
{
    protected static $country = array('Hong Kong');

    protected static $syllables = array(
        'A', 'Ai', 'Ak', 'Am', 'An', 'Ang', 'Ap', 'At', 'Au',
        'Cha', 'Chai', 'Chak', 'Cham', 'Chan', 'Chang', 'Chap', 'Chat', 'Chau',
        'Che', 'Chek', 'Cheng', 'Cheuk', 'Cheung',
        'Chi', 'Chik', 'Chim', 'Chin', 'Ching', 'Chip', 'Chit', 'Chiu',
        'Cho', 'Choi', 'Chok', 'Chong', 'Chou',
        'Chue', 'Chuen', 'Chuet', 'Chui', 'Chuk', 'Chun', 'Chung', 'Chut',
        'E', 'Ei',
        'Fa', 'Fai', 'Fak', 'Fan', 'Fang', 'Fat', 'Fau',
        'Fe', 'Fei', 'Fo', 'Fok', 'Fong',
        'Fu', 'Fui', 'Fuk', 'Fun', 'Fung', 'Fut',
        'Ha', 'Hai', 'Hak', 'Ham', 'Han', 'Hang', 'Hap', 'Hat', 'Hau',
        'Hei', 'Hek', 'Heng', 'Heu', 'Heung',
        'Hik', 'Him', 'Hin', 'Hing', 'Hip', 'Hit', 'Hiu',
        'Ho', 'Hoi', 'Hok', 'Hon', 'Hong', 'Hot', 'Hou',
        'Huen', 'Huet', 'Hui', 'Huk', 'Hung',
        'Ka', 'Kai', 'Kak', 'Kam', 'Kan', 'Kang', 'Kap', 'Kat', 'Kau',
        'Ke', 'Kei', 'Kek', 'Keng', 'Keu', 'Keuk', 'Keung',
        'Kik', 'Kim', 'Kin', 'King', 'Kip', 'Kit', 'Kiu',
        'Ko', 'Koi', 'Kok', 'Kon', 'Kong', 'Kot', 'Kou',
        'Ku', 'Kuen', 'Kuet', 'Kui', 'Kuk', 'Kun', 'Kung', 'Kut',
        'Kwa', 'Kwai', 'Kwak', 'Kwan', 'Kwang', 'Kwat', 'Kwik', 'Kwing', 'Kwo', 'Kwok', 'Kwong',
        'La', 'Lai', 'Lak', 'Lam', 'Lan', 'Lang', 'Lap', 'Lat', 'Lau',
        'Le', 'Lei', 'Lek', 'Leng', 'Leuk', 'Leung',
        'Li', 'Lik', 'Lim', 'Lin', 'Ling', 'Lip', 'Lit', 'Liu',
        'Lo', 'Loi', 'Lok', 'Long', 'Lou',
        'Luen', 'Luet', 'Lui', 'Luk', 'Lun', 'Lung', 'Lut',
        'Ma', 'Mai', 'Mak', 'Man', 'Mang', 'Mat', 'Mau',
        'Me', 'Mei', 'Meng',
        'Mi', 'Mik', 'Min', 'Ming', 'Mit', 'Miu',
        'Mo', 'Mok', 'Mong', 'Mou',
        'Mui', 'Muk', 'Mun', 'Mung', 'Mut',
        'Na', 'Nai', 'Nam', 'Nan', 'Nang', 'Nap', 'Nat', 'Nau',
        'Ne', 'Nei', 'Neung',
        'Ng', 'Nga', 'Ngai', 'Ngak', 'Ngam', 'Ngan', 'Ngang', 'Ngap', 'Ngat', 'Ngau',
        'Ngit',
        'Ngo', 'Ngoi', 'Ngok', 'Ngon', 'Ngong', 'Ngou',
        'Ni', 'Nik', 'Nim', 'Nin', 'Ning', 'Nip', 'Niu',
        'No', 'Noi', 'Nok', 'Nong', 'Nou', 'Nuen',
        'Nui', 'Nuk', 'Nung', 'Nut',
        'O', 'Oi', 'Ok', 'On', 'Ong', 'Ou',
        'Pa', 'Pai', 'Pak', 'Pam', 'Pan', 'Pang', 'Pat', 'Pau',
        'Pe', 'Pei', 'Pek', 'Peng',
        'Pik', 'Pin', 'Ping', 'Pit', 'Piu',
        'Po', 'Poi', 'Pok', 'Pong', 'Pou',
        'Pui', 'Puk', 'Pun', 'Pung', 'Put',
        'Sa', 'Sai', 'Sak', 'Sam', 'San', 'Sang', 'Sap', 'Sat', 'Sau',
        'Se', 'Sei', 'Sek', 'Seng', 'Seuk', 'Seung',
        'Sha', 'Shai', 'Shak', 'Sham', 'Shan', 'Shang', 'Shap', 'Shat', 'Shau',
        'She', 'Shei', 'Shek', 'Sheng', 'Sheuk', 'Sheung',
        'Shi', 'Shik', 'Shim', 'Shin', 'Shing', 'Ship', 'Shit', 'Shiu',
        'Sho', 'Shoi', 'Shok', 'Shong', 'Shou',
        'Shue', 'Shuen', 'Shuet', 'Shui', 'Shuk', 'Shun', 'Shung', 'Shut',
        'Sik', 'Sim', 'Sin', 'Sing', 'Sip', 'Sit', 'Siu',
        'So', 'Soi', 'Sok', 'Song', 'Sou',
        'Sue', 'Suen', 'Suet', 'Sui', 'Suk', 'Sun', 'Sung', 'Sut',
        'Sze',
        'Ta', 'Tai', 'Tak', 'Tam', 'Tan', 'Tang', 'Tap', 'Tat', 'Tau',
        'Te', 'Tei', 'Tek', 'Teng', 'Teu', 'Teuk',
        'Tik', 'Tim', 'Tin', 'Ting', 'Tip', 'Tit', 'Tiu',
        'To', 'Toi', 'Tok', 'Tong', 'Tou',
        'Tsa', 'Tsai', 'Tsak', 'Tsam', 'Tsan', 'Tsang', 'Tsap', 'Tsat', 'Tsau',
        'Tse', 'Tsek', 'Tseng', 'Tseuk', 'Tseung',
        'Tsik', 'Tsim', 'Tsin', 'Tsing', 'Tsip', 'Tsit', 'Tsiu',
        'Tso', 'Tsoi', 'Tsok', 'Tsong', 'Tsou',
        'Tsue', 'Tsuen', 'Tsuet', 'Tsui', 'Tsuk', 'Tsun', 'Tsung', 'Tsut',
        'Tsz',
        'Tuen', 'Tuet', 'Tui', 'Tuk', 'Tun', 'Tung', 'Tut',
        'Uk', 'Ung',
        'Wa', 'Wai', 'Wak', 'Wan', 'Wang', 'Wat',
        'Wik', 'Wing',
        'Wo', 'Wok', 'Wong', 'Wu',
        'Wui', 'Wun', 'Wut', 'Ya',
        'Yai', 'Yak', 'Yam', 'Yan', 'Yap', 'Yat', 'Yau',
        'Ye', 'Yeng', 'Yeuk', 'Yeung', 'Yi',
        'Yik', 'Yim', 'Yin', 'Ying', 'Yip', 'Yit', 'Yiu',
        'Yo',
        'Yue', 'Yuen', 'Yuet', 'Yui', 'Yuk', 'Yun', 'Yung',
    );

    protected static $streetAddressFormats = array(
        '{{buildingNumber}} {{streetName}}',
        '{{buildingNumber}} {{village}}',
        'Block {{buildingNumber}}, {{estate}}',
    );

    protected static $addressFormats = array(
        "{{streetAddress}}\n{{town}}\n{{city}}",
    );

    protected static $villageNameFormats = array(
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{villageSuffix}}',
        '{{syllable}} {{syllable}}',
        '{{syllable}} {{syllable}}',
        '{{syllable}} {{syllable}}',
        '{{syllable}} {{syllable}} {{syllable}}',
        '{{syllable}} {{syllable}} {{syllable}}',
        '{{syllable}} {{syllable}} {{syllable}}',
        '{{town}}',
        '{{town}} {{villageSuffix}}',
    );

    protected static $estateNameFormats = array(
        '{{syllable}} {{syllable}} {{estateSuffix}}',
        '{{syllable}} {{syllable}} {{estateSuffix}}',
        '{{syllable}} {{syllable}} {{estateSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{estateSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{estateSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{estateSuffix}}',
        '{{town}} {{estateSuffix}}',
    );


    protected static $villageSuffixes = array('Village', 'Tsuen', 'San Tsuen', 'New Village', 'Wai');

    protected static $estateSuffixes = array('Estate', 'Court');

    protected static $streetNameFormats = array(
        '{{syllable}} {{streetSuffix}}',
        '{{syllable}} {{syllable}} {{streetSuffix}}',
        '{{syllable}} {{syllable}} {{streetSuffix}}',
        '{{syllable}} {{syllable}} {{streetSuffix}}',
        '{{syllable}} {{syllable}} {{syllable}} {{streetSuffix}}',
        '{{syllable}} {{syllable}} {{syllable