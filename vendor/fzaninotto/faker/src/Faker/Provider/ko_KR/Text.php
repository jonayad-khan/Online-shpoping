, false),
            array('startsWithLetter', array(''), false),
            array('endsWith', array('abcd', 'cd'), true),
            array('endsWith', array('abcd', 'bc'), false),
            array('endsWith', array('', 'bc'), false),
            array('regex', array('abcd', '~^ab~'), true),
            array('regex', array('abcd', '~^bc~'), false),
            array('regex', array('', '~^bc~'), false),
            array('alpha', array('abcd'), true),
            array('alpha', array('ab1cd'), false),
            array('alpha', array(''), false),
            array('digits', array('1234'), true),
            array('digits', array('12a34'), false),
            array('digits', array(''), false),
            array('alnum', array('ab12'), true),
            array('alnum', array('ab12$'), false),
            array('alnum', array(''), false),
            array('lower', array('abcd'), true),
            array('lower', array('abCd'), false),
            array('lower', array('ab_d'), false),
            array('lower', array(''), false),
            array('upper', array('ABCD'), true),
            array('upper', array('ABcD'), false),
            array('upper', array('AB_D'), false),
            array('upper', array(''), false),
            array('length', array('abcd', 4), true),
            array('length', array('abc', 4), false),
            array('length', array('abcde', 4), false),
            array('length', array('äbcd', 4), true, true),
            array('length', array('äbc', 4), false, true),
            array('length', array('äbcde', 4), false, true),
            array('minLength', array('abcd', 4), true),
            array('minLength', array('abcde', 4), true),
            array('minLength', array('abc', 4), false),
            array('minLength', array('äbcd', 4), true, true),
            array('minLength', array('äbcde', 4), true, true),
            array('minLength', array('äbc', 4), false, true),
            array('maxLength', array('abcd', 4), true),
            array('maxLength', array('abc', 4), true),
            array('maxLength', array('abcde', 4), false),
            array('maxLength', array('äbcd', 4), true, true),
            array('maxLength', array('äbc', 4), true, true),
            array('maxLength', array('äbcde', 4), false, true),
            array('lengthBetween', array('abcd', 3, 5), true),
            array('lengthBetween', array('abc', 3, 5), true),
            array('lengthBetween', array('abcde', 3, 5), true),
            array('lengthBetween', array('ab', 3, 5), false),
            array('lengthBetween', array('abcdef', 3, 5), false),
            array('lengthBetween', array('äbcd', 3, 5), true, true),
            array('lengthBetween', array('äbc', 3, 5), true, true),
            array('lengthBetween', array('äbcde', 3, 5), true, true),
            array('lengthBetween', array('äb', 3, 5), false, true),
            array('lengthBetween', array('äbcdef', 3, 5), false, true),
            array('fileExists', array(__FILE__), true),
            array('fileExists', array(__DIR__), true),
            array('fileExists', array(__DIR__.'/foobar'), false),
            array('file', array(__FILE__), true),
            array('file', array(__DIR__), false),
            array('file', array(__DIR__.'/foobar'), false),
            array('directory', array(__DIR__), true),
            array('directory', array(__FILE__), false),
            array('directory', array(__DIR__.'/foobar'), false),
            // no tests for readable()/writable() for now
            array('classExists', array(__CLASS__), true),
            array('classExists', array(__NAMESPACE__.'\Foobar'), false),
            array('subclassOf', array(__CLASS__, 'PHPUnit_Framework_TestCase'), true),
            array('subclassOf', array(__CLASS__, 'stdClass'), false),
            array('implementsInterface', array('ArrayIterator', 'Traversable'), true),
            array('implementsInterface', array(__CLASS__, 'Traversable'), false),
            array('propertyExists', array((object) array('property' => 0), 'property'), true),
            array('propertyExists', array((object) array('property' => null), 'property'), true),
            array('propertyExists', array((object) array('property' => null), 'foo'), false),
            array('propertyNotExists', array((object) array('property' => 0), 'property'), false),
            array('propertyNotExists', array((object) array('property' => null), 'property'), false),
            array('propertyNotExists', array((object) array('property' => null), 'foo'), true),
            array('methodExists', array('RuntimeException', 'getMessage'), true),
            array('methodExists', array(new RuntimeException(), 'getMessage'), true),
            array('methodExists', array('stdClass', 'getMessage'), false),
            array('methodExists', array(new stdClass(), 'getMessage'), false),
            array('methodExists', array(null, 'getMessage'), false),
            array('methodExists', array(true, 'getMessage'), false),
            array('methodExists', array(1, 'getMessage'), false),
            array('methodNotExists', array('RuntimeException', 'getMessage'), false),
            array('methodNotExists', array(new RuntimeException(), 'getMessage'), false),
            array('methodNotExists', array('stdClass', 'getMessage'), true),
            array('methodNotExists', array(new stdClass(), 'getMessage'), true),
            array('methodNotExists', array(null, 'getMessage'), true),
            array('methodNotExists', array(true, 'getMessage'), true),
            array('methodNotExists', array(1, 'getMessage'), true),
            array('keyExists', array(array('key' => 0), 'key'), true),
            array('keyExists', array(array('key' => null), 'key'), true),
            array('keyExists', array(array('key' => null), 'foo'), false),
            array('keyNotExists', array(array('key' => 0), 'key'), false),
            array('keyNotExists', array(array('key' => null), 'key'), false),
            array('keyNotExists', array(array('key' => null), 'foo'), true),
            array('count', array(array(0, 1, 2), 3), true),
            array('count', array(array(0, 1, 2), 2), false),
            array('uuid', array('00000000-0000-0000-0000-000000000000'), true),
            array('uuid', array('ff6f8cb0-c57d-21e1-9b21-0800200c9a66'), true),
            array('uuid', array('ff6f8cb0-c57d-11e1-9b21-0800200c9a66'), true),
            array('uuid', array('ff6f8cb0-c57d-31e1-9b21-0800200c9a66'), true),
            array('uuid', array('ff6f8cb0-c57d-41e1-9b21-0800200c9a66'), true),
            array('uuid', array('ff6f8cb0-c57d-51e1-9b21-0800200c9a66'), true),
            array('uuid', array('FF6F8CB0-C57D-11E1-9B21-0800200C9A66'), true),
            array('uuid', array('zf6f8cb0-c57d-11e1-9b21-0800200c9a66'), false),
            array('uuid', array('af6f8cb0c57d11e19b210800200c9a66'), false),
            array('uuid', array('ff6f8cb0-c57da-51e1-9b21-0800200c9a66'), false),
            array('uuid', array('af6f8cb-c57d-11e1-9b21-0800200c9a66'), false),
            array('uuid', array('3f6f8cb0-c57d-11e1-9b21-0800200c9a6'), false),
            array('throws', array(function() { throw new LogicException('test'); }, 'LogicException'), true),
            array('throws', array(function() { throw new LogicException('test'); }, 'IllogicException'), false),
            array('throws', array(function() { throw new Exception('test'); }), true),
            array('throws', array(function() { trigger_error('test'); }, 'Throwable'), true, false, 70000),
            array('throws', array(function() { trigger_error('test'); }, 'Unthrowable'), false, false, 70000),
            array('throws', array(function() { throw new Error(); }, 'Throwable'), true, true, 70000),
        );
    }

    public function getMethods()
    {
        $methods = array();

        foreach ($this->getTests() as $params) {
            $methods[$params[0]] = array($params[0]);
        }

        return array_values($methods);
    }

    /**
     * @dataProvider getTests
     */
    public function testAssert($method, $args, $success, $multibyte = false, $minVersion = null)
    {
        if ($minVersion && PHP_VERSION_ID < $minVersion) {
            $this->markTestSkipped(sprintf('This test requires php %s or upper.', $minVersion));

            return;
        }
        if ($multibyte && !function_exists('mb_strlen')) {
            $this->markTestSkipped('The function mb_strlen() is not available');

            return;
        }

        if (!$success) {
            $this->setExpectedException('\InvalidArgumentException');
        }

        call_user_func_array(array('Webmozart\Assert\Assert', $method), $args);
    }

    /**
     * @dataProvider getTests
     */
    public function testNullOr($method, $args, $success, $multibyte = false, $minVersion = null)
    {
        if ($minVersion && PHP_VERSION_ID < $minVersion) {
            $this->markTestSkipped(sprintf('This test requires php %s or upper.', $minVersion));

            return;
        }
        if ($multibyte && !function_exists('mb_strlen')) {
            $this->markTestSkipped('The function mb_strlen() is not available');

            return;
        }

        if (!$success && null !== reset($args)) {
            $this->setExpectedException('\InvalidArgumentException');
        }

        call_user_func_array(array('Webmozart\Assert\Assert', 'nullOr'.ucfirst($method)), $args);
    }

    /**
     * @dataProvider getMethods
     */
    public function testNullOrAcceptsNull($method)
    {
        call_user_func(array('Webmozart\Assert\Assert', 'nullOr'.ucfirst($method)), null);
    }

    /**
     * @dataProvider getTests
     */
    public function testAllArray($method, $args, $success, $multibyte = false, $minVersion = null)
    {
        if ($minVersion && PHP_VERSION_ID < $minVersion) {
            $this->markTestSkipped(sprintf('This test requires php %s or upper.', $minVersion));

            return;
        }
        if ($multibyte && !function_exists('mb_strlen')) {
            $this->markTestSkipped('The function mb_strlen() is not available');

            return;
        }

        if (!$success) {
            $this->setExpectedException('\InvalidArgumentException');
        }

        $arg = array_shift($args);
        array_unshift($args, array($arg));

        call_user_func_array(array('Webmozart\Assert\Assert', 'all'.ucfirst($method)), $args);
    }

    /**
     * @dataProvider getTests
     */
    public function testAllTraversable($method, $args, $success, $multibyte = false, $minVersion = null)
    {
        if ($minVersion && PHP_VERSION_ID < $minVersion) {
            $this->markTestSkipped(sprintf('This test requires php %s or upper.', $minVersion));

            return;
        }
        if ($multibyte && !function_exists('mb_strlen')) {
            $this->markTestSkipped('The function mb_strlen() is not available');

            return;
        }

        if (!$success) {
            $this->setExpectedException('\InvalidArgumentException');
        }

        $arg = array_shift($args);
        array_unshift($args, new ArrayIterator(array($arg)));

        call_user_func_array(array('Webmozart\Assert\Assert', 'all'.ucfirst($method)), $args);
    }

    public function getStringConversions()
    {
        return array(
            array('integer', array('foobar'), 'Expected an integer. Got: string'),
            array('string', array(1), 'Expected a string. Got: integer'),
            array('string', array(true), 'Expected a string. Got: boolean'),
            array('string', array(null), 'Expected a string. Got: NULL'),
            array('string', array(array()), 'Expected a string. Got: array'),
            array('string', array(new stdClass()), 'Expected a string. Got: stdClass'),
            array('string', array(self::getResource()), 'Expected a string. Got: resource'),

            array('eq', array('1', '2'), 'Expected a value equal to "2". Got: "1"'),
            array('eq', array(1, 2), 'Expected a value equal to 2. Got: 1'),
            array('eq', array(true, false), 'Expected a value equal to false. Got: true'),
            array('eq', array(true, null), 'Expected a value equal to null. Got: true'),
            array('eq', array(null, true), 'Expected a value equal to true. Got: null'),
            array('eq', array(array(1), array(2)), 'Expected a value equal to array. Got: array'),
            array('eq', array(new ArrayIterator(array()), new stdClass()), 'Expected a value equal to stdClass. Got: ArrayIterator'),
            array('eq', array(1, self::getResource()), 'Expected a value equal to resource. Got: 1'),
        );
    }

    /**
     * @dataProvider getStringConversions
     */
    public function testConvertValuesToStrings($method, $args, $exceptionMessage)
    {
        $this->setExpectedException('\InvalidArgumentException', $exceptionMessage);

        call_user_func_array(array('Webmozart\Assert\Assert', $method), $args);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

namespace Faker\Provider\sv_SE;

class Address extends \Faker\Provider\Address
{
    protected static $buildingNumber = array('%###', '%##', '%#', '%#?', '%', '%?');

    protected static $streetPrefix = array(
        'Stor', 'Små', 'Lill', 'Sjö', 'Kungs', 'Drottning', 'Hamn', 'Brunns', 'Linné', 'Vasa', 'Ring', 'Freds'
    );

    protected static $streetSuffix = array(
        'vägen', 'gatan', 'gränd', 'stigen', 'backen', 'liden'
    );

    protected static $streetSuffixWord = array(
        'Allé', 'Gata', 'Väg', 'Backe'
    );

    protected static $postcode = array('%####', '%## ##');

    /**
     * @var array Swedish city names
     * @link http://sv.wikipedia.org/wiki/Lista_%C3%B6ver_Sveriges_t%C3%A4torter
     */
    protected static $cityNames = array(
        'Abbekås', 'Abborrberget', 'Agunnaryd', 'Alberga', 'Alby', 'Alfta', 'Algutsrum', 'Alingsås', 'Allerum', 'Almunge', 'Alsike', 'Alstad', 'Alster', 'Alsterbro', 'Alstermo', 'Alunda', 'Alvesta', 'Alvhem', 'Alvik', 'Alvik', 'Ambjörby', 'Ambjörnarp', 'Ammenäs', 'Andalen', 'Anderslöv', 'Anderstorp', 'Aneby', 'Angelstad', 'Angered', 'Ankarsrum', 'Ankarsvik', 'Anneberg', 'Anneberg', 'Annelund', 'Annelöv', 'Antnäs', 'Aplared', 'Arboga', 'Arbrå', 'Ardala', 'Arentorp', 'Arild', 'Arjeplog', 'Arkelstorp', 'Arnäsvall', 'Arnö', 'Arontorp', 'Arvidsjaur', 'Arvika', 'Aröd och Timmervik', 'Askeby', 'Askersby', 'Askersund', 'Asmundtorp', 'Asperö', 'Aspås', 'Avan', 'Avesta', 'Axvall',
        'Backa', 'Backaryd', 'Backberg', 'Backe', 'Baggetorp', 'Ballingslöv', 'Balsby', 'Bammarboda', 'Bankekind', 'Bankeryd', 'Bara', 'Barkarö', 'Barsebäck', 'Barsebäckshamn', 'Bastuträsk', 'Beddingestrand', 'Benareby', 'Bengtsfors', 'Bengtsheden', 'Bensbyn', 'Berg', 'Berg', 'Berg', 'Berga', 'Bergagård', 'Bergby', 'Bergeforsen', 'Berghem', 'Bergkvara', 'Bergnäset', 'Bergsbyn', 'Bergshammar', 'Bergshamra', 'Bergsjö', 'Bergströmshusen', 'Bergsviken', 'Bergvik', 'Bestorp', 'Bettna', 'Bie', 'Billdal', 'Billeberga', 'Billesholm', 'Billinge', 'Billingsfors', 'Billsta', 'Bjurholm', 'Bjursås', 'Bjuv', 'Bjärnum', 'Bjärred', 'Bjärsjölagård', 'Bjästa', 'Björbo', 'Björboholm', 'Björke', 'Björketorp', 'Björklinge', 'Björkvik', 'Björkviken', 'Björkö', 'Björköby', 'Björlanda', 'Björna', 'Björneborg', 'Björnlunda', 'Björnänge', 'Björnö', 'Björnömalmen och Klacknäset', 'Björsäter', 'Blackstalund', 'Bleket', 'Blentarp', 'Blidsberg', 'Blikstorp', 'Blombacka', 'Blomstermåla', 'Blåsmark', 'Blötberget', 'Bockara', 'Boda', 'Bodafors', 'Boden', 'Boholmarna', 'Boliden', 'Bollebygd', 'Bollnäs', 'Bollstabruk', 'Bonäs', 'Boo', 'Bor', 'Borensberg', 'Borggård', 'Borgholm', 'Borgstena', 'Borlänge', 'Borrby', 'Borås', 'Bosnäs', 'Botsmark', 'Bottnaryd', 'Bovallstrand', 'Boxholm', 'Brantevik', 'Brastad', 'Brattås', 'Braås', 'Bredared', 'Bredaryd', 'Bredbyn', 'Bredsand', 'Bredviken', 'Brevik', 'Brevikshalvön', 'Bro', 'Broaryd', 'Broby', 'Brokind', 'Bromölla', 'Brottby', 'Brunflo', 'Brunn', 'Brunna', 'Brunnsberg', 'Bruzaholm', 'Brålanda', 'Bräcke', 'Bräkne-Hoby', 'Brändön', 'Brännland', 'Brännö', 'Brösarp', 'Bua', 'Buerås', 'Bullmark', 'Bunkeflostrand', 'Bureå', 'Burgsvik', 'Burlövs egnahem', 'Burseryd', 'Burträsk', 'Buskhyttan', 'Butbro', 'Bygdeå', 'Bygdsiljum', 'Byske', 'Bålsta', 'Bårslöv', 'Båstad', 'Båtskärsnäs', 'Bäckaskog', 'Bäckebo', 'Bäckefors', 'Bäckhammar', 'Bälgviken', 'Bälinge', 'Bälinge', 'Bärby', 'Bäsna', 'Böle', 'Bönan',
        'Charlottenberg',
        'Dalarö', 'Dalby', 'Dals Långed', 'Dals Rostock', 'Dalsjöfors', 'Dalstorp', 'Dalum', 'Danholn', 'Dannemora', 'Dannike', 'Degeberga', 'Degerfors', 'Degerhamn', 'Deje', 'Delary', 'Delsbo', 'Dingersjö', 'Dingle', 'Dingtuna', 'Diseröd', 'Diö', 'Djulö kvarn', 'Djura', 'Djurmo', 'Djurås', 'Djurö', 'Docksta', 'Domsten', 'Donsö', 'Dorotea', 'Drag', 'Drottningholm', 'Drängsmark', 'Dunö', 'Duved', 'Duvesjön', 'Dvärsätt', 'Dyvelsten', 'Dösjebro',
        'Ed', 'Eda glasbruk', 'Edane', 'Edsbro', 'Edsbruk', 'Edsbyn', 'Edsvalla', 'Eggby', 'Ekeby', 'Ekeby', 'Ekeby', 'Ekeby', 'Ekeby-Almby', 'Ekedalen', 'Ekenässjön', 'Ekerö', 'Ekerö sommarstad', 'Eket', 'Ekshärad', 'Eksjö', 'Eksund', 'Ekängen', 'Eldsberga', 'Ellös', 'Emmaboda', 'Emmaljunga', 'Emsfors', 'Emtunga', 'Eneryda', 'Enhagen-Ekbacken', 'Enköping', 'Ensjön', 'Enstaberga', 'Enviken', 'Enånger', 'Eriksmåla', 'Eringsboda', 'Ersmark', 'Ersmark', 'Ersnäs', 'Eskilsby och Snugga', 'Eskilstuna', 'Eslöv', 'Essvik', 'Evertsberg', 'Everöd',
        'Fagerhult', 'Fagersanna', 'Fagersta', 'Fagerås', 'Falerum', 'Falkenberg', 'Falköping', 'Falla', 'Falun', 'Fanbyn', 'Fellingsbro', 'Fengersfors', 'Figeholm', 'Filipstad', 'Filsbäck', 'Finja', 'Finkarby', 'Finnerödja', 'Finspång', 'Finsta', 'Fiskebäckskil', 'Fisksätra', 'Fjugesta', 'Fjälkinge', 'Fjällbacka', 'Fjärdhundra', 'Fjärås kyrkby', 'Flen', 'Flisby', 'Fliseryd', 'Floby', 'Floda', 'Floda', 'Flurkmark', 'Flygsfors', 'Flyinge', 'Flädie', 'Fornåsa', 'Fors', 'Forsbacka', 'Forsby', 'Forserum', 'Forshaga', 'Forsheda', 'Forssjö', 'Forsvik', 'Fotö', 'Fredrika', 'Fredriksberg', 'Fredriksdal', 'Fridafors', 'Fridlevstad', 'Friggesund', 'Frillesås', 'Frinnaryd', 'Fristad', 'Fritsla', 'Frufällan', 'Frånö', 'Främmestad', 'Frändefors', 'Fränsta', 'Frödinge', 'Frösakull', 'Frövi', 'Funäsdalen', 'Furuby', 'Furudal', 'Furulund', 'Furusjö', 'Furuvik', 'Fyllinge', 'Fågelfors', 'Fågelmara', 'Fågelsta', 'Fågelvikshöjden', 'Fårbo', 'Fårösund', 'Färgelanda', 'Färila', 'Färjestaden', 'Färlöv', 'Färnäs', 'Föllinge', 'Förslöv',
        'Gagnef', 'Gamleby', 'Gammelgården', 'Gammelstad', 'Gantofta', 'Garpenberg', 'Garphyttan', 'Geijersholm', 'Gemla', 'Genarp', 'Genevad', 'Gessie villastad', 'Gesunda', 'Getinge', 'Gideå', 'Gimmersta', 'Gimo', 'Gimåt', 'Gislaved', 'Gistad', 'Gladö kvarn', 'Glanshammar', 'Glemmingebro', 'Glimåkra', 'Glommen', 'Glommersträsk', 'Glumslöv', 'Gnarp', 'Gnesta', 'Gnosjö', 'Godegård', 'Gonäs', 'Gottne', 'Grangärde', 'Granö', 'Graversfors', 'Grebbestad', 'Grebo', 'Grevie', 'Grevie och Beden', 'Grillby', 'Grimslöv', 'Grimstorp', 'Grimsås', 'Gripenberg', 'Grisslehamn', 'Grums', 'Grundsund', 'Grycksbo', 'Grytgöl', 'Grythyttan', 'Gråbo', 'Gräfsnäs', 'Grängesberg', 'Gränna', 'Gränum', 'Grästorp', 'Grödby', 'Gualöv', 'Gubbo', 'Gudhem', 'Gullbrandstorp', 'Gullbranna', 'Gulleråsen', 'Gullringen', 'Gullspång', 'Gundal och Högås', 'Gunnarskog', 'Gunnarstorp', 'Gunnebo', 'Gunsta', 'Gusselby', 'Gustavsberg', 'Gustavsberg', 'Gusum', 'Gyttorp', 'Gånghester', 'Gårdby', 'Gårdskär', 'Gårdstånga', 'Gåvsta', 'Gäddede', 'Gällivare', 'Gällstad', 'Gällö', 'Gängletorp', 'Gärds Köpinge', 'Gärsnäs', 'Gävle', 'Göta', 'Göteborg', 'Götene', 'Götlunda',
        'Habo', 'Hackås', 'Haga', 'Hagby', 'Hagbyhöjden', 'Hagfors', 'Hagge', 'Hagryd-Dala', 'Hakkas', 'Halla Heberg', 'Hallabro', 'Hallen', 'Hallerna', 'Hallsberg', 'Hallstahammar', 'Hallstavik', 'Halltorp', 'Halmstad', 'Halvarsgårdarna', 'Hamburgsund', 'Hammar', 'Hammar', 'Hammarby', 'Hammarslund', 'Hammarstrand', 'Hammenhög', 'Hammerdal', 'Hampetorp', 'Hamrångefjärden', 'Hanaskog', 'Haparanda', 'Harads', 'Harbo', 'Hargshamn', 'Harlösa', 'Harmånger', 'Harplinge', 'Hassela', 'Hasselfors', 'Hasslarp', 'Hasslö', 'Hasslöv', 'Havdhem', 'Haverdal', 'Heberg', 'Heby', 'Hedared', 'Hede', 'Hedekas', 'Hedemora', 'Hedenäset', 'Hedeskoga', 'Hedesunda', 'Hedvigsberg', 'Helsingborg', 'Hemavan/Bierke', 'Hemmesta', 'Hemmingsmark', 'Hemse', 'Henån', 'Herrestad', 'Herrljunga', 'Herräng', 'Herstadberg', 'Hestra', 'Hestra', 'Hillared', 'Hillerstorp', 'Himle', 'Hindås', 'Hishult', 'Hissjön', 'Hittarp', 'Hjo', 'Hjorted', 'Hjortkvarn', 'Hjortsberga', 'Hjuvik', 'Hjälm', 'Hjälmared', 'Hjälmared', 'Hjältevad', 'Hjärnarp', 'Hjärsås', 'Hjärtum', 'Hjärup', 'Hofors', 'Hofterup', 'Hogstad', 'Hogstorp', 'Hok', 'Holm', 'Holmeja', 'Holmsjö', 'Holmsund', 'Holsbybrunn', 'Holsljunga', 'Horda', 'Horn', 'Horndal', 'Horred', 'Hortlax', 'Hoting', 'Hova', 'Hovid', 'Hovmantorp', 'Hovsta', 'Huaröd', 'Hudiksvall', 'Hult', 'Hultafors', 'Hultsfred', 'Hulu', 'Hummelsta', 'Hunnebostrand', 'Hurva', 'Husby', 'Husum', 'Hybo', 'Hyllinge', 'Hyltebruk', 'Hyssna', 'Håbo-Tibble kyrkby', 'Håga', 'Håksberg', 'Hållsta', 'Hålsjö', 'Hånger', 'Häggeby och Vreta', 'Häggenås', 'Häljarp', 'Hällabrottet', 'Hällaryd', 'Hällberga', 'Hällbybrunn', 'Hällefors', 'Hälleforsnäs', 'Hällekis', 'Hällestad', 'Hällesåker', 'Hällevadsholm', 'Hällevik', 'Hälleviksstrand', 'Hällingsjö', 'Hällnäs', 'Hälsö', 'Härad', 'Häradsbygden', 'Härnösand', 'Härryda', 'Härslöv', 'Hässleholm', 'Hästhagen', 'Hästholmen', 'Hästveda', 'Höganäs', 'Högboda', 'Högsby', 'Högsjö', 'Högsäter', 'Höja', 'Hökerum', 'Hökåsen', 'Hököpinge', 'Höllviken', 'Hölö', 'Hönö', 'Hörby', 'Hörnefors', 'Hörvik', 'Höviksnäs', 'Höör',
        'Idala', 'Idkerberget', 'Idre', 'Igelfors', 'Igelstorp', 'Iggesund', 'Ilsbo', 'Immeln', 'Indal', 'Ingared', 'Ingaröstrand', 'Ingatorp', 'Ingelstad', 'Ingelsträde', 'Innertavle', 'Insjön', 'Irsta',
        'Johannedal', 'Johannesudd', 'Johannishus', 'Johansfors', 'Jokkmokk', 'Jonsered', 'Jonslund', 'Jonstorp', 'Jordbro', 'Jukkasjärvi', 'Jung', 'Juniskär', 'Junosuando', 'Junsele', 'Juoksengi', 'Jursla', 'Jäderfors', 'Jädraås', 'Jämjö', 'Jämshög', 'Jämtön', 'Järbo', 'Järlåsa', 'Järna', 'Järna', 'Järnforsen', 'Järpen', 'Järpås', 'Järvsö', 'Jättendal', 'Jävre', 'Jönköping', 'Jönåker', 'Jörlanda', 'Jörn', 'Jössefors',
        'Kalix', 'Kallax', 'Kallinge', 'Kalmar', 'Kalvsund', 'Kangos', 'Karby', 'Kareby', 'Karesuando', 'Karlholmsbruk', 'Karlsborg', 'Karlsborg', 'Karlshamn', 'Karlskoga', 'Karlskrona', 'Karlstad', 'Karlsvik', 'Karungi', 'Karups sommarby', 'Kastlösa', 'Katrinedal', 'Katrineholm', 'Kattarp', 'Kaxholmen', 'Kebal', 'Kil', 'Kil', 'Kilafors', 'Killeberg', 'Kilsmo', 'Kimstad', 'Kinna', 'Kinnared', 'Kinnarp', 'Kinnarumma', 'Kiruna', 'Kisa', 'Kivik', 'Kjulaås', 'Klagstorp', 'Klevshult', 'Klingsta och Allsta', 'Klintehamn', 'Klippan', 'Klippans bruk', 'Klockestrand', 'Klockrike', 'Klågerup', 'Klädesholmen', 'Kläppa', 'Klässbol', 'Klöverträsk', 'Klövsjö', 'Knislinge', 'Knivsta', 'Knutby', 'Knäred', 'Kode', 'Kolbäck', 'Kolsva', 'Konga', 'Kopparberg', 'Kopparmora', 'Koppom', 'Korpilombolo', 'Korsberga', 'Korsberga', 'Korsträsk', 'Koskullskulle', 'Kosta', 'Kovland', 'Kramfors', 'Kristdala', 'Kristianstad', 'Kristineberg', 'Kristinehamn', 'Kristvallabrunn', 'Krokek', 'Krokom', 'Krägga', 'Kulltorp', 'Kullö', 'Kumla', 'Kumla kyrkby', 'Kummelnäs', 'Kungsbacka', 'Kungsberga', 'Kungsgården', 'Kungshamn', 'Kungshult', 'Kungsängen', 'Kungsäter', 'Kungsör', 'Kungälv', 'Kurland', 'Kusmark', 'Kuttainen', 'Kvibille', 'Kvicksund', 'Kvidinge', 'Kvillsfors', 'Kvisljungeby', 'Kvissleby', 'Kvänum', 'Kvärlöv', 'Kyrkheddinge', 'Kyrkhult', 'Kyrksten', 'Kåge', 'Kågeröd', 'Kåhög', 'Kållekärr', 'Kållered', 'Kånna', 'Kårsta', 'Kälarne', 'Källby', 'Källö-Knippla', 'Kärda', 'Kärna', 'Kärsta och Bredsdal', 'Kättilsmåla', 'Kättilstorp', 'Kävlinge', 'Köping', 'Köpingebro', 'Köpingsvik', 'Köpmanholmen',
        'Lagan', 'Laholm', 'Lammhult', 'Landeryd', 'Landfjärden', 'Landsbro', 'Landskrona', 'Landvetter', 'Lanesund och Överby', 'Lanna', 'Lanna', 'Latorpsbruk', 'Laxvik', 'Laxå', 'Lekeryd', 'Leksand', 'Lenhovda', 'Lerdala', 'Lerkil', 'Lerum', 'Lesjöfors', 'Lessebo', 'Liatorp', 'Lidatorp och Klövsta', 'Liden', 'Lidhult', 'Lidingö', 'Lidköping', 'Lilla Edet', 'Lilla Harrie', 'Lilla Stenby', 'Lilla Tjärby', 'Lillhaga', 'Lillhärdal', 'Lillkyrka', 'Lillpite', 'Lima', 'Limedsforsen', 'Limmared', 'Linderöd', 'Lindesberg', 'Lindholmen', 'Lindome', 'Lindsdal', 'Lindö', 'Lingbo', 'Linghed', 'Linghem', 'Linköping', 'Linneryd', 'Listerby', 'Lit', 'Ljugarn', 'Ljung', 'Ljunga', 'Ljungaverk', 'Ljungby', 'Ljungbyhed', 'Ljungbyholm', 'Ljunghusen', 'Ljungsarp', 'Ljungsbro', 'Ljungskile', 'Ljungstorp och Jägersbo', 'Ljusdal', 'Ljusfallshammar', 'Ljusne', 'Loftahammar', 'Lomma', 'Los', 'Lotorp', 'Lottefors', 'Lucksta', 'Ludvigsborg', 'Ludvika', 'Lugnet och Skälsmara', 'Lugnvik', 'Lugnås', 'Luleå', 'Lund', 'Lund', 'Lunde', 'Lundsbrunn', 'Lunnarp', 'Lurudden', 'Lycksele', 'Lyrestad', 'Lysekil', 'Lysvik', 'Långasjö', 'Långsele', 'Långshyttan', 'Långvik', 'Långviksmon', 'Långås', 'Låssby', 'Läby', 'Läckeby', 'Länghem', 'Länna', 'Lärbro', 'Löberöd', 'Löddeköpinge', 'Löderup', 'Lödöse', 'Löftaskog', 'Lögdeå', 'Lönsboda', 'Lörby', 'Löttorp', 'Löwenströmska lasarettet', 'Lövestad', 'Lövstalöt', 'Lövånger',
        'Madängsholm', 'Mala', 'Malmberget', 'Malmbäck', 'Malmköping', 'Malmslätt', 'Malmö', 'Maln', 'Malung', 'Malungsfors', 'Malå', 'Mantorp', 'Marbäck', 'Margretetorp', 'Mariannelund', 'Marieby', 'Mariedal', 'Mariefred', 'Marieholm', 'Marielund', 'Marielund', 'Mariestad', 'Markaryd', 'Marma', 'Marmaskogen', 'Marmaverken', 'Marmorbyn', 'Marstrand', 'Matfors', 'Medle', 'Medåker', 'Mehedeby', 'Mellansel', 'Mellbystrand', 'Mellerud', 'Mellösa', 'Merlänna', 'Misterhult', 'Mjällby', 'Mjällom', 'Mjöbäck', 'Mjöhult', 'Mjölby', 'Mjönäs', 'Mockfjärd', 'Mogata', 'Mohed', 'Moheda', 'Moholm', 'Moliden', 'Molkom', 'Mollösund', 'Mora', 'Mora', 'Morgongåva', 'Morjärv', 'Morup', 'Moskosel', 'Motala', 'Mullhyttan', 'Mullsjö', 'Munga', 'Munka-Ljungby', 'Munkedal', 'Munkfors', 'Munktorp', 'Muskö', 'Myckle', 'Myggenäs', 'Myresjö', 'Myrviken', 'Mysingsö', 'Mysterna', 'Målerås', 'Målilla', 'Målsryd', 'Månkarbo', 'Måttsund', 'Märsta', 'Möklinta', 'Mölle', 'Mölltorp', 'Mölnbo', 'Mölnlycke', 'Mönsterås', 'Mörarp', 'Mörbylånga', 'Mörlunda', 'Mörrum', 'Mörsil', 'Mörtnäs',
        'Naglarby och Enbacka', 'Nedansjö', 'Nedre Gärdsjö', 'Nikkala', 'Nissafors', 'Nitta', 'Njurundabommen', 'Njutånger', 'Nogersund', 'Nolvik', 'Nora', 'Norberg', 'Nordanö', 'Nordingrå', 'Nordkroken', 'Nordmaling', 'Nordmark', 'Nore', 'Norje', 'Norr Amsberg', 'Norra Bro', 'Norra Lagnö', 'Norra Riksten', 'Norra Rörum', 'Norra Visby', 'Norra Åsum', 'Norrfjärden', 'Norr-Hede', 'Norrhult-Klavreström', 'Norrköping', 'Norrlandet', 'Norrskedika', 'Norrsundet', 'Norrtälje', 'Norrö', 'Norsesund', 'Norsholm', 'Norsjö', 'Nossebro', 'Nusnäs', 'Nya Långenäs', 'Nyborg', 'Nybro', 'Nybrostrand', 'Nygård', 'Nygårds hagar', 'Nyhammar', 'Nykil', 'Nykroppa', 'Nykvarn', 'Nykyrka', 'Nyköping', 'Nyland', 'Nymölla', 'Nynäshamn', 'Nås', 'Nälden', 'Näs bruk', 'Nässjö', 'Näsum', 'Näsviken', 'Näsviken', 'Näsåker', 'Nättraby', 'Nävekvarn', 'Nävragöl', 'Nöbbele', 'Nödinge-Nol',
        'Obbola', 'Ockelbo', 'Odensbacken', 'Odensberg', 'Odensjö', 'Oleby', 'Olofstorp', 'Olofström', 'Olsfors', 'Olshammar', 'Olstorp', 'Onsala', 'Onslunda', 'Ope', 'Optand', 'Ormanäs och Stanstorp', 'Ornäs', 'Orrefors', 'Orrviken', 'Orsa', 'Osby', 'Osbyholm', 'Oskar-Fredriksborg', 'Oskarshamn', 'Oskarström', 'Ostvik', 'Otterbäcken', 'Ovanåker', 'Ovesholm', 'Oxelösund', 'Oxie',
        'Pajala', 'Parksidan', 'Pauliström', 'Persberg', 'Persbo', 'Pershagen', 'Perstorp', 'Persön', 'Pilgrimstad', 'Piperskärr', 'Piteå', 'Porjus', 'Pukavik', 'Påarp', 'Pålsboda', 'Påläng', 'Påryd', 'Påskallavik',
        'Rabbalshede', 'Raksta', 'Ramdala', 'Ramnäs', 'Ramsberg', 'Ramsele', 'Ramstalund', 'Ramvik', 'Ransta', 'Rappestad', 'Reftele', 'Rejmyre', 'Rengsjö', 'Repbäcken', 'Resarö', 'Revingeby', 'Riala', 'Riddarhyttan', 'Rimbo', 'Rimforsa', 'Ringarum', 'Ringsegård', 'Rinkaby', 'Rinkabyholm', 'Risögrund', 'Rixö', 'Robertsfors', 'Rockhammar', 'Rockneby', 'Roknäs', 'Rolfhamre och Måga', 'Rolfs', 'Rolfstorp', 'Roma kyrkby (Lövsta)', 'Roma (Romakloster)', 'Ronneby', 'Ronnebyhamn', 'Rosenfors', 'Rosenlund', 'Rosersberg', 'Rossön', 'Rosvik', 'Rot', 'Roteberg', 'Rottne', 'Rottneros', 'Ruda', 'Rundvik', 'Runemo', 'Runhällen', 'Runtuna', 'Rusksele', 'Rutvik', 'Rya', 'Ryd', 'Rydaholm', 'Rydal', 'Rydbo', 'Rydboholm', 'Rydebäck', 'Rydsgård', 'Rydsnäs', 'Rydöbruk', 'Ryssby', 'Råby', 'Råda', 'Råneå', 'Rångedala', 'Rånnaväg', 'Rånäs', 'Rälla', 'Rängs sand', 'Ränneslöv', 'Rättarboda', 'Rättvik', 'Rävemåla', 'Rävlanda', 'Röbäck', 'Röda holme', 'Rödbo', 'Rödeby', 'Röfors', 'Röke', 'Rönneshytta', 'Rönnäng', 'Rörvik', 'Rörö', 'Röstånga',
        'Sala', 'Salbohed', 'Saleby', 'Saltsjöbaden', 'Saltvik', 'Sandared', 'Sandarne', 'Sandhem', 'Sandhult', 'Sandskogen', 'Sandslån', 'Sandviken', 'Sandviken', 'Sangis', 'Sankt Olof', 'Sannahed', 'Saxdalen', 'Saxtorpsskogen', 'Segersta', 'Segersäng', 'Segmon', 'Selja', 'Sennan', 'Seskarö', 'Sexdrega', 'Sibbhult', 'Sibble', 'Sibo', 'Sidensjö', 'Sifferbo', 'Sigtuna', 'Siljansnäs', 'Silverdalen', 'Simlångsdalen', 'Simonstorp', 'Simris', 'Simrishamn', 'Sjuhalla', 'Sjulsmark', 'Sjunnen', 'Sjuntorp', 'Sjöberg', 'Sjöbo', 'Sjöbo sommarby och Svansjö sommarby', 'Sjödiken', 'Sjögestad', 'Sjömarken', 'Sjörröd', 'Sjösa', 'Sjötorp', 'Sjövik', 'Skagersvik', 'Skanör med Falsterbo', 'Skara', 'Skattkärr', 'Skattungbyn', 'Skavkulla och Skillingenäs', 'Skebobruk', 'Skeda udde', 'Skedala', 'Skede', 'Skedvi kyrkby', 'Skee', 'Skegrie', 'Skelleftehamn', 'Skellefteå', 'Skepparkroken', 'Skepplanda', 'Skeppsdalsström', 'Skeppshult', 'Skillingaryd', 'Skillinge', 'Skinnskatteberg', 'Skivarp', 'Skoby', 'Skog', 'Skoghall', 'Skogsby', 'Skogstorp', 'Skogstorp', 'Skottorp', 'Skottsund', 'Skrea', 'Skreanäs', 'Skriketorp', 'Skruv', 'Skultorp', 'Skultuna', 'Skummeslövsstrand', 'Skumparp', 'Skurup', 'Skutskär', 'Skyttorp', 'Skånes-Fagerhult', 'Skåpafors', 'Skåre', 'Skällinge', 'Skänninge', 'Skärblacka', 'Skärgårdsstad', 'Skärhamn', 'Skärplinge', 'Skärstad', 'Sköldinge', 'Sköllersta', 'Skölsta', 'Skövde', 'Slaka', 'Slite', 'Slottsbron', 'Slottsskogen', 'Slöinge', 'Smedby', 'Smedjebacken', 'Smedstorp', 'Smygehamn', 'Smålandsstenar', 'Smögen', 'Snöveltorp', 'Solberga', 'Solberga', 'Sollebrunn', 'Sollefteå', 'Sollerön', 'Solsidan', 'Solvarbo', 'Sommen', 'Sonstorp', 'Sorsele', 'Sorunda', 'Sparreholm', 'Spjutsbygd', 'Spångsholm', 'Staffanstorp', 'Stallarholmen', 'Stamsjö', 'Starrkärr och Näs', 'Stava', 'Stavreviken', 'Stavsjö', 'Stavsnäs', 'Stehag', 'Stenared', 'Stenhamra', 'Steninge', 'Stensele', 'Stensjön', 'Stenstorp', 'Stensund och Krymla', 'Stenungsund', 'Stenungsön', 'Sticklinge udde', 'Stidsvig', 'Stigen', 'Stigtomta', 'Stjärnhov', 'Stoby', 'Stocka', 'Stockamöllan', 'Stockaryd', 'Stockholm', 'Stockvik', 'Stora Bugärde', 'Stora Dyrön', 'Stora Herrestad', 'Stora Höga', 'Stora Levene', 'Stora Mellby', 'Stora Mellösa', 'Stora Vika', 'Storebro', 'Storfors', 'Storuman', 'Storvik', 'Storvreta', 'Storå', 'Strandhugget', 'Strandnorum', 'Striberg', 'Strålsnäs', 'Strångsjö', 'Stråssa', 'Strängnäs', 'Strömma', 'Strömsbruk', 'Strömsfors', 'Strömsholm', 'Strömsnäsbruk', 'Strömstad', 'Strömsund', 'Strövelstorp', 'Stugun', 'Sturefors', 'Sturkö', 'Styrsö', 'Stånga', 'Stångby', 'Ställdalen', 'Stöcke', 'Stöcksjö', 'Stöde', 'Stöllet', 'Stöpen', 'Sulvik', 'Sund', 'Sundborn', 'Sundby', 'Sundbyholm', 'Sundhultsbrunn', 'Sundsbruk', 'Sundsvall', 'Sunnansjö', 'Sunne', 'Sunnemo', 'Sunningen', 'Surahammar', 'Surte', 'Svalsta', 'Svalöv', 'Svanberga', 'Svanesund', 'Svanskog', 'Svanvik', 'Svappavaara', 'Svartbyn', 'Svarte', 'Svartvik', 'Svartå', 'Svedala', 'Sveg', 'Svenljunga', 'Svensbyn', 'Svenshögen', 'Svenstavik', 'Svenstorp', 'Svinninge', 'Svängsta', 'Svärdsjö', 'Svärtinge', 'Sya', 'Sysslebäck', 'Sågmyra', 'Säffle', 'Sälen', 'Sälgsjön', 'Särna', 'Särö', 'Säter', 'Sätila', 'Sätofta', 'Sätra brunn', 'Sävar', 'Sävast', 'Säve', 'Sävja', 'Sävsjö', 'Söderala', 'Söderby', 'Söderby-Karl', 'Söderbärke', 'Söderfors', 'Söderhamn', 'Söderköping', 'Söderskogen', 'Södersvik', 'Södertälje', 'Söderåkra', 'Södra Bergsbyn och Stackgrönnan', 'Södra Klagshamn', 'Södra Näs', 'Södra Sandby', 'Södra Sunderbyn', 'Södra Vi', 'Södra Vrams fälad', 'Sölvesborg', 'Sörfors', 'Sörforsa', 'Sörmjöle', 'Sörstafors', 'Sörvik', 'Söråker', 'Sösdala', 'Sövde', 'Sövestad',
        'Taberg', 'Tahult', 'Tallvik', 'Tallåsen', 'Tandsbyn', 'Tanumshede', 'Tavelsjö', 'Teckomatorp', 'Tenhult', 'Tibro', 'Tidaholm', 'Tidan', 'Tidö-Lindö', 'Tierp', 'Tillberga', 'Timmele', 'Timmernabben', 'Timmersdala', 'Timrå', 'Timsfors', 'Tingsryd', 'Tingstäde', 'Tjautjas/Cavccas', 'Tjuvkil', 'Tjällmo', 'Tjörnarp', 'Toarp', 'Tobo', 'Tofta', 'Toftbyn', 'Tollarp', 'Tollered', 'Tomelilla', 'Torarp', 'Torbjörntorp', 'Torekov', 'Torestorp', 'Torhamn', 'Tormestorp', 'Torna Hällestad', 'Torpsbruk', 'Torpshammar', 'Torreby', 'Torsby', 'Torsby', 'Torsebro', 'Torshälla', 'Torshälla huvud', 'Torsåker', 'Torsång', 'Torsås', 'Tortuna', 'Torup', 'Tosseryd', 'Totebo', 'Totra', 'Tranemo', 'Tranholmen', 'Transtrand', 'Tranås', 'Traryd', 'Trekanten', 'Trelleborg', 'Trollhättan', 'Trosa', 'Trulsegården', 'Trångsviken', 'Tråvad', 'Trädet', 'Träslövsläge', 'Trödje', 'Trönninge', 'Trönninge', 'Tulebo', 'Tumba', 'Tumbo', 'Tumlehed', 'Tun', 'Tuna', 'Tuna', 'Tunadal', 'Tunnerstad', 'Tureholm', 'Tving', 'Tvååker', 'Tvärskog', 'Tvärålund', 'Tygelsjö', 'Tylösand', 'Tyringe', 'Tystberga', 'Tågarp', 'Tånga och Rögle', 'Tångaberg', 'Täby', 'Täfteå', 'Täljö', 'Tällberg', 'Tärnaby', 'Tärnsjö', 'Tävelsås', 'Töcksfors', 'Töllsjö', 'Töre', 'Töreboda', 'Törestorp', 'Tösse',
        'Ucklum', 'Uddebo', 'Uddeholm', 'Uddevalla', 'Uddheden', 'Ullared', 'Ullatti', 'Ullervad', 'Ullånger', 'Ulricehamn', 'Ulrika', 'Ulvkälla', 'Ulvåker', 'Umeå', 'Unbyn', 'Undenäs', 'Undersåker', 'Unnaryd', 'Upphärad', 'Upplanda', 'Upplands Väsby', 'Uppsala', 'Urshult', 'Ursviken', 'Utansjö', 'Utby', 'Utvälinge',
        'Vad', 'Vadstena', 'Vaggeryd', 'Vagnhärad', 'Valbo', 'Valdemarsvik', 'Valje', 'Valla', 'Vallargärdet', 'Vallberga', 'Vallda', 'Vallentuna', 'Vallsta', 'Vallvik', 'Vallåkra', 'Valskog', 'Vankiva', 'Vannsätter', 'Vansbro', 'Vansö kyrkby', 'Vaplan', 'Vara', 'Varberg', 'Varekil', 'Vargön', 'Varnhem', 'Vartofta', 'Vassbäck', 'Vassmolösa', 'Vattholma', 'Vattjom', 'Vattnäs', 'Vattubrinken', 'Vaxholm', 'Veberöd', 'Veddige', 'Vedevåg', 'Vedum', 'Vegby', 'Veinge', 'Vejbystrand', 'Velanda', 'Vellinge', 'Vemdalen', 'Vena', 'Venjan', 'Vessigebro', 'Vetlanda', 'Vi', 'Vibble', 'Viby', 'Vickleby', 'Vidja', 'Vidsel', 'Vidöåsen', 'Vik', 'Vika', 'Vikarbyn', 'Viken', 'Vikingstad', 'Vikmanshyttan', 'Viksjöfors', 'Viksäter', 'Vilhelmina', 'Villshärad', 'Vilshult', 'Vimmerby', 'Vinberg', 'Vinbergs kyrkby', 'Vindeln', 'Vingåker', 'Vinninga', 'Vinnö', 'Vinslöv', 'Vintrie', 'Vintrosa', 'Vinäs', 'Virsbo', 'Virserum', 'Visby', 'Viskafors', 'Vislanda', 'Vissefjärda', 'Vistträsk', 'Vitaby', 'Vittangi', 'Vittaryd', 'Vittinge', 'Vittjärv', 'Vittsjö', 'Vittskövle', 'Vollsjö', 'Vrena', 'Vretstorp', 'Vrigstad', 'Vrångö', 'Vuollerim', 'Vålberg', 'Våmhus', 'Vånga', 'Vårdsätra', 'Vårgårda', 'Vårsta', 'Våxtorp', 'Väckelsång', 'Väderstad', 'Väggarp', 'Väjern', 'Väländan', 'Vänersborg', 'Väne-Åsaka', 'Vänge', 'Vännäs', 'Vännäsby', 'Väring', 'Värmdö-Evlinge', 'Värmlandsbro', 'Värnamo', 'Värsås', 'Väröbacka', 'Väse', 'Väskinde', 'Västanvik', 'Västerberg', 'Västerby', 'Västerfärnebo', 'Västerhaninge', 'Västerhejde', 'Västerhus', 'Västerljung', 'Västerlösa', 'Västermyckeläng', 'Västervik', 'Västerås', 'Västibyn', 'Västra Bispgården', 'Västra Bodarna', 'Västra Hagen', 'Västra Husby', 'Västra Ingelstad', 'Västra Karaby', 'Västra Karup', 'Västra Klagstorp', 'Västra Tommarp', 'Västra Ämtervik', 'Växjö',
        'Yngsjö', 'Ysby', 'Ystad', 'Ytterhogdal', 'Ytternäs och Vreta', 'Yttersjö', 'Ytterån',
        'Zinkgruvan',
        'Åby', 'Åby', 'Åbyggeby', 'Åbytorp', 'Åhus', 'Åkarp', 'Åkers styckebruk', 'Åkersberga', 'Ålberga', 'Åled', 'Ålem', 'Åmmeberg', 'Åmot', 'Åmotfors', 'Åmsele', 'Åmynnet', 'Åmål', 'Ånge', 'Ånäset', 'Åre', 'Årjäng', 'Årstad', 'Årsunda', 'Åryd', 'Åryd', 'Ås', 'Ås', 'Åsa', 'Åsarne', 'Åsarp', 'Åsbro', 'Åsby', 'Åseda', 'Åsele', 'Åselstad', 'Åsen', 'Åsenhöga', 'Åsensbruk', 'Åshammar', 'Åsljunga', 'Åstol', 'Åstorp', 'Återvall', 'Åtorp', 'Åtvidaberg',
        'Älandsbro', 'Älgarås', 'Älghult', 'Älmhult', 'Älmsta', 'Älta', 'Älvdalen', 'Älvkarleby', 'Älvnäs', 'Älvsbyn', 'Älvsered', 'Älvängen', 'Äng', 'Änge', 'Ängelholm', 'Ängsholmen', 'Ängsvik', 'Äppelbo', 'Ärla', 'Äsköping', 'Äspered', 'Äsperöd', 'Ätran',
        'Öbonäs', 'Öckerö', 'Ödeborg', 'Ödeshög', 'Ödsmål', 'Ödåkra', 'Öggestorp', 'Öjersjö', 'Ölmanäs', 'Ölmbrotorp', 'Ölme', 'Ölmstad', 'Ölsta', 'Önneköp', 'Önnestad', 'Örbyhus', 'Örebro', 'Öregrund', 'Örkelljunga', 'Örnsköldsvik', 'Örserum', 'Örsjö', 'Örslösa', 'Örsundsbro', 'Örtagården', 'Örtofta', 'Örviken', 'Ösmo', 'Östadkulle', 'Östansjö', 'Östavall', 'Österbybruk', 'Österbymo', 'Österforse', 'Österfärnebo', 'Österhagen och Bergliden', 'Österslöv', 'Österstad', 'Östersund', 'Östervåla', 'Östhammar', 'Östhamra', 'Östmark', 'Östnor', 'Östorp och Ådran', 'Östra Bispgården', 'Östra Frölunda', 'Östra Grevie', 'Östra Husby', 'Östra Kallfors', 'Östra Karup', 'Östra Ljungby', 'Östra Ryd', 'Östra Sönnarslöv', 'Östra Tommarp', 'Östra Ånneröd', 'Östraby', 'Överboda', 'Överhörnäs', 'Överkalix', 'Överlida', 'Övertorneå', 'Överum', 'Övre Soppero', 'Övre Svartlå', 'Öxabäck', 'Öxeryd'
    );

    protected static $cityFormats = array(
        '{{cityName}}'
    );

    protected static $state = array();

    protected static $stateAbbr = array();

    protected static $country = array(
        'Afghanistan', 'Albanien', 'Algeriet', 'Amerikanska Jungfruöarna', 'Amerikanska Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarktis', 'Antigua och Barbuda', 'Argentina', 'Armenien', 'Aruba', 'Australien', 'Azerbajdzjan',
        'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belgien', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnien och Hercegovina', 'Botswana', 'Bouvetön', 'Brasilien', 'Brittiska Indiska oceanöarna', 'Brittiska Jungfruöarna', 'Brunei', 'Bulgarien', 'Burkina Faso', 'Burundi',
        'Caymanöarna', 'Centralafrikanska republiken', 'Chile', 'Colombia', 'Cooköarna', 'Costa Rica', 'Cypern',
        'Danmark', 'Djibouti', 'Dominica', 'Dominikanska republiken',
        'Ecuador', 'Egypten', 'Ekvatorialguinea', 'El Salvador', 'Elfenbenskusten', 'Eritrea', 'Estland', 'Etiopien',
        'Falklandsöarna', 'Fiji', 'Filippinerna', 'Finland', 'Frankrike', 'Franska Guyana', 'Franska Polynesien', 'Franska Sydterritorierna', 'Färöarna', 'Förenade Arabemiraten',
        'Gabon', 'Gambia', 'Georgien', 'Ghana', 'Gibraltar', 'Grekland', 'Grenada', 'Grönland', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana',
        'Haiti', 'Heard- och McDonaldöarna', 'Honduras', 'Hongkong (S.A.R. Kina)',
        'Indien', 'Indonesien', 'Irak', 'Iran', 'Irland', 'Island', 'Isle of Man', 'Israel', 'Italien',
        'Jamaica', 'Japan', 'Jemen', 'Jersey', 'Jordanien', 'Julön',
        'Kambodja', 'Kamerun', 'Kanada', 'Kap Verde', 'Kazakstan', 'Kenya', 'Kina', 'Kirgizistan', 'Kiribati', 'Kokosöarna', 'Komorerna', 'Kongo-Brazzaville', 'Kongo-Kinshasa', 'Kroatien', 'Kuba', 'Kuwait',
        'Laos', 'Lesotho', 'Lettland', 'Libanon', 'Liberia', 'Libyen', 'Liechtenstein', 'Litauen', 'Luxemburg',
        'Macao (S.A.R. Kina)', 'Madagaskar', 'Makedonien', 'Malawi', 'Malaysia', 'Maldiverna', 'Mali', 'Malta', 'Marocko', 'Marshallöarna', 'Martinique', 'Mauretanien', 'Mauritius', 'Mayotte', 'Mexiko', 'Mikronesien', 'Moldavien', 'Monaco', 'Mongoliet', 'Montenegro', 'Montserrat', 'Moçambique', 'Myanmar',
        'Namibia', 'Nauru', 'Nederländerna', 'Nederländska Antillerna', 'Nepal', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Nordkorea', 'Nordmarianerna', 'Norfolkön', 'Norge', 'Nya Kaledonien', 'Nya Zeeland',
        'Oman',
        'Pakistan', 'Palau', 'Palestinska territoriet', 'Panama', 'Papua Nya Guinea', 'Paraguay', 'Peru', 'Pitcairn', 'Polen', 'Portugal', 'Puerto Rico',
        'Qatar',
        'Rumänien', 'Rwanda', 'Ryssland', 'Réunion',
        'S:t Barthélemy', 'S:t Helena', 'S:t Kitts och Nevis', 'S:t Lucia', 'S:t Martin', 'S:t Pierre och Miquelon', 'S:t Vincent och Grenadinerna', 'Salomonöarna', 'Samoa', 'San Marino', 'Saudiarabien', 'Schweiz', 'Senegal', 'Serbien', 'Serbien och Montenegro', 'Seychellerna', 'Sierra Leone', 'Singapore', 'Slovakien', 'Slovenien', 'Somalia', 'Spanien', 'Sri Lanka', 'Storbritannien', 'Sudan', 'Surinam', 'Svalbard och Jan Mayen', 'Sverige', 'Swaziland', 'Sydafrika', 'Sydgeorgien och Södra Sandwichöarna', 'Sydkorea', 'Syrien', 'São Tomé och Príncipe',
        'Tadzjikistan', 'Taiwan', 'Tanzania', 'Tchad', 'Thailand', 'Tjeckien', 'Togo', 'Tokelau', 'Tonga', 'Trinidad och Tobago', 'Tunisien', 'Turkiet', 'Turkmenistan', 'Turks- och Caicosöarna', 'Tuvalu', 'Tyskland',
        'USA', 'USA:s yttre öar', 'Uganda', 'Ukraina', 'Ungern', 'Uruguay', 'Uzbekistan',
        'Vanuatu', 'Vatikanstaten', 'Venezuela', 'Vietnam', 'Vitryssland', 'Västsahara', 'Wallis- och Futunaöarna',
        'Zambia', 'Zimbabwe',
        'Åland',
        'Österrike', 'Östtimor'
    );

    /**
     * @var array Swedish street name formats
     */
    protected static $streetNameFormats = array(
        '{{lastName}}{{streetSuffix}}',
        '{{lastName}}{{streetSuffix}}',
        '{{firstName}}{{streetSuffix}}',
        '{{firstName}}{{streetSuffix}}',
        '{{streetPrefix}}{{streetSuffix}}',
        '{{streetPrefix}}{{streetSuffix}}',
        '{{streetPrefix}}{{streetSuffix}}',
        '{{streetPrefix}}{{streetSuffix}}',
        '{{lastName}} {{streetSuffixWord}}'
    );

    /**
     * @var array Swedish street address formats
     */
    protected static $streetAddressFormats = array(
        '{{streetName}} {{buildingNumber}}'
    );

    /**
     * @var array Swedish address formats
     */
    protected static $addressFormats = array(
        "{{streetAddress}}\n{{postcode}} {{city}}"
    );

    /**
     * Randomly return a real city name
     *
     * @return string
     */
    public static function cityName()
    {
        return static::randomElement(static::$cityNames);
    }

    public static function streetSuffixWord()
    {
        return static::randomElement(static::$streetSuffixWord);
    }

    public static function streetPrefix()
    {
        return static::randomElement(static::$streetPrefix);
    }

    /**
     * Randomly return a building number.
     *
     * @return string
     */
    public static function buildingNumber()
    {
        return static::toUpper(static::bothify(static::randomElement(static::$buildingNumber)));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Formatter;

use Monolog\Logger;

class ChromePHPFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Monolog\Formatter\ChromePHPFormatter::format
     */
    public function testDefaultFormat()
    {
        $formatter = new ChromePHPFormatter();
        $record = array(
            'level' => Logger::ERROR,
            'level_name' => 'ERROR',
            'channel' => 'meh',
            'context' => array('from' => 'logger'),
            'datetime' => new \DateTime("@0"),
            'extra' => array('ip' => '127.0.0.1'),
            'message' => 'log',
        );

        $message = $formatter->format($record);

        $this->assertEquals(
            array(
                'meh',
                array(
                    'message' => 'log',
                    'context' => array('from' => 'logger'),
                    'extra' => array('ip' => '127.0.0.1'),
                ),
                'unknown',
                'error',
            ),
            $message
        );
    }

    /**
     * @covers Monolog\Formatter\ChromePHPFormatter::format
     */
    public function testFormatWithFileAndLine()
    {
        $formatter = new ChromePHPFormatter();
        $record = array(
            'level' => Logger::CRITICAL,
            'level_name' => 'CRITICAL',
            'channel' => 'meh',
            'context' => array('from' => 'logger'),
            'datetime' => new \DateTime("@0"),
            'extra' => array('ip' => '127.0.0.1', 'file' => 'test', 'line' => 14),
            'message' => 'log',
        );

        $message = $formatter->format($record);

        $this->assertEquals(
            array(
                'meh',
                array(
                    'message' => 'log',
                    'context' => array('from' => 'logger'),
                    'extra' => array('ip' => '127.0.0.1'),
                ),
                'test : 14',
                'error',
            ),
            $message
        );
    }

    /**
     * @covers Monolog\Formatter\ChromePHPFormatter::format
     */
    public function testFormatWithoutContext()
    {
        $formatter = new ChromePHPFormatter();
        $record = array(
            'level' => Logger::DEBUG,
            'level_name' => 'DEBUG',
            'channel' => 'meh',
            'context' => array(),
            'datetime' => new \DateTime("@0"),
            'extra' => array(),
            'message' => 'log',
        );

        $message = $formatter->format($record);

        $this->assertEquals(
            array(
                'meh',
                'log',
                'unknown',
                'log',
            ),
            $message
        );
    }

    /**
     * @covers Monolog\Formatter\ChromePHPFormatter::formatBatch
     */
    public function testBatchFormatThrowException()
    {
        $formatter = new ChromePHPFormatter();
        $records = array(
            array(
                'level' => Logger::INFO,
                'level_name' => 'INFO',
                'channel' => 'meh',
                'context' => array(),
                'datetime' => new \DateTime("@0"),
                'extra' => array(),
                'message' => 'log',
            ),
            array(
                'level' => Logger::WARNING,
                'level_name' => 'WARNING',
                'channel' => 'foo',
                'context' => array(),
                'datetime' => new \DateTime("@0"),
                'extra' => array(),
                'message' => 'log2',
            ),
        );

        $this->assertEquals(
            array(
                array(
                    'meh',
                    'log',
                    'unknown',
                    'info',
                ),
                array(
                    'foo',
                    'log2',
                    'unknown',
                    'warn',
                ),
            ),
            $formatter->formatBatch($records)
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

namespace Illuminate\Contracts\Mail;

use Illuminate\Contracts\Queue\Factory as Queue;

interface Mailable
{
    /**
     * Send the message using the given mailer.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send(Mailer $mailer);

    /**
     * Queue the given message.
     *
     * @param  \Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function queue(Queue $queue);

    /**
     * Deliver the queued message after the given delay.
     *
     * @param  \DateTime|int  $delay
     * @param  \Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function later($delay, Queue $queue);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PHPUnit\Framework\TestCase;

class ClassTest extends TestCase
{
    public function testIsAbstract() {
        $class = new Class_('Foo', ['type' => Class_::MODIFIER_ABSTRACT]);
        $this->assertTrue($class->isAbstract());

        $class = new Class_('Foo');
        $this->assertFalse($class->isAbstract());
    }

    public function testIsFinal() {
        $class = new Class_('Foo', ['type' => Class_::MODIFIER_FINAL]);
        $this->assertTrue($class->isFinal());

        $class = new Class_('Foo');
        $this->assertFalse($class->isFinal());
    }

    public function testGetMethods() {
        $methods = [
            new ClassMethod('foo'),
            new ClassMethod('bar'),
            new ClassMethod('fooBar'),
        ];
        $class = new Class_('Foo', [
            'stmts' => [
                new TraitUse([]),
                $methods[0],
                new ClassConst([]),
                $methods[1],
                new Property(0, []),
                $methods[2],
            ]
        ]);

        $this->assertSame($methods, $class->getMethods());
    }

    public function testGetMethod() {
        $methodConstruct = new ClassMethod('__CONSTRUCT');
        $methodTest = new ClassMethod('test');
        $class = new Class_('Foo', [
            'stmts' => [
                new ClassConst([]),
                $methodConstruct,
                new Property(0, []),
                $methodTest,
            ]
        ]);

        $this->assertSame($methodConstruct, $class->getMethod('__construct'));
        $this->assertSame($methodTest, $class->getMethod('test'));
        $this->assertNull($class->getMethod('nonExisting'));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php
namespace Hamcrest\Core;

/*
 Copyright (c) 2009 hamcrest.org
 */
use Hamcrest\BaseMatcher;
use Hamcrest\Description;

/**
 * A matcher that always returns <code>true</code>.
 */
class IsAnything extends BaseMatcher
{

    private $_message;

    public function __construct($message = 'ANYTHING')
    {
        $this->_message = $message;
    }

    public function matches($item)
    {
        return true;
    }

    public function describeTo(Description $description)
    {
        $description->appendText($this->_message);
    }

    /**
     * This matcher always evaluates to true.
     *
     * @param string $description A meaningful string used when describing itself.
     *
     * @return \Hamcrest\Core\IsAnything
     * @factory
     */
    public static function anything($description = 'ANYTHING')
    {
        return new self($description);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestFailure;

class IsEqualTest extends ConstraintTestCase
{
    public function testConstraintIsEqual(): void
    {
        $constraint = new IsEqual(1);

        $this->assertTrue($constraint->evaluate(1, '', true));
        $this->assertFalse($constraint->evaluate(0, '', true));
        $this->assertEquals('is equal to 1', $constraint->toString());
        $this->assertCount(1, $constraint);

        try {
            $constraint->evaluate(0);
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
Failed asserting that 0 matches expected 1.

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    /**
     * @dataProvider isEqualProvider
     */
    public function testConstraintIsEqual2($expected, $actual, $message): void
    {
        $constraint = new IsEqual($expected);

        try {
            $constraint->evaluate($actual, 'custom message');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                "custom message\n$message",
                $this->trimnl(TestFailure::exceptionToString($e))
            );

            return;
        }

        $this->fail();
    }

    public function isEqualProvider()
    {
        $a      = new \stdClass;
        $a->foo = 'bar';
        $b      = new \stdClass;
        $ahash  = \spl_object_hash($a);
        $bhash  = \spl_object_hash($b);

        $c               = new \stdClass;
        $c->foo          = 'bar';
        $c->int          = 1;
        $c->array        = [0, [1], [2], 3];
        $c->related      = new \stdClass;
        $c->related->foo = "a\nb\nc\nd\ne\nf\ng\nh\ni\nj\nk";
        $c->self         = $c;
        $c->c            = $c;
        $d               = new \stdClass;
        $d->foo          = 'bar';
        $d->int          = 2;
        $d->array        = [0, [4], [2], 3];
        $d->related      = new \stdClass;
        $d->related->foo = "a\np\nc\nd\ne\nf\ng\nh\ni\nw\nk";
        $d->self         = $d;
        $d->c            = $c;

        $storage1 = new \SplObjectStorage;
        $storage1->attach($a);
        $storage1->attach($b);
        $storage2 = new \SplObjectStorage;
        $storage2->attach($b);
        $storage1hash = \spl_object_hash($storage1);
        $storage2hash = \spl_object_hash($storage2);

        $dom1                     = new \DOMDocument;
        $dom1->preserveWhiteSpace = false;
        $dom1->loadXML('<root></root>');
        $dom2                     = new \DOMDocument;
        $dom2->preserveWhiteSpace = false;
        $dom2->loadXML('<root><foo/></root>');

        return [
            [1, 0, <<<EOF
Failed asserting that 0 matches expected 1.

EOF
            ],
            [1.1, 0, <<<EOF
Failed asserting that 0 matches expected 1.1.

EOF
            ],
            ['a', 'b', <<<EOF
Failed asserting that two strings are equal.
--- Expected
+++ Actual
@@ @@
-'a'
+'b'

EOF
            ],
            ["a\nb\nc\nd\ne\nf\ng\nh\ni\nj\nk", "a\np\nc\nd\ne\nf\ng\nh\ni\nw\nk", <<<EOF
Failed asserting that two strings are equal.
--- Expected
+++ Actual
@@ @@
 'a\\n
-b\\n
+p\\n
 c\\n
 d\\n
 e\\n
@@ @@
 g\\n
 h\\n
 i\\n
-j\\n
+w\\n
 k'

EOF
            ],
            [1, [0], <<<EOF
Array (...) does not match expected type "integer".

EOF
            ],
            [[0], 1, <<<EOF
1 does not match expected type "array".

EOF
            ],
            [[0], [1], <<<EOF
Failed asserting that two arrays are equal.
--- Expected
+++ Actual
@@ @@
 Array (
-    0 => 0
+    0 => 1
 )

EOF
            ],
            [[true], ['true'], <<<EOF
Failed asserting that two arrays are equal.
--- Expected
+++ Actual
@@ @@
 Array (
-    0 => true
+    0 => 'true'
 )

EOF
            ],
            [[0, [1], [2], 3], [0, [4], [2], 3], <<<EOF
Failed asserting that two arrays are equal.
--- Expected
+++ Actual
@@ @@
 Array (
     0 => 0
     1 => Array (
-        0 => 1
+        0 => 4
     )
     2 => Array (...)
     3 => 3
 )

EOF
            ],
            [$a, [0], <<<EOF
Array (...) does not match expected type "object".

EOF
            ],
            [[0], $a, <<<EOF
stdClass Object (...) does not match expected type "array".

EOF
            ],
            [$a, $b, <<<EOF
Failed asserting that two objects are equal.
--- Expected
+++ Actual
@@ @@
 stdClass Object (
-    'foo' => 'bar'
 )

EOF
            ],
            [$c, $d, <<<EOF
Failed asserting that two objects are equal.
--- Expected
+++ Actual
@@ @@
 stdClass Object (
     'foo' => 'bar'
-    'int' => 1
+    'int' => 2
     'array' => Array (
         0 => 0
         1 => Array (
-            0 => 1
+            0 => 4
         )
         2 => Array (...)
         3 => 3
@@ @@
     )
     'related' => stdClass Object (
         'foo' => 'a\\n
-        b\\n
+        p\\n
         c\\n
         d\\n
         e\\n
@@ @@
         g\\n
         h\\n
         i\\n
-        j\\n
+        w\\n
         k'
     )
     'self' => stdClass Object (...)
     'c' => stdClass Object (...)
 )

EOF
            ],
            [$dom1, $dom2, <<<EOF
Failed asserting that two DOM documents are equal.
--- Expected
+++ Actual
@@ @@
 <?xml version="1.0"?>
-<root/>
+<root>
+  <foo/>
+</root>

EOF
            ],
            [
                new \DateTime('2013-03-29 04:13:35', new \DateTimeZone('America/New_York')),
                new \DateTime('2013-03-29 04:13:35', new \DateTimeZone('America/Chicago')),
                <<<EOF
Failed asserting that two DateTime objects are equal.
--- Expected
+++ Actual
@@ @@
-2013-03-29T04:13:35.000000-0400
+2013-03-29T04:13:35.000000-0500

EOF
            ],
            [$storage1, $storage2, <<<EOF
Failed asserting that two objects are equal.
--- Expected
+++ Actual
@@ @@
-SplObjectStorage Object &$storage1hash (
-    '$ahash' => Array &0 (
-        'obj' => stdClass Object &$ahash (
-            'foo' => 'bar'
-        )
-        'inf' => null
-    )
-    '$bhash' => Array &1 (
+SplObjectStorage Object &$storage2hash (
+    '$bhash' => Array &0 (
         'obj' => stdClass Object &$bhash ()
         'inf' => null
     )
 )

EOF
            ],
        ];
    }

    /**
     * Removes spaces in front of newlines
     *
     * @param string $string
     *
     * @return string
     */
    private function trimnl($string)
    {
        return \preg_replace('/[ ]*\n/', "\n", $string);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  {
    "name": "symfony/css-selector",
    "type": "library",
    "description": "Symfony CssSelector Component",
    "keywords": [],
    "homepage": "https://symfony.com",
    "license": "MIT",
    "authors": [
        {
            "name": "Fabien Potencier",
            "email": "fabien@symfony.com"
        },
        {
            "name": "Jean-François Simon",
            "email": "jeanfrancois.simon@sensiolabs.com"
        },
        {
            "name": "Symfony Community",
            "homepage": "https://symfony.com/contributors"
        }
    ],
    "require": {
        "php": "^7.1.3"
    },
    "autoload": {
        "psr-4": { "Symfony\\Component\\CssSelector\\": "" },
        "exclude-from-classmap": [
            "/Tests/"
        ]
    },
    "minimum-stability": "dev",
    "extra": {
        "branch-alias": {
            "dev-master": "4.1-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// ensure that nested tags have no effect on the color of the '//' prefix
return function (InputInterface $input, OutputInterface $output) {
    $output->setDecorated(true);
    $output = new SymfonyStyle($input, $output);
    $output->comment(
        'Lorem ipsum dolor sit <comment>amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</comment> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum'
    );
};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  INDX( 	                 (   p  �       �                    �`    p \     �`    �G�b� })�_�b��G�b��       �                b u i l d - p h a r . s h     �`    p \     �`    ej�b� })�b��b�\j�b�       d               c o m p o s e r . j s o n     �`    ` J     �`    /��b� })�A/�b�,��b�                        d i s t       �`    X H     �`    g<�b� })�L��b�f<�b�                        l i b �`    ` P     �`    �ުb� }) z9�b��ުb�       J               L I C E N S E �`    ` L     �`    ��b� })����b���b�                        o t h e r     �`    x f     �`    ��b� })�C"�b���b��       �                p s a l m - a u t o l o a d . p h p   �`    h T     �`    .�b� })��E�b�.�b�X      T              	 p s a l m . x m l                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     Different float syntaxes
-----
<?php

0.0;
0.;
.0;
0e0;
0E0;
0e+0;
0e-0;
30.20e10;
300.200e100;
1e10000;

// various integer -> float overflows
// (all are actually the same number, just in different representations)
18446744073709551615;
0xFFFFFFFFFFFFFFFF;
01777777777777777777777;
0177777777777777777777787;
0b1111111111111111111111111111111111111111111111111111111111111111;
-----
array(
    0: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    1: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    2: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    3: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    4: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    5: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    6: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 0
        )
    )
    7: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 302000000000
        )
    )
    8: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 3.002E+102
        )
    )
    9: Stmt_Expression(
        expr: Scalar_DNumber(
            value: INF
        )
    )
    10: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 1.844674407371E+19
            comments: array(
                0: // various integer -> float overflows
                1: // (all are actually the same number, just in different representations)
            )
        )
        comments: array(
            0: // various integer -> float overflows
            1: // (all are actually the same number, just in different representations)
        )
    )
    11: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 1.844674407371E+19
        )
    )
    12: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 1.844674407371E+19
        )
    )
    13: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 1.844674407371E+19
        )
    )
    14: Stmt_Expression(
        expr: Scalar_DNumber(
            value: 1.844674407371E+19
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php
namespace Hamcrest\Arrays;

use Hamcrest\AbstractMatcherTest;

class IsArrayContainingTest extends AbstractMatcherTest
{

    protected function createMatcher()
    {
        return IsArrayContaining::hasItemInArray('irrelevant');
    }

    public function testMatchesAnArrayThatContainsAnElementMatchingTheGivenMatcher()
    {
        $this->assertMatches(
            hasItemInArray('a'),
            array('a', 'b', 'c'),
            "should matches array that contains 'a'"
        );
    }

    public function testDoesNotMatchAnArrayThatDoesntContainAnElementMatchingTheGivenMatcher()
    {
        $this->assertDoesNotMatch(
            hasItemInArray('a'),
            array('b', 'c'),
            "should not matches array that doesn't contain 'a'"
        );
        $this->assertDoesNotMatch(
            hasItemInArray('a'),
            array(),
            'should not match empty array'
        );
    }

    public function testDoesNotMatchNull()
    {
        $this->assertDoesNotMatch(
            hasItemInArray('a'),
            null,
            'should not match null'
        );
    }

    public function testHasAReadableDescription()
    {
        $this->assertDescription('an array containing "a"', hasItemInArray('a'));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <text:p xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0">
  <draw:frame xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" svg:width="12.567708175cm" svg:height="16.848541467cm" draw:style-name="Frame">
    <draw:text-box>
      <draw:frame svg:width="12.567708175cm" svg:height="15.848541467cm" draw:style-name="Image">
        <draw:image xmlns:xlink="notthesame" xlink:href="Pictures/kristian.jpg"/>
      </draw:frame>
      <text:p text:style-name="Text">Image <text:sequence xmlns:style="notthesame" text:ref-name="refImage1" style:num-format="1" text:formula="ooow:Image+1" text:name="Image">1</text:sequence>: Dette er en test caption</text:p>
    </draw:text-box>
  </draw:frame>
</text:p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Faker\Test\Provider\de_CH;

use Faker\Generator;
use Faker\Provider\de_CH\PhoneNumber;

class PhoneNumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Faker\Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new PhoneNumber($faker));
        $this->faker = $faker;
    }

    public function testPhoneNumber()
    {
        $this->assertRegExp('/^0\d{2} ?\d{3} ?\d{2} ?\d{2}|\+41 ?(\(0\))?\d{2} ?\d{3} ?\d{2} ?\d{2}$/', $this->faker->phoneNumber());
    }

    public function testMobileNumber()
    {
        $this->assertRegExp('/^07[56789] ?\d{3} ?\d{2} ?\d{2}$/', $this->faker->mobileNumber());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Illuminate\Queue;

use DateTimeInterface;
use Illuminate\Container\Container;
use Illuminate\Support\InteractsWithTime;

abstract class Queue
{
    use InteractsWithTime;

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * The encrypter implementation.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * The connection name for the queue.
     *
     * @var string
     */
    protected $connectionName;

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $queue
     * @param  string  $job
     * @param  mixed   $data
     * @return mixed
     */
    public function pushOn($queue, $job, $data = '')
    {
        return $this->push($job, $data, $queue);
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  string  $queue
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @return mixed
     */
    public function laterOn($queue, $delay, $job, $data = '')
    {
        return $this->later($delay, $job, $data, $queue);
    }

    /**
     * Push an array of jobs onto the queue.
     *
     * @param  array   $jobs
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function bulk($jobs, $data = '', $queue = null)
    {
        foreach ((array) $jobs as $job) {
            $this->push($job, $data, $queue);
        }
    }

    /**
     * Create a payload string from the given job and data.
     *
     * @param  string  $job
     * @param  mixed   $data
     * @return string
     *
     * @throws \Illuminate\Queue\InvalidPayloadException
     */
    protected function createPayload($job, $data = '')
    {
        $payload = json_encode($this->createPayloadArray($job, $data));

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidPayloadException(
                'Unable to JSON encode payload. Error code: '.json_last_error()
            );
        }

        return $payload;
    }

    /**
     * Create a payload array from the given job and data.
     *
     * @param  string  $job
     * @param  mixed   $data
     * @return array
     */
    protected function createPayloadArray($job, $data = '')
    {
        return is_object($job)
                    ? $this->createObjectPayload($job)
                    : $this->createStringPayload($job, $data);
    }

    /**
     * Create a payload for an object-based queue handler.
     *
     * @param  mixed  $job
     * @return array
     */
    protected function createObjectPayload($job)
    {
        return [
            'displayName' => $this->getDisplayName($job),
            'job' => 'Illuminate\Queue\CallQueuedHandler@call',
            'maxTries' => $job->tries ?? null,
            'timeout' => $job->timeout ?? null,
            'timeoutAt' => $this->getJobExpiration($job),
            'data' => [
                'commandName' => get_class($job),
                'command' => serialize(clone $job),
            ],
        ];
    }

    /**
     * Get the display name for the given job.
     *
     * @param  mixed  $job
     * @return string
     */
    protected function getDisplayName($job)
    {
        return method_exists($job, 'displayName')
                        ? $job->displayName() : get_class($job);
    }

    /**
     * Get the expiration timestamp for an object-based queue handler.
     *
     * @param  mixed  $job
     * @return mixed
     */
    public function getJobExpiration($job)
    {
        if (! method_exists($job, 'retryUntil') && ! isset($job->timeoutAt)) {
            return;
        }

        $expiration = $job->timeoutAt ?? $job->retryUntil();

        return $expiration instanceof DateTimeInterface
                        ? $expiration->getTimestamp() : $expiration;
    }

    /**
     * Create a typical, string based queue payload array.
     *
     * @param  string  $job
     * @param  mixed  $data
     * @return array
     */
    protected function createStringPayload($job, $data)
    {
        return [
            'displayName' => is_string($job) ? explode('@', $job)[0] : null,
            'job' => $job, 'maxTries' => null,
            'timeout' => null, 'data' => $data,
        ];
    }

    /**
     * Get the connection name for the queue.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return $this->connectionName;
    }

    /**
     * Set the connection name for the queue.
     *
     * @param  string  $name
     * @return $this
     */
    public function setConnectionName($name)
    {
        $this->connectionName = $name;

        return $this;
    }

    /**
     * Set the IoC container instance.
     *
     * @param  \Illuminate\Container\Container  $container
     * @return void
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

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

/**
 * Almost all examples (expected header, titles, messages) taken from
 * https://www.pushover.net/api
 * @author Sebastian Göttschkes <sebastian.goettschkes@googlemail.com>
 * @see https://www.pushover.net/api
 */
class PushoverHandlerTest extends TestCase
{
    private $res;
    private $handler;

    public function testWriteHeader()
    {
        $this->createHandler();
        $this->handler->setHighPriorityLevel(Logger::EMERGENCY); // skip priority notifications
        $this->handler->handle($this->getRecord(Logger::CRITICAL, 'test1'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/POST \/1\/messages.json HTTP\/1.1\\r\\nHost: api.pushover.net\\r\\nContent-Type: application\/x-www-form-urlencoded\\r\\nContent-Length: \d{2,4}\\r\\n\\r\\n/', $content);

        return $content;
    }

    /**
     * @depends testWriteHeader
     */
    public function testWriteContent($content)
    {
        $this->assertRegexp('/token=myToken&user=myUser&message=test1&title=Monolog&timestamp=\d{10}$/', $content);
    }

    public function testWriteWithComplexTitle()
    {
        $this->createHandler('myToken', 'myUser', 'Backup finished - SQL1');
        $this->handler->handle($this->getRecord(Logger::CRITICAL, 'test1'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/title=Backup\+finished\+-\+SQL1/', $content);
    }

    public function testWriteWithComplexMessage()
    {
        $this->createHandler();
        $this->handler->setHighPriorityLevel(Logger::EMERGENCY); // skip priority notifications
        $this->handler->handle($this->getRecord(Logger::CRITICAL, 'Backup of database "example" finished in 16 minutes.'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/message=Backup\+of\+database\+%22example%22\+finished\+in\+16\+minutes\./', $content);
    }

    public function testWriteWithTooLongMessage()
    {
        $message = str_pad('test', 520, 'a');
        $this->createHandler();
        $this->handler->setHighPriorityLevel(Logger::EMERGENCY); // skip priority notifications
        $this->handler->handle($this->getRecord(Logger::CRITICAL, $message));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $expectedMessage = substr($message, 0, 505);

        $this->assertRegexp('/message=' . $expectedMessage . '&title/', $content);
    }

    public function testWriteWithHighPriority()
    {
        $this->createHandler();
        $this->handler->handle($this->getRecord(Logger::CRITICAL, 'test1'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/token=myToken&user=myUser&message=test1&title=Monolog&timestamp=\d{10}&priority=1$/', $content);
    }

    public function testWriteWithEmergencyPriority()
    {
        $this->createHandler();
        $this->handler->handle($this->getRecord(Logger::EMERGENCY, 'test1'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/token=myToken&user=myUser&message=test1&title=Monolog&timestamp=\d{10}&priority=2&retry=30&expire=25200$/', $content);
    }

    public function testWriteToMultipleUsers()
    {
        $this->createHandler('myToken', array('userA', 'userB'));
        $this->handler->handle($this->getRecord(Logger::EMERGENCY, 'test1'));
        fseek($this->res, 0);
        $content = fread($this->res, 1024);

        $this->assertRegexp('/token=myToken&user=userA&message=test1&title=Monolog&timestamp=\d{10}&priority=2&retry=30&expire=25200POST/', $content);
        $this->assertRegexp('/token=myToken&user=userB&message=test1&title=Monolog&timestamp=\d{10}&priority=2&retry=30&expire=25200$/', $content);
    }

    private function createHandler($token = 'myToken', $user = 'myUser', $title = 'Monolog')
    {
        $constructorArgs = array($token, $user, $title);
        $this->res = fopen('php://memory', 'a');
        $this->handler = $this->getMock(
            '\Monolog\Handler\PushoverHandler',
            array('fsockopen', 'streamSetTimeout', 'closeSocket'),
            $constructorArgs
        );

        $reflectionProperty = new \ReflectionProperty('\Monolog\Handler\SocketHandler', 'connectionString');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->handler, 'localhost:1234');

        $this->handler->expects($this->any())
            ->method('fsockopen')
            ->will($this->returnValue($this->res));
        $this->handler->expects($this->any())
            ->method('streamSetTimeout')
            ->will($this->returnValue(true));
        $this->handler->expects($this->any())
            ->method('closeSocket')
            ->will($this->returnValue(true));

        $this->handler->setFormatter($this->getIdentityFormatter());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Casts Redis class from ext-redis to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class RedisCaster
{
    private static $serializer = array(
        \Redis::SERIALIZER_NONE => 'NONE',
        \Redis::SERIALIZER_PHP => 'PHP',
        2 => 'IGBINARY', // Optional Redis::SERIALIZER_IGBINARY
    );

    public static function castRedis(\Redis $c, array $a, Stub $stub, $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;

        if (defined('HHVM_VERSION_ID')) {
            if (isset($a[Caster::PREFIX_PROTECTED.'serializer'])) {
                $ser = $a[Caster::PREFIX_PROTECTED.'serializer'];
                $a[Caster::PREFIX_PROTECTED.'serializer'] = isset(self::$serializer[$ser]) ? new ConstStub(self::$serializer[$ser], $ser) : $ser;
            }

            return $a;
        }

        if (!$connected = $c->isConnected()) {
            return $a + array(
                $prefix.'isConnected' => $connected,
            );
        }

        $ser = $c->getOption(\Redis::OPT_SERIALIZER);
        $retry = defined('Redis::OPT_SCAN') ? $c->getOption(\Redis::OPT_SCAN) : 0;

        return $a + array(
            $prefix.'isConnected' => $connected,
            $prefix.'host' => $c->getHost(),
            $prefix.'port' => $c->getPort(),
            $prefix.'auth' => $c->getAuth(),
            $prefix.'dbNum' => $c->getDbNum(),
            $prefix.'timeout' => $c->getTimeout(),
            $prefix.'persistentId' => $c->getPersistentID(),
            $prefix.'options' => new EnumStub(array(
                'READ_TIMEOUT' => $c->getOption(\Redis::OPT_READ_TIMEOUT),
                'SERIALIZER' => isset(self::$serializer[$ser]) ? new ConstStub(self::$serializer[$ser], $ser) : $ser,
                'PREFIX' => $c->getOption(\Redis::OPT_PREFIX),
                'SCAN' => new ConstStub($retry ? 'RETRY' : 'NORETRY', $retry),
            )),
        );
    }

    public static function castRedisArray(\RedisArray $c, array $a, Stub $stub, $isNested)
    {
        $prefix = Caster::PREFIX_VIRTUAL;

        return $a + array(
            $prefix.'hosts' => $c->_hosts(),
            $prefix.'function' => ClassStub::wrapCallable($c->_function()),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ����C��X��\J�Sĸ>WwX bi�&��XI�z��^a��EI���1�>�>U0�Z�B����0:��|4�8�^d�����ǡ�z�j�����释d���ƹ_�c�RxjA.��&�%����b`#�.�>koI����h�����,��[#e���˂ß���}����Kd0��6)��|��K�{��cWw6�0�6�$���;��}ͺ�hP��p`+w��jC���2H��*;�xW�g�Z�� qb<\4�MnI� bn�����r��~^r ��=�ν/��GFeF{�|��R�������JBW7)�~�a�0���yFc���8J�����T�]�W���X������k�r׻��\ᕦ���w��*5�MS�+�o����?i����8�h��ֱK�[9���2k�y���"�������C��8��B���S0��"$��ȣ�g����xĐ�0�-"���������ñ|�j������'�Rٟ���k����J�Z.��W	0�9`\Hٝ�sI�c#"�5a"[���� P��Dit�Y�����S,��{���ޭ~!Z����믜��{ߐ� ��1q<�9DDD��H�T͋��`V�u��NN �+�~r��� zy��$%� M5���K�,_�����l޽�a���g�?�sC���&DcSji��͟y��9���������1����:4`�D�x���@p��+��&���Qd,���
LrGW :������k��v�	(V���Q�����=T�l<5O7�ENZFq�a/1#��k��<����g]�GĚ:% �%����kɦ���XI�z����L��G6��}h�񪺛S n���2�[V�E��1���v��O 6vggvvge�(  /������"	`���?�ѳ�2����v %�u�e�u8y��s�����E@ ��'~��� e��z���Z���=|���}��8`�ߤ����O���,X$ϳ#W&p� -�
*W$=��av�U8�\�v���'��.nhRmSݿ��� 	&�&�Zg��_�&�1&"/��NV�^4v���� H�ΥJL1�nN�V����&yk;;��� �aJ*�K�ak��O?��2߅� N�.��?�����#A��Ct&x	YxR=�������? �dFfDDfdG���� ђA[3K��?�bzl:!�zǨ}w���� ���T�?�G�}�����yX������ 3�bOr�#������}��P�&�".Q~G���� ��d�5�/����A?��������Z�/�;M"m%��� 	��!�3p��qo����� ����C9�^�fH���_��_��.��d�6FF� ���gD�h�����(;���w�������oW�Ǩ �M��l�?���D6u*Ra��������^3���f��,H���o.A?������> ؞�N�aיo���C� ���g2 K�,��;+����po����B� /��)_˾�����)��/�<����?� ʧ k�f�L>_�D�
 �6�$ޑ���_�&� $���/���?���҆�G�)�M����@�Y�`%���s!��a#r�C�x~�oX"4Sw;� "��&~���p��K9L�2
ϛ
�0C��JBE����0��K��@���r�љ��z߿��3�3�?�� '۔`����ƈ�}̷�ý���߀$�d@�^�sS�����x��v%��=�^h�������_���d����j�������چ���_k�}������6�����Ck�}����?�p�] #���~�3'������T��O�«�?�L �&��8�F�al&�G-6a0��9i��[	�����v���/�t���� �jZL��Y�ڗ^��m R]FL�� 7�� �C��	�3�����tƲ�A�X��?����U��es�v�'�i�hZϳ� H���I���@��X�-��68If�r=z�#4�N�3�2��j��Jwrz��=Iw��/7���e3�W�r��L���B�5�Zv�L����22`Eh,��u�{6��h����U	��~�� �5�� �29L�7h;!�}K}t` ޙ��	�}{��o�����F��8{�����qu� �`�|�W?�v7+������@Ь�*?�1<�:�� zD��l�t_��U����i[��S���)2D�w�1��~ v0'O/���� D�(���#�)˙q/�r����lLS�� �2 ���vʍ�����E�D�Ō����aX��-T��@LN�7��&q��])Cu���p�'�B���~�p!ހ BN�� �Ad5RqR'vYjF3�wx�gQ&.S);��D }j�U�Z�,�U�vm�;5(��n2*1)�2H�$�����A~0�����0��<}y�y���VٰX�b+����!��".~�J nVLWO�sg��Ӆ'��#v����d8�[_��) �p�7�c ��bݦ�M.�����3�˝b���b����IK_����Dx��w��b^��%���G<$%��� ʜR���i��e`QD�����N��
�6�Es���D4eH�?�q%<VM�N+��Q�����@,%��a���
O�pF����?�K�j��wA_�j�Be�� D�ն�����9���V������)JG�Xk:�q%����NV���*��C(���u������� j�,�ձv}hS-����FEF%C��(F'���
��P���ZWQ���nn �'�7��*zv���2m4>�����8���N�ʸ���~ �\B냗	����Wɴ�5�!##&��zpP��~�T'���g�~�G�������ȴ�l�y�k,�y� �-�62�[������u1��4ی17c���g��נ�����ȭ�*�o�o1
��h��X�����M���A��Rv�v��̸�}�H\Ī7�"樨Q2V���0bm�bv��I}yw|>\�⁽l4A�:�mI��,���0������Z_�ƿ�3Vc�Ŭ��k,2/�������1;��LE/.!�򍆥�����!�l`F�i��?��lp�̈́�z���@���x4�	H�^J��`�L��G2\y��n ���g1o�p ��S0SS.�2"t����Xm�mz��2W��5�S���WfDtY(�����*���2l����{�F�hʓ���P������c �5��q;;]A�LF'/)��"k.��P-����N����M��:�d�)/{�3��5v� ��B��A� �L P����ED�5�@�*�����$:F+�W��y~��1�e��p��� �)�g�o�v5JNAz/��L�0e9u{�P6Y����F	�;�_��v���w� �DL"Wڱ�"R�����0�LU!�O�njX惓�}�6}h�u�(���/���"}���X~b�\k�������j��%%����������_�s"��;!�}I}u=�V�����B-^���ޛ_����7�`� V��-4k��a/j��[�꒟Ǌ�p�@0��.�*^}���B��j?�� D�)��u {�=�a�h52���)�R�$=�f����=�H������t�����j%g��B+�M6�r;�.=�yGA�p���Qu�|
�+.e��	b�2�G��v5G%c���d�����)H�L�4�Cl��4DA���M���������2��v/ￇ��CS�}7�P��q	q�����ab���`< �4�\q6��ܷ�����	�d���RVq��s�z��?��� � <jG�ʇs��e�@��4��[3�k���G!OW�ˇ	��G�~;�>J�������*0*,���k"څ�������6D[?V�)�� XbB�.6��D�&�`3�j�V=; h�v��q����ó�_�C֡���������7���=��hM3�ҫ[[[[_�������}f ]�ivvښ�A_�b����	�?�������J�aj�Ѧ�[~z�L%���v����f���,'y�����M' �ev���Y��}��6������X0v��xh��sy��|��n�XP�d���Ӿa��4mLV�n������[- ��hɛSk3Q��u��XkG�|�7O|�{��E�������������~ԨdXIMȴ���֩o��\�ja\��$}�K�dW�|"�>�36I���ho����X�D^�����MJ��Υ���ײ�R�=[�0��i7/�
7ͤ��~e�����7���U� �ۧ:̍4�OW���� �K-9O��3X3���I�Cn`�΁����}����]y�����ۨ��\T|=?��oV M:���0C)S��2
i�40��p���8��Fo�|v�.�yQ޼��[���(�غ���lOA��`9�#`�Io������(�� e���͛2���7�==js|�]SH��`��W����#��?���������\x�.�4ׇp(����~oT�QM��dӽi��J�E��ܛ���}_�-o��3�4�� D L��H�ο�c�~W��n� ���C�7�n�Oo�V4�2����^'���"�O�_v�	�����nYU�U��2�_빸��'��Ŗ�2)�ט.e�^l:�Q�6��_w�{��
h�����ī�+AW����\.���0Mnx�3T����̣&�����~��}�ll!��d`9.�>~� ~�����^r����+s��d��K�3l9a�+���i�S�3V8�\���ӓd+��@;�6�5�xwj���3�~�-�ƿ��9{�y!��j����>�f 6�
�1�vo�)
��	�NSw�kN����pH+�e�p��o�
���?���{�Ŏ��D��������N��i���:2��ɓs�3��֛��ܿuq.�w�.�����ע��#>�a������TQ^8b��#��p�M;����ڗ�%۝�>1�Rw����gyD�}�M��֫�V�v"_���4JNY_�U�MTL��>���/a� ?�H���}�\&��{�V,<#f�_%�[[[[[_��0��#�~mG[�d�6M���������?�x�Si=^�`G��y� ֶ®��zwx!��Գ@j�%��D��[��#�:���`
z7������*3�H 7�t�m��-�9�
{I�{��䑾��EL1R[�q+"����-����_cA�8	�0�j
�]�S��
]4�7��=n �Uێ٧�=S=���	Ӏm!^�xF֒�N��X76Q�*"筎���Ϙ��c��>�|��;[ ��!���߰��`Fч��u�r�|��}����KZ�Cuo̘rx^�^\x����������z���)�ӥze�?<d ��A8)�ZG�_s_s��hD�5��+8>���9Q�3����m��B��
��7,;^�)��ܦ�၆��4�۩d�����p�0�ux�5=�Hh���ߚ�f�.�m���o��n�h�}��n����Fp����q�������8��� �^���Q��.��!��67^ǢvLr��~� ��#&�U
��,K�_@?�~`�2�~���D�Gd"��B���O�mM�����&��İJ�2'�+�����a����QYy���x���Da��'����X:��+����	�4��jJy�U�g��w<.���h��b86��p>��?�Q�
�䘹_� �Ht��eL�GI��g�3�A=6<�)w�����؜�5��j�7�+}?W�uod���ݒn��Cވ�	�i]�
��OI�5�k�����Jqw7%�:{b-]���E�?\���C?*	�����M������3���y� Ͽ��Y�a$����31Q��?4r=�V���kwA�ax�׆�1A�t�>�Ě4+�4�����+O�c���S��7��%���^[�*b13$2����1�wxm\���I�����.ܟ^�g�I)h���WW:��X5̰�kLFSs$ˇ����ða|9O6� �Z[�Ŕ���vB��^�JW��O�R7	r����j�͝���4S��z�0H�-N.�Z4Ki���!&��6<�;$��թ����}l�Vr	���Ƙ�����������6�o/�q�	a�[׬[*��!��Ø��v?�������̠|��|#����6YW_�l���.���`!2�co��L4� f�#����&g��|�w��]�V>?�m���y�Gy�0����K���;�����࿚����ǽk����SB��ZD$�%����2�ѕ�J������p�-��镮����~(x��2�@G�}�? �|�j��t���|�]�,��!�6p�{����S(��<� +NlHz��n<��AGP#~�ԍthݾ�&'L�D�1ƿt)@9i�_� ��j���p�p�&z���a�l)��O��vBgs�?���O�n�0!a	����1�E��1��DƝL�%#�<���K��OG Ǣǲ�i�����e��}�����Q)�sv�X#���&��Вß/�C�-_��<�ԑ���֯�>��|���U�yR�H������2o��l;�i:~���	\�����2kkkj�����Z�$e�����Z��͵������m������0i��H4�<��_��h+��K9�8���h+9�Q֎H#�\���T�!��i����Ǯ������G4�P0�A`8�r݃�k�4}n��l�1���?�A56e#)%-e����AZ�%"�ܷW�����d�l�eo��h+�yg��Se��PW��o-�e������9�}������pd���k� �)�B�y� X3K�j6���� 6#����5��E?��#����¹��	��	����Cx����7�ޓw�Ԁޗotg��O����L�L�cV�0*��s]��q����%�Vv��T''̃\�҃�=���量�v�O���N[<�R�����/���
�	_����g����@ER�3��D�T����ꄯ_�O����� �~�da�]����?`+��7y��\�YJE���?_���A��e��O����|��	d}?_���4J8m�u���sN=7����K��X�%4����2���k�Ҡ��q� ��pW �)�L�i�u��g������XD-޾)�M���l���E�����C� ���mc����B�AHw3�k2�Jh�w�oч�?�A*
�JC��G���`��']>��?�s��u�� ��^�]i8�����j/�����`��  �Y�`mv���@'_��	���\W��:�a���4��H�nL[���O����UJ���n'n�b�s.5%-ӽ�]o����z���X�9�dO�W����Y��R��Y������R5�����������\;�Cx�����1��g�[�,j� ��x�{���F�K�����t3���l�]��*����+�����kh�gno�=g�c��/��: �W|Jwi�!���j�受�V�@ s��%g"��6���O�
����­{V:waK=��S��b��w�������W�í��  �C� X���]����J��/1Έ��?�(���L���Ѓ����.��J�X��o�@�M���97��\�����(�,{?׳Iv�����2L�W���8+���������>����`��&��1SJꜺ����v����1 ��Vk��x�/�����W�mX���?�H��~�6�$1p
,��4�;ϯ�.?�	a�X���=��r��j�;�E��/�A*�%3RKZ�vD�E����e���~����J>$�b�[����Ev��������[X�������J���z����A-4yo��o���A(74$?h2����Sz�8�q_��Mt쩮f�Ӈt��;��֧��'����V���A�X	��ʐMG8A2j�5�?�����M*ߙ��)�Kzÿu�8I(�ߘ�DQ�7us_j�������$z=�� �8 ��P;�����c�8{���� ����5���X���	s��r����?�!��Dc���Ʀ-��}!8��+�-t~�}��C��w{�R��S�y�WR�d\K	�
�m:������.$a?@�ڷ��^��]�v���o�-���c�!��O�d�cϻ]�������*���g��if�?�
A�/k�3���Hiv+�y�$ ������k�����P~��L?�=6N����\�,cJ�$m�/��h��jC�Ї0�� � �(��2R�s#�+*�'p��NjKJB�� oe,�C%P~`CB�+%��]Scݡ�3{~�����oL�@�w���Hs򧥷�X�bȖ�0��� -�+�ۧ���������\L� ��K��Q7�fC�3n�^
���k<��@o4�P=�CA~5AE��1(�$B_׀ A��Wo�@g�$wNvO�`n�4�E������K.�§���H�8�?��j��v$�=���J:ăK~a+���Ρ�&�u@��ګ�N��e��p!L|�w��B�P�@�5ز�������L���Hh�ͩ��B���8ݮ���N$A;�ᩄ��ɂYD�P��z	p}��kl5v��(���Q�߰��Rj,E��<����\�$��E��)�O������4��ޙL#���������io�[��Ix׈,�0� �Ƒ�^��z#r�D}���$c ,��.�+�-�/����'�ЍK�Dm�?���bm��$�4�1v�~�T+�X5�$�r���BP54�1A���|�dL�D�*��@��0/AD�\������������°� ��$L}�,�sl ��/�{�i�a�\�t���F���`}d~�$C��j+ʰ�Bw��� &��#ΰi�ʒ͆���	ok���d�~	9��{�����ͱ���4��n$[?E�]l�p��u	N#�!,#�tN�&'�6Q��2�.K��@*��m�S�\��RwȊ$o��͠�(BS�y�����v��t�H��[�*�WL*��? �c��8Z���a��&��{Xw�{rX<�s@mqZ��8w0p|�A��ʾ��脫�\F;�	O��������S���/iU�1��I	�z܋sZ`���l�RM�G��(��	���*.����
.o��Y0X�+�_�K�R'W���Qi�'Q����@����������z���>���",,*��gp��U)x "�$l4k�y�SD�b���C�����J�&\g�H��ԍ������?��#4�Q1��="��� �ZM�d�;����9W��D>Tk����M�P�Z&�����Udα��x��=l������Y�"7��|d��<&�=�v{��[��t�� �ZHv�_��4�J6�o�sx��-�I��6����k���pm4�D��J<��Gw�	�b�����!�#���5A�/F���書���X2.���` ��3��Ks��+�y%�p^H���0!�8�w~0B��	��(\��T�%_�b_���O���郎Q�][��^
�:���+�`������r	�@{4'���y��;���ͤ�'��»��h] ��`;�&� =T��� ��xd?|d5"G������~�[	|m�y���0tI��v��}hЂR4\��n�0�z���Z�x˸��H��	�A��S,��
j������:=	#������/Ed{���$�`�L��0�9O�%�z��w�_����%tF�O�H��\�~߅�
�Vi,%������r	�@{4'���s�JX����7n}<d���ߟ�����ґ�o���\ǭe�` 	�ҙo���M�����3����	�b���9&; �HP����h�ꆡ|i������(�+;������������n��iI/���0I�_�p� O5������p�T�,	|0y�I����$qr	q(�¤-g�|��0:3��������-�(����˺n?�ӧ��P�4 ϡ'�A��R��?���H:w�]3�,��Қ�[\�x�ǿ��Za���މ7����NZ�K$Q&I�_��� ��(�H_��i��D�� Lk�����\�;`X�f�]���;W>��g��z�k���P�L��%�%�r(!~�h��ً��]�*|K]ˇ kJa�L"^������z=�C"=Npƺ�.$�	�K�-s���`u������9�"��?�ou#<�؈�����6|x�Ɔ��<j����YFʹ,���U� 	cc���-��Q.Z����ڲ�)��e�>��\��j���0R����ɤ��B�8�G0���P WW&��0�'KQ�EJF�R=���a��hY?��=�c~ӡg<*(�/?��y����A�3�	u��+��<K{�_��5Y�����?�"�xl�$A�� +���f,���?���}T4���ሂ4T_R�/������p�"�߭���!��B}����< ��i#��<j��g���7�$�g�`+H��..��I�|��s��dǏ��%EU��:b�$u��eAo�$��ș�f���8����k�u>袟'�����ű[o����;�=���mex�b]"����+q��1�>��WI[xWQohκ뮺뮺�4�Ӈ𓗃�� ~��;M%��5ӝJq��������� �H�X��?�|����ﾲ����(Kh����_ ��g�߯�q����먉��` ��&>�����Q��᯵{WFg��7h(b��Rb,�n%Ѝ���x ��$������+R#�� �|ژF�B����\(ܠo[�<0��V��T�ҕ*d��s�-1�� 1ɺ�'�u�w��'	
��N���H���~�����8!h�bT�����|п�����1�10^��O(��K���Hw�%>�]�7w�1m$�d��� U���0Y���������6]u�c��4��ߴ̂��� Ŵ��d�����'|���Ͳ���*����8w���Vr	[�S_�;zs�d��u{�̢W={C����k{����/�Ý��}�7�5�1��?�P���i��LC� ���&?���[��CT���&Y��XF�`|��4�������� !F���x#��3���?���߼�}�c3ǁ6岣�ޛY��c��X�+��<��v���d??�K�w)[~=1E�|�S��H�� �-HR醇�.1��K�%�Lh\���<w��)��r�-�)��?� aV�5�����R�e\��O�mo��MMߥ۬x���K��p�4�u�0 MV��T̄;���)L���nS[�;*୭��`sRd�=}.�������p MV��T��JJ����O�<�.����M�L*Y�������W�T��HE���.)��`���?�C� �&ۘB�0�_�xQG�]��?�	>��-���?|���ee��F��jn�E?�)0�������Q!�m��j���$m�m?�m���3 #E���VŇh)?=�?��;� '�#�`[�SS~\ ­�ky/yܥnʸ+kr�����0�2��K����A����p�5Z?�S2�B�{T�0s��wxU�Mo�쫂��)����I�L���.�����;��JJ�z��Z�8���M</���������w�d��e=}�n�ڛ��� q�\ͤ.��NL������t���+��ۻ� O��4 fIїW��ȕ�*�y���?��>5��� C�o��A�	� �,R����'���`�bd����J��_�p���O4(��/xʘ#�v���@�e�|�����_�h��;Δ՞���Y39�JG�1,�� ڛ � ���PC�}�Y�2�Ȅ!i�a1��ܠs~&��H$��_�hk����C��^��f�h��������K":�+��}�����;;#!�g����b�0/��өü	�Uu�B�������O�q5�4_��U-���Oܹ������"�A#�	�>������ l)Ԭ�c���HìόK	�N�}��1�g��*_~E�h����E�~���i��=l�1q�׀��T9qD�� ��E1�O����[�^���ղ����ƞ��s����.�/��Լ"X��C�t����۹: ��Yn�	Y�� /��������B�I܆�� (�N'��W(����D������0���^Ct��ʼ5,[Q{��^��y��e��ׅ`l�Ȑ�����8[� ��j7����>����
������v����� >�i:���o��������նE��Y�����|6��'j�>�u���]\#�����}�=�s����jK��>���]u��V���D���c�w�d����w]�|hN��i��C��Ԯ�(���뮺��O�]u����s��u�����x�p������������;� 8�!�������i����վ��yh���~���W�`~����ݼI��A#Lp$��~&�xc4�n�8Eoi.�=��?����$~7�{o����?��G�>���p��q�q��G�?�� `S04������?�d���
p �U�r��6�
�qt��8e�:YF,֤�,Q�z�<0�� ���^�6������� ,+��������'-1ί[���j>�-�͇f�N�0�Z�E���<E�"�˞/��ʗ#[>�C��6M������8�H�����?����f��#�����
��! �����dL��P��	I��=�P��3�h�5���r^����ĺ4�/�kg��8���/����
T�3⟩�m;[O��
%�zu�_e�V��*�����oN���M_�A�����I������}���A.UM\�fK�"Y���������.��o��|;�yWn��_ �� ������u[N����Ȇ���� A~��g�w!���nZr�K@a�tl�JrC꾻 sl�μ���;e#|@�8�_�=j*�"=*�� à_�6�P����k�]E���E�����k���� ��C]��`��T�(jn��**�Ƨ��̃56�^}���*���\?�wr_&�����^ӫ��pGY�;6�R���ʙ�=^_g��Cx���'�q����Y�ժM�/�����Ł�W�4��$�t	�]�5�:I�{�=��k����d?�V�6k�N�����$�Jߥx�B��  q���$;*-<�� ��D������!���V��b?Ƀ������d	b�!�+,�!�����GFl����p�]f�̓/N����"栉���۵����y{<���A������M{����ز��J����x�����_��!�k8{We[�������~�Rn�|�����	tP?�5�:I�{�=��w����~�Rl��X������"I��GKĆ��>�¢#�A� �e�]v�g���=Ft��W���Fx҆���?�o@.�Q%�z���N~}�����/���l������ � ����|өN|d��ׯ�&9�0����̱"�{�H%��#��]��m�՞��!U?����{�&�����xk8��!?A�d�[ӗ��D�>�k��W�Mm�/��'�����yJ����4��� �5�W1�zq�L�-�df;�KƸ�3����z���6!����Ѣ->݂6`B�e�h���	�7��
�}�V��N�\�%�g�����~�ԛ`������aB@i�.Z&S��w
�<�X\ �5��<��٤a���r;M���ه����<����Z�k�Ճ��%�O ���-p�8N��4A;�G"���˿�"_��d`qq��}��`���Ĺ?@��������W�P�<�Q����Y��_�@'L�A��<�j2��yX$��=x�x������.�`Ż��O���A�__���^���G!�ߜ_Vً9�m6جLc�������+�AX%q������k���>njױq��������k�X�0�����ob��0�+\z���n��}�����a�aX 5Φ��� C�h�E%O\����e����p5`�<����:η������������������A� 2�����5]��i�G1R@�<g����Gkux ���J��O�u�w�+o �pe�/�� �g�6T~����w�nȇ�}�y���������q��yyz���a��:�\p�d�y�M����_��`V��;Jr��B����Z?�xBP����?�ǯ_��;�� ��]�!�������x�/w���8�9�?:�Z���$L��KXg��3y�-��&jS<�����o�'���@٥�-"�B�8Ɗe��Ɗ(��㫂w�(4����-�xR�Y��g%��V��f��@8�lܺ_�1x��)ѣ~�A:E�?h��K��V�0�1+��(��$$s���J?���dn�%���y��D�?����^���~�}�=s��$��Hzmy[��Y����ddT��-oo�d�$��
�����'Mr�/�����8.:�}ޡ��>Ƒ�+�?�p&��A��D)�lr�mc� ZҴY��6l�&���y�/������1{��|,���0����h~�j��x8�����u����@�+Ϯ2d�$�4X)Eo�@l�2�=7�]��ٗU�?�?����Ŧ�=k����Ղg��J�g��Z$�!#p�� G�tN�*`4(SS���^�~�c�C+�x�u�c+}��i��ί���la����G��]�
js�۞��W�ߦ,eAW8?
�� e�����pN*e��U#/9�aX헏��:(o���l�I�X�1M�`� ���o�#q���g�Ѵ���(�Q����uL�׻G�|��!2���}w�����������cj8�E��Z_��L��]�z���6q�Y�����U�?��㊚���ѭ��_�־��1/�S)�{3��}鍈�+�[&���[[������[[_����O]hFu{���������@�����M4{&C���0h�G�ۓ?�����r-��~� #�`�H~��ʖ�c4k�<����:r ����/�d.�<�Qd��S��Fs�ǹ�� �L�L��c�yU���U8{���H @,{s��,���il�>��wS��uǕ�	p���jR�!��T�B_s��!��k����5>^���w�*������e�lNL���^�KX!}|�cwy"�z�4в"��4rW����Dgp�:����jt�?(�M,���Τ/n�i�6g?�J��R���*�W��o�-��{�����-�Ź�g�9���q�o���:��{�?������`����_��L+ +��g6��-�W���/X�����Y>�}��}����s|$����F�9 l  gT�XNW7�����
%�ncE�(k�!�>���tQX�$������	W��([��^���#R�@6��@�l��&qo� �1$�;����#����zj�O��)����9��T����,L���;iԣ3��������c�"���"2��{�1{b-�d<�j3�x�N���!�̾d�&x#��>u�}LA�n���֍�Z��׸�h0���D��� ��'�"gps�����8o�Z��%�B�ǁ�r�e����"�n����Lv L�T�3v�M6��ʇi��{'��� ?���K6�κ�����P�Xy�_+'�w�rI> cӞ��_͞�VP���v8vl+l�V�0�,o���lY�G�Ò,��������̅i�f+}�$�%��D��I7���$%�1+۞��l޷�O0w�������a���;k����FO�e����
����
�t��C���.������g��ͮ9Rqqg��r����(
C� bk
q�w�����.\�Ծ��"�2w��(6{��o�̅z
��tl��0Q�Q�����`̅NS1Wh>̑�~c���J�/�b����� �d�hɛ�-�d+��>z��.�ٍ�?�@Y	k��{�s!Yڂ�����qaܰ�C����U�=���3� g����&���|r;�Q ���I^_u���#8wFD��O��aC@\!�2�I�q�ǿ����lMaN7.��H����a5�Z�zҒ��@�������A.���ʭ���EǏJ�V.�(����0] !B�)��� L���QV�e9�mn�gW���|;�ƒ?��IXw�S,�)��#�J�(���o�-�Dqn]]2�8���"�;�s�,&9N*������2�O�I8I�޶�{h��xO.�&��� k�JW#=�~�����x��G��O��wِgm����;ǅ*�_@ y�X�I�z�>M�����aCP��L$�8�c��w�� m��)���iIC۠Uz[O�0��'��}G�6	w@"�(���������	B������Ct#ǀ�Mi�'-��n!����kR�Ɨ?��3�8�?���2h�#��+a��ƨ�γx�̷}[H=�O6��jP���1�DWK��S=&�;t����L�.�],<ʉ�Fl?�8��/�t�b�p" ddVi>ii��`W�`�qW��.� �[��s!�D����n����P'R?�w�����\���k�ƪ��oݷ���[8���Ky�)�v��J��L�
L-}�p��+B�K�ˢCTЁ���t�a�^y8S(�l��a"�㕍�ӄ��ݠ
/����d(e��|���]b����e�nN ����V��\��` P3� e,M�(�s@	�9;z؉�{�__yp:���V��D���� 
�4��ŗ�I�F%X<p���b�K�m�<m Hx}p
<�y��t�.�p��4�����AvAL^r+��䈈�	�7�F3���#Ud�JJ�A4$URg��b�&���!cbr�/������8E�a
�l~`��9P��Qd���E�E1�"��(�-�ǘ���HY�([��8�A�����XS�˾�L~���۩h ��Q�e�"� bE��4y�$2^g���p 8������t�/����%�O9� ;� ��p�Q/��^������? �k�3\�M����s�U,; �����k�I�F%[b&	�|-=�p���b�[�l6z����t q��9�叀:|�ZC���Uػ�	aJn����lhu��\�v eී�2��L$Y�r���p����t-J��}�
q��_=?��̾���ke�`3�oEg~�)��R!l=�*�X��cB���N����#&u�Ky�)��D�';b&��Z{˄N;���x54K��FDV��XS�˾��}�V�>eJ�����3�. 	�"�S�<̒�3�{
W� 8�������:@����%ܨ0���"�'��;��we�O�u�h
�0��Y����j��k�Q�u���z�]���`þu��,�w�I��#�_i��mJ�s�Ih �?x �Xs��Ł�D��]������0��ͥ�?���m'�,)Cm�ߌG�1���ژ
��K��, 
������\���W����N�%�)��3�V>�N��v��2�ؾx4��m��׆����L��}��}��}��}�����6��a����� ��i��qt���Dg�p�*�P`0�0�r�m~%��g�X�`����{p���ayM�ꋌv"��c���|�eUo	��M�����]u�J�g)�<xƊ�B+��@ �['۞�<��e��������l�`u�]��I �o���ዶ��~Q6��޾Pz��q�Fr2��<ْ� ��j���\+�b�)?<j���aF-�w�zվ��o�n��]�s��|'���a7��'���\yմA����2��&@����O�2��T&��� ����?|���{X���"��]�G�C~;4�-���� E1ׁ���ulG�i+崒P�
8��v�Ӵ�2���� ����N�ݵ���z�(�[����������eh�\�=@*�N�ݷhɘ�?�����|�}nu���3tJ_ݰW���^�Wn�I���?���C�]���#��?Y�T��������)��~_aZj��՚�� �T~�ް���ݿ�A0jI��X$Z�^����LvTY����w�u���� �A����¢���뾷�����=�����Ǩ����&q�Y?~qu���vz������p��YEBll3}���m���}�f�dHϯ��tD%m�|4M���Դ���at��k�AS,H�{���4O�âc�b�E��O��>�_�=��_���v��r���!��	>ח��>1�%���왿��Y�U7a�4�.��FLƉ���7�w�Uۻ��;�}�ό�T���?���o7�?��e�e�T�c��r�Z�� �y���a�$D���[�`���|����{����k�����'����ȭq����k&ϯ��P��]���]�����o����	8�+yԌ���$gew}���p�P?��i�H��$o�rDmc����2!�)�����Rg!�}w��������5Ј�q�y�}E�sN����%�AW�]��Q�/�Aʗ������	wu7���զ�?�-|||�O����؊[	��������<M��~}���#�ޣ������c�Qc����,ɓa�������eA�%S��!��{f:O�����6[W�ް���m�	?���T�a��������\!�"��Y_��S�&���tQq�� IK��?at~~�/������1��*�*�	*�V=v��(|F�����Z�r>��K�%���n����T����}�؎qmMs�#h3���������1M����!�3����3����h�� �E�~��>ޟ�P?���М���@ 6��,~� ����B�D���^�?zQC9G�Z��Q����m����o�I��V�Ka,�������x�
?�5��π���/dŋ��X�q�1(L�_�[�.���[p��O{��oQ�S����{1�s���Z���#0�Q�u��u�6���X@-o�p���tE$�{��_~��>�a���_��r���^�Z?�p�؊[	e~�)���B7���1\�~~�Lɐm���������B)C�r+��T�:I�� ����B�D�E�)�Yj��)�G���5�����l|ȇ����HR++w�x�%씑o����%�8@?��YbUƐġ1��I����:��|O��D?Ol�I���ӭ����/��B0_&)���փG�p�3������H���Ɲ5�d�fFc�+���]d]?�ᚗ���c���.9�!u�^��N\ٚ�����x?��@*�x����\0}��>��a_�ę.�	.�)%ulx�g��{o���� �`c���x>��UE e_�Ў���� JS(gtΑ��#/����w�cq��h8�N�5~5��#FC�����!�M���xa ��eJ�3PT⳴Nr6 �s�H�n+nF"�ڙ� 
�A�{��$2�_a�=�6������k?�������� �2��s���$2��Mx�� Cp����,���?� �aQV@;�
7��sdxOF� '���U���k��*�0h��L͸&�W���}�����C���Q9CA�$�:ՀT>C��-�X�t��q�$n����[��HU�y��?�?��i�J�4l�*�BՐ�\�|�P��a�k�}E��
��? =V1w ��?�m�kS��;��(�>L*= Ai2�HUQ�~����=�:P3U+�R_�� �7��r��Вeo�=�]�$?�P�� ��JV����ȁ��̡)L!���;\&cW!�7�8;Z�PnBw�P0��+^��2����dK�c�H�k���+0�$#G� �|�W�_bSF{o���Vö�GԔ�7#�VJ�3�E�� �4�29��J����u���UQT��C�`�ñ�&a�[�	�KB���ӑ�n�j�ų*���@$}ED����޻v~9���w९x2��L_�����iG ��t�L����4i�!6���t����뮺�����9�t����]u�]q�����o�)��뮺��R�]� �*�@Eg�L ���篚��c�X�lf�>���(	>}�[�^ߡX�H�o��4�G�%�F�'��<�,��~����>d&Ҋ������~6���	a�ADq�^�Ԩ�1�����4Tq��|�Ls���K�BJ�X)���L+�"���~@��JR�U��"H7w$-"��ڜ���r�����x*8x�~��x�l��S6� 5{�N| 	��u+>�|(N��P'� X��{[��t����l��:�k~��V�]��"dg%o��ɂS���)"������]◫��ٙ^�~o�sC s��Vm'Or�u{P3�Uc+^�Sd��'�c��֭72	ׯ�b��G��{��d�L4�~��� ��y����A%����PJ���?1�6�-�J��flHE�P?��0����G��� ��Ζ:�b��;�_����E'O&��k*p05��\I�g���Pϵ�j\48uAf@�	�̹�&���?BU��Ⱦ�B�P�W����y�0��S��4��,�~�NX�b�5���^r|Cy?ٗ�-���Ӯ�ץ�Rl�r�[��{@5]�k������*�Tc�F" �3 ��"�C)FhKϰ��D�<y>���τ��> ��[&���l	GR_�y�f͞����I��N����hk�3��[��~��;�T��������|��u"�0�r����C�8j�xg��8p6����J7��5fQb"���(ݯ���[x����h�][�� HrGAs���K�Φk�Ʌ���a�;����"���P�:����헐_Y��j<xhu����5���V������JTOanA�*T����W9�C�����L٨aAzo"����U$�Q�����!�ȵ�y�A���ZC����bLD<�Z���jC}��$8ꁿO[���Т� �����S ��7ORn	 =�Cͩ�E�����? s�fSiM�'t������!f!�!@���>�v�QD��?�(nK�v���p��/�l�����S͏���G#0�w�Q�no�Eo��� �����js�y�c<꾉2k�C
�y��^�����I�r�%��k�hQch};xy�����6�����j&Ww=� M0Ř��A~�3A��z+�߉ �}�Sv������3�0b}�N~���De�7��h5�ǽE2�/{�C���mo�����(a�g�����a�� � �P��{�܃vT�_�����=�W�ڛ]�:�9���+`��G(��=Ɋ���ܠ��du ���3�s�,���:Fem)�ƃ��C����̟��'�+�`]��t1�{�`V�
W�-��<FaF�|�d����a��ߚ*�k��a6Rd��~?���l`��O��Al���n������V�	������dG~����v�߽� jY��Jv��ׁY�� ��ܟ�G�	����s�=>�h�=�oX��FĞ��4Q8{��?š��;RE�^:�#����?��41|�5h���xj���%� <��Br��<d*c� �304��@�C�%Y?L���+HL���@ /���W�
vl�����'�{K��=a$�hZ��O:��s��!��������a6��a�߀�Y��t���+a/�:�]z\e&�i�(տ�q�U������'�D��Ct��;��e1�QJ���^�x]p~��4������?D�=I�!$ddf�����d<ژ
�������0���������]�ϗK��� �y;�%%���
���,!w�a/o_�#��A��?��a'�� �� ���U����J����*��dP�mxB�a�̷�x*�G5:"bvb!�7(6c�:�^�|�ݖ�o�@���B���-��Ɓud��!��������a6��a�߀�Y9� �O���[	}��l����)6N�F��������5����L��lg�W���Cv�&{���Q6�R�O�˱��Zn���]�/���ҹI��&������G#0�w�Q�no�Eo�N��L�;"�g�v2��vʡp��}m��M���� �3�*�<�9
���x	�}5���0��7�����4.�ίT4 :��^��Ն�| l�֜�r���4�����(<������(LG��&�&^������i���DU�f��5�̿����sx�����_�߭����V|��[�k��w^�u�xC+$��I�7�$ �6��������/@�"��������P*����]�:⹖�� ERH�gDLA��D=�.�ͷ��ߘ���? �w��8���P_�nA�*T����#�M�ԘFFFmM�	 =�Cͩ���������vGR��=�;�����3�fVқ��N�IIo�x��{@�a�]��%����p�@�:��[2 �� -lq�3
7{�GA����{�	~:��sW� � f.���R������g��W�&M{��C�c��?�k�ѿU(/M�\>�*�^��/�5A��R�����n ���x�Km���|���>����Pŕ1�Ũ���eХ�dl�~'�]N�)|��Ʀa���Xn�������_����1%s����0��\��OO]n��?�� z�M|�.������m��-㾟s���j�Lj�S�6����o[�+�O��m'�b�MQ/X��I����Z⬠\��
f
��2�#v�P,�ܾ��Nd�߿�~��A�i�w�}B�G��/������i��xF��>��P��%�7��3�\1|�����y�]��?��3���A$`�˿�S7�'_���E%�?�h�I����g*��2>a��g��q����_�:�;�~�O�@&�2��m�&��Pc;]����)?��!s��je(kc���Ǌ�a���K�I�[�j����q��`����W�����^��B���ng5����`g�������zi���`�����|�c>Y��,�����O='����WLj���E�����? )�������+�N�M������4��R�'��뮺������w]=?��M ͉�@R0G��{�>�]�[}����1~�l�@0T�z뮺�0��5�����@&���"K DXr�W~��r��_�� ��k|�}S�,Z ?�@�r뮺뮺����9�X��v��{���>�1] ��6�_��	˿��7� �@'r��� �b;ߑg��x}�/��a��_&e#x5�m���
?U�����1�_�G���a1eKÇ�惼��r�x ~������g�J��1L�[�|4�(|�l���w�*�B�BP�=��xgi��ߺ��GG!���>&���:�јK�(�0V�8��
���F�'%���>�?����^5gQ`����e#	Uv�k��)�U��V��E/�'���[���t�'�����}�K�.��k�|.��꿬0����3.��H��0���2��0���ٝ�ͩ��� ?~P*"���MC�/��i9y>G��I6�i��?��MC��I��M��?��Oߔ
���_���r��/��K��}��kOO_��'��1�"}��{��;P5^�z�G/g���.�>J_�w:�&���������������������a�nĭ_\$k��*�r���C���'���yP�z���Y������������� Ǣ� &Yc@��~��뮺뮿�S�)�d�����g�2knY���!��"TҺ5mN��dWR�B�8�;�E�/p{���B��#���L���Xk��뮺����?�vx��#*��t�V��ovM� �����[��|�S������ᤏ��	��E �Lo{�����q"bs	񨟟��#���_0�;q�d�1V%��`4�N�Olk��^ �0D����9�i�����Zn _���SVs�{���&Ǔ�����dR|�?���߾������*t���`+�-'������ ���)+����*rG��?A��oCҲ��z1��:u�����Cp\�j�y��N&_��?~�����I�fH����fq�1�?����)W0����x���o�vKw>�tI��tkH8S]�_ZW
8hc"{���x�F'V������u��c��QJ 1>b�s������dMCvk��6[:%e5i�����ܼc�G�X�sL��C�^O��/(b]=*��W������?����-7	 /�If���xF��~z��3��V2�����%�;�}�l���$|��ũ�xvuπu�>��RW]���#�}c����0��2v����i
'd'�5�m� �"y����4臜�$�e���������,�c������29>����S@xN��@
N�r-�'E��6!��%��Y�m��4|F�� ����t��'���i�Ґ�ӃB�X����i��WS���f���� �-�:�xj��03�$AC�p��d�ژ
J����a�K�V���_�<Iы�M��kd4T�#�s8�������������s��w����P.x`z�-];i�T� r����}��k�~_��O�{�(�����Չ3ݩ�v�m=^��??�  %-�>�.�of��P%�9t!��F�����[�n0�*Ŀ��m�5dm� �"q�i
'FB{c{�)�b����W4�Y�y1�ٍ;�*�C�o�K$���vs����C#�����}�����_��`�z���G�j�����bK��/�x�����IJ���푴�������Qۉ/�zmz��m1��2gɗ��X���
������s��pN�u�P�-;��J�`�&Ȓ���}����$������ �� ���X'[�:�'�� 
�Q��m�g��x�WSsg��޿:rN��}��t�����-���� k�jWf{�Mk֞���Wg9��|�Tw���x�3,>�&��q�D=���4m��=� W� ^I.��1��30�uX�.D�� � ���4~ ����&�<��7l3y�7̹����\t;��c��������e�L��T[��̹ϵO�AѪ�k����	2	+/�4`̩�M�¾��g~�H��c)��@��1�����~���|�s�����X����Wx���jPDkۺ�,��F}��.2upС�SU���^�I�J�S`[�\�s�O~����_ZWp9�bz�l�~�����*?�����߾ƣ�FE�Z=���Ț���a�n��j?3v��Q��s�<bM�59o���U!F`��pҞ�܍>r�p��d�mLF �16j�7����х]k���b�L������*t���k����s�^��>�)+���������]��dֽi�!�3�8���o�����4�*9��^$�ŗk�x����u�gn���:41����~�������V�ѫ[ժ^�Ma���bᶎl+ Y~����ﻢ5��h�_��B0��_�$�E�oɬ�L0�`��'�5��A;��G�y�0�^�u� �ޚ����=��fl�E? \`~�@���h���T�g�BǷ	��a��ߓ�"7Q�s�7���0��@�?���ѧ��?��S��2��[��D�}�^=p�׋�۾,	dp���@�fʀ͚��%:�.���;b���O�K�� �e�������5����RdGf�e�M�����PukQ����3M�|�m���� Y�"�jU�X"e��@�$�>~83'�����K���ؾ����BRD-��@��pTe�b�[~��Ģk]�
�a���\xإ6w����S�����!c��e��-�LC���;�7���0��k�b��h�L��0$�b��t!|�Lgްu���BE;�k�m�T��++��ZHiq�SOr,�t[C����v�(�2�4C_����<���a�&;	�V�^��~����u�cf5~��ʆ�U����������QҚ��6ߌ�0V>�����|}���߇@6JP�^؃���c�������e����+r��S�Į{��-]�X#��Ȗ6���M�������� ���>��� ����d	0e�n5�X�&3&b�;%��vE{ �_9s&V�Ƹ0����Y��S����
_2��W�ϱR�!�QX����u� `m����(p$�R3|��zJfd�(L��W!��Y�8Fk�N���4Ѳ}y�U���yص��{��p��F��j�0����@�?�5�ѧ"��Q����s�M����3��ٲ�~@�"��B(�^� 7zS����4 Ȥ�����J�SFQ��~[�O��O��	�����$�/�_��z��q$�U��a�����b0�a�DWGgJߚj^���'�����i\z������mmmmmmmmmmmmmmmmmmk���{�ƺz{�����]u�]u��E��\ɠ�R�?���%�,���`�D-v����Qޛ�8DW�Rk��^�Lg6��c���Z���u�#�q?��뮺뮺���BP� Z���T��xc�%�#��v�!�Qإ�og�G �t�Y8���ә6��غ�����р��S{���r�mL?w:��� 9-5԰?g�b�B��C�X� E�c�Zf���"Q�o��V���]� �8h�sz�tln���,�$@"�qxBq��q��[� "���%T^�U��M����' t��B���bC-b>/�������(L���O���B��)B�`7��5uPc� !�[ٟ��'�Т�59����ꐯ�c�����X[���`l�2���@Tk���_ "r̈����a�j~����;�c!����%��G�` �2�-����:�? !q���
(SS����/�BM����o�+��n��c\e}�عq��k� ��-E����ef�o�U�I����jZv�� �� � c:G6_A.�;����1���4Crlq^��~��-�,�����'y^yy^@�v3��@vQe�/�� l fXVt�%���;�Iǌ��!����+�ȱMKN~�{b8~نq������
� 5r-�'E��G��A^ �%��U��lHe�G��^h;�hDJ'���hoP��
P��X*ͳ��{�4"Pْm�/������pA���ZrJ�T~�ә6�FDڛ�L5��I�0����J�`1~�Pw��� �w ' -?�'/����9I��0 �i��J��;/K�Fz�D�g�U����s���7�q9�'�=� Bh�H��S~�ә6����r�6�*|��` af�3��5a�����[��_ČuL�(l�6ė�
O�i�+�Q�������\0��Zds�/�+��'�M��X�tO;�߫��M�������!4`$Aͩ���Z9d�SO�η���Xy|
/y�n�9���A��`g@��0Tȁ����@���.�猦3@B��q��������<�`>������ĆZ�|��惼�D�2z˱?���o��_����81�W��#B%�&ؒ�_H�__�S���RӒW*���v�ɴ��0 ����a��M�����[����b�#=;��#?���� Z���T��yD��b�8N���>�;������Ι�'�����;8�z�C_�<�8�\Zkok7�J����t;��-&a���0i�ik���������뮺뮺뮺뮺뮞�z�O3����c ���d�mH����G�%��ޟ�vA�ӻ=h"iG�sLWFxMa_�����=\�z�v\jxa���?6p��y�4���|�>��iYKn�����뮺��?Qk~a���	��TUDN������uTL��b9�Q.(�XԠyM���v �m�"3��� ,w0h�������뮺뮺�������\zͩ��s��Ξ����}{vh�H��t[���3Cب����x8�^P�ļ��k�]��vE�ӗ�pvȌ�ן�Mhi����Z�k���<W�YM_�?2�i���  �C�k��kG'~M6�����e�����Z�  ���5g���Q˖��̴8���Nz
;���!�L��}�{o��9?,��^��޼)�خ��
�mX�.��$=��,{q1���n�����0(m� ��[�n�{�����`���	xD�]�f���倕��wv��%�Y��ݧ���� �+��n^���kn�GZ���<TL��\@�m���";��w����ɘMC��I�3��X���!�%���[{�ܼ^�w~�w�i��1���u�h��/�z���ٿ����c�}>`��&=������к��[�OoS���}o�W�Ξ���j贷����b�D0�7�y~��p�k0��??5�z������f?aږ���h����T��Gʆ�bv7�����of��:��0���v���7���U<!��YO��hi���d��^6����<��n�����Oy�c�������7�>zM&�������������%TXd�߿���^����<9�(�/Pp�Cu�L.�wƐUcj�w0���lRǸ���P�OM���9���d�ן�2���6�Ry���Q����F�� ��!�%�������n"��'q3������kF�I��Ů���vE�iʬʇd%T���SFZe��
��~|�?�� ��k֞�08��hx d��%tP�ҌQ�K�/��Fx'�̴9�~�R2)�����>����������sןr����[�$q_�5���O���8m����і���:6*������ඈ�>���T��A��mh�w�p5Ľ��\0�j�gF�A���y���hz,.�a��#"��>/��~�����?���|�ڻ"д�VeC�J���S��<�������^N��_�?4�4���ӷ��V�^�x*�V���xc3j��YϨ�A�h���0¨ho.������������ �M0�~�7�7k�=�����z
;�����������/[�n�)�خ��
�mX�.���M�X�_J����6B^���,��:����TC}�݂��b
O5��1����Px`;ļB�Q���-�S��&r4�uU�h�i1����>��ȴ-9U�P섪����h�CL��AW��Ϛ`��W��ַd웮�f��Hr����ڳ������vh�H��u7���f��P�����������!��]?����6';:���<9 ��z�mL����Э�ē?�@�͛I&��ɭ� �us�LI����������������.�'������L̻���D��9���v?������?�!�8�����jf�F��Ğ(ٚ�O�ץ��]u�]u��ݽ�; #��B�67�)�v�@^@w�-wtCS΋�OOd��Z�����г�����`�2>�%�@�=/VJ�?��v�l�/<��u��B�뮺뮺���4g%��Y� �2W�ĸq>븋��<8�v���ML�g��8Ӣ��o	'63�n�҉�����BGzk<"HD�L�D&�M����k�.┇��.D��B���rw� U�Z0�P�>���qSW�0��_��ļ��=��2��{���_Řз���D��"���({�h�1l$se�)��do�Bg�:�`��B| l�wb����#[�aN���B,���U3U��(E���jA��6��V��M�?�|�5�뉔`�C�����i���,���;�8����v&F_U{ŏgJQu�޻�h��������%�Z|L����D�L]�!Y���ne�J��U��bdda�)[�o�6�?ﭩ��[�5�5�����zQ�"$r~��r�~+hU�y�\`a�駏��_<�����.ݽ�\F������Gu;���������А�;��0֥�|��T;�!:n7DQ&�tr��� 6���b�uz���ſ[V��� ��c�֥k�/^Xxk3Fe~ Ky�)ӓĨ�mM�ɭz�wKy�)�a��  ����^je�#���4w��X���Z{}9	@��b&	�&�����J�#��>�q'��K�c#��c"e�x ����O�1*���S6�ܜ@+ͩ������p���b�K�l����}����W�;��}O��  R�L�:��|E��"�'�c�����G@Au���C�s�~� vZ�X*H�O�g���Ja�"��׫���
��$�������dZ"�ՑC��5	w	72��ۜ�����Y��̷}t��";��E�S6�rq �6��ͤ,ڔ-��n�<�~�����l|ȇ���0���(  �hR5�+/i�P�O��|����xe�r������Q{�+o�.�� �X��QH滴�DbU�@2rv�d?Ol�I��}z��j���0Ox+�k�c��U+b_�k_�0����!�"��Y_�^��B�2�� |0��S�[DS�/:��2��t��"+���L�N:G'Hi��mJ�i�kW�rDmb��۝������."���1M����
F�%e��d��x�я�N ����V��\��� P# �eA�%S��Y��1���G��W��]	9�^ߎ��ׇ������ r�M�b�6m!i��� �Rf���Id4�"�=L�O�:(��;�<[�@�S T8�$���{��2�{��r���g�]��;� v�9X�����ȁ�0�<���i�����q���3�c�Y�3(;� �X��QH朞%GCjlMk�{�X��QH��� @8����S,!��񣸎�rİ�~�����H��0Oxrai�Z��$�r9ak�����Ժ�Ldq�dL��C� � ���}���_%3i=���ژ
��K�����Vq�훷$��b)l%����=\��� �VL�:��|E��"�'�c�����G@Au���C�s�gZY���xTL���~��vB�~��
rS6�d�g�����OF�{����./�HI��F̒u�l��:ϵ�%qnb��������@5bc�y@'�R$`�O���V��|�� �P]nAʷ� 0�P�O��|��	��?���\�aQ8���09&���_Q�/�Aʗ�H������P�85��������4/��g�T�X D�)����[&��Be���F��1����f�fm�&���oof����S~�r��B:G8a  �0s������E
e|tD0Ls�q���`�p�[DS�/:��2��t��"+�����HY�([����5dU�H���s�[s�Ih ��g��c����1M���#Hz"�:��8��x�JM���3 _�R��b�G4��*:S`te�������Dt��� @8����S,!��񣸎�rİ�~����B%��<1�"����dZ��ȫ�$�G*�a��&�"g��PCS7�sdP����{Q���`)#=	Q�L$Y�r����}�8i�������&%�W,��:�	yLM��cVI�c�i�����V �_��cL>S��(�loP�����KU���@*h��������5Ld 
�#{������:��|O����~0�َ����09&���J�U[_��le����wE'�:��rU�.h_��~�}� 7��n�%���¢q��_��36�~��Ҡ�K�u7�����oof���L$�8�c��G,J�ޙe�G%O��.�5[8!��7�})�V^n��\��q���iC�띐��N��A��{1�q{��KQ�ɑ�
<�y��t� �0�*�Q�,7,���r�J�Ј�C��� [��c@ ��r��)t�nH�8޿Ƅ�cTi�d������G�����+�~I�����n�ʴ�����������������֖����z���w /��Sޢ@�N_���\0[���;A�v�����]u�]u�_���Zz뮺뮺����_��� %u"��G�x}���d����
ј��?�p�A��W�f��;��SNy��W���R��b�G5�!+Qn�E�� �����|����=������h�Y_�P���� �<? �Џ��� ��s���| 
��Dc뇨U{S����QM9���k��N�?J]�����5���? 0'�(������������?�D�0���Ky�)֌��E�F�?k�_��� ��s��}�c��H϶9�s�T�7���ƌ���}�������Lڛ��� BG��w�8xf�<z�G�}����W1�/���o�C�t��,����&^�֖��D���0���+Fb����6O�2w��	��}q��g���> xS�&N��C�}O���l������y��I�������'�*g<�Z߆&i4n�G�5�7q��m7�ՌH ��"���˽��s����b���
��g{�~E��3ɂ	SF�8�b3P.�_�/Y�{rI�pN`���m���>?�~br�������Ӌ�F�t
��������%�Ы�v�M��3(�c5����d��j����^m�o��1=��WAp�=��>�L�������Q���df�7<����	�`��1�������k�_M�CS�-�����rN^�:�������77s�p���_��][��:�����?m�N��}E{���7�c]��F��F_�{�]u�]u�]u�\w�EE�����Ki�� }W��(�����z	��sM@;--��G����L0�c�%_�t#8dR�p��!}  �5�~0%����mw�H�{�B?p��҇���뮺�����@�]u��4H!��.�[S�e9Ʀ�Pp���¯}jL���,~~O]u�]u�_�LV�����< d_+/�ÕU����U�`o�gw�o�-v�܌?�@$�����F�eT��^�X��Ikm�;���`� T�V���Y4��ɒ���0�'l���I)��C�l���� )��Ӓg?�,��c��#y3�^w��J�+����}����������d$�ߒ�8Đ�� ��,%�l���)���������*�c��w�����?�}m][�և��P�!�o{<���<JO r�i�W��2 �H߮�2���.�9*k��kiÎ�~F�UC�)�.���t�/�����`[�ɥ��߭{�����/͡���k���~B&d%/[w����+�36ȇ�G��� ���y�u�C��%@��97P����K��� ��c��i��Fݗ�9���������G��dM<������0g��ٷ�=FȌ��<#ZQg�s��	��.s�K�ٲ�u�>,�f)��+*�b��u��Iv.)Ͽ�Qܯ\��H����(��C�A;yS��!z��5)��%K�������Gh=&�����k��P���]�����w��_zY_�6W&����� !�bn����c��w��&�%�_A�L��ɖa"%l���I)��b��o�ʃ�J�?��c���c�~;v}�9��$w���jX)A��f��Mݿ�x|;��}6�����e?���}�)���Ɂ�3��/���3�*D��}��A� ��{=(� ���M��0��d���|;:"z����W����X�>oAb+����)���˭������~�>��4!��k���� ۾�8]/�N�xRt��$��n��I�ۀbx�8��g�d\���d~ �
(# �|;:">�Q?7�[��4�0�k����f+u{�������ii�����5��P=�w���߼5�3�/����=����������\
��|�&��'yu������"�׭QQ��e�pM��3��D,�J5u1o��]���9T � 1��#'����^�x%#C�ʓc� ���vOF���A����S��98����Xۧ��,����6�b�����̅G��,b����D4U�?������@���1�S�?�g���M�(y��@o�;��k|�"v�h}��;�ۆ!i���z����`���ԋ���jX&����b�m�Q����27F(��������R������ ��|��Ò�����he�9O����m�Sw�Q�[�&?�8�#����i���K�II�n��F�6\W���f~���#d�6���3����^��%�8�û�l[��0nWw���b`���0���,��2u'�S�����d�Xl������  �x�4��?�n{Z8$+��p䵚}�L:�7���?�@�"���Fڊ��e�G�����6?�>�� ��x�_�I�`rA��k��$wo��ty����'�������|�ܘ�o���V�e-���G��������,�JA�E������~�%��qj%��v�p].�-����)J��FysL7^���Ӆ�{Ѐj�FUn�͈粦��p�ԙ_���ش���&l�_Dz���#?�ޅ!����L�?�<)@��ԛL�2R7U�v}л��W d�n>���t���/�N�ԡ�?�Pnټc�Ȍ|0�cK���΅�Xu�`d�w���b��;�/�O��e�i��)�vVH�y��u���/�K2��`���F�_���� &�M��I��2���^��� �c��+�M�d�)딷T�M��z
Jo�`�A�%m���|�>����z\v�_�~�������������������?� ]����������U��~�{a��z����A���u�]u֫����)f%�oc���1�Aw�۫�ZX3j�jLa!4�;D���Z�mae���7`%c��q���{�̡�%�Zp�]u�]u����w #oN(�3.���7�>�֙s�2-�k8�9��8�C���¿�9,�ף`	��v�g��<�7ן��!^��Å�/�o&�D3{����s�����',�x	��v�)�L��o��V�����^��_��4�i$�I����Ki����xa��C�eW����SE�o�a���#}x��Å.�����I�	������|��i�SE��W���6Az�Z��u���o
�7Tg)�\� $Fޜ,P�v�Z�H�]/�ZC���o�}��2��"d[��qHs���3��~.d������^�v�Z�ɦ"
���r�����W���;��"3|�>ę<��W�+Y�{�>Izۼ����ضð	�`w���_�}LW���� 'ؓ'�J��k>���	@_��� ��vB?��$���yzv\���[���1�鵽���;�(>B���$��y{<at����o�C7�t]����s`+!� ���o<��!;; 2Ѻ#0#�m������w���iP���A������3�a~�?�t5���'a�;�Du��4�NZ�ջ���O��}�����z7�h���"[�]����¿����a��7w�/T�	�߸�KX�N����xW���9I ߂2������@�lWkR����`�`&H�o�������$����v�BB����Y��+r�����8v !C��Ă�����r�"F^�·�d����'-5�%*�F7��(�0���g�xd�����^T<�^�vߕ4Yf�������ø �zp�Dؑ�t��ɿ���˟ȉ�o�Y�!��y���>xW�G%��A��l2���L����C!g�F���Ӄ
����(���}�y7�!��ld3���üNY����jR �"3|�_�g����_��˪��;���*/����x�/ve�v����;ｭ��+O��"WkkkkkkkkkkkkkK\v~�c��맧���|!���9Ŗ6���vJPj�� ����i�|-����?>�ko��n���=u�]u�_����AB٩�����|J�ԥ_��������e����!���t����]�#��{#��X��os�i�ѥ���s�A���r���Fc�)˻_���뮺뮺�e��%�B�H�>�*�]_l�|�	�]��,�ጏװk����W��I����S�o�H/E?��������|~h4Xa�%��m����!���P l��uB^��d�x��0���XWR�F([_ߝk!�Ä��$O�r~
�;�?��?P�,��TxC����Y�u��i�����L;�F����������nh֖`��~P �p��:BJ�
� c����m�W�w������[��Q�{c)����~�p��q�����h	�xp�[C��+k��4JSc��7C~�w�œ~��0k�{�ʉ�{N�A��(uؕ��uV.����n�~��i*��8=���ހ�!y$o�,�M?�%	�U��~>ٵ��è^Į�{�0N�����v�v�6i�Pi*��:�ռ���&�o=�u�"�٫Y5�����yq��rW���� �>��SO���;����)J[�8��1C�ɼ8�<Oi���54�N�h��>IK �.����S��� у�|-�](�Q��������6��Z�<Fn: 􏖑���*�^j�DA-� ������lI-�xx�Yi���6�#0.P0k�{�ل/&B�w�L[b��*���s���O�L��G�����C%{��?�?�}�3�M���_����v�����`��"o�����ݨo��_Q�K׊���_Y7��c�$R�w��P��J�{�
 �ґ��ww��i�n�X�I�߻��j������� �������E��߿�!L�9������89k8� �`s�?�Ҕ����Rɧz�Y�I��my�<�y�<�ђ1�~���"FrW<�[^�����8�a�?-����L����_�m��`�f��QM6g�����#���֦����`�������%|�J��l?���@��%�B�H�>�*�]_l�|�	�]��K*�c#�������U�*�E���-�����O�h�j'�����V	l��q����Hr��T_�;��d%�_��2Y�\�y �2��L�����k#G��U|H��4��<�w^��~���N;67ǖƮ]O^��'�F�o��%&esw��>z�x_F�}�;�v���0�[}�ƀldR�l}-a#^kSw�����:����;~�p�C�N��PO���r����}?Kߦ�^�Rb[$u��"��������뮺뮺뮺��;;�맧�Ɣ��c8-�	�� �W���m8�ű7O��O����t:޹ϴ�����k1�Ή�P!� ��,����U���뮺뮺�� J��y���?w����1����P�ba�۠>� 6���[�u߀�����p���`��+]��]u�]u���C�, Vt^��B��6��`��;��`M�g�Xeo�B����/ X ���VQN2�XCo� a�T�~`!k
�3����e�Z~�B�Ϸ���>^Y��������E�h�C+npL2���ñB��<
Q{��׮akJA�7�e�9�GF�]�F�J2M�%���ZrJ�TY��>!s�?���)���4.��GE�J�!z�v�N�ְd뒐<X���bgT��Ǩ$#Z��%�y[�{���ww6��=`�4��'�as!Z�Q�����!4`$Aͩ� ��!e��?�c��,���&��$ژ
~�u����>��ȴ-9U�CjA��d����wݿd;b,���2��\����������ei=h�����h�n�cj*�D�ChD5������G3����ӣcuw=^�w�� �8�Ȉ���x(���Z���cuuݞ�2��*6R�,�V.�hq�,��c�4uA��$c��`#B%�&ؒ�*5bS,��>!3�?���ZrJ�Tk�j9F}��-�Lk��f&%�8�x7��f���g/��fD`a ,�-�3�]��)��0�O���c�U�魇a¿�-��
�����K~`|w��=1�pxa�ͪo�b�v���:�#)����S����فj7|w>��^�{���C~ �s��'�� 08��g��l�cUU���Rm��P `(��a���䁨�N9��=^�����. �,�T�1���{��H�29�U��n|}����z�r؎�q��ק�< 6S���P �' t��B���|H�Q��LY�u�4��3��<�,=���?���]���V���ϱ��<'2�*�=:R�m��;�tc��,����ڊ�Q����f�gz-RX�2Hw���G�h��;�;�?��.52"-g���B�˗P�YR��X��g,�����h���G3����ӣcuw=^DD�r�}N�����G࿉�2�ЉCfI�$�
�Y�lU�&t��
�8��7����,f�G�PA,�;I�-9%r�?��5��>���)����ĵ �L���Z}���s¨��Ml;�ql�VN�����0��ƨ� 6r�3��@��[A���v^v�LS֬�1��u_��$�ߘ��d���gb��/	��lz��ig#4��z�;?O�/$�}�����.�A�j7�T��a ' -?�'.��6@�Ei��gQ=	�L��֥���z��V����o0|⭟�-�Xr�]�8���8ӿn&b�Rf� �)�B�(_F )�#FW �͠��0�	�e���a�^x�����5��W�(}�&}��&��9���*p��a�i�� X ���P�=�'e����=��R�3��A2+O������z��_�?�x&)�P���N}[{f&�Wcg��1C���� �*	I4�PA�� 1�LFsߴ�"r���zO��M�8 �8h�s�xtln���fMW��\A�X9j>��cuu��G����1�c�O�C�f�p���m6�
|H�Q��F�T&u�'��.�h(�g��vw��/<C�d��nP�^L�=x�kn��ُ�Xl;�:i���{��2hк�|���L�W�,/�e� :�
|{B���B�D'F����5�C���)A�3��3������frG���a�����#��K��dT���=�����[�MY�9��	P?��ŕ/Sz����BG�ѡ���������b��ο����������w�D��� �F�L�ƅ;yb�O͟����}��K%��S��Ԍ���h���ѐ�l���;�N�5���A��|�P��*��T���fS�|�Z9N��čl�@Wj�x!��������3c�u��y(�$�X1�C	�����4�!�`� C`e�C���k(�0�oͩ�9� n��K޿Dn��� .�3���]%3�}�>!��]vK d��ڙ
�J���D;J�<���U�"�<���5��2\C�_?��fh� ���2&ƢU`^HO����;rk�JwtE�pem���R�Sw��) }y���l�e0��Ƀ�0�Q��kv�r���@��^2�9��_
�d��Rkkk���]u�]u�]u�]u�]t�����]u�����dr��#��v�t%�,����]m=}ux���f��o��c���u��¾	��N��[���u���"��?��t/d�|��?����-��B�p�}������ $�r��kv��D���:��K�S���0��*Cx��궴i5���SI�mMڵ�R'tSfZ�C�I�HJ��r(��w_�ò#2u��SFZE�(�d�M�|�����~���ma��)d�~�����4��L��������Ѣi1���]�����,�D�Z��%e�����C�~_�%���h[���/��g�X@�C�$�}n�6�� ?� B�L���憨��~ފfZE����?��)f8��������أJH2ǽh�LѲ@úf�A,%����?Wi���?������ma�������e�3J$ʐ�(;��_��U�h�dx���EE�(�KV��䬫��l�@���Ä��L^r+���!���jiq����ә6����5��Ckǧ����	����|�f>� ��c~�F��%��	��%�e��IX����6���~����ٙ�ׁ��d�{���S���c��07x&���]��uϟt�ڟ�#1¹]�j�֟w�����^����.�� !K&[�\���5&n(�H2ǿ��h�LѴ/�,���x��U���i�w�߿����jƟ���#_��x	��(��;�D@X����߰�G���u�1z�pVNd�`��kF��~)2R!�
gGE�/o�u����tc/��ƺ~?���GCFT���T���� ���0i"�fD���u3��f���o����}��A�u�Z;658��)U�[S���wM��C�/�_������Öu]�ˡ��t��];��뾺뮺뮺뮺뮳�������pm�$�Í���f	cq,S^f�j�<4���y6�VK���	��lo:nj�]��_������]u�]z��~�Q8����_��	u��� �DES�o��6=?��z�� A����`:�-�?��0yde��,����	��c����{@�� ���S:)C����=	Y՟�ђ�Daw�=o��m�	Ėߦ4]��ih>�^����ѢC Ai�A��|�]u�]u�]u�]u�]u�]u�]u���YT���뮺뮺뮺뮺뮺κ���5�����~�=?�u��<U������6w�]u�]n�맮�x���u�k]u�]u�]u�]u�]u�]u�]u�]==q�X�~����]u�]u�]u�]u�]u��������]u�]u�]u��]e뮺뮺뮺뮺뮺뮺뮺뮺맧�;��O]u�]u�]u�]u�]u�\wEE�_�OO���
{ 	�x�a�7���2��ø�� �d���|%��b?��_wOO��뮺뮺맮��@��ڳ«k�S�~�`��O��O�������4v ~�АQ��ۅ��M����H�}�@v�kj���d 2��}�W�&�e��}Ļ1� ,�������ƛ��F˯�3,6�8 }�[BAF�o$-99WodBl#^��P#���_��3*9L����:���Xj����)P��'�H1j�%xy�@�3y(���?03a ܉f  H��%0�*����v�n�������d2�Ⱦ�vcpiH��_�6'�����hR�f8Ͽ��|g=�`."wb���	܉f  H��)�%0�*����aChG�u��������3��`������U�INsM��Z�t�o��Ҧ�A�
)Z����tT.)W�1`'\�|�nm����f� �b. �wD��
�������B�����v���N��P�Z��ذ��_�����v
n �P�I�|?��n��Z��i�b��3�Ok ��_��?_m�a��F��)>���dU��W�u�Y���ՍH����� |�s�P��خ���&�K0 � \RQ#����������S6�c���O�����[�g�����I�4ր����i�Go�@�7��?�LPn 5�ȿ��퀋�?1��[�uTN��0,��U'�EM�Z5��?��(ø y�:�=���;��+�wI�Y:NxF_a�mA�yݠQ&Ε{�ËPW�6:��0�� �� ]5	�o~?��HtOq�%3O�Qo��1�GV ˑ/��}7F����g��Z����>�=?߃�Q3!���� �� ]5	�o~"�fC_Wg�I��.]A&�e�Z�D���cפ������!|y�C�v�8��KS�[݂ ����U�p�a_�%+�F��&�}ziݱ���w�����/+�d�|K�c�`��c��?��6�bM���}���B��ov���@s�H�����ڮ"re�P�L0�';��
]�L $��-��$.X�U���{��O���Y�{��z�,F6@���0Z�j��d톳��^��9�q;�w��9w������c��Lژ�`T�=��h{a�*~�k��&�h�B��K�~��W4�Y���͞�.na�l���[ ,J�fw��?� ;!�dG�*� Y�G��Q���� D"灝��\����h>\>��d?�v �#? �9x՝E�n������g���>LS3V�U�����J{�h���k߯�r��������`8��^��_H���r��[�F�@�b�P����N�����v��������b����n����� ]5	�o~�I�QQ3!���#�}c���j��.������6?��6�ی'a��/�����vB{c_��� ���'�~�i̳L8l]�4����/78���ك�?��`4�Z���1�:�mV+/����dy�S�w��mė�����0TǸ�k�.W��(�#��,�� ]�nn�|;DJA����+9=��>F��R90a=�D ��H�)�]�Z�o��k�<9b�q�GO�?c�GG!���>&���:��`�P����QQ3!������#�}c������X����m�F����}O<S	E�]~�D�h*��3a�i
'd'�5�`D�tR��_��s,Ӽc;0p����/78��dy�Sާ�� Ak�[9�`��q..`��s�T#�C���0{�xl�1Bot�;�B6�K��R-��yo�iT����F���'@8�������s��}gn4� �}}O.eb���,?��7���5,�C�����I�@�?���5�]==u����뮺뮺뮺뮺뮸訾�z{�Q��u� ˦Vm���뮺뮺��� �}'|���O�7'�r|���"����"]� \�� ��pWׁ.b�.�,�R���8Āw2���y��<����PD̓�q�G�JG��V��E�U0p���6���?�c"J_�P?l�A�������]�asq3���qa~�q������,�^\�A���⍘���o������O����/��[-a��,,��e����ͳ�� ��s��G���h����Qve�����~��\[�A�`�Xyl<)��>t�_�z�s&����/�XxإO?�׀n��H���YC�̍��q��`o���đ"�S]:��O��
�k�����HZej�{�ht�~���K�L���lŷ������4�/�����#{����?�%�7�CN�ʶ�H�?& ����AD�<�l�� %�D�#� ?���{{8��̾ٵ0~� ���$~���q;���O�kʐ������x��i�݃������������0��e0bl�F}��d+Fu����*<�Cb�4݉Qr�����@������36���e����}�uU���"��K���	����{���]��|?�+��O�&I���t)���G'������&��������@[|�=˶J���à��?�Q �T�� �������1+9����<�r����2�~u�z�u�'�	ia�! 	KpG�c��_7��݁T����_0��],�c������29>�����o{{���$ɿ&{���_��)z���W�Y6��~�[����p2��,"hĬ����H��f߹I�~�h��%@ J[�|? ]|���>��My��,�c�����?�5���dr|�?��߾�����M�H!�~L�٫ F�����]:��C��l���W *k�${� �$���v�K?������4����
�~ 
fe#�P�P���O]t���]=u�]u�]u�]u�]u�]u�OO]u�]u�]u�O]u��_��"���� ' -?�'/ ���Q�L�р+L�bUE� d|�%� 2
ds�(u�\d"1C����]C���༥[��i����x^�'��	�"mM��Nd�n&��$ژ.S�)�hs,���dR�ł����o�߽���섫��T(!����`�4KÚ�	8�����o��1�e3hD��$�_�)>��$�UG�p\��~��q�l��覌�4E�ѱT/�%���E1�Eڤ7��kF��.�p5İ��\���B���i��J���s���7�|Mc���<��~�ә6����u����'����e�谻A�?��B8�������`2O���G,|	�"mM�&��$ژ
~�u����>��ȴ-9U�P��-y��-"�i��i�è�C�*�9����i����? � dᣙ�S��iѱ�����q��Q�y|ƪ�~}�&��>0p
Y2����F}���E5��� ������%T^�U��M����' t��B���Wi̛L1� �45G.[��S2��/��La��!�L��}�{o��`?��9(��p&��9�7��kG,�j`)������H�Q��F�J2M�%�k�}mY�r���߇Е�k��hyL���}�lU�'I����T��A�/㄁W�����q��L�q.��K ~��ZrJ�T~�29�]༥{��i����p^�'���ඈ�>��&tjA��V֍'~��y��8e�wE3-e����3|Z����u��!4`$Aͩ�Wi̛M��Z9d�S|
~�u��� �wϭ���~��v�Ƌ^vE�iʬ��4׭=�і���D��>B����o����� ��h�|���~�29�U��?���	� )H&KN��}���C�� 0u��C�"ؽ^1&����!m��rfN '��;�#a?o�b-�Ց_9Z[�m��9<�]�w��'>צK�Y~�R���K`ߊY����ͱ��h۞e�����/k���y�f��M���4x,��7L9d���&��������SwhP�Oz��$%,M���0+|�N�pN��F[�L�����\���33Ȍ���4Py�L���J,��`�ъ�/����܆7��k�yS����<χ����C�o���䓄l�j��W����9���?��d�\Pb<�Tο�}�� w�a��Y�  N Z~�N^A[������� V�Ī��8�]�� �)��J譑����F(p��:���@7W���s���7�q9�'�=� Bh�H��S~�ә6����r�6���tS2��Y��HȤ#��`�|�ڷ������vBU�^u ��|��q��!���椂N+����[��_ČuL�(l�6ė�
O�i�+�Q��+n����p�;��)�-ptlU�'I���mL}A��⃻��Ѥ�ˠ�q,"a�=��.�`��Zds�/�+��'�M��X�tO;�߫��M��gF�A���y���hz,.�a��#"��>/��~�������Q�xFDڛ�L5��I�0���������wϭ��-NUfT>���^E8�Cȩ�i�Zyu����C�*�9����i������ X ���W�
�3���p��߂rn&b�Rf�`M�g��{%k|�w���.ƩG�ؿ.�����P �(��y���� � V�Ī��yJ�>	�������(T����9�i�3� �G1+������2�����FE!|^��������9�Eۀ!4`$Aͩ���Z9d�SO�η��/�F:��4"Pْm�/�;]��j���O��;!*�?��2��L���}�lU�'I����T��A��q�@����@n�8�����T�%�?I�-9%r�?�V�Į��^R�ς�����8/]����[DSDW:5 ��kF��~�X���2�;����2�ߊCD��>-h�z�ú�I�&��9�7��9�i��kG,�jo�O�η��0�����w�o߽��k�ȴ-9U�]�������2��\����^7� Y��-����2!�5 0�PU͸ ƻ�t�ќ�����Q��ߤ�_�}����fI���!�$"���zj�f����p��V;p��+3$�(d��m M��x-�
]C�+�|�E_��Ћ���)�1��3���)پ�'�)փ����]ƅW}S�P�}�Y\l�]�:a:*BϬ>[�����M���\��p1�7S�B%��ro�7 ���.=o�&E�6v��-�3aa�S�cA�	�-��Ċ���bO?�k(�0�o��XN����|$B7\˵���_P�-1��^��d���r�u�e ���kS!C�I\~o{��ǌ����������4��,ٛ֨�	��맮�뮺뮺뮺뮺뮳�����z �1 d��<g��O��K`�=�&��L�m����vaa~1�[M3�gX���F��L��@���]u�]u�O]u�]������T� �L}�P��){�~n��4�n&>�ꃨ�h�cTE__���:��2���c������L�M���ڙ|;w�����a�m�%��~ Ky�)�v��J��Ͽ���ÿ����5D^u��e���1�DWK�
/�����C��෹8�V�S[�s���G������< q��9�叀:|�ZC��\+� �����k��}�V�/����� ��'
�sj`+o�.� ��s&��ϴ����xH���85���;��rRFU��*Mǰ�[�D���+/7iq������_%3i7'
�sjl
��K����+���� ����N�%}�	Yy�_��; r�M�b�6m!i���vb��R}��+��s��\�w(0��\|~��c@������cR�Nu�:��rU�˚�s3ߪ}�ȫ�-�[�ѽ� D�)����[&��Be���F��1����w�������� ��t��S גt�L����A���kd�u����<�l��?��5¼ �	NS�����}�iBVW�^Jޖ��!^aŖ �v���E�E1�"������ �SI��YC�ͤ-:�=��)g�?�ü;�� [�� �3� FN1gc |T%���U9�� ��.�y����0�6Z 9�p�d(�"�����6�/�a���øHl������x ����}�����2!����x ay+6�fww}��8 �-\���M������h ������m����þ Edn���Uc��^͟����� Ͽ���+��P]B�������~8�#�I�z�%��_Xr|(���������A����m�,T � fָ�	�;��w@8�7�^�뮺z뮺뮺뮺뮺뮺�:맧���]u�]u�]=u�]u���.��0��>2:`!��@ 6��,~�@����(S(���-Lj��j⋞;p���P��t�i6�~�ۤ�4 F߮rDmc���2!�)����",�� 1��xJ��eA�%S��+�%T5�G��(����&d����~0�َ�����M�����"`��W������V(Ŀ���>�a'��XC�E-���x�U���y`p�=*���:G'Hi��mJ�i�kW�rDmb��۝������."���1M����
F�%e��8~�<8D ��*�*����~0�َ�����}O�u8q��?�P���u8z�6��F��b�j����iLb����Uv.�XR�ۅ##�`&�pK�1b��!E\iJ�\�`�(8���52rv�������g�W�-||�������檕�1/���v��!�"�Ɣ����z����L�;���u���� � �  R�L�:��|E��"�'�c����cLՍ�z(���3/oTr��^ߟU���]��i9�B!G�V����N����I�q���B�\q;�skA��8QWO�����H���8�����q��8@8p�jq.�� (��j2̙7�TBU>'��pD?Ol�I��p��ɜ��+*ڷ��w���k�S	g�d(e��|�6�?s����~^�t�x�G�~KQ�ɑ��5����:"6�����tQvv�?�� x���ZR�_��2)���A�IK��?c�Dqq�+�Bu��^1���!�5���aQ8�`A�F��*_���� ��Ž��3{���L����}+��O���8�#�0� m�9�X�eao"�2�� ���+�����SfO������p�Ze~��&1�
�2�~k���
7��l-:~��!��{fp����]�JC)/���j	�������G	FRb9�ͣ���5����������3hRuu�R�DM���h��ޥ�f������!a�K�u�&?�V�t���&*���V�A�s���C��b�5��Џg�>A+u4�Pe�0J��)B}�Tl�Η���Zh��#0O�쎼h<M�6�A�N�K��.�D(�� P��kP+������3c�oO"8��'6<Ʈ��=FPY$��"Dp�<xš�'���ݿ�
�\^R��q�zI?��@�8]:,9Y�L=�r#1%1��S{����0�2���xR��D�����}oߡBX|4��!J]&�4�S�����9������(�} 3`n�wM�ڧ���������J�)�����am�^����h�PN�� �XeR�� 9k�W� ��r��>Y6$�޽!�e���:F-�{qN��;%M67�� �3�a������u��r��zm����8��6��}}~�ن/�<5��Np��}���mOؕ�?��{�21�5b�ӟ�vq4��[�+�b�ߺ�	
R�~��ބ�m������l����+��R�o_������w�  �xj �7_K��2�F
��+� �P�'����3+iF˨8�F�(�����3�t0�[����{���jf�=^aƝ���"�d�r�aG���xJsc:&�|����� �@�����Ez���/�`�%N��?F%�`E��٢dfY�8�q!*y2G�=x���!աώ�߉���1�ok�Ȉ��d]_xP�t԰X���.9�+�A;�-��M��7���[�r.��p8/9�z��/O���뮺뮺뮺뮺뮺��t����0C��`$Մ|�KǇ� �N �o=5�]u�]u�O]u�]�����/�pq	�o�3�G�@H @!����E��&+�I��v��A��C��223jl!��������a6��a��%�V�_zu� ��G蛧�7��!����������%����������,�9�����<FaF�|����v�߽�� �3�*�<�9
��s@���x-�`�C��	VO�"��-�~�U�7��������	��3~�n���}�UzA�� ���~�I�7�$ �6�����������=W?����+� �,���l'����ҹI��3le�x���k��F�?<&�[��Еd�2-�5d�o}4����<���ئa����qM�-�a4��v����ؓ�x#1�./C}� Ο�2l�; ��"�qQDAv@1�sRMK_�sg�%���l�^���p��TQ\��i�]Ž��ʜ\�a����s^7 7�տ�@ՇxM �e�I5-�Jv�&������� 	�8��/�&h1�Ey��1>b'?e�@�"2w�ϗk��3V���ٖ6� ��ǈ�(���HY��͌ ?pB)����s}�+~��\<�)z|^�����0�N��s��؜~��A�����,DR!��T���r��	0�_{��|:�a��� �\ "-�)�Q�����E'���G�Y} bk^�`��CVՙ?����.��� ���0x���f��!����E�h[j�������7��-�3�
a�I�7����y�0���&��M�l���� ��y�0__���] ���p2����,I�~ -lq�3
?{���׷��l`��O���t���-��*��d[����!OO��[F��K��5&���Pd��$���ڛ}�m�h;� ��M���k�E�V�_zu� ��G蛧�7��!����������%� T]}�����j����r1G�^?31��� Al��������dV�Q��� �A��X�샰�#�r!
�@J���������H��?>�O��ݼߠ�����i�%��D7�Z��j'Y�\ƃC�1����;�b]��7]�xzyCR#hC��������X ��a���@���4���O�H�-A����ـ,,!�щYV�������h��f�5Yw�Wݟ��y�}�f�d�w�I�h7i�g{��r01NN�83��~-��!��V5�w��9�~#}�ן���w��,%,> ��_������(��21j_0A�>�����/,�9�Z��Vw}m�
�!<�������v�������O�o�������y��la�,���;��/\9~B����"x��8ݘv0����n�����_�i.��o_�. 9-�=��ӻ���f/X����cа������[u����?�r���΃��J�Qd9`��t����7U��!_��Z�f�㶺Y���)x�g�	��`Pk�8 ��D����51dw�ܸ ��#���V=V+���&�Kyx�o��b]���F��?�+����Y+�#u�w�w�D!\�O(jDmQ����az���3�~0������tL'��i+n�����#q�C5��i뮺z뮺뮺뮺뮺뮺뮞����������)�o��xo������n��뮺뮺z뮺����] �� h ����e|�َ1M�=	�O�"����'� ��I�u�5o��E� �vA���>|�t��ʽ�<�Ғ����p���w�qM?�5�Uohl;p(�p�����g��W�&M{�aAzo"����׀L-�-���y�զw��)6N�F�����/h�2;��>A�K�e^:���'t����<B�U��}���!RK����T辟P��1��$��&��U��v���vʡq?��l-� �5��O�,]��֦`l�J��������A�����2��;�3X���A���Q'����fk-�&����D�%�ci��NK=��-�-忉c�ᭈ�+�Y+�5��?�k)�z�RŽ�tHb�>]o���5���K>qc3-�g��W�W_�����F����З����_�䎂����Lש������@?�� ��%�
vl������'�{���:�����PA󺏏�����E� �vA����7I~L����<�Ғ����
V���ÿ֝��g�p��5�
Q4������n����P^�ȸ��0��z���?׀_�@��^2�`4�j�������^��|��/ɕ{Hy;�%%����O�;�ߴ5����P*���*I������\�Pc��'w����_ �8��E��K�ks)f�����b
����9�͙�Ѓ��B���O������S?|���B"{�����;㉩���_�������҇��/פR7[��������_��`e�U�����0�g�&���-���-DʼFN�+V�|f�F>@"![�WV�֞a�A���i��L_z���t�����"U���܇�R��RW��0�B��|B���
���)�`�r�I��2AUɐה_Ɩ@et�b^�����@����< ��4i����x���f������R�4���������Ż��>�%��x���e���Z �-�_�{���������@<���	=_� ���)�VF�S�-��Ky����"�l���C��������p���5�VAmj�����)�1k~��� r@ʒN�c��t&����%��]u�]u�]u�]u�]u��/������K]u�]u�]t��]u���Ⱥ�	�> ��粨 �MȖ`  � p;�]W⒉}�^�Q� k����x��~ >�:�O��������:�w���$����#Dq�C�����_�
\� @�Ta �y�ꄬ |0pp�U0�A��H������ 0+/�'���!w��A�M�o��;Ŀ���0 �{�Y�Yh���0�c�M��~�@:0���aؿ0m�:,����
�	�0ў��o�&��v	���`�??'}� ���6E�
�&a��o�f�W����MF3L�0��?��"պ�����g���eݘ��M�G�߹���+�x��5����8M��F������xi���߀�-s��������t������f!ˤ
�t��;�	 /�Kͩ��wI�wn�J"ً��;0#�1�����%�e�X�ךP��CEN�>uR|f���aK������h����G�?�I]w�� @���1Pu����P~���?��Ԣ�fC_Pz!�3�8��3�����3�� 
Kp͂G��of�ߗ�qϵ;1�Xhxaf?�"�g�7g���% ���Ѭ�T�LO| $%R)Jw�B��خ��ƾ���|ё�OW���-k7����T�,�m���3ҽ-�^7h�K�������CP|Mݝ�uk~���?��Ԣ�fC_W�>�1] r4��M�@��jb�g�� ��G�������8>������ ��t�#��p��<��j.���r�4-�r��
J����9r-�j����	2	+/�4`̩�M��y��N|�����o�}k,���?��(W;�\�!�F�V9�=z_�����`f��=��&b���	�܂(��z!�鸩��Γ{
#��~���fR7���i��{��w�uy�h���d�Y�`L�@dY�=�|���F��������;0#�1���|�ԙ�1�լQ�#��m�$����7�Kw>�tI��Ȟ���^`��1��$�p(v����A�澴�r���� 1>b*�6.��C�&��?��}��2L��1&e��'��v%Eʦq/��;�W<�eE�CHwA���5pL�����)���)e�ИU�``$�=�똴����!c(���p�ę{�k�����C���ӟr'+z|�>��Tv/A]��ӌ�LR����l��J���q/ӂ��о�`n�O~2������ E�=�%3O�Qo��w#O���*cx�^��uX�.O�HR$��7��|˛���n�W�_�X�k�f;�Eh����^�?��Ǥ|��r�n _���SI]w���?kd4T�"ǲs8���?� 5е+�=��o�޷|����Ԡ�|��7v�rA�G�[�����&,g |&W[��� �"�3��׭<�L�Yq��V��{s���$��ͣ������$������8�ˀ;x�Q�q�� x�6�%���q7�'��a�.�w@�[)��6<�v��f��i�EUȝ���ed�!�/��ѴǙ�a"M��0+#��p"5����L���4%8�C@a/���K��k�]fr8߆�C;`��j��Z�+��AX�m��Yo}��De�#�k��M2�;����}W��a��Ŷf��]��$�m�V�y	G9��""/ 7�` Xf��ŉ�-��H���k�wp��/zԮ�:���kw����C&ǔC�gq6��|9�9-��p5Ϳu=��x�RZ���Avhʥ*�~�MIS�~XK˼@��.Cr�Aދ���\PI� E�SY�~ &$R)Jn՚!���4��* 43�`h����^�
F�%i[iF͘a,�##5�
H��{�$(���p��a(�$T������S�U��������Z�8����֣��w���k�]fr8߆�C;`��j��[��m��Y/}��X�1�$c����e���
Gg�|���=�UT� 0e�)B��s�f�� �1 )N�?��8�ɉ0d��� �[�8��B0O� g��B���P��&N����J��.�o���� �d&OW�U�T0�z>��Z�U��L|0BR�[�������a�d0.W�X ���Һ����	VO�"ՄV���ΝѴ%�;���sC+:���^k��] ;8���*W�b���p7L14{i��
'[�?{������������ݰ���K��$m�u���~��Z�i�=h0�	�\Nc��}�6�󬷾�`t@fy2=�p�Z7�8P�;9����}�x֫�W��I�g����B��b�GH������~��Dt�J_� ,+�oW:zb�M��	�?���5�?*'-/5s����^⒈D���U��hk�P�R��6AmQ_���C��ؤ��НK�]�JPpi�����s�aan�[`��RU:���ݞ� ���;�U��a>(I�j_��e�,�]��Ol�K����� �eӀ�5h;�����{�ޫD��m�w�&���?��,n� 
�i]�. ��PY-\�vQ)����&��b�����_Y�� ���T��ʨ�'٩�t�8�d����r͋����İ�(o�2��UF>�HV	��-1���5<�)�XE�� +%�˃�	�(���������{�P"�g�7g�֛	�BM�R�Y� -���P��2���8�d����e���"'w� ��ӻ��{�0�Fq�C���hg��cw� ,�f�,����b ��e���	�dn��s����>oz�^����@l�C������[���R�%����D�u��	�pe������z�mt��]u�]u�]u�]u�]u�^O�L9 <
���<<*:/�w<ҩ��wv 5b<��������<v �٭������L�% Ǝ�C@�x%<�a���@��Z~���p�G�=��c3���;/2O��`��� W� ^I.��2Ħi�*-��� D�·�+�{wQՈ2�K��AѪ�k�8��Pӳ*ݿ����Ɉ%t����&J���|^Eh������P-����P+��Y\
����
��s�3�Kh����KTy�� iW�݅!UB��� �ilV-����4�/��������6(�����c���V�fj-�v�o0+�fX��PP^�̓"�\(�/�~j���B��wʐL���W���� E�=�%3O�Qo����[�j�L�L�1��W �_��)D$U�i��3f0�2�~�v}7F���܏X� ��X�R�R�/h��s&�YK�*��u������L��(�EZ���`r�LE}����v� ��b�[��ݦ��'l����O��a\O�F�����gXqm�ߦ�6׀�L<��2L�d��'b���b9x5���Z��a��-=�_ �'�B��4���V��ʐ'ӳ��?��#�u��!�B�b�����!���sNe�w���g��F������'�w)���T�.<n �bڍ�6F����3���o:��NBфk9�/(;�!a�5�,���:���d���D?< 3�Y$0���#O�w_��׌�I�ʹ��Z�$��?�Fe�J���~f-�4�����f�EWs��S,��7���K�Y���^o���9���z뮺����]�0������a�������9�?�B~�k�_�	����-8uq�\m��@�֫w[��/���������)��6ooim��������������m}������x�Cٜ�hMO\w�c���뮺뮺뮺뮺뮺���G����$���U�� ��������o�(�f���9�������=8���������3�7�_ˏ����O��g�{�g.�����1(�"뮞�뮺���]u�]u�]u�]u�]u�]u�]u�OO]u��]u�]u�]u�]u�]u�]t��08 B�Nd�g�Y���> �'2"���뮺�뮺����u�]�M&K�����6¶�q%c+}�޶���BV7�Y�����L�vm�Z(_^����5�f��g�$���q�Xv�5�8ܻ��[�����Z�I+�g��-���mC2�Ӄ��4ܺ��h����0�[�A$$KΛq�F���]`�;��(r����r3�!�-v���|ZO�1u��$���~/�7�6�_�0�챐������$��v1o�]�l_���k���Ű}e�!�°����H��L��jD*Yb�w����V��EX�W��/�O�c���0���6���	Q�o��DZ�?l�c��ʑ�� �ƨ��4n=n�l'g?|�-'6SeSE3fTZ��`���ɦ��x�ٔ3���뮺뮺뮺뮺맧���뮺뮺뮺뮺뮺�뮞�7�}u�]u�]t��]u���Ⱥ�o�]{8�?��]2F<��{���y-���&I��hɵ}�%$2�=?�-�O?�-���N�����xGX�h&������EL�An��n�,z�����- ђ?�νu�g��_P�?��[���#����#Z���tbvS�
�׎�K�T��ݡ���:�m��a������k2
�8i,p���Z>�7��HA�m4
W���� ���Te�r��\r��A�A�Ч�D4�z�l665+���k��s��H5#`0~��B�zѫ���x�(���R4���od'��?���{oٳ���u�]u�]u�]u�]u���]t��]u�]u�]u�]u�]u�~�zz뮺뮺뮺z뮺����]M0�����]��v�G�6١6{�F����k�����H�\3ZL�YQ:�����������뮺뮺뮺뮺뮺뮺zz뮞�뮺뮺뮺뮺뮺맧��뮺뮺맮�뮿��E��/��X |<��2��s��������� ��O놗����=:^����a��t����pH���O����	�i]�ak�t��Y�+�� �_}��{��^_�8�� B�M3jo� ���dX���:��G꿯���GG!�u�ZM����"&�΃��a��t��K��O` �M$�I��� x���Ƭ����0����_ �CE��輑&���]u�` �����̌��� �6]��7�o���+����뮺뮺zz��D����뮺뮺뮺뮺뮺맧��뮺뮺맮�뮿��E���/���0FU��@�b�L-����JAb-�!o{�M���-=�(��&����k�����$RD��g����O`G&!w0�~�����fc�}�@�Y�0��}��0� +� /$�D������c���A�"_�� j�:H�臜�$�m����6�JOt�7��|˞[����!}š���qPw��i �?�,Jf��������Ctj���� 
�h�J�5�h�52O��`Ő��Q�Z����D�=Z��xY��#E�풵�����A�8� ;�  x�x<`�����$ �/6���
J����`m�Y� [!��I<:!�3�8����W��s{��a!�����#ӟ��vz5�#{���&aͲU���;��,f*����� �%�t<X{���f2�n����|^���"վ�\�&�b?���m�F�C��t�P-����?Py��A���^Q���S��`����'<#/�*�Ҽk\�;�զ�����@�Y�0��}��0�;0"�1���|�ԙ�V�h��G�D<�q'/���`\!}�h!U� ��2��MB߸�4��fC_P"�g�7g����m���k� �����7^���V5������At������ɼ<v������g2�r`����+9=�M� |��g~�" HJ�R��5�`�P����l���h�ħ�ت$�������g�� ��S�o�`�1G38��^.�d ��TL�k��7#O���7	 /�If��RW]�������i5X�������CN�$|�C�gs�������/��v�z�|�`�i^ ��h�}�|<�� ����a@�Zل~��4`̩�M�	����?T�������0�߽�s���\�r4��N�"���׏��n}����	I�l�X���Z�>o�*&�9�$�0�c�M�?̼ <�k�V����u�%}n�>/�L(���vj�jna�2Je���꿗A"�#��CS_�Aq|x�#��g�u-�h:�;�%�e�X���
�!��!���Olo�%̘	�v`Ec���]��of����Ñ�����y�
�B��!v���9�zgm`-�|�!�'�x��zTw/�+�41�=��f�j��S_�|b�`{��mT�d�t���D'�e.l����;"js�)����j��o� ���U�x[���C�M~���D��՚��ҸQ���C�}� �x��#*��|����X���kݹi1h�O��8���l����Xʹ�HSD��f����E��%�z���x k }{��iH,E��-�pG���h_)ET�6�����i#��ی'a��/�����vB{c_��� ���'�~�i̳OO`G&!{0�����d��'G/��#P���V?�����!p �8.[OHP`o� ����ī^s��z�`Ő�a�?MB�����\�׆4;�&繛�}f�-�D���v�Z�t�uFooAeI���8zo��	�^iT���ݏ �p�9Y�	�tM�t1�� �Ik�$�ߞ�-�H�}C���vƠ��/��5�З�-�b�Zig�[�������S�r����$l�y�������뮺뮺zz뮞�뮺뮺뮺뮺뮺맧��뮺뮺맮��Y���x?`?U06��x? C�z��r�M�~��h;���Ws����	�� -�V��b��g�g����&<�FC:��=w�}��]--�mo��[���?�#y	We�l��7��p��v ���<��F'v���뮺뮺�����?�O]u�]u�]u�]u�]u�]u���]u�]u�]u��_ ����	���^�	9/p�'K������������X c�\��H�z�L������k��낓��
�C!����]u�]u�]u�]u����d�/˓���g�B�����  5_��/p!Z�N����]u�]u����t?��Ǯ��뮺뮺뮺뮺뮺맧��뮺뮺맮���]w�]u�]u�]u�]u�]u�]u�]u�OO\vf(�����<��� jp|_T2�|���f����������|?�� {�T�1�u���]u�]u�]u��_���� ����������]���� � �]j	���:���g�ڟ�����4@} ci6�n�;��Nv/��;� ��_6�����z���]�?�� v��篘m-���\%�����ව4�8C�W�g_����&g*~4R�\v 	��I&�O�� U,�{�;����B�?�~@15�8��� ��믷����)���^�W�v�}��Z�ٞ��FL��l�֜�r���!�� ��믃�|H�Î��{��`��@�T�1
n�&�?���~��xQ];�#�Nʷ����H�c�x&ڶ�_K��Z��#�_��� ��H�cz���>86ڷ/���; �M&�M7����h4���; ��_���7!M]u�]==u������A ����
��n =�@7!����)�B��=������eT�߅��9��_���8����*��*c+����u��G�!�������< @��`V���t������?�M�r�]?���@�e����}�$��!cQ~�5�nO־���*�A��ݿ3��y뮺���
x���]/z@ ����~���qkZ�Ẅ�v�~�=u�]qߢ�*/]==u�]u�_� �ᝑ�9� ��֯���ʖ���z맮����`b���pC�?|�i���������>����P, @6� ��(��6�O�(:~W
Ep���6Kv^���L#��j4�(Q��}K���*�xN�2(� �� /����UwM���������"�������@���m��	����3^/��Ő1�?T">�`���a�9R3G�m�����(U3�����C(���0����S��~���r�>���Sy?��N
��s�1x�J�{���ٝ�&��{^<Tn�E���F��`��1�e��<w°�n緁/e�"��f��3�����6a�LM�@�[�+���Y�]�dg��MPa������/H�D�ʱ�8�_�C� ��(zy��Bx�<�|빱F1�x`RA��Y� +���Z��BT��[#=�Fj��f}r�~!��}���A�7E�ܬ,�8���ڃ�x ~���W([>$ٓ�p2U<l]P��<y�3:����{6l�{�@|Eݛ���k��w�L�03��^��������A�`0F��ֆ��#�lv vF�0�j�6N���z�4c�pez�Ilq������q�ʽ����o��X�t[�{�1K_����i��a�y$�W��AQ9��͇*Fh�@�Ulw,�gA�"h���Irf �J� 	�U+>�۷
CЌ?װ:��[���j��Y���&�%�e�߰zñ�T)��W�S�B(�w�����Ca���V5lZ��1�h�	C���E�:�lQ�Fǫ�q�:yJ��� �%��1�� ��,�"|c�/?�E�G2����fTvɨ�v���F9ƍ=���C�G�3�~W���ɓ#r��k��%����?>��͠ht���bH� ���[�aiL99���cpK׃���=^��s�j�_�u�� M0Ř��A~�FO����X���W������awM�g��Lk�Jf�YL{�S-b����f|��[�O�X�E�~���	q�s�a�|���G#0�w�Q�no�Eo��� �����js�y��*��d\!������ܪ�3F��Y�◸����u_D�5鼸�������3��I�u�5_����"����	��; 6o>f���*� ��=�� ]xŘ�������}��O���n���@�Iq�U�����P�+�'����'�#��I��o~�V���F��iAi���Ήs���px`�����]^������kq��`(�&x��Yj#m��y�>���;]�%?`~����ZK}���Ug˭���
��#)��?�� 	|wX�-πl���F'h.P��e��3����6�Cn�?��URqOHH��f_���ACJ�`-�x�~�ڻ��xc��2���	b�z��"���������8kIo����A�2!����N�^.��c��\G��c>�G0TF��#�{I�z�D&���I�4#�U�!���v������`O��&ѵ��e���t;�lhj�����4�g���H�oOMC�g�3,�XV�i-���Y_�x��\u@*���j����Y�F��!�֥����??�g��7�q�d��ޛ��a٠��,�أ+{�;�Ԍ��?���G#0�w� %�L�[�����"����`Di%�N67Gg���j4i/��O��q�՞4��a���Լ]u�|�GA����x
�E]ʄ1�뫇��!�O��,�8�OrHl���6^Wd!L��q��(đ��B�����6$��U$�����Ռ�'����By��]O���Ӑ�$��+��%0o��P%#c*J��/}�&m3�����ﾬ����Á�'�+�`]��t1�{�N�Ɵ���'�\&U��1�	ZTd)_z՚ 8�+=���U~�U��"l�ɷ���g�� ~��$��jb�a#����	�}��������,�9�����<FaF�|����v�߽�� �3�*�<�9
��$�ctv}=O����������5���0��7�������i&#a`�apZz7���6�g�*�w*ǿ��x3�Cew,�8��q��6^Wd!L����%fb����0}�Q~���U$����Ռ�'�����By��]O��P�/ �.�[�<Q��������/�� 툳��z���Q#״�W�����05�i	>���5�ǄYj���Y��6� <dt������@6�������>M���8�ۦ[�`76d��s�q`�.��vb<4�뮺������C��������a���	^�����p����w���:fX�.��]�
���WP
ݸ�A��t�uLm/�%md�|�f�3D��B��RR/�L^�GG/���Aʽ���뮺�����>:���<�
���	�Ő��+�jV�{�]u�Y:��뮺뮺�]u��W��+�Ğ�~�����?��kkk�S?����<=����CA� c 2K�2����M��ԀnCE����������;�2M�w�#�~� <���>� }�B�^�F�9i�H�d�ښ�~C�$3�����;��Շ|
J��݂>��;���"Ŀ���B�ѐ����8�,t���x	\��gڢ�m6!_���<��Z|?�/����->��������l�r�n �/6����we��#��#�p���">r�:��n���MBoߩED̆������"?�p���&�4[>N���lC�K�� yC1Z|?�'����-2�T�����>�!]-�@�%���RUv��}o�p��d�1%��e��,;�z����I�(�	���%r-�j��m6!_��� �ei�����!�`���� ��9t�܍>r�p���y�7���wo\�l��#
|�_��� ~��'�Hm���� � W��%�2�C�x^�-P�f��
B��`RCE�}I��jS=&xE'7G��V�����h�;��`����>T`,+�"�߁����5��cJ3v_�AK��"�!O�Q/����6��7ZB�hC�����O��8����|0�4�0 3$�# �{��[$�mH 6�4[>N�Q0�jnU�A߁�lC�K����i��Ș�2���r4��M�@�%���VC�$3�����;��Շ|
J��݂>��;���"Ŀ���B�ѐ����8;ɂ�����CE��Qp6���g
���P̭>���i��i����߀|=��2���$~2^mL%Wn����』�?�`b��/���Ú$�*&� c 2K�2����&�cjo��ǅ�F��
ÀnCE���&�;��}��3���"}܍>r�]Xp������>�!]-�@�%���RUv��}o�p��d�1%��e��hw����w�&��td'�7� ��h�}�/��؅|c8W��������ƃ�0_��Pw }�B�^�F�9i�H�d�ڛ�IUۻ��fq�B��_��9X~ RD��a��c��c�)�C�4͟�ܝa��ݫ�J'u�{�4�7 ⱪ"��@�Quy���AS�E�#K1b�-<����C���z�*�`U�����y��� �C�������e�X��+��0xĴ?R� (��������5q
P���j0�oe4֓��������#{����������/��~�Z�����,�8��!$,v3��mmmmmmmqC�A�������p��H �����z���$l���Yb�q�~�[�Xާ� ��Y�5���p*&Qz�����N?�2l.��l��?����ߵ��-�[^����ŭ���@t�� Zll!��y���sZ-�'E�X�u�`���g�DkW��hs���@Ny���>?|`b��/��{�kd4T�"�])oۯD��1x/��m�jѨ���$�m�������� �0D�O��s,��d�3N���F�������x���� }� �o9��W��Y���i��X���di��o�~���s��V2����&KN�� {m����0A�a�[!��I-�ĜL�������������[�� �}�6g�� �����_7�I�)Ƈ�a���B?�53�"5����+~��w}�i��WS����X�C���B��-�:�.���c���װ����S����y��N&_��m�jѶ� _D��'��^~��0f<���������Ao��U�ـS���әf���<�{�6r|�?���NV.w�U�,������4r������0��>?}X=���c�a��>��!2_Ӻ����h��E��y��N&���w����)o��o�� �#��ϓ�������`=�R%��U�~8A�� 'r& M9�"�z[!�F�"�b6
�8�1�SOW�aO?h���$/�M�}G�{����6�w��GO��`��[R���D��"�Y��QS���v�v�v�ؓ�n��Q�<���[ߤ����HTO�-��A4u�!��m�<cs����o�2��z��򨐼o�����2R��
w �h�_��~_��� � 4�� Zll!��y���sZ-�'E�X�u�`���g�DkW��hs���@Ny���>?|`b��/��{�kd4T�"�])oۯD��1x/��m�jѨ���$�m�������� �0D�O��s,��d�3N���F�������x����� }� �o9��W��Y���i��X���di��o�~���s��V2����&KN�� {m��Ǐ�A�a�[!��I-�ĜL���3��߽�Swo��-���p�H68������Щ��? n �F�f�������\MM��Õd�6��Cӭ�,4>  ��P�?#Z�{���l�:/ahs���@�9��V2����&KN�ݍ>��Lw_����*t���9�I�����m��Z6׀�"y������Y&Ǔ����~\CU�-�8j�0
�5�]�2��=�y���l����߆�*�\�ޫ�Y����h����9�`+|~��=���c��)	���׾��CEN�.P�C�gq6��p�߽�ԥ��%������1����]��dֽk������^$��>�&��ҡ ��*`�c�ڞ�n��昘23+M�B�H/���L?�kK��Ќ��e@�틘h5k9�d}kV������/%oI�	�����W]������w�?�Y��8��P���v%hDr�ڏպ�����*v$���n�(��p� �;��-�)�n^!}�W2�Z5���z�_�}t��]u�]u�]u�]u�]u�d�/��p���z���2�Z��������(H�2������L�x�д|~�vc4����5>�\���b���h��o��t��v�� Y����Q��~���-��M�%>��Ҏ���Ҧ���<��p���)��:67Ws��""X9j>��1���� J�#��Q|2��4��`n�C�!�M	sjn�U��M������ӓ�
������9�i��kG,�ja� �wϭ��ݿ�S�ſ��s�CW�O�η�࿉�2��+n����p�;���̓lI~ ������U�lU�'I���mL}W�mc�=Hȁ����;�Zds�/�+��'�M��&tjA�X�tO;�߫��M�]���1t��G��FDڛ�L5��I�0����k�}m]�hZr�2��i�Z{7M0�~҆V��<���ZO��� ü�n��o�K�`w@ H������@,����o�f��)O�4ɞ�?�Oƍ�h�󺠴;�H�Q��F�J2M�%�%B�}�,��Bc^��'Դ�ʨ��]�2m?ඈ�7���8��x���?��~ �р�6�� r4��O �+#&p�3���r�6����o��k�}m]�hZr�2������xeo���=o�i?��aj�!���!�,�~�e�y��Xg& �L>�*0���. `{I��D�jZ�G=���� T�z8=���zu���%�����2������ �р�6��]�2m7h�mL0�����O�η�����*�*��?#s���<xe-���S�� 0`{I��D�jZ�G=���� TĽ��ؽ:�p�����s��.n��������`�3�Z�A ��7!o0 rx�G�X/��g�R7s?���S";��BPM����/� �k�\�K�&�Jw$��a�	�
��A�-*�������"7��w���d �b�P�K�?�2�Z��4I� �Г~���`������$��dᣙ�S��iѱ����Qh�Z��~��]o=�����`:3���8�8�1��Pw����Q�� �(����Z#,��7�ʰ�0�[ݑhZr�2�����������v���9Up	T�Ʃ��(��YKY&����"
	{���; ��u���6v��J!��¸7�8?��ˬ�;c�٫��guXv�L,�w��%�Zk\BZ��[�	��հ z*�H�^���"�W��`s���%��r�D"C��0����a�2�����w�k��~�f�i�R�;�"�d{���y��*��6@j�F��oPrq����+|����f�Hа� X ���W�(�g�G.�AkfBx��w��|V
�3����^�y�[�zߝ��Àuc�C�<ژ:$0��Ji8�����[,y�Mm����cY���ڈ�TM4|��Z�gW��Pq��=cDE�?Z?�0 �vD:jl����Q$����Ђ���.-�w��`"��*x��R�E4Xg��e���Y����F�'/�b^.^������(�;���P��a��
�G�F��`n����Ң<ZC������MM����Uޕy������� v!	���<'6��ڶ���/y���ތ �1t!�`����^ ��d�ng�dh�C�� ���fS �е�߷�� �/�K[��s�X�tG�@=R�'�l߸��&����;��1Xv ��=[��m䭸�[�g��J��4E��̗����v��0؅=^�.i9��n-���M�*̣��7+�U���C�<ڛ�%t�_�"�!�7��q[ ���ov;�~�Z��m����G���~�ck�� ��ٴ�<��fR3�`>�������$|dt��&D�˛��KZ��8��m/�14��Ȥ	lB�,���h����g�T����$�)���L��M�� m��gq��B���������_@�xT1��Ҵ�X	3~�%Y~��(�wN��F��Z���I��i��� @_�6tIT�<�Dh�>�����:Q��Y��d@aG�x)��r�#���أh�tm�^�:T3��8bfO_��=��̡t��]u�]u�]u�]u�]u��_�}��������������������5`� m�,r'��Sd�������9�J� �2��5��sAi4�O�?�ln���yd%T��B�a�� �k���S���^؋�Y�]u�]u�_�'�k ��-� ���o��[��>���]�M��n��%ފfZE����4I����=������+�ן�}��%��q���p(p}�Cx��궴i;��?r��6��Z��)�)�-ʡ�إ�HNTϋ��8������A,RDcE�?��e��T���M��?t���^�����3oa��Y3��Q����^��	Cڤ7��u[Z4��X�>c�����eo���q��2����9����<L7����%�����Ft<��H;|Gy����:(_xz�_�A/�[��lێ�+�ׁ�tS2��*~P����pA��#��~�G��/�?����ٛ=!W���B�J�������Z��yNų�Ƽ���M&�1eT��1o��0���������� 5[Z95�t������	G�Rɖ�����7�n���}E#�5�߿�H̄��`�CdD8���:d��Ͷ!��-e��L�C�w��)(ŷ�����������&����mʕ�s߿����!��Ã
�CЙ�#��a���_�:Q_k~i:����w��.+3�a��҈e�>�������/$���K/5~E����5V��t/dk|������y��[�[�P �{�e�� re�Bf����u�����⥷~k�&;�2w����=g���Z�74��=g���8|�������K�/ࣼ>U��Zَa��<����n�5xp۷}�92|��o35xpۗ�5�O���5"����y�Æ�������4O�=�ǚ�8m��rE�g�C^#8G����ѕ����6��������}��p�����,��_�� ��nD�ݴP�6�����������]�������{��E�~���:A�?>��?��w���� ���%-Ӛ�����2����������)�B	w�]i��v�m�tYV�~����)D�����4��4��:Z�뮺뮺뮺뮺뮺� ��گ���t�o��	��F���OO]u�]u�]=�ΐi/��x������<;8�j�e�������s�H#�f(H��Ѳv9y�JM�%�+�����?���뮺��Bѡ������$L}b�Z@[DS�/FC��� m�9�X�����P�Q?�dZ"�Ց���h\��?r�@`���7�,�w�I��"�_i��mJ�s�Ih �� Q|�ͤܜ@+ͩ�DYq 
b�$F�f9����"b������xJ��eA�%S����x:��m��{�j��z��o�m�%��x( �ȃX�)���7����wi>�īlD�=௅���5T�Q���	��?��T�m[���ak�����Մ>�R�K+���h ~��`���ƨ�γx�̷}#��4�i6�~���Et� ��)�I�R<�~ae�SMxȈ�Xj�s�#h3������1M����
F�%e����|# �rq �6������� ��*�*����~0�َ�����G���?����+��?P:��u��=W5u��0���
R�ﶔ�4{�֢͕#�Gt�gj�UP9��r�vs��p�Ze~�� wB��Dq�+�"���z}�\_�f\7/E�	D���� �XX\2	��8D��Z��̬�v�}��0�z��D��E�r���_%3i9�86��D{ sA:����������-�'G:3��Фka+:�5��� @;��`9�0���?�X `0
b�]�7$D@0�H0G�7�S?�~�*�*�����1�����dE~LSV��Kr������)���sP7xT&����9��_Ucό�ח� �I�J���bE��db�4� ��s�^�/)����}�8i�������=cVI�c�i��}��D�7��& �'�I�I�S� >��%��k�� 9�Aq� X F��������x�P�O��}���	��?��3�i�����ԂKo��������
/�Au�*ߗ4/��b߰�2TN:���`^ff�o�����N�$qoof���L$�8�c��p_J��/��ފ`/��磖%Q�L��ޣ�����!x��8�c��&��ӄ��n��B�\q;��ͤ-:�<G�S{������I���-F[&F�0�tQvv� IK��?a`;[x����n�K�p�$(b<�M�� x�X$(] h ���������q�Ўֽ�{����I�Z_z��	@ ǀ< �nDz��D�an� ���Z���m�4tE�+�h;6�[WA+���p��v���+�W��D�@��{��U���;ߺ�ǚ����
�ub�;.L'n����MS;+��3k*���NT�;�����$	p}b��u��U�W���X�[� Qȏ^}��an� ���Z���$%+��>=�s��� ��_I�_��O=� @Ċ?�o�bC�1������2���P� ��)��O���=��ef����:�\wٳ?��{�b���pb�x��s}���@	t4���5l��m�$m��Q��?89� qD7"=x �&�Mq2��Z�[�P�'=֥�s#�_��{��u@̛4E���O�m9�ꏮʵ�m��k��ѕ�W~��C���:z����kT���}a��Uo�71��}[H7�Av d\2�
>ҕ�n�NX��v���}�4'�����O�3�����~Ѧz��29�"����Hq����lב���������\��u�ڷWW��+ƏZ��%���[�8C���L�.��+g����6ȸ�2������v��^��w���>���$��w�U�L�����%my���[�h�{����J��p��a��;�=��N�P�Fʯ[[|�Ƽ���,��nR�Ƅ�s""� �� ��L.��iq�����A�)?��c�H	�ݿ�t���t~�i��0�S�� ��ih'�A� �@� -e@	
L`4�8ށ�!^������H^pGi�Aq�uC8�7� �'���>꿎f�~�����H��؀8'��� ]��=�_���A;�(.�ʥ��(
HV���艸~����2E�)27g�j��W�'n�̋�S!G���Uo��ָ���0
,k��< �nDz�~괁��-ܠ3�a�D��עh}�������b)�v�ך '����n�0H� ��]���
�1���<���A��B�2@���-sw�}�0 h��,�`R-̇z_��-R����=wW��?���B���@�u8����r�������}�u�v߆��>�|���������?�c+5?��Ց0�
VU� �=�1�{��U�J�9��D(��]~�z)�[8��o�@E�$�q�{깏�F/��Qȏ^GH7��=�\L����V��>��u�p�������a��?]P3&���h0X�Naz�벭sy���� F�euߥ����<������(j��XD?#[����q3�@���]���B���G&�ۻS�$��n�_m�	� .����@�>B2��ߴi����L�{H�����8�}}�ۼ�}'��ݴ��&�����պ����[�4z�-�.���[�8C���L�.��+g����e
k-���p�O�������6��})5�I���L2����i�3�n8|�Y��Z"~�� �Gg6�L�M!�I��u���6Uz�����F5������������5��)��<��w�F��K��.������9�[}u�]u�]u�]u�������xW��{AG�b��sbS(1�D�FM'"+��>X��� �:gz맧��뮺뮞���1�:�iiiiiiii���� Lqf*1�_�4������?D�=I�� ����Jj�U� ����ڟ�%��j`TY�In� �, ���ZI��}��	��P�
�&܃vT�?����N?n���{�V`E")����`��I�0nTY��pH�2mM�}���__��Jh�.$�É/��Uǁ͖ a�֛�%��W9�医J��� �d�T�a?����ƅׇ���li\��|�ܵ$��FFFmM�	 =�Cͩ��������tb���?����;�ZĎv1OW�Y��Ff���j��}};�Ԍ���	�^ٞ�wLA�A).�I�#U���#$��Ec��P���C{� ��H�cz��N���~����n/z2*�!�Ǡ�_��x0�&ڶ�__N�u#:���t�& �����S{�@q��j`*.�����{� Q��j�	���w�1����3
A?o���aw+³�}�V���?�:.���C� _&�Rs ����BDܮ� j�$s��z��r� �30��.4,�A�%�������m�k����R3�� ��J�~��h[j
��; 6o>f���)��0� �����S ��7ORn	 =�Cͩ�E�����pܗ�q%���XW�[x���GA����{Еd�2.�B�P�W����x�	��3~�n����223jopH�2mLE������ ��y��~~��	�R*��� ��A�[W� M��<h%���	؋>E����^b-S�c��u�g�Zn2����?��-���Pŕ1���1%s���C�u��������Z����������n�M�=u�����_����gr��}u���9d�W����������;,;�1�Z[���/i�l�j������[M�O��%ˌ�����������v�������ތ~����?5?�"o���	��2���ƽ���.J#^Tyh��p��M�n��_���%V�e�����2%��������	y5zwa'����뮺뮺맮�&�뮺���]|�����'�D��Jf�YL{�s%bw�hDF]�{��wo��Vg˭��:�?�����a����))-��Uohl8���!w0��[_�I#���"bvb!�%���� ��C�����}�;w(6c�:�^��g��vX6!����w��MW�zv��չx`�$t;������f�L�_���B���@������~ \<�Ғ��ϰ�
V���À�M�������Yv����=��{%��5���'�L�{J��gGS읃6IO������B��2��5�c,��k"�v�&���Q7vR�������P�.�T*�~?w|�JH?��;����������;�U����c�^���&N�IIo�x��{@�aˈ.6������	C���� p�FB	*z�����`Di%��N67Gg������H5��X�~�'W=����Y,i���z�J~P�U�t��dD�I����J�3��݁���|wB�sͰ� ���kᄜln�ϧ�3�{���a����P*���P��6����������Є�;��{��%�o������Y,?3(�x�ɷ���/��&��Ob�8�70[���V�����r����?�6����i� �����`��o�=��?!( ��Ihh�����c����"�At��� N�|0�������h��kl��$���K�N�d^�I�u�5o��E� �vA���  :��Q��y�	��5���_�*���wJJK< ��3�o��([���
Q4��������p��n]��{
m��]^� ~؁����V��1�W��3�N��&��0��7�p���W�h߿���+a/�ay�զw��)6N�F����>>�K���j�Au��^�Wd���|�t��ʽ��<�Ғ����
V���û���~������P/�|Q B������(�+#g����3󴄆�_��.��T;�
�����/�h�סs���<���A��Mn>����뮺����8 ͿW�����w-��gP?=D��;�VyZ���������������������������{�0�g���zi���i���s4���ޞ�뮺�;�ڛ��L�!��a&�w|�I�� �mfs�v7��r�����>?�K��tY�ݙ�y�kT�u�0:�<��:��HI2�=����
pb-��s�� �[�H�Sm@)w�ϘZ[*�{��Y�7T���z���q%��_��P߁>�?y��Wb=��Pm��1��[���AV�>���� dXк�a��c�􆉐��|��������j�JDÅw�<�]u��]t�����������������������������������������������������������x�?��#�<���G�RPŊO��83��l���$"&�}�xA�>[+ȃ�'���A��5�1G��C�'CU����u����L������#֒������)qә������#���n/��/�=����N�����P�k�>�����{K���_�]{LhT��3�B8�L�Ҝ��M=u�]=u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u���!����$��� v�:��W%Q7_���Z"euw�{�� �2O���:QV&���NL*�_���:#cZ��[�aH!���9G�J���^�cf o���w�g����6�k?�e[)1�g���^)�@�I���P�I6���u��� C�{��������,�8 c�\��H�z�L������k��炓���G���2
����'��뮺�뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺뮾p?}��1�U����!6�` ˀ=�)$�N3?��*��F��w��\-��R��UM�i�M�Δ�������F0�J��7��GN�0n"�@]��ڎ�݀ҥ-i�Bu�Y�&4P�����Sg�o�~�󡍌��뵮�뮺���xU��-��e�׋�� !��Ah$��*�+'��Uͦ�5-T�����<�f��&���\�M͒�� <L��Tu���B��s)߀��#v�!���Au ��{��� ��؝������ �I�6�����R[������@7zyl���� ]@3W������	�U��?�P ���w��b�]�������� }w�����a1j��=OO� �ViL�8����|�ͤ�.��M���m��?��E�S6�S�Yݛ��\�'%h���>�7����߀&Q�h8~�G*�`>m�=u�]u�]u�]u�]u�]u�]u�]u�]u�]u�]u�m��	�-/�$}~H·?u�Zd7�i����p�N{�|2�� [>�,^i��[���{ ~�ߌEu�����z��@�]M�xM�#M�w��������o�h
:qj@ O��`7�$�}`r���.`��K��/�`u���|����뮺뮺�g���0��[��d4�@h���6�4�'��`َ�.�I
�A�~�`���|���Q'�N� v7�c��I�/���2y	7�Z�M�dd��j��N�m	.��������)L"f�v/E�J���¬���s���0(�����aN'����2�B al]a@�����C*�p��4w�!q��g$lO����X�7���%�o�X�*�+,{�s�}O�� Ý�&��#�9��@�W,׿�K���P��Y�uvRf�M׺4�#�b���F��'/���0� �@�"ȓ�;�@���w��w�C�5�~ eV�b��~�*ZG� 2����f�l<C��H1�<r�eX>���|m���?�k G�a�co�WXP=�s�aV*�!M�w�l�L���C� �d��W��1�x_M��X��2БSt�#�E"K�@��)k^�u�z]��� �F7s)��]Lqf�+mJ<�>-������X��'���p H��r��qO,�8#�Q�0S��[�x����,�,��Q�`�_������t���P[���紡�ȍj�V��q�\���55��+Ȍ:E���� ��c�������H��	Ĳ9��������0���UL;u�}9N�z�`4�n���(|�WB1&�Y�iS��¤um�W���O�O����������v�G� �~�PX��I������!��콠���kѧ��eL��]R�P� �u-�>��0[���]� �sGP&`���� 3+Qf��f[�1?8g�:�Q?���i�S"6�ː��B�����1��Ϩ�i4��p�s��ȑ�9?�!s�`8c�j�
��~���V�}٠3�!��v��9#b�\�k�"��Rɣ��ƒ�1�Q��m������4#���7�L�-���DD�G�G<rͥ�j��pQ�2.nB{�%��!�w���*E+b�����ʙ����T��Ԟ��97�검ź��M�����YH���# ��Ɂ���<5��Z�'���[�)Hlh��M�vvh���z9rY�ĝ;��@��I�����27-����A_Q�ףO��@YC#�ό���T �Qo �ʝ�Bm�y8h���ii�\��W�q��� D����w�'�#��8�����{�xD��B�e�s��C��PY�d�o��	.������Z��oS�W�]��{����_�i��?�]a@����8U�s�w��h�B�=�$�I����:����Ü�,�<`
"c���Vx�?M3�����G�r�4M'����C�K�߾� ���u���r#�!O��"(6<("a�~�0��8����wK!�"0���n��QU�&Kӫ��a���Ѓ��^F.cR�{��l�G���D�yd�DK��Ð51#��Dqg�@����ȿ�wm'���Fq���X�Y��k�v��-���lp�����u����������1O���!�	�B.�&������44���?$F��k�į/i�s��l���mW%�L'B�r<���"�2 ������|~��P�������9�����"�C���B�	��
�����뮺뮺뮺뮺뮺뮺뮺뮺뮺뮺�X���E���@�~�	��;���쫕S;����D����c\�ba��k�\_�l���&3���JD�p����_��~	8��[M�����������`==A�Z�kkkkkk���.��%���E�7�O�h!
vk�[�b#ȗ3#E��޷���N���C��W|�?@Cq�����IgW��
�+7n1��'�J�E�Q8�0�_�����1��4�͆�1	E��r_�k��� � ��fLv����d��}��$W�����B��I9� �����vd�/F��z½��;V��
�Hk��m;*��/�ζ�}D�f��?��Å}�|��:�����l�I a�k��cV?���Ko�r4rY��m1ԋ�9P���0o��a]���R)c܃F����w�6���0�U{D����%����D@�ɦ��P<�d�����C�(�2������G�{O�X2I�1^W�MSH���f%VtNC��D+���;�/t���i)�_��q4�5��g�Y��'�5$��G>��=U�L���ی���X�Iz��/�7��0�����Sƺ:4	������� B���<01R��$a�l�*~�����M�l�]�e��M8X1�5Y�b�h��z����g�q�J����RV�i0q��?|��K��	��tqYc#.�J��
*�[[_��㡀�7����mu���� ���2�y���m���Vu�Mmmmmmmxp�|� �e� 7�R���ݾ���Y��}��}��}��}��}��~!�@0z�;L�}��}��}��}���<|$�� ��Sr����?���������)���Z4��v�^�Xp	�V�>����p�^]���[R7##�Fe����-��F��BD��L0 �I%sl{�b
u���X�79� �;������l���G�q��[tX��ح�� )%�����Y\F<�J)�Ņҧ�{h�	fs��^-�pVNaZ�\J$A#-�z�'x:�.��#��Z8J�������YE���Q��� ���` B~�}g,���[�H���[��� �g��lljR�:��+'0�n2*��3:���^�A�����)eh?�����Q&lk�ęr��d�r��	]W.�P����v?���S�~�n���.>����KH0(\� ��E7��{?��laz���{�^��}�Ǖ�k`��49r��>0�npa�����M��\M7�i����1�u��eM;�>����S[�~�0>�0��h��pW�F�G-R#9�Y33Hn���8I�UP܃X�-Gc{�<��m��[����������x Ndy5h�p_�Φ�q��{�����B�NS1M��,jg���	����c�LuW��тY	x��Nغef��Z��Zb�We]�(�`��K(d4��x�3���"��9+�TOq���Ğg8��1R���
z��	�����l��^v;�fy���㪶�!�8�e�5#��]_��)A�x+������S�$a*~�k�_��[�(͒�N�Ӳ�p �Ԃ������ʈ*��|� ��m�_��W�o�q���`R*Y��W�6f>��2�&�z�{�;��>�`CO�E�פw��G���.Gd����İ�|*����	v8�fs��W-�pVG1Z�����b��p H�k�>�:�e�|I~Il�d�PĢE����k��9�����M��X�a�.�?��i���c��)�X BJ~�` EyI�[�,�V����:�ղLX'ă�Ԁ�J�ߙ�x�� �8����uz�-�%<b���_�����/��~}k�{�9)R�X��5i4M������0C����8"l8��B5rXK����I@b�������&�Ӽ�B�.# @-���1��Y_v=�~���	WO�N���4���} �H*��'�a��? X���M�I?�}M�G���#�c1������������9DC�����o!�2�iw��)�,��+�3[視�u0��1��C]�A�N���>�@B��
.���#��w2d�x�U�I]t�!6�g�:Y��皌�k-��x+������2$"��h�A�uGBo����3U��Lk��}]�T*Q(UL���?�l�aN'.�
�B����1CO2ŝ9ĥ�rei��[���U��)2 +��(�DDZ]��RDhdh%ul��(9 ��?�l�h+&��eC_����֨lc ޡ?�x3���sY4��+!/�q�w�6�V�rｚ��BEՇ�ߊG��/ ��k(�T���8��F��6bz�˯�4DA�=�}��r�-��?���κ�nмE���mY�=���	�����6���'�^��Q�d�Ǯ��Z+~ƃ�f!\9��k�2d(� ��3�����~.l�b��,k�3�2�	�_Č�����[��Xn�y?o����4@�a��N�u~�>a����+Y�#�Rf)�]�\Z���
3ƄA�c�D���h�v���bCv��������~��N��`��sahE,F�9.[��/��m3$|dv�Q�Y�<�����su|���_��ݠ�v;�g�M���Ɖ������d�Z�������x]��8?�225��������c�k iO�;���If{&_���������r����s "��j_~4���� XDD_���Vߺ	��`�u�hǸ�z��?�̽@�{�,o\�������b�H���	���"xk��J��_ef�O���E���n����%���� -���������泆!��������0|�dx��Ҿ=P7�Ň� �W�Dq Wz	������(�����m+mw�g�v�����g)�_�X�䵯F�c�E.R7?�����xx�"�������t]*�|j�n5G3�_��QTg����X�5J6�i��]?R�Ľ$>�R$������CߊU�
ނ�k[[[��������������������0&��]��&T����0��Pi�q�z���܏C������^q)�Q��:)g���y�Ma�a�|�)#(�3������5�KD�����k]?OcW�_��;�b������~��� ���JF���e�I;/��X�A_+w�?����P�f���������.���	���3� ��b%�ޣ��I�#&}�	~c���r;%�`ĥ�2?LOB(Ex�zĽ���EU�x�hO1	�wF�1�d����-1m}_�[��.����?�d������@(����k��K��*�4@�a�;�}�f �)6������K�Kg��f�j����<�Z�����,�Hs,�)��C@�JQ%	놇�2esg�Sy�R1���VAʗ�k�ǋBq^��L���ߍRA�,������rX6�_�Ym�Y�O��0��5���Z���@@�e �xûs��/� F�?� �O��z���m��ƭq����� ��k��'m�y�0�_!�e&��]��͢M����� (e� ��cVG��93�"��_�����	����b����g9k��K$к����&pC��{���+��|[}~�M6|��,YfS�M@m�b@Y����.R��Ա���]*Oۛ���T��8eB������$U����7b�]s��"V O��C0��͙�u~DC^����dɺ��g�f�pVEa�[��c�����y�����e����y�{wbۨ�j���s;��5嗁�IN���@V@l	�+^�P]��jO!e{���k��C'w�Gd����!�M�(���a׏ܪA�fk#1~��p�Q���tn�&O+� �����K�Kg�D��-��\7[ĺ@�4?�[��^B���J�$*R��n�&�����0� W�i��:��K���Bz�t�6i����1R���V�I�.|����]���~��l���,�A/�io�w�#���Oې��8ڻ�י�$F�u����T͖�1m!������@p�-� ���3b�L 	(T�o�?�~ #f�[�b�H��y���8�v 
�i�v�0!J%0�榇U�� k�Y��s��Xl�<Iį�}���u%���Q ���#�C��1��6���m�U�af����#G�r��E�Ƃ�%�Jyw�b�j�����1C�o,����
�ƈ��I�+��O�:��ZJ���K�!������L &���%a��`@w� �w�����Xd_������a��9~��~���[��|tnr��_0a� �`Y��b����7Jeo�fa�o�Nt^yaJRq^7�(�VË@����� "�ƈ��&����K��2kH�<` "0�π�6�Eq�`�`��ͦ��'�(�+I��QjO��t�U8�\�5����U������� =�ec6�������dU���B�ڢğ�#��*ؗ�Gr��id%��		~� bzl:!���*����l/�����J����5�c��_���l���p��ڠ��t�]� @1&"z�Φg���琦�Qx��{�?�A�����΄>�I�x �`Y��b��H�Ł�\����:'\��x�&��0����w����j��N�J�� �.���\�]����w1xW4f��?�FY��%����w�^�h:�\� Anc�eB�|P 9�Q:�.jhuQP{�S	yV(��/ø +�`��8bBܥ�G�c����S�x���pJ�����\��	�w���H-�6�џ�;�����0�~ �r��z��g�>��ຒ�Q��.�o��a.!��_��U�af����s���v�W�C��LNS���^qZ�`�l/����W��cG�FoҸk�}~�� ES�5�3pc�_�}��}��i�����姏���V&')��`�<}y�i���a�h����N���v�r�љ�h�⮅~���tN�Է��l`X�En����^L�k��(�Y��t��8��&@[���P�|P 9��u�LH[�����k �0���T�qo�	^e�%����,��X�?�� �5��dMN f3=2�in3?R����0l4�%�5Ɉ}��n:䕝�� -f;�fDQw�� IT�%#sH {^y�(b��Ή8p�����zԣg��tK�DD�%q=�=�քȴ`8����ED��4Ò��;��r^�?����:�9��߄AE�#���.�of�p V'����}ǎ��=���h�\?�R��?����;4L��"�/����Rr�L��3��l�z� +�ˇ�𖞴5"C�ƃRXr����xP1N�3�~� <Щ꺹�^��!,�.h@���"���g��N37�� -�wl�� +hh�}�~Lq���@ �?:��j%g��o!���A� G$'����h��E����@���`k1�s2e}��8�⡊�c�����F�	y�)JE�� ԋR��/{��� u	C�U�/t���_p�#�����[��x����D�k����K܏y��E��]��Fٰ{�uq����(�H�_�ǃ��cu0}�!�֋��TT��b�]�S��� �ɑފ����J�a0��~a#�(�������+Z��	���lP���8v��̸�]�,L���*Kܽ���Q���9� ;.�VĽ�;�.H ��T}�P�������D�����C#{{������������̀<; ����~D��[aI��>�WM����$dͮZF���A����SZ��7)�J�=^\���?�}p� ;�cMB�?�l�ʹA�w��g�x3�����^����Q��:�x��^%�v�k��="�Ƒ[����0� !�S=&a�o0:�؁,���b̄���OͥZ}cL/�#�����|��ZK�_�̾�2*!����CE����$� � IT�%#s`g��تg��������v ��S8�Pf�Df�֬A.�����R�k���� ES�5�3ZZ�x���MH�Y�c8+����+Cr���\�Y`��y.��<,;	���uSv!�"����w#O�dya	���^x %C�!UCL
U3�vd���S�c���7�?G\�|9�=��#���8��s�ˇ�������}�u�w�`���If.�S?�!D3�s��y��8B�bdK1��Y�&�8	Jm����0"�9t����?�p.\x11n���+W�5�}�y��o��[�
���� h�F~����bdV��_Զg�������@�k_�'�#�W��,vy�����Ǿƀ��d}N<���$���ޝ��
�}��o�
^�� 
���r����gr�极/���M��������X���x=*4+��4n�}�`�@u��I�"�������H��N�������%�^#��G�S\�6 �?���.����$i \����vK���x&۳a������!���Eޛ��$�M��'�w��Y¨��D��&� L�!�*����~��� j�?�����cJ�Ϝ\ ��W��� I�{k���\��ﺀÂ��5 1�k\�$:F+�W�� �h�{���DJo���=��Em�.��X�����A���3>xc7��n2*���������z�f'/)����~�]{&��t;aׄ�����pm̙7����Q*�Gk�߮1�}��I�1�U?P��]q�x��VEH�/����b�<�������z��M3����6�!����sXk�s%��Fy"�Qj_x�pC|��bpB����$dTf���Ce�����$��Y�|H�"��o�v�fy1
��������%G`�ԍ�!��[X�Ȟ�r;�|~c����(��h����Uml.(���)z�t��������� $X�4K?�v�b��v�o������߿��yה��q��A�#�A�8��o�i��j���������"����(��l���a��S4�O�0��� ��V��zrho����BtZ��z�����{�
�g:j?���h ��T�X�$dTcV?����b��벙���������e>�*g�	��u��%���gQ"b�2���i�� d
[ͩ����� R������n�S/|��H����(�_"7��M%o�Hr�"p�~7_=�g�	\�2T~��K��mz����M^��HYb�%����L3��p�c�d�x	 ����D4eI����SG�e9u{�K�>���޼7�@t_���繆&�F/o�yK�����"Px�]��\&g�f�����c��������\n2*��������{��E�����$��d����Ê�a��G�5�����Y ,gʇ�i� ,\	Q5�5�޲&2*Bt^�k е��9K���?�)��ˈz�o�br��z`�LV!����Z$��l0���� �2; g�G�Ft�ȴ�]~a=���Е��N��VJ���d���ڨ��N�Ȫ`�O7ߋ��3V�I����\O�)�0��'��DIS,�~�1������ҝ��d������Bѥ�]V�v��O� ��6�r�S�<�_����%��!$K���M�0��y�˯��q�%�Lb�|<�qE��O/�����m^��1.����/��׋�|��뙡��t:ת�%���~�6 ����X}w�͈���c����cf���5���R��L���!&����=б�����^.�!��a�D��k���H%���)6�����4|T�d�<�K��x7LV���? �E������K �].S��E�b�D>/�v;u�|�K��}%\��K�F=^�P�ß�]x��n���5�:��ھ��?"��bY��)�c����?zt�=�]]�.�ٜy����<�s�{��$������c7������U�A?�����'tGcnk��j:3Q�����GF�OW���+&���xj�]/_�A��u�l�\Y7�����M^��3Ck��t��)q�}��Dx��~������JU-�N����gN�:��
&J����΢L]�en�
 � S`������!��k�;Lĝ©��dN)p���>R���8rB�7���?������������������������!���5����g�/��6`��\�Z벙ԧ���]�|��A-��!�!M,���26F��_��ҡ2m����z�@?A��72�����E�����<<`���t�]D��iL�짹��n�W��!f�6�?�׋�̿����8?s�B���/�_���گ����ޖ�H�b)ya�W����^x��KՊ�x��҈�duw}o��n_���)\�rw�?��������	p)|�3�����RÏ�� '�����Q������l!�����t��4�k���o6�����T=���j��>G���e�<�;����D���j|f�ξ����?�[ߟ�S�,֓�o�7^v��%۪�7o���=C���WBĿ�V�����/]w����~<A�`Lk���Jw�=��jD�7>��� ��#�9֠�f�z���7v�׿w?���K� �{����a&e�x�Oo����A��	R<���������΄�:�_�3~\����.� <�����<tP +�$���"��i`  -�p��/l�'c8B�u�z ܬC���i�v�0v�!����� "�s���0������)F%eWw�E��2wE�m-��YW�&�kl���8����N�)�}�|vGl>LkC��۠�� Y� �4��tN(HL ~��/hŎ�� �Vo�I��ؤ�$���>u�+p9��Do�+af=�A�W��0�t�u&�>�`j 
��9���M4��qn^���F>ɡF��cp(��1��`�A�{�H0{y��	<xx^��J��7��L�Sm�9�_So�I����n���
�&>��c:>�����3-}��2���C��?�ڟ)p���?���9`M:����A�X&����mQ�5���ݽ����?u �P�\���{��-o�|����l0��]���3��8� ���FT���ir�,»�*k�r�88u�� ;����OW�l�T� ����5��v���#�� �"P2<w�y���{0�C��"���Q0�@dW!y��`��q��[���n9�2�#�rEɏ�30)��S<�g�4159 n5)���`����85�`ŃL�������D�K���k ��;�dA�:��e�H���dj��\��c-�����������K2!?N�����f������:Cd�� `eI����M���Jc��6`Qp����>t�	��<����k�p��&в�S�6��w�;5*��c�Gj��P�`_�{�e]�?o����8�q��+��
y�;�p�?��pkt͝okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk���g��������L�������\-�BJ�{I��������A�m��� ��1'��z�T+�?�΀��0�?#���P(��P�G�t1�r���<YG���1�UJ>��J��H43���f-s ��U ����-�o[��E�R(�̀�l ���]G�p��[� �5�Y��@1:�Q13����՟ � č�\�i�} ��C�lT��|�!/FP��Vq�����
�\����۹![�
^�=Y�����MYPBd,�x$�Xf&��tʎ��)�5S��� �c;7���}�ߗ%��>�|e��1��#��SV���H�ׂԶ?�~�݀5R���*���qѹ�2 ��b%w��rě���*d��%b_����	�hy�����������W{����Ԁ��Ӆ�M`$�Ã��y�U�/T�� ���\9P����I!��RJW���������lx����xa�@���� r8ѐ�\a��a�¹�x�����dr�^^&����F'�rXi���]Z�2�O+z*��f��0�y�564�@���}$G�_`D�ᦿH��q{��� �JH�)�T%Oo����_�7��:h�ˑ@�y�j��!{��C�e�Ϋ��I�r��O�Ц��Yi��I�W>���%"���R�޼�T>���ɇ@v�G��t�Z�A��֖������]p����J�U- 5��_u�Dj�}�^����o���׺_�Y ����+:f]
mʁ��5��q�W�-蝏��`p�l+ۂW��:Aw�i����x���2Lh�ӌl�3@h;<�U/� p��(�#��Qk�BҘ�f|��ҕ�r�8�f+Jm�0�Ȍ� �_ oż��|0J;��U��Ű�q�<���A����~�/ 2S������3)��|<�[^��Z6	�u�� ��x�2����mW��������8�ɷَ��	<��'Y������ؿ^39�{��xW��
x��<����L����0�x��U'�r�V8y̓g���_{�����Be��Ao/i���K��7Z�v�������7�����~< �=N��D�[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[X������?�~g����7��/��[�ww��Ѧ�,\���|z����0���O���b7�7������Xt�V�&y�����:	A<�!$�v��!l���
�[�'yg����b|��f�wbX��Y����"H�`1���ɤj[Q��{ޖnW|� i�mM�A�@$\�x{���8���NԎ�cu���&	-�xq��H 'Jo�XQ�Xd����C�����O�s��fG�'��nٰ0@��6�3?�&KL}|3�s|��c$8���r,�p}dH���i���eB���?��g�i�Aֺ��rI�dX��]�=݃�� ��wi�g�?��EqU��(���h���N���#-���#��p��?�
������U�&G�������o��D�4����06$�P���>� ����� ҅&����$�z���~�G{/ym�lf�ǰ�D��Y%���L��i֍s5�<�m�X>�o��_.��,���2YS�/A �����eOL�(_̥>�%w`�'��]KG�
�H�㌆���D���iZ|4���M��񥺪j�,���v��/�݋�U�]iUn���m5<���zF�Ћ���S	n���~{�ĵڱ�p�|��U�����t]�>Ҭ��Dt �	�Q
�#J $b�<�4(�A��h0j�`�(0v�8,B�!��J!
�"����p�~�;!�<�p��]�~��8c��j���Y����G�ju��s����J;��ӯw>_fWh��.�x�~�
L�B����J����4$=��ƕ���[�V�3u��/�n��	���Zz���{�y��I�LB��4�ݻi��N��� �+��`�i����ד]���l�)�L�����E�b�_����z;��D�_G+ˤk'�̿]�N4d��q���9���`����|��Uu�1�>�:�l�����H#8�ʊ�J����?J�BqBI��'g1�g5
#՛]YPp�'*���'b�jӴ�u�Li/ޅ,�x@�P��A4(A�0`��G�pY`�(�����[�<�< X=n�����_�ʷm[���'���G�/O���ȇ��������]���	{5�=r���n�,��<�)�OhYr1R�-
�������ɷ��ɡ��~���~���d�,$3��`��g�ظ�����m���k���v�}e�|�� 4�,��"�N�M�ɥU�quo4M6nW��E���_��j6%n����\b�1��a�w����,�t���6��W1]�����g1;�;����_)�M���9p"�lsU�q�8\��J���Y)�#u�&��Z�\�~����ɜ���k1�d�����͓}����B�4���hPD�Ѐ"ޏ''�e� �~`-t�>!� �y:��=M���L�q��,������%��1ǯk��}&��:��=a���`���� ��ܜ�*��=9����I��A�ڗ,��l4�[����օ��~h�jả�{ʺ͗��=��k#��7��!{�VQkZ�V$�q�.s�ƭ���	��;؂d��^��F�Zrp۔���Ѽ���ʛ���"���@�.+{Ӛ�pHi��xڝxbZT	袯^�nC0�����Z�2��_�k�����O��.&�(��P4ދ� D+H��
��j$�U.*����֨x�=� 'SN.F�0*�a@�(ˁ 1�C���vN����
=[���-�'q��/����l��[�6��/��R���Yٝ���}��}�/�S����l����^�ŉwJ%����g����[O��y���^	u��+tՑ^�]J�W�\�׎�ф����-�\��4ӗ�9l~1��F�"��ŵ��J$�m�)i��ƍy�]3z�T���`��Ux����_t��~"�l6��o�H� ���rr@. �D�06�`�X�6	�b �PB��vph��B{?X���y�����_f�r�d���|_·O�}&��*�����Om�W��~�?.�UH{ۉ򶀯ka�M��z�� b�ׯ�*$L�i��"ֱ|��!hu�,��(1�EH�n��y\��t��e�I?0�����E�sX�>r-@���\����5F����cK[4�L�ߍ4=�E�n��W26א
�1u;�.�Oe����N�	�0 `P�  H�0����L(
���P,����`1C���F�(Ѣ��ak_�����~.5^�/�~�m듶�ë��q����y٫sz�	s�f���WQ(h��j���kxH��6vue�ceB~�n�NEq3o�k
�4�D|7+��wK��g���ퟭR����'�+���o�k�ʛ�,��ǈ�N�W����Yi�\�H�k������ו����i����p����ٜ�+��e�c{0�WN~O��>�pހ��\P
� 
* �F�4�`�P�A`�X�5� �`!C�䣃��� �������k����򿷙7,�]�V�Bt��A��$�d��]:/O��j�c�÷�����!��>�ĝ�Z6�3g�e��EY[�����u����@�M]�uSIk��g��>)=��0�8H�r�<Fbr==�7��}������N"�O�j}�RM�uF^#8�*"[:EPӭA�6h�ԭ|r9&�%����bw{�������" � �� D � 8F�4����0	�d�X0 �! �@B?&��`��@y~QP�	���/c�-o������}�=�O�e�I.=�<v�t��ۇL:hݖ%=ɩ��)2៪J���@R�J��e���b��yJ����W_���4����ײb�5�����U|�����L��J�Xg:�gL��Y�nV����毫�]�����[���WƝ��`UI|m��k��kQ��g}�515Y�����g��Z_�ݮ&d��q����T�C	��� [��,@(ʦ�E7@�P:��`T%

��0`l]���d!'�Q`5�#����(� �VO#}�����ߩ?�y��sy�˥����,޾%<��u\q�fWT�k�k�7���\N�w��3�1�]���O��C�����и֗j��@�Y\�u�69���k�J:}W�4G�p짿.s�)�75r�q�E��	ib��ގ&��rU�K��|;q�*�pig�_�D6w�k���k����F�J3�����e������cYZ�߭k���g��݆7��ʍ�$���Z�8F*�bL��p#\�f�(�=s���4��_��Lf��sL��/bR�_�n^A>�F�4���X4AaPX 1 E�ɇC������{?��*�I~���������X<�8��/��Lg̭9��H��|�}���?E�g������l;�v���{[��;Y	f�ud��l%��߳l��mk�K��Ւ�y��t���AO�h�l���KtdF���cUZ�8Q�U,6��zp�/��Qʘ�����n����C�pQ�u�ܫ�[�����cX�H�s������=���ҷz5��=C07r�p^_����{}r�0  $� &D�,��0�L�`�TB D ��e��=��T(}o�m�+s�����.����{'������ݢN��Dһ�Z�y����bw/��m�~����&��
e�,�͎�;�X�S,�#c9�Q��Α�nOޙ�Ӓ�>�=�s�φ�CW;;����j�P���ֲ�ؔ�e_�	΂ �x4�$%�+h� �t6tJ�&�d.���9�*��Ӳ�?���c��|"�6�R����e����\�ev�g��%�W��2�O�;���  L	  D�0f-�aA0
�� �@bP�!��d >�Q|_�N����X��z/O�/è);��6[�LX�bb[��܍Vvɺ�3�Yuww-�#��8���������&�l����`M�O�.Lu���9�����䫑�}1O0=V�Xb0�J>��5-ˢ�K���'ej<IRphc������ֺ3��X,_���;4��V�=�Dx�����uڵ�&" � �0*Ǥ��
-��M�l-�g��zr*��@l�( $� "� L  D�4�a@XP�`�Xp�`�h,�"@"�G��d=���V"�w�����5v��3�e���.��d�uI�ۃ:^�������c�� *3�=�T/?�	��X�[������W���_%ݖ��m�旲��]M�v�I�_�����x[��NN��g�X�S�HU��ou�w+��q��{����G�vSt�X��<mL��NcV4�o|N5D,�r�#����z�E�|;
|X;7>% �&���}�Q��gt  @	 	�@  ��   	0  8a����������1�p�O�v��7/���C��N��k��d]K.n�����l�p痆���\��q���d7l�)o����V�g�5/��Dx��_O>�\�q�o�%�ƅo��
&����Z}ڞo/�U�/�'��0���}˰	FA�)g��7"��Lٿ�����q��4��|�\���7/�� �\_0h���O7��'���
L���v��7/���O[�};~^Qn�/	�����I���O����y	��7i�\�Cr\�2����r����%����2��#�x�N!q�\B��%$RYI��%$RYI��%$RYI���*e���XvK�r���@&���Y|,�������e%��"8+~~��*�=����o����C����U�^U�>�I���3����e�/ш[�W�x:�`9l�0r�&|#`�3��}��tɯֿscɊ����+�	sp�(�N�I��� ��s?Gxo�	�y)��W���OS�e�`9=Kprz���!٣��N|��P;���#bZ|�t��i1�L~l`�+;�<_��~���1����A!a� �)����Ǥw0##�M�FGLU6�K��^4�Zu�� !���T� �ۀQN���6�L0 n ���� |H�I�������uɎ�a�ߍ�HV4>.9s��3��M'<k�T�`�N�)v��"�0w��l]&pJw�@����
x!��I�W6p�7 p	N�(�P;��w�@��a�:�`��P;��_������-�x��hL��������~? ��y�������F��O��~�h����XN��^��g�O�4݄���|���@{�Oġ��O7��-��������ѵ>?����#|߁��OǓ��?�O-q~���E-�x��hM�}/�=����cu<ߋ����y��ףv��ȿ�N��y�rL��-���o�?�5������ pn��������]b@hڏ��y���o��v���_��Ns'�����&���~:���)l<w�.oG�s�\w�@�sxO��nYW�x,;��w��xi'�x����ؖ��nC~�7���n�����(�P�`9zL���f^I� ��#<�|?<�
?/�`� b���q�ЈqX��I(:����_��[@um9�\� �ɀ��?�\�9��ܱ��@Hu�E��?�"~�����7��w��2(n�Ǘ��8���o� M����'�?�1���-O!'�4����x�c+����
�W��C9��-� ���"�1𑧌�-�G����BV�Ɍ����\�����Jӷ����p{Է�&�o��䄭:�+�����b#��`!8�rG%�����$rY����$rY��B����.!q��u�_9#��s��
sq�KB������_d�����^/�d�����A./�2X�X�c/�2X�X�c"wj�-�e��,��0�e�^�-cع!�%l8�GC��1z��M���B*�)��b��Q=b��b��x�3���<DZt����{���[�>   	0   �a����C��8M�M_�!f�g��(�
��= �im?����	�b�����P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w���~�	�B����.!q���Q@   	0   �a���個|�現L��u	��++��(?����Y���8
 ��)�_�~�
x�(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
xЄ.!q�\B������   	0   �a�	��	��t?�@�����#y��� M�ůֿ���
x�(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@���� �B���.!q�XXG �@@�0����`4
�a@X0D���@B�"l裢B��IP|Td~�~`{�Aws2�t��r���g���p�]�e���lftr@���A������óW�Mؕ���5'G�����'���Ư�wW�0��*�T�O��_?��7�8��&k�����	fla����w-�Ԟ/��m�[=3'uk=x_�,;w8���W����.'�ʿ�+�>)��}�J�̇�/���~�//}FL�r����?{��n� ���q R� �<�H�`��0�c�XTH٠h���������C��G�;��ߗ��3�}|�=_?=?�Q�pN�-�[�
�w�D�=�+�v�T�R����gH�W��{��}��=�<kJ��Qh�V\��>�R|�?���$�|.=V�ۣ���>�٥�>H��~��^.ַ�b��}�٦Mϯ����N��םa&��c)x԰�=	P�� �/�K�>K�w�u���S�U�����[ijv��D����m�Sp/�6ʾ��d9��� �� #pR"*( H���L��C��:�6��PXPV�b�T !B�@Ѣ���� _���o���*��^����k�5�޾����7m¥�G���OwӝY��_��5��Щ��[�*��3H�Ǘ��������I���j����+���7F��ɶ�i�_%}���P�Y�ӯo����(����2Ʌ��Wu�U�g-����]+U�U��w˺d�$��>��A�?�l ⬒m�p��'Q����#g^{��+P'X�Ί���e����'��3\� ��8H*��X�.�Zt32$�!31�p@�0v�`�0F4�`��@0Cg �����_��A�?��>�2�߿�s*|�~Ϻ��o���|>߫��?���E���7LD�����K{ņ���9��oß����c��g��j�Wf�!U�ȷ�,���r�-�{��Tj�4��S�#��l�Ku`�Ի:�H����h���­����-gF�s�%4b�t%~O��g��jk�~4�@^��\��=��e˄�.</��^e�>/#��a�����v=��n�l`H4@ �J�rQ& �wh�$�� ���:�L
���h0&�`L-�`�X!=�r�S�� �8)<5�{���{;O7�r����n�;�J5��W+������yP��h#~l8���mZ�o�����YO��q��6
�cۋa��.�G&�;t$lfY�eK�,�-�S���\�m<H�6������0�>{><(�ݳ���o����YƮ�2F*�6���W�������T����j{{9��!UR�m��x�*2%o����l����G��%�h�<W��T8�'�f�mG�,���|�\%'�E�2G���I@��o7�� `�,\u�IЌ�HZ�;Ù��+4YS^V��h�~p�������<�4��0`,+A`�X0$� �@B �!a��h�B�4y~A>#�˘W�9�s޺�O��82�&�G�����g�.�O�I�4*�O�i��\���{�3WHp8t���gg���x��%9K�T�yZs}7�O������)�ݬg&������!ӭ��d��2ܫ����ݨ,��/�5�9��O��a�h����Э�\֧���w�	��n���P��_��l�Rt��˭/m(1���5���oFq���pD*)pHa��,X" aR!�@�0&�`�XP6�b@X ! B��G �,��/��y����~~U?^���������	\����$n�2g%WΗ+P�SG;���7����ִˌ"x7:��Ta��h�F*�j��=9�{X��A�I�QZ����uENeYMf�/�,������l��Y�<b���sL̫V�U3��6u��Y4�.8�8e����1-�'��^�q
0l�MQ�Gm75�$���pC��
��cV�;����E�Y2�   �A�!U	��L �5�,� 
�>�4KÁ�`,�' �a�:,��/��ZE�}[����7���~+�W��l���A\�tg�`�~�y�d~��>����Ν���B�HM����s�����w�7�U�d��$��LU6e�E?��$�����J������uG���H��\ʷ�v���eM}OϢ�V�@U���c~Kgh3���hѵ6J�����UY&>�j���;}�_	��)U�/�����u��/�Y�#��.~������� �D %T�U2�&*uVj� �r2r 
��8�48A�0`l�`�YtD�D�D,��,�������b�[��n��Y�m�,��	�;���;I#��ŧ�]�~~2�m�}aȽ��~l>|2̷���z�?-?;o�&�I@���Sc%�[9y���ў�v��㺞�:j��
#�~[�X�jG�W�䲻yn�V͵΃{�������Ĳ㞼A姧�I�M�1��N<�%w�Rھ�%tWcPA�Ֆx��OGX��}�Ƭs�
(r?�����b� q, @ 	��p,�I��� �D�ģ�<�PJ�`��P<	�P�D HC��!<�  -�^	̋q�6�����r�f�������$�����֍}\|��x�_�ԈO����ǧ��q�p�GKF���>5y�ï7���OQKGf�_uk�VD/��cM�:<q�Ia<��v/���KF�A�y����:<��2O~�%�*1b�y��q��r�l��c[��^�&3��Kwa�<��F�Mv����y���u|;�d���匸n�KYD�	� ..@	&�"DTT
(8@�4	�Aa@�0$	�`�X($�A`�D@B�D:<�tYe�_� ]l����|d�jS�v}(|�����v�w�hK����6��\}��G�����%	*�S=�4���_G����p��©g'�Iń��
�p]-P��T![F*�F�ѳ����=��+�>��SN>ڮ:�RY����U	��&���Gei�;�M�sk��Sg�pFGI�cV_�?��L��,�>��ڦ�&�n;�q�����z�¹R8w�d~�>
���� �� � 
�P�Њ�&���:�Pv�`��,*6� �@B�� �,����<��Z�s������o�E����d�܀L���
|1:�s�^��gPϤ��x�O렻'��y*�ʍ9WΒb����;z�<2����%��(�-��-~�੄������j�9�ˎ�~'��9\���+��w�Ż�{dI������_;�����vU1K_N\ǲ�:��Ԍo�y�M�[��η���}�Ԏ�-<�j�3��}\�s�N�hH &0��⳪s ��4� ]�B�0+
���0�,h.� ��"=�f�! <� � ������k����_�����/;?3~���M2�Ca�����U���ho�Svf��/mm���vb���ɇ����-���T�I(�>���ts������ov�w��3����9ஓt�Y`�l�h볨��<���+%�Fg]Ɩ�@o*q=�_HZ4V�c`�USN�P¹��N�2M�t?�f5��Q�е,��>�ze�ًܤ�"`� 	 FaPC\d� 3*U�/PPX8�4�aA�P�AP�D@!L8(��<��	#����-�oۻ�����_߇����Qx�x�2���3�]4绬	chS��]yK�kuzfg�?���E���]�S7s3�?�j��.�K��czbZ&�dNa�;�~O��e�δ.�ڸՔ�H8p�H�5^y%2�8h�+�4�]7����cn�$�q�ۿBo��)�d�_!���U.'�:m��WO�!��r.й�f�{,�/vNJl5S%�=��8��L�P��:����x*[`���� P/�mڱ@p8�P�A��X06	�a@YTL�4B��ϸ@�#ֽ��a��G�w8��������[o�k[�%S��v�'�xg�:"4t����+lL{���\]3U�#�����ѿ�e�<b�H$�W�3�b�ԟV�M�L5.�,�ˈ����)|�s�Ypz+�|�h�S2����cp�V�9U�m����z^ph��v��ʖ������]z���m.mvp9�^ɡ�RF�ܚ� �)��[�ŕ*�@T"�`,��@�X*i��f`�$U$R��:�LA`�(0�c�Xp �% �a�4h�Yd�܁:Y� �������?�+����k��_e��"ϖ�d:�����l������m��ie%&��}�
Ck��O��9/B�y=~�Ҥ��7_ǳ����$ϖL��q�D��k�����ێ��R\���ߍ�a�o�9�u�Z�!.S��j��O��!)&�0N��U��
-@ǀ�1��tl|�`Ԁ!�eJ��˫Eg���z��E-�zM5$D��s�\�@RәI�T"�fK �pZ�Z8��@�@�   	0   ya�� �L��z1����P�1LZ�k�(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
x�(�P;��!q�\B�����p�   	0   �a�� �Bn�-~���(�P;��w�@�$9 Z:�e��<������x8�:"�`�$����?_��(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�B����.!q��   	0   la�� �Bn�-~���(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
x�(�B���.!q�\B��8�:�6A`�`,����tD�D��:4@Y`��܄(r��V�8ސۻ�n������5�7�6��?�-_{��G�����}ƾ��"��a>��k�9�z:m�@~8�[J�1N��i沿����8곍_��}E.r�ʺJK���z�yw0�����fRr��gU{�~��D�gz�7�>C�5ݖe��k��^yW}�P�%�ݾ{��u+�^�Ɣȫk:g[�MQ��c�[>�(/�Nj��� H �	���H���PԀ����R�a H�hE+đQ�8�T
����,(;����v�4B�d �? �t� ���p���n�nQ�|Z/��~���^���v~o]����<�f�r�:���/�����,�^�>٦���z��ьOی���\_O�f�l����ڙ7
�����?>M\���a�7(E�"���`�kW�>�4�̚�z|5mi�Ϛ��ٍQգ	����vo��ÿ��'!}���mu��6�~�ΕFz�����2|8��Qtâ@bo⥑|�<ծ��Қ3�݌I�X[Q]r��]p�� J[��Y�3�n���-��mȔCއk\b�F��]��XƖ�v�36�`��ZK�'<7�3���"f�U�|@�0���X0T	�b XH5� �@D��84B�`�����da��M���U��Ծme]{�]yxk�=��Ó��0��܍��r�#jS-��ݔ��{i��]�y<�?f�|i�c���}���5��v�LHSA�'F���+p��0�*�m����*�v��~>��>�s�Wm7E�ˮ`�B����I!�Ҭ�;��W-���8/=�*~ꖄ/���������d�	+ܑ��z�F��`�(�Ap]7a��	��,*��>�46���`L*Ɂ0@"�tC�!!e_�@KɁ�o��f�����ۙ��kێ��z�zǽ�!v]I��`q�~��v���F���?�~����ғfI�]��=�cХ��_,U��޼�����e����Y;g��g�Y�r�L;�<x�)��G��"h��^�_�^�u�ʁ��5��9�X��E>���
�+�p�F)Բvh������(r(C ��D/�W�Vk�9��!m����k�~�
ߦԒ�0 K��\
 ����q0LQ�2�� @ �8:�0*
�aP`l����@l8�,��A����vo�v�:?�*�D��n��U�s�[W�z��W�{�֞>�9�S����� ���5:J6�{��/-�e޺�&u昷:�H���ۻo�'{%<��>�f9U����ݸ�%�n���Z���K�����]��x]cM�s���ضۖsQcMՕ5��e���׾'��=�q���
��j�گa�1��b�z�c�!R�O?��+c�BRalq�Ḡ/����M 	��eiނ�l��D�E��)Y� J.:�p;��0`L*��,
����"q��B,���t�����{?��}�C�~ܲ�W���{��.����g}|�"r��c{�zj�˳��\Qɷ���l�mͅ��㲞����y4ޕuГur漌3�wϪI��/�;1�I�]�KRW�fZ�Jr�a�~o��.��Ԣ�j����ɵ"��_����|d�޻/�<՜׼��d�-��<ٖ*@�����R0N����V8�*nf�H���P���ń��,$X.b��6�6
��`�X��BY�B�'� An쾥����%�Z*�k�z�����Ǻ���Y�?���ٽW������U^�����Λ'��L&��+r�,�m�-7��K��������}��Q���y�im��K_�O���ӫ�ص۳�)B��zTi�t�`�9칷v�4�U�r����s�i�p�l�c��<����Ӓ��a��t���]�o���tkv[5T�uj�ϯ�['_���~�Y#��� ��6��
����qB��/:��"����s.�(p6�4C��hLA�0`,(a���,�� 4$!D[�< C�  R]�7��}ݹ��ˍհָ\�������*����c�K�<�~�7ZI'��ƸgQ�\��G�~l}<֧�]@4���5��u0�VdH�a�𾙾��`�"y�vE�;:r��4nZ��&����)��5s#��dӓT¸�����@�j
Z�	����2*7%/�@j�,�N�jJI���G��&��F���&�4�?�T���]T��S���&P��䏮��wc��H0X�����+K(�"D���P�zPXLI�QF�6�V�+��T�b�)�z2�F����(Ă���<�0*
�aA0�A���"���,�!GG���	���=���VN����[o��5wK���N�����	#5��^�+Ph����
6�����4���.��nί���y7y��U��1٦f�Z��
퉋Gg*����%Rk=1�}}yDSt6�;\(k@�Y[uW�O��ok׫_yJu�Lo[��4߶�qZZ�5>4١���7�o�G����#0�=������Z�2/�`��*>�0��t )�� L� ��@�� ���B�sҲ�  DO�<�4(����0F	�c@XT�!
a�b�,��� 5);����M7������s?Ϯ�9町$��~��������M���+2����KB7	�����,�/�&j
��������g���ߪb;E�P�,C����9��n2as.t�
�[-�4Z4NO/K�����L���l�Me;ͮ�)��Ib��3�0Ŝ�:�'��M�'-�j�罻�u�(]#�hسM���}S${2�s׿�l2``0 -g���,	� @���P�V�
/0&,��:�6
Aa@X0�A`�D`B DC�Y����Q霏��'�9�f��F�PH?_�����F�wU����O_�����?����Q���~o���Ѳ��=Yl�Ӗ~��ֿ�/�n	����|)�,ώ�=�U��J�g�^4�(6�΃�hZ�
i��WT�MK<��.j�r��-w�e���[����gg�͑R˦-�	{%&��+��rT�v�4�|j�=7�g(Ҵ��v�ήZ��a�����=�Ȁ.�& R����4B� 
HN:�0F���`,
����,�
�! �@B@�pC��Y��A�v�����7kq��3�l��B�y{���w��?[
��l�0�n�~S��)��.����~>�V�=������K�-�[�����v�I�L�_M�2W�>�?]�H�q���]�e=�k� �"�'G��Ι?G�3���s��P����:��9n�g�X�T�Ҩs��*�\t���˄���ǺK��Z��w���~\&L����=�7�V � TMEdUP��>�4B@�h,Af�T Bâ��O� -�^i�9�R�~�������nE���6�I�u6�6����m�Ϭ�_����'�gTZF�F��W�%|�
D�nʯ.�|�m�L*�D�yJ�ta�_��nRajY�FX0������s����}sD����筧�e������s/�0�*�ӫ8�ŖJ�|�����b>�Q���F��`�'֫xM��`鑔�q�-�\-Z��虞9��D�`��[T`�rL�c�8�P���hp�`��0[g ��B�:~��-�"!�'HT��G����X�x�f���xep:ս�����_�}_ϔ�u���<����]�dn��,�SY�m7]��66<�_�-Kv:�rt��vmt�ݶ��~$��Ο�A
�*[s�.�l]b�(��2 �a�*�5��:�~3t��&W���|�??��ѽ�QI���	�6�)Դ�T���u�F����!�N���d2���q�zjy��6�}�<��zſ��q���W��`�gT��t��0	 �z�;I��!P��eܿŖ�wz=����Lk���mc�p'k���f�>��D�4�24�NkR|   	0   la�� �Bn�-~���(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
x�(�B���.!q�\B��8�   	0   la�� �Bn�-~���(�P;��w�@����
x�(�P;��w�@����
x�(�P;��w�@����
x�(�B���.!q�\B��8�   	 r�e�� �� ��  � �1-3V��"f#,���#���V��Ħ��G
��3�E�9������T(��-�T��"
\+���M�`���Bs��&uV�(�c)�{��}��Ò��3��[s���B$2���14��Q�"+(����H��(�`�9���� ��f�K��v�E���޲ֿ�o������GU&����x�I���0L�B8������r��K	����D��J�p�ܵ~x��Z���zL���9�D����}}_ 4��H"*K�nB�s���1��μ�����4; �����>��3�|�ͷ�S[(j�E�SR0��/�CD��|��My4���,VuF����XI�z��'ЈS�ڃ` .,�l����ܼ��y&2׾ަq��n���~�F��k��2�f�շy�]�� ^uz�-��#^���]���s������X������k�r׻�CA�@ W�Y�p��5T�ښ��WC��9{G\�N�Ų �㎆��|����Ѐ2��$���.�[�c�g_�2bh��ި 1�O[)�.���uv����W�[b�Im���ઁ�C�M���mq57v��d>B�=x	�FiW⡴�]+O*�@�ƿp���	$��;b��?�[6){<o�<݀޽��Dq��o`�����,>�A��u���j!�Vt-X؊�6���D�l�JE�?9ÿ{��y�������%J��$��)ƺ1�t�'�p���� 14דO�k	6o^� i�<�DT� ;�#2���S (��$+Z�����'�N����`�[�׽L5#<����a�,ss�WWp01�%'���o9^.	�&<�,����k��kƏ���.��Z��6Z[�pXs�P��y�����)l���1�ϔq)�}���kʦ����A��%��������by��;u
��+lZ��n���s���U ��( Wi̛O�ޫkG;�����<ϙU� }	�~T#gVI�A7mX����j�i&�-��O�~�rn��m�&��"�c�KO@�;-2ʒ ��"�]D�����Myi��}Jيz�,����њm�G�y�g�y����_�<�W�W�<�J�|�r�%_�x	�3��*a�W�gv[Mip/Vt��L�x�|�L�����u��cV���Y�\��م�f>��k@v8���u~  ���]uD ��,�ru+��4�6yDI=�	�jF�,������8�~-U4O^_��Y�sv��~�����.�U��-{K{���6}�o��X��pw�Du��
Vb�4pS��P�UTbs�z�{����  �I!>��]��%�\6�fu�w����1��F��g��R9����j�u��'�:�j^?�f�i��J���'5�����}ͅ7�Hڰ�   ��cƄL�DQ#_V����E;��g����1�Y�7M���������=?�-D��iW`�ȭ,�h ���>���zd[�q��Qw����٤��H�b[��:3��!'�Ẑ�Q#?��L� �M�����E�Nz��0��rIV�Y;�������� �ȭ��!��s�4jQ����z�{��_��I�����Bn��il�+h�ï����_���ݷ������m��L��Ų�̿N���;� ķI.��;j�����-�`��Z�#��g���(:6�μ�8���V]���R����u>]���5���#D)Lx�g��-��IR5�΄\5�Mp���'bTAP��EP�{C�� 9��3���*qM�	�I�߮����0�[�/��8��ߪ;Zd�oFͭ[��q��>�W���P��%��0,a�@J��i֡��x)���8)Y�Lh����5�[��~�@	���ȷ�_f	Q�T��ͳH��m��X��l���_6�<����7A������Ǝ�������Mv��h����zn  �$�.�r+3mE?؝�e��ݝ
��3��y ����'�b[/u#�[�#7�\�����z�߼Qv^[�l�-q�=_��f�C�PLk˾2�ɠ�G:�,F�r,��&��������Lד����|�b��XI�z��p(d��­ ~�L6G������o�*~�m#yo�0ܻg���Ne��{q�R����D�K��[�N�%����[Đ�?W�|��hV^�f.�*,�~�N���q�Z�,{�&���]��d9�0
ȹ��2"�M�X��P�Z��T5���Ѵ�f�`�b�z�^����"�ϣ�~4xС�T��k��%��D� バ1� ��p�-�ݘ'D�W����d�ft� (Zzbk����L|D����zb��n����,��+&�]�-���8��&d�ހ7�^o����0��0?�g�w����"&R���Fpf�l�z� =~c�d���4����D��l��٦�ɗ�pcC��uf�z���U�}��/���uפo�d�Xx��8oA~^|`�~	�a��""I��L[R4�o�� �a��EIvK�,_����1E�"
�ys4;�n�}GTg1�[�������ⷽ�:Tfǽ����*��I���}j(������x�X�Jܷ�/Y���&��� ��������r�c�~��|(y�[�+����{�O�1�w����~�Z�ư�Rf�� ��Z�6���"�@�@�G�Z� �@kv����ɝU��
$X�l^�p�b�U�pq�YN�/�"A�J?H�rN��N�gw}l�&F�%�e頑k��w�����������x�ꭀ`���K	���D��J9�[��]���	�k~ ���� O;֮+��&��xQ"/i�u��x�I����L��#}������r��16ۯ+m_���0P���b���i��Wܸ`�����y��$&��!\������k��v馼�o��+:�S��A�$ٽ{�.hv@��3{�o�uFq����ٵ0]�� 9g�c--�� n�U�Z"�%ME�_�u�B!Nj���V�a+�� ίRe�A}��k�^�K�W�N��x�q��n����4d~������x�?c��wX.�,�42�DD&^���߰[�c�e_�2bh��޻ST�
�[�G/h�_���x�&\q�ѕ/��Rf����ri3�L����tЀ%\h>�%��,��[� �U=l������G:a����\�ۛ���u�b�������m��:�G;~�����f�!��Z����W�G5N�C��Z��;����bD�lр��=Pq3q��X�F��qL ���O 0� Z~E�ި=�c�� �^M<��f����g����)$��~�����5�|w���E�2.hv���ܱt5�A�Q����˗��5��Dt][ė����a���1�.�>U0�D�kWs�`uۤ�i�rkoI����h�����,��[#e������2[����~��1�˘xP���\����Uͩ����^�G�Kq���JC�G`s/�`_.~�.����@Kd0�� ��.Ώ|��������|�2^�!���
YW��G}��Ѷ�����%Y~���6['/��d"i����X�����2�1������[e��g����A @��$�ү���;�����,{g�LV����d:�0U�!��|JE�?9�_��:1��T�y]6l�R�u����%�D;�)`�cB�s>Q&2������ Rr����d�K� ��� \����P5������������6��_�?��Y5[���,wZ�ض�׀rg�vBz�|>U�J4#���� �y���ʻ_�tٳo���&���B F�����2p5�?����P&BW#�S n���2�-��W�K�j�4L�7�K���sD�'��'��L8�e���fZ��10���0� Z~E��g�LV�`�9���� ��f�ĤX�����.��;������^���x����}�&J!WB_�?���uX�5��Ytxƶ�/H����%z_��?@Lk!Eo����;��`نV���2�؎_țNV\s��Du�fL+�.{M�ߕᯅ�>N�����b�ή���h;�c'�ej�����`�	�Iem��я6���"e�_v�.�
K(�/�g�uG�Oo�b㎇�u�`�&o�m\_�v6��h>���a��5��	V�&�1��q4Mˀ��3���Xg%:v �F�J��Yf&/��R	-;�f�Z��B��a��1ku��E�.I���8��|�jʅ���F[�~a��r�)GK�j���f�L6�� _���7_��:\���z�H���(Pa�Bt�/�j���Sf�btk��;�ƨ:��+c��6���*��|Ɲ�� !�H�B]1f+e0���U��F?��
�r�f��oL�x�3���f٢*�^�!�|ٶ> �[Զ{fՏ�@��;.<�"g>�2X��@R�1.�!��g> ��p�����ڋ}W�`�5��&P���h'��d�頄��Rf؊*m��^�K����Z��Pڍ}F�DV׾UT�}}{��J% K���Į��]��QCe����;X�Z��� �}����7�2�����Lu����Ec�]�ao�K�S^Tc�}O;�f���xg,����Uj����F�03�ñ���V^4(}�(|���u�n9
i0m�^�m
����p;�ׄ�%�Y�"B�fv�2���:
_e��o=���_t��{��=i��z�z��f�%���kA�D�E���j����8�M7*?�o�11|�D�4]�$�� !�H�B��+-�-�KTt����zp�Ŷ�X��I������>���lI�P��%{��ۥ5�<4���.��I�z��w�lŭ@ y���J���&� u��}ϡ�k�u���ۋ�Q�{�^.Sꧢm�ݼ$�3]��ѶmL��n�%������ćS'D�(<�K�U��u�kɦ��:a&���@bf+t ���"��!=.�a�M����&Km#{�Nڿ�� 0�-��ފ֦���
wD�pPQ>�7����a��=4Ը�9O�02{+J���G4LN �kɧ��5��7�}��T�G���_-{�ij�>�ǣ���L���߿Gw�<?�aq$Bpe�{-t_ W�ׁ5�e��w�&kEk��� t�Ǿ�h��
�!ͩ�Ww1�B&��Ȋ�5{�ao�K�s^R3���s�f���dy �$͛S������d��%�@����$04�u�����ɉ��v�^2\��_&&�-{�;�#U>���jj�/�]�{k����������9{G\�0�㎆���0���[%�G��4M{~�KF���}�'u~ _��5+��T���,_� L�g�DD�߀XWɢ��W��(�zZ:��@�������.�U�L-{KyO�Q����nfo�l1CJ�F
���\.����?�� �DE�[��"$4�z�vk�&��� ��f���l����w����~������A:�06���q��9�}�	�B8�E����r��K	����D��J�p���~x��Z���zL���9�D����}}_ 4��H"*K�nB�s���1��g^Vڿ��{���U�jQ��>v��ͩ�*�CU�,:����,	|�&�{�n�kɦ��qb��5/��M�׾���zL���9�D�3������J���r� Y��^��S��������ᯱkc(�om[w�u�`�y��L�/�T�{��)v
�)O���K�b""�	�E�^�Ś��R��d������0_º�Y��:�t^,���t4eK��Aݍ� e�I`8u�\�|ǌ����d�h��ި 1�O[)��F̵��t
�)_�meh�m���
	������=�������)���K^_�OȈ���d�]+O*�Ax��%��P7zb�>� ��(K�o�v��g]d OȰ���tLu{�z&�=��s�T�%��ٵ1�#�ĤX����Sy�{� ������C��X��\J�Sĸ>WwX bi�&��XI�z��^a��EI���1�>�>U0�Z�B����0:��|4�8�^d�����ǡ�z�j�����释d���ƹ_�c�RxjA.��&�%����b`#�.�>koI����h�����,��[#e���˂ß���}����Kd0��6)��|��K�{��cWw6�0�6�$���;��}ͺ�hP��p`+w��jC���2H��*;�xW�g�Z�� qb<\4�MnI� bn�����r��~^r ��=�ν/��GFeF{�|��R�������JBW7)�~�a�0���yFc���8J�����T�]�W���X������k�r׻��\ᕦ���w��*5�MS�+�o����?i����8�h��ֱK�[9���2k�y���"�������C��8��B���S0��"$��ȣ�g����xĐ�0�-"���������ñ|�j������'�Rٟ���k����J�Z.��W	0�9`\Hٝ�sI�c#"�5a"[���� P��Dit�Y�����S,��{���ޭ~!Z����믜��{ߐ� ��1q<�9DDD��H�T͋��`V�u��NN �+�~r��� zy��$%� M5���K�,_�����l޽�a���g�?�sC���&DcSji��͟y��9���������1����:4`�D�x���@p��+��&���Qd,���
LrGW :������k��v�	(V���Q�����=T�l<5O7�ENZFq�a/1#��k��<����g]�GĚ:% �%����kɦ���XI�z����L��G6��}h�񪺛S n���2�[V�E��1���v��O 6vggvvge�(  /������"	`���?�ѳ�2����v %�u�e�u8y��s�����E@ ��'~��� e��z���Z���=|���}��8`�ߤ����O���,X$ϳ#W&p� -�
*W$=��av�U8�\�v���'��.nhRmSݿ��� 	&�&�Zg��_�&�1&"/��NV�^4v���� H�ΥJL1�nN�V����&yk;;��� �aJ*�K�ak��O?��2߅� N�.��?�����#A��Ct&x	YxR=�������? �dFfDDfdG���� ђA[3K��?�bzl:!�zǨ}w���� ���T�?�G�}�����yX������ 3�bOr�#������}��P�&�".Q~G���� ��d�5�/����A?��������Z�/�;M"m%��� 	��!�3p��qo����� ����C9�^�fH���_��_��.��d�6FF� ���gD�h�����(;���w�������oW�Ǩ �M��l�?���D6u*Ra��������^3���f��,H���o.A?������> ؞�N�aיo���C� ���g2 K�,��;+����po����B� /��)_˾�����)��/�<����?� ʧ k�f�L>_�D�
 �6�$ޑ���_�&� $���/���?���҆�G�)�M����@�Y�`%���s!��a#r�C�x~�oX"4Sw;� "��&~���p��K9L�2
ϛ
�0C��JBE����0��K��@���r�љ��z߿��3�3�?�� '۔`����ƈ�}̷�ý���߀$�d@�^�sS�����x��v%��=�^h�������_���d����j�������چ���_k�}������6�����Ck�}����?�p�] #���~�3'������T��O�«�?�L �&��8�F�al&�G-6a0��9i��[	�����v���/�t���� �jZL��Y�ڗ^��m R]FL�� 7�� �C��	�3�����tƲ�A�X��?����U��es�v�'�i�hZϳ� H���I���@��X�-��68If�r=z�#4�N�3�2��j��Jwrz��=Iw��/7���e3�W�r��L���B�5�Zv�L����22`Eh,��u�{6��h����U	��~�� �5�� �29L�7h;!�}K}t` ޙ��	�}{��o�����F��8{�����qu� �`�|�W?�v7+������@Ь�*?�1<�:�� zD��l�t_��U����i[��S���)2D�w�1��~ v0'O/���� D�(���#�)˙q/�r����lLS�� �2 ���vʍ�����E�D�Ō����aX��-T��@LN�7��&q��])Cu���p�'�B���~�p!ހ BN�� �Ad5RqR'vYjF3�wx�gQ&.S);��D }j�U�Z�,�U�vm�;5(��n2*1)�2H�$�����A~0�����0��<}y�y���VٰX�b+����!��".~�J nVLWO�sg��Ӆ'��#v����d8�[_��) �p�7�c ��bݦ�M.�����3�˝b���b����IK_����Dx��w��b^��%���G<$%��� ʜR���i��e`QD�����N��
�6�Es���D4eH�?�q%<VM�N+��Q�����@,%��a���
O�pF����?�K�j��wA_�j�Be�� D�ն�����9���V������)JG�Xk:�q%����NV���*��C(���u������� j�,�ձv}hS-����FEF%C��(F'���
��P���ZWQ���nn �'�7��*zv���2m4>�����8���N�ʸ���~ �\B냗	����Wɴ�5�!##&��zpP��~�T'���g�~�G�������ȴ�l�y�k,�y� �-�62�[������u1��4ی17c���g��נ�����ȭ�*�o�o1
��h��X�����M���A��Rv�v��̸�}�H\Ī7�"樨Q2V���0bm�bv��I}yw|>\�⁽l4A�:�mI��,���0������Z_�ƿ�3Vc�Ŭ��k,2/�������1;��LE/.!�򍆥�����!�l`F�i��?��lp�̈́�z���@���x4�	H�^J��`�L��G2\y��n ���g1o�p ��S0SS.�2"t����Xm�mz��2W��5�S���WfDtY(�����*���2l����{�F�hʓ���P������c �5��q;;]A�LF'/)��"k.��P-����N����M��:�d�)/{�3��5v� ��B��A� �L P����ED�5�@�*�����$:F+�W��y~��1�e��p��� �)�g�o�v5JNAz/��L�0e9u{�P6Y����F	�;�_��v���w� �DL"Wڱ�"R�����0�LU!�O�njX惓�}�6}h�u�(���/���"}���X~b�\k�������j��%%����������_�s"��;!�}I}u=�V�����B-^���ޛ_����7�`� V��-4k��a/j��[�꒟Ǌ�p�@0��.�*^}���B��j?�� D�)��u {�=�a�h52���)�R�$=�f����=�H������t�����j%g��B+�M6�r;�.=�yGA�p���Qu�|
�+.e��	b�2�G��v5G%c���d�����)H�L�4�Cl��4DA���M���������2��v/ￇ��CS�}7�P��q	q�����ab���`< �4�\q6��ܷ�����	�d���RVq��s�z��?��� � <jG�ʇs��e�@��4��[3�k���G!OW�ˇ	��G�~;�>J�������*0*,���k"څ�������6D[?V�)�� XbB�.6��D�&�`3�j�V=; h�v��q����ó�_�C֡���������7���=��hM3�ҫ[[[[_�������}f ]�ivvښ�A_�b����	�?�������J�aj�Ѧ�[~z�L%���v����f���,'y�����M' �ev���Y��}��6������X0v��xh��sy��|��n�XP�d���Ӿa��4mLV�n������[- ��hɛSk3Q��u��XkG�|�7O|�{��E�������������~ԨdXIMȴ���֩o��\�ja\��$}�K�dW�|"�>�36I���ho����X�D^�����MJ��Υ���ײ�R�=[�0��i7/�
7ͤ��~e�����7���U� �ۧ:̍4�OW���� �K-9O��3X3���I�Cn`�΁����}����]y�����ۨ��\T|=?��oV M:���0C)S��2
i�40��p���8��Fo�|v�.�yQ޼��[���(�غ���lOA��`9�#`�Io������(�� e���͛2���7�==js|�]SH��`��W����#��?���������\x�.�4ׇp(����~oT�QM��dӽi��J�E��ܛ���}_�-o��3�4�� D L��H�ο�c�~W��n� ���C�7�n�Oo�V4�2����^'���"�O�_v�	�����nYU�U��2�_빸��'��Ŗ�2)�ט.e�^l:�Q�6��_w�{��
h�����ī�+AW����\.���0Mnx�3T����̣&�����~��}�ll!��d`9.�>~� ~�����^r����+s��d��K�3l9a�+���i�S�3V8�\���ӓd+��@;�6�5�xwj���3�~�-�ƿ��9{�y!��j����>�f 6�
�1�vo�)
��	�NSw�kN����pH+�e�p��o�
���?���{�Ŏ��D��������N��i���:2��ɓs�3��֛��ܿuq.�w�.�����ע��#>�a������TQ^8b��#��p�M;����ڗ�%۝�>1�Rw����gyD�}�M��֫�V�v"_���4JNY_�U�MTL��>���/a� ?�H���}�\&��{�V,<#f�_%�[[[[[_��0��#�~mG[�d�6M���������?�x�Si=^�`G��y� ֶ®��zwx!��Գ@j�%��D��[��#�:���`
z7������*3�H 7�t�m��-�9�
{I�{��䑾��EL1R[�q+"����-����_cA�8	�0�j
�]�S��
]4�7��=n �Uێ٧�=S=���	Ӏm!^�xF֒�N��X76Q�*"筎���Ϙ��c��>�|��;[ ��!���߰��`Fч��u�r�|��}����KZ�Cuo̘rx^�^\x����������z���)�ӥze�?<d ��A8)�ZG�_s_s��hD�5��+8>���9Q�3����m��B��
��7,;^�)��ܦ�၆��4�۩d�����p�0�ux�5=�Hh���ߚ�f�.�m���o��n�h�}��n����Fp����q�������8��� �^���Q��.��!��67^ǢvLr��~� ��#&�U
��,K�_@?�~`�2�~���D�Gd"��B���O�mM�����&��İJ�2'�+�����a����QYy���x���Da��'����X:��+����	�4��jJy�U�g��w<.���h��b86��p>��?�Q�
�䘹_� �Ht��eL�GI��g�3�A=6<�)w�����؜�5��j�7�+}?W�uod���ݒn��Cވ�	�i]�
��OI�5�k�����Jqw7%�:{b-]���E�?\���C?*	�����M������3���y� Ͽ��Y�a$����31Q��?4r=�V���kwA�ax�׆�1A�t�>�Ě4+�4�����+O�c���S��7��%���^[�*b13$2����1�wxm\���I�����.ܟ^�g�I)h���WW:��X5̰�kLFSs$ˇ����ða|9O6� �Z[�Ŕ���vB��^�JW��O�R7	r����j�͝���4S��z�0H�-N.�Z4Ki���!&��6<�;$��թ����}l�Vr	���Ƙ�: ��w���}���M���P Q��f����X�5R�pڵ��;�� 1��؝��ОY�3y�xq䛅����5�¦�"W�W�|*��+T	��`!2�a���T�X�3*d9��U[:�|�w��V髟��m���y�Gy�0��UI���}�mF��࿚����ǽk������п eV����Id-��oh��.������p�-��镮����~(x��2�@G�}�? �|�j��t���|�]�,��!�6p�{����S(��<� +NlHz��n<��AGP#~�ԍthݾ�&'L�D�1ƿt)@9i�_� ��j���p�p�&z���a�l)��O��vBgs�?���O�n�0!a	����1�E��1��DƝL�%#�<���K��OG Ǣǲ�i�����e��}�����Q)�sv�X#���&��Вß/�C�-_��<�ԑ���֯�>��|���U�yR�H������2o��l;�i:~���	\�����2kkkj�����Z�$e�����Z��͵������m������0i��H4�<��_��h+��K9�8���h+9�Q֎H#�\���T�!��i����Ǯ������G4�P0�A`8�r݃�k�4}n��l�1���?�A56e#)%-e����AZ�%"�ܷW�����d�l�eo��h+�yg��Se��PW��o-�e������9�}������pd���k� �)�B�y� X3K�j6���� 6#����5��E?��#����¹��	��	����Cx����7�ޓw�Ԁޗotg��O����L�L�cV�0*��s]��q����%�Vv��T''̃\�҃�=���量�v�O���N[<�R�����/���
�	_����g����@ER�3��D�T����ꄯ_�O����� �~�da�]����?`+��7y��\�YJE���?_���A��e��O����|��	d}?_���4J8m�u���sN=7����K��X�%4����2���k�Ҡ��q� ��pW �)�L�i�u��g������XD-޾)�M���l���E�����C� ���mc����B�AHw3�k2�Jh�w�oч�?�A*
�JC��G���`��']>��?�s��u�� ��^�]i8�����j/�����`��  �Y�`mv���@'_��	���\W��:�a���4��H�nL[���O����UJ���n'n�b�s.5%-ӽ�]o����z���X�9�dO�W����Y��R��Y������R5�����������POBx������~���En���S|��@��=w���ܿV�t��k��}��!�8<���}�� ���)ݥ���k}����>^X <���M���|�g��A?��~�d �vaV��;�����Y)�w�a����z��
����������  �ԍ�,bp\�.���i�^���D[�T�� ���&d��hA��^�~�%},]�7��W�����} ����
�_�A ��h�=��٤�G���X�&]�����yS�x~H��`�B{��
0��{]����uN]L����;[TRM��NM+5Љ�<o�?�{��+�P6��_���$N�?|r�	��P�M�������,A���b�`�5O�ͅ������s��%�E;"U����	S2�YzFX�O���%m1M-���D"�[[[[[[[]��z������%P�G�sFf������<��ɷ�Z�����f`I�)�aV���B��vT�3C�úJH��S�S�����R�U�� �,�[�LeH&�� �5���ݟ��s��K��&��o̿��^�%�=aߺ��$�xo�
�"(񛺹��h������=���`NH(�}��}1�=��}�e��R�_�,k������9Y�g���W�1�V\cS��I��>��F���?z��b������)	���)ż�+�o�.%��P6�wQ�����	���0��Um[�a�@�.�;hr]����]�����'�2i��݈������^TEz�3�ⴳ؟� ��ʙ�\ͤ4��<�Z�~��5�����r�?B]&��'LDe��d1�%p�6×��X�]P5!��C�s� x fY�)~��ؕ�o��g�'�%�!�� 7��q!��?0���[���u��������B������S a;�����9�S���,W�dK�p�Ć�����_I\@PQ��.&~ {����(���!ڙ�w�XT�5�� 7�g�񡠿���P��z�/��  ��+�
�7��3�;�;'�7i�i"�� �@�N�%�KaS��y�C�h���5��A?�����J%bA��0��A��P��:�N���U�'{��M@8�>X	���١D(W s��Yx��~V��d�~�q$4T�����B�r�n�A�l' �����C@��,�A�p�ƽ�>�A�5���	��ڔq��(�o�Aa�5"��e��~�POc�������o��`�v��oL��RN������4��-�U�$�k�j�w��cH�]���m">��sH�1�
�Qʇ�]�Y���nYR��F�ܢ6�H��ǿƱ6ۊD�YL��u�����X�t9C�[D��(��M�����Y2�j�f^|�K���e.{��pG�H��xn�aXs z�&>Ж
 ȹ�H
K�L�մ����v�QAã�`g0>�2?l�!�x5	��Xu�;�����y��X4�eIf�Z]����~�2`?����܊���f���՚bf7-������Y��v�b:��'�^����'w��(�P����	�b��)�.m|);�E7���f�m�!)��wg��;u�A�H���Z�q��Y���y1�ќ-
B�EͰ����{M=�;�=�,q��6��Z�;�8>a �c�_L�	�BU�.#�q��������i���Zh)⋈_q�4����K$��=nE��0��X�a�&�#��xY�m��w��l�7��,�,p�����������
��������� j`R��E�~H�H�C
��f�b`3�8�N*�� m�65�Q<�)�_1R��!�~��%q.	3�$thjF�Č���s�A��ё�i(��Vx�Hd
��]-&�2F�K�����
�"*5��m��@-�_�����*�gX�j�J�E��j	@�ҿ�q�����2��R�t�ǻ=��-��Ap� c�$;\/�ٚ ƥ}����[t��V��_��|���5�X�86�i�ZI%z�����Ʊt_~�Gǐ���|���W���M�Dg��A�k��J����򥏹�vĕ��<��V�/$y	́��ΉK;�!�g����.sv���Ғ��/��O�'��\��V(�I.���/H�\�v��T0~WDo���� 
=����I������z|��j�����C�]¿�4.� c|��À?��R� �J�2���#�B��i��?�-��6�<�J�:$�ɻA��>�hA).b��?��=CQz-�_���ph�M�۠�O)��5�~����������l��b��=�`�a�b&z�b��g�=�j;�/��O���#'�$`�.x�o�ͅw+4��XD�A_�� 
=����I��,wq��>�2G�}����+��hJF�1��}s���< '��Je���77�D�:4�j��� &5��������!B���a�c�����+�������������[�4bVU����a$h�L#�$�'�~��0�<�2XS��}R�%�
D��A&z�${H���%Ģ_
�����,|p�����@k{#��T��&��.���sN�6K�C4�>����JV����� ��t� �_Jj�amp�Y���3�i���z$�_��M9hpcY,�D�'��B�"�;��!�)�s)�� a1�J����PYs��b-��,5v���t�\������멮��\yB3� �8�EȠ���_�f/��w��-u�.�)�y0�{�Pz˗tF-�����9���`��<&�/�4<,�:���1֒;\/���Z`����%�Ԍ�b#��kl�-�������ne6аS#��qW� %���F��D�j�kҷj˼�/ƸU�|��rbūW���J��DFF�&���A
l�	��@]\��$���-G�I):L1H�nK����-�dl��x�>��E��N���d��_��o�u��%ւ��wX�-�5| ~��f���p�j��C��E�G<�~�� ���i���g�hvc���P Ҋ��"h�EQ}J�����;�Ӊ���~�6�$�[�	��� 8 � ^jY��W�P��!�/4@�t@�Y����"h฻e��&��b��r i�<k�jdp�Ws�D�0��:%�I�x�z�"g������k�����@���|�/���8�m���뮸�{����ᵕ�]�t���gG�ƿ�Ơ�)]%m�]E��:뮺뮺��ҟN�N^O��O���4�7�X�Nu)��#���S����� )c�������N��������q-�����|&��[~��HG�hJ�
;��&r]��3�����<o�Fˆ���]���ݠ`4�q��AI��a��B65������B�����H����3u�jaF�J?��qp�r��m���ÿ5Z?�SJTL<���Τd��� �&�ԟu�-�SH�$*$
!:��)"R����/��ð���M�R
?�c}�[B��� k�Ƅ��{�<�^a/��!����v��߀Ŵ�%��� MV��T�gd�{�߻���t!�(9����|�vG~�23���#%���.|w���V��6�o�����?�����1Y�$io<M~���� �F4e��S2�\���K���/��	g2��!���<ט�_K�0��aC�XoI�s1� }�N�P����n�SW�B��f�	a�]�����/����P �-�� U��S֠�fz&`<�#�k~�Y����ۖʏ�zmd�d�Ub(���d�-�/�w͐�� 	/yܥl=���I��?�N�y"nt��!K�r���).Ж�1�ptF���A���;�ˀ�`����� �[����^�JݕpV��?����a4e7~�n����/��y����p�5Z?�S2�B�{T�0s��wxU�Mo�쫂��)����I�L���/@c�_��T�5Z?�S�u)(e�ߣ��>�p��h�C߳6�0�f����_���A^	R�m!�`h��?�a����������na\�w�1)�E5v�0��t$�\_���L��G�=���� `�������?fH7�nk��D��7u�C�̑�ʹ�	�u��� � �H{�a[����p��B� �Ď)�n�MM��p 3
�)����r��*୭��k��h�n�/c��}�COY� �h��L�C�m�R����-��V�5����
�ܧ��5&I3���������u)(e���;�j����4�d�$f���[x�A�Q������jo���s6����92����(��Ӈx.جVKn��?�(��$cF]^��"W`��5�C�p�����c�| -i����&T���J���2�D���������?��Y*���:�	<УW|��*`�x1�X7�=�����~	����_:SVx[��d��r|ґ���K-�6��:�<�8��z`̷2!�ZoXLm�1�0��j?�@ݏ�� ����\�?����&k������	�Ĳ#���L��٫�����S�2��xf/����:�;��a5WZ� _�����k�`d��Qn#E��R�H��˘�����z0�!��?`�3�ak
����J�F9��;Č:��İ����w�@|��x������_�����d_���>������ˣ�mx	HeC��L
� �-�SD��	_E�e�	:[*�y�\i�L�9����R�8KK�r%��,�?WO񟟯ͻ����Ő���������`���
���*���l)�����q��r��84J0���!�*��:�c�� �7I~L���Rŵ�n� ��n7����[��xPw� v��
��~�Q�����^�y�S�?��=��!�XM��`�}��Q���Ɠ�~}f����0��J 1o�[g�X�e��:.���o��v�����\w�a����?�k,G�hs���*�?+ߑJ��������]u�]q� En�뾙!TN���f8�~&K���uއƀ��Ͷ����9�J���/^�뮸�����]��'9Qo�^��Ǐ���= �nZ�����c�0��"8L`�m?��6�)-��[�<7�V�/�g萻�x& g��+}�ę�lqd4�M�g�i�3J�ӄV����ѯ�S���G�7�������${��k=����zs�j 3KY�)����O��� �^�)*�`��਷J�Ӏ�vZc��b�jH2������M�5�Sn�x�K���¿ J�O��r������_���r���vm�������]mMps�Z"*������r5���D?�#d�����������������n��8����@������D�?�n�������)	��96��[��'%�H*q/�K�K���}S������k� ��I>)���ӵ�����_'�_u�X5`/���k�/�����ѥ���l�oěnz���7�����uT��Fd�B%����z,������6���ÿ�v����	x@0���j�WU�����̈hmM�����pA"	 ��)��F���$>��6������S�R7��s�E��֢�r#ҧ�� :� �me�Y�ƻ��X��j�[��0�o�v�y�:��5�!����A�EH��ڢ��,j���3Sh��ё����h�����w%�oL��_U�:��u��n��u.� ̩�#����i�7���p�~�(�)y��U���Z�ݒ�oO�<XEzsH��M�@�%�!@��Xc�������-&��x}VC��j�f����n�Ht��W�!�`  k"C�R��Ɂ� ��$M�/{�����o�f#��?X_��@�.��Ȳ��A���Ttfʿ1�E�o��2���0�~�}2.j��ܐ}�_N.`�g�����xt����׽~�,�!����o����J_�j����ְㇵw�Q@���KϿ������&��z}�a�q/ �@���Xc�������-'��������&�}�����"$��[�t�Hl?��,*"?��	�X��Wh~k���`�LmE}���;�g�(a�q.A.�#�����_ר�z�d������/M����?V�N7������@0�k�W�:���H:�z��c��	���Yl�)��Ԃ_`}8�5я{��+�Y��2S������k�w�{�I��������K�9|tI��V�� u~t������{{�����?���J�_ �^��5qc7��t��r�% 31�r^5ĉ�ط��װ���)���V�i����/#F��� 8N� W���
t:��-[8����$%�������E/W��
O�r�2���V�
�� ����D>�#7vc��o����<�H5�q�&w"�[_�~�x��/�x�5�k�l��u~Ѣ	޲9��h�]�����#��$�{��x���%����f���҄���������:�,��B:fR���d{Q��3��$��ƋĽ��o�5�us-��|�7:����^��gb9~�����Y�_�i���b`C�_�����^�
�+�E�_6��C\�9�sS�����>o���]����?����{�p��0��Z�Յ�{w�������;
���u4���G�|�2)*z�x�����-��|;����@�@>x�a�u�����������������?���|��#����m�O`�9�����=��x�g�
;[��.6BWM^*�����Q[yˀ��.}o>�"����~�� �vD>���#ϟ�N���u��G$�k���O���-�Ԑ��߃%s��l������0C Z�=��P8���_�G?� �*�����%Oy��=z������F����}���?���}i{�����!�����ܒ�؇�"dF�Z�=�I���m513R�i�lX��O#}9=P����/ie2��~4S,ߞ4PF�\��A��5��Ao�7b�,��9/����7��ŋf��b������N��	�.��C�o\b]����щ\�)Gݑ!#��ǇRP����n�#u	+���ȅ�"%���������~[�����8.1 �fr@���k�ܥJ͍]�c#"�O�)kx#ȣ&i&� WS��W��:k������Q�p1�����i�4�_d��c�7��*x�b!O�`��k�֕��Ew��dI4���}�|������1����e��^�����cC�e��W{��O�.�#��5�?��^}q�&�&	��Hz+�g��龪�x����̺���������-7`��]���F�?��W�?��� }!	�-� 18���+�v�qP��B�����(�����h:^[�Ek�;[�o�[O��u�_�c@�:?�
�4(SS�����0ҿv�0)c*
����U�X/��~���qS-Ƃ�y�#
�l��A�0�Cx�m�<fzO:��m{��-;I�t�s>΍�L-yG�n��g6��=���x`)	�u7;諿/���wTv�+Q���,-(���t�gG��x���������o�̺������Tֿ7�m�z�����A�|j��H��ٟ��LlG�]��7�}����}��}��}����������#:���}��}��}��L ^��`m��=�!�VM4G#�mɟ��gxG9�c�?] 0g$?[�eK~1�5�F�F�9 ~����2o
a��g���F#������ ��z&{��<��~���=��\�  =���S|��T�}^?�����������@�5)Z���*{! ���C���m������x�/Y�P��i����jr����6'&pg�/G���>�A1���S�~hY�O�9+���q�"��@��Ά��:_���Z����J�R��e4����JR��}jhD��z����ӂM=�~A\c�b��3����^��7�C���=џ���C�L�n�@���g������e�d�Ã���� ���,w�J�쬟o���>����Ў��pK��� ��@�#\�6 3�C,'+���Av���71��	5��VɟZ_������z�z�����-��/}w|�f�Q�o6�T8�ސ��U��xQ{����5?�'���`Q�m�}	�]�M��&Dcv����Q�����T����@�sJz������	ȋ���<C'\����Nf_2 ӓ<�ʟ:�>� �_�Q��F|kF�jc��~4x��"H��	��m�ԑ3�9����7�����a��!Zc�չo����|�E�_��
�; &d*r���C�&�SVeC��=��BC��	��Ag]~����(~�<�/������$� 1��f�Q���a+(Cr��G;;��c�+BV7�^����#�a�V`t{����fB��3��\������X"Xछ��q����gZ�o[�'�;���Tt���c��Wa���s�ns�'�2��]@[D�̅a:X̡���^ن�����P�`3��f��8����9h���Ȕ!߀�5�8ܻ�w�qP���.\�_K�r;�}=�跀Ê�B�I�:6~j�(�(�����A胰fB�)���fH�?1�bg�
Y��1x|�Uw�d2e�d���C2����=G��[lƅ��� ,���{��9���AADw��z���X̡���倪��ax�3�K` �XS�˾���塚Ajm$�/���v�����;�"PA'��0��.�L$�8�c������&���|f$Ta	���0��y-�iIC۠UzXT{�a��u��eV�fy���ǥa+Zhx��.��!S��Sv�&R��(� �2��ٶ��E3���x����I�ʤ�;�)�g�ov��F%[AuR�U7���"8�
.��
ӜN[|q�����f�\�zs'�$�$��[h��o}<'�	��I�� 5Х+���?_o����I�ʣ����V;��3�6���c���o/� <�,`���=~&��ml0��w� ��y�r1����� 6���rﴤ���*�-��ME��o��ޛ���~EH�@����sD��}���Շ|	!���f&����@����I5�AcK��f��B�K�4y�������h�cTE�Y�Qf[��-�ݧ�HY�([�t��"+��C���s��H�@m��p�u.�eD�d#6��`I�ʁ:]��2��+4�4��x0+�0k����[�r��㹐¢q��_�7ka��(���E�ysB��f{�O���U_�7���x��������k�I�F%[b&	�&��8|ʕ�F%�e�!�h@�r?���C��/��)�K6�0�fq���i�V^n��L�O�2�ؾyjq.�t\����÷'
�sj`+o�.�� (�� 2�&�R9�̜��lD�=௅���}�A��q�_��[a r�M�b�ݤ�#�8|�R�F%��͞6�$<>�L<�Y�Kp8ko�n��� �;��/9�SrDDt���#������X�%~��*�3�؍h1}�?�{�����9{�ǃW��C�X"ð�vM6?�Qu�}q��d�{�� ��"��y�oY��c�L�ͤ,ڔ-�_ܠ��V�kx ى�)���]&?��}��ԏ4 Fߨ�2�f 	�"�S�<̒�3�{
W� Q����H�:@����F��'�����^y8S(��i�]����韇��5�b��u���z�]������R��b�G5ݤ�#�������8|�R�F-���=v����`� 8���r��>m-!�Ł�D��]����
FG~^64:��.l; 2�[�D���,�9X��8J�����vg����v/������_`��5�ð�7����ȎC)���L,KﱡY���T�����:������j{"D��	�M-=��'�EV<�%�X�"+x ى�)���wi>�īn2�b�I�l
�D�� ؑj)�fI�י���+� Qy���DD K����T	J�ߑs�� �;�Ч��4�Ii����[�L5DQ��(�:�Ss=`.���T0a�:��e�����/��i6�~�ۤ�4 F�� q��9�揃b����Uv.�w�����v�������S6������H���#ؘ��XmLm�%�� Xr�����z���+� ��o'
e���E��+}�	Yy�_�
q��_<z������X|�y���������mml�\?���q���`�S��W8�z~�"3�8M�|(���t9M������,t�r��o=�{��0����E�;[�	1�k{��t�������&��v�뮺�_3��cEj!��o  C-���TEI��~�es��k�6\0:�.�H��[����p���x���J��_(=^z��#9UDl�[�[5{��o	_��1P��5i?���0�»��=j�Xg��7_�.ƹ�F���ZD0����֓�T_�<�� �~�|	�Ys� ^�Wߧ��xx�k�_~�H����r=�y��u��.ģ��b��O� "����O:��ɋ���r�I(I�]�;{��@	{g�~�`�C]�cn����_��P���������kmᲴ}.g�
���U�۴d�h������>���:�[�������%/��+��vo�F��wѤ��ן��v�!�.��ځ����ڿ�}�y}�������5jjj�ZI	`���Y�XOAS����5$���-z/H����;*,��W���:�����G������aQJ�ru�[�o�ȁq��Z�v�c�]���8Ƭ��8��o�;=S{��M?�o���?����66��o�6щj��>�3A2�g���:"�ξ���?��Z\��0��5� ���|���CE�'���1��["��'��I�_����O��o�;
�z]�����τ�k��������L��A�Ѫ��ǚd��ݣ&cD��}��;Ѫ�����>���g*u�������ܷ���m2�2ΪW����D�y��[�p�������"V�A��ʭ�az�>����=�V�}?�5��CE���c�dV�����㵓g���(gj��h�Ϯ���k��7�u_��h��F]�I���������@(�k�ͤDx7�9"6�1��m��������h�3�Ǿ��P`������DU�֋<��>�"ɹ�\[��� ������ڠ�K�X�BW�	�������L���wٟ��>�Q'��TC�E-������w�P�&�L�>�{��oQ�S����{1�(��~KQ�dɰ�R	s�|���]2����?��a=�'�����-���XZ��6������u���y���Zi���Ka,��_���?���:(���k�$�����?L���p�P�BӕYU��G+�IL�>#p�S��w��r9g��%���	x���}�[�N�tG�@��lG8�6������o����\|ȇ���a�Y����~~�Lɐd��?_뇎oO�(�jވ�Nn��  ft�?�YX[̡L�[BM�X�����ӭE������������$���}����W�?���r��<_��Jg�M����bſ�k,B����&��-��P��{秽�취��������9�}�-FLɑ�a�������W�� ��8i�y:"�m���ӯ�k_�0�����x9@w�/�-���C�E-���y����!��a??Z&d�6��~�����| �����9�ڪ
��$��YX[̡L�{"�Ƭ�5Qa����
������?��>dC�SB����)����	�\�JH��w��� �k��
*�HbP��w���NTBU>'��"�'�c����������uw�����/����skA��8Q������c�S���N��2l3#1��^��᮲.��p�K�EF�aE���`���� ���.l�\��Dc ��h B<l|�D�>��W�ð��bL�o�A����
<B��=��ZSG	�ΰ1��Jݼ\�*��2���G��� %���3�
�H�V���N�G~�ܱ��d�@�p���\D���!�IOOH�&��X<0� A�2���*qY�'9 D9���$~���LmL� l��ؽ��@/�ܞ��L^HK��_5�����ek�� ``����K�kx� �� ��Ā!��I�I�w�?���� d��� ��A��<'�M���*�`p5�hD4St�f�y��g��>�w��!�`������ ђYj�*!�֖ͬ�:Ac��7o�t�-�o�*�������@4���T6D	�}!j�K��>B�F�0�5ž���g�Y������a�p���5�����Y&� ��X�*��?k�^����(��۩/ވ̀n��9`chI2�7���.��u� J�%+S����@���P��&�Ԇ\��1�����M�7!;�(n���@��KCuc�%ױ��@5��q��b��F>E+������=���+a�L��J{��+%љ�"�c�q���s¥E�����������(�_l!ܰfa�ғ0�׭�����Lz�i��7}�p�ٕx�}��	>��F^���o]�?�Z�;�R׼�Q�O�
/�ǈa���4��t��	�&o�g�4����QS�:{��]u�]t���X�ƺzz�k��뮸�����7��܋]u�]u��)H�߀�_��"��� vi��s����k��,L�3k]�v������q�oЬu�c7�� �s���#[���{��G[R�2iEX��@]~���T����� �8ί`�Tl�cu��m*8�{	�x&��Fܥϡ%D�������&?�\u�� WQ%){��E$���FLmNr�T͊�WH�`r<<?Wּ�6Kv^��G ����'��b:��z�>
's�� ��[k����-�y:WDFN�S�Z��?]�+H��}�23������)�}O� ��f�
P�k����K����̆/N?7�9��9���6����i���(�*���E)�[M������V����퍅�\t�����R2Z&ʿnf�  �_��}��d ���`v�%T���ڛx����c36$"���ٍC��p��TQ]� �Kr1A��/�VpR� ����{ٵ�8ـ�Z�$���A�gڌt5.:� � ��f\ԓR���*��d_}�m�h+� ��M���k�)�l�^�F?b',D1]��\Y�9>!������[	}��l����)6N�F��������5��ˌ�QG�a����#| ��T�	]���4%��DP"X<��rg�GT F魓M�y6��/μ�f�W��r�$�s�'yW����5���-��?�J�*L[�� �fg��T�PԺ�C�@�T�끃��5[�3�Ȝ8bq�w����(�H���n����-��<FaF�|Ӵv.��� $9#����G���S5�d��]a0��l`��O��W(g��W�W_���/��B�<4:��qg���s}�+~��K��%�'�� ݕ*W��˫���!�O���Ϧl�0��7�p�����G����D���Z߼ܠ��d-!��D��&"z���vX5!���u@ߧ���_��QO BH��ͩ�G蛧�7��!����������9�3)��􇓺RR[��V���Uohl;p(�p����7%�;Z���p�ė�]�a��)���k`#��Q����77ݢ��j�������ʵ9�B����u_D�5鼋���	�[F��J$�9T����5�4(���>��<�E�|H�Î���5	+��� &���Tc��X���W���Ā^�>�)�@f����ҙ�1>�'?m�@�"2��ϴ�cޢ�k��!���u���P�Y�0����b�w��� 
^��(EQ=�nA�*T�����	�^ٞ���mM�.�q��{���if��D���S�\nPdc�:�^�|�ݖ�_�y�#2����A�c�ƁpFFfO�ܓˁ�߰.��:ý�0+J��+��G#0�w�	²X����0����[��}0��)2o?�?	���s60 ����@��x	�}7u�j�Q��+Q��wAp���j2#�Q�no�Eo�� 5,�{�;�@���,�Vk��O�u#����W9�C��m4H����aAzo#bO\�(�=����Ѝ��^H�"�/��p���r�]�QR]<5d�`���~!9`l21�G�@H @!����E�v���&W�A� ��{+�;6c�RfBu��Ƚ��Xu��r4-XN��C�9���B�P�W����y�0���i��,�F:�Im���ޝv�.�.2�`4�j�������]���Q��"s���!�ED��������Z��/F<.�?�E���E{�^~��n����223jopH�2mLE�����hDF]�{��wo��Vg˥���?� \<�Ғ����
V���Ö��0���ߑ�z �w��w���� R� ~�B*��r�R���Еd�2(C��!w0��[߼I#���1�1���1�H/x>�����7��htr!S�������@������B�P�W����y�0����,���l'��Kl�����Au�q���\�V���^�Wd����&L�63˫��_!�O�=�C�(�)F�����F�7W�l.��li\��|}}���`#��Q����77ݢ��'X~&t�W���IC�eP����6�^��z�� �����js�y�c<꾚�^�P^���}~�Y�W�pC�h�
��K> 6bkNq9m���V�m{�}u�xk��&#��tړ	�[F��Uv���j�*�3{����_�WR�9�\�EDm��������Hb�>]k���5�z;�x:Ƽ!������$���ڛ� {���SQu�������JTO�p�wJJK�([��vׄ.�q\�{��"�$sQ��& �f"��B}������A�p��t;�Zz��(/� ݕ*W����&��L	###6����!���T]}��r�f;#����۝�`؆����3+iM��'t����<B�U��}��.������8O�D����{� �8��������v�߽��	�k~��� �3�p)D�{���3�N��&��V��1�W��5�h߿����._��I/}�����xj��ӷ M��<h%���	؋>E��k� ��(bʘ�b�@��2�R��6?���.�c�A�cS0�P��,7Yw�v�xYk�������	��昒�����z�.wsç���O���X =R&�lY`��LE6�ږ���O��@�h5v&5d��Y�G{{�7���J'��6��1Y&����MU$������qVP.H`3
]�k���C(z�_o�'2M
o���@��մ��>�!P#����M�b�C����<#G���A�R����� �	��.�>F~��\��.����C�i� �0T���)����G�"����4p$������M��?�0����b8��~�/�w����@����}�JA
6���1�����������52�5��	�_���[0�z��$ƭ�5DG��\���0C��k���`����	Fb!N��73��D�xY03��D�X�ҽ4����q���w@EM�>�1�,���`G���'�����?�|+�5gh}���JV͟��P_��`���'K&��c��ך_�)R��]u�]tMt���b����������fĎ� �#�����=��	�.����Ņ����V�wF�*i=u�]c��xge� f�B� �%�",9l����Z�~G����C�5��R���}�-��N�u�]u�]u���?���,	�WtZ;K]=���a��.�ss�H�/��������� ����Q�P1�ȳ��<>����0�x��2�������������a��t��#���0��������A� ��9t� ?XGYJ�c��%q�|��f���_�>q6x�;��f!n!(R����<3�����a�#���A�wgtK��%ٔH�+_�a�C�M�k�����i��b��/���z	�O�2�SG���@5�s{��*�C+񢗇����-��� �j���ED̆������Q��յ��_��_�x� ��J�$y?�O���R��]C������������(m�`������4���#�i��I4���`�����$�I��M������D[���i9{_�����%�i	>���������~��֑���=������R=q#����x�A
%/Ի�i�[[[[[[[[[[[[[[[[[[[\?���7bV��5�@v�T�y!�����Xp]<�]=?���,��J{߆_l��|���������c�q� ,����O]u�]u�_�)��2D��t�3�ٙ5����x��*i]��^ ��+�s�{�A��s���=�OL�rO����R&uxb�5�]u�]u�Dl� �<GL�bw�:X�Sr���ҐX�y[������оR���mo�Wu��G�^���"�b&7�=��w�{8�1����O���e���� ��x��2v����i
'd'�5�m� �"y����4�M���-7	 /�Kͩ�9���zL�c������2)>�����o{����:H��0�����hr�FP|�x��}��9#����m���YP݆����:��VN�!�.w�D<�q'/����Uy��I$�ȳ${��S�8��������h��E���
�<}��7�����D:$��:5�)�����+�41�=��f�ӣ�l������:��ٱ��(��1T������C�&��5�r-�������v�xF�^1��,�9��&Iv!��'�`�1?���D���H������i󖛄��$�j`�<#Mb�=~֙�`+|~��R	���׾��CEN�>_Tb���;���:�^�)+����������~�Y�`;U���4�����׀�L<��sNe�tC�gq2��z��W����I�1����}�j�?�����)�<'lN�  �x	�ϓ��d��W�������>#_g�^P���zY��r4��LiHzi��V,T~��4��+������3X�C���B�L���W�5C˂�� ����H~2^mL%u�}��0ߥ�+M��O��
$�������*t���9�I��������U��NN9�c��P��(<0=W�.����*� 9j�[�X>�i5�/�t�'���TL�k��ę���;J���Ra��� ����_7�D׆��������TE�������J�b_�����6׀�L8�	4��!=����tR��_��s,Ӽ�̄lƝ�I��7���`�y;9���F������������xj/�P0a�=P�T#�5KMs��1%�����<jc��p��P\�Av��QTMjznw��mė���6�`L6���3���f�T�ǅ~���Hz9�M8'C���q��d%R�A�dITM���?�p�R��W�� h��W����z����L(��6�g���٫�������n�_�9'^W����:@�R���]�?� 5е+�=�&��O�DK+���c�k�*;����I��j��������`6�I�� +� /$�D������c���A�"_��@ J[�|? ]|��^f�㎛����\�����:��1эp~�P	уk~2Ħi�*-���\��gڧϠ���������������0fT��&��_Z�3�{�O�1��y� Z�ܘ��_� �h��k?�܍>rӹ�C^�ܬsvmz���B�o�("5��oG��>�a:�hP�)��I�/h�$ĥ[��-�.}9�'�y|rՁW/�+�8��1=O�D�xWCg����|p���cQ���#"�-�������dMCfh0�7Mxݵ���y��|9�f�&�����`*��0[ݸiODnF�9i�H~2K6�� L�5X�����h®����1H&K�w^���:H�|5�S�A��/Q�x��}���� �BԮ���2k^���ĜL�����oxv�a���fbˏ���`]x�����}�X���w\}��H	��{�^�}hխ��/V������E_1p�G6�,���������P�t����Pm/�_"���R�D�}�ߓ��M���x#�f<�i�a:�[�MSF�q[�P�36l���.0?S IN��H �Z*L����!cۄ��0￈u��ב���9ś���P w�K��h��@���)�Gt�����"c>����J�k��m��8NEu��x3e@f�
�a��{���J��d�'�%�ϐ@��	��AT�k��Kɩ2#�I2����xzCʌ�:����
�`���W>����	� ,�q�*�,2�퀠m�b?������J����l_a��y!)"�͠WE8�2�1O���t���Q?��̅k0�N����<lR�;���d	)�v���k��� �D�� ��&!��k�ś���c
m��n1R�4s&Ds�e�Ll���&3�X:��ġ"��5Զ�*dp���h-$4������v:-��N}Ż{Nl!����Ȟv�������֫i/T��U�{����
1��i�eCM*�Xq��N�h�l��MDٛo��+C�|�ž>����Æ %(~�lA�f�@1���w�
�Ҏ�2���k��k���bW=�z��,��K�K}��&��[XŁ��oEl��f\d�UU��2�2�7��,D��1X��k�	"���n����+L�\i�OK���)�}�ĉ�/�p���ةxè�DO�ӌ�ߐ0��w��JK8})�k��%32G�&]꫐�q,ǜ#5�'X}�h�������o��Z�I=���MN#m�5O�
TN�v�w�I�hӑ^X���j`����&��A��fl�E? Gc|�i�i���)��tu� dR��Ix͉O�t��x)��(��?-�'�N'���[���JU���vJ�wʗ�/�\�D=^�8�C
*�c��fu��ñ^���+���o�5?�H���Z~n�T���������������������ֿ�����k���?���u�]u�]�_�!
u̚�+3��?Y����&�B�kk-����E~�!ƿ��sl ��;	���IzGX�: W�y~�뮺뮿��%� �Q�1eH���<�Zb1l�'`zRE�[��zdpgLœ�����9�k^ˍ���a�M	)�7��kG-���S�s����s�b�P�K�~/�,n�9�� Q��&>u�a��;B �f����hI�U��	���g7��'F����Qq��RD)7�'`��u���+L�bUE༥[��i���rNO*{�F$2�#��/���
����.����-�!�ql��WU=@5�ݙ�� !q���
(SS�����
��*F8���	���i����3+oM�F����',Ȍ����&L6��h�l�3��2I x]��\��|v �-��o9���#��)��'�Т�59�����A^4$٘܁�½�v��5��W�͋���"
�ڂдQ?h�fVm���Y��|���o��	�2�3�s`���ù��q��s@�0�&����!M�R��/����w�痕�c8`?� �a�[b�<0�e��u`�@��]�]ù��xȫ�������Դ��Z�#��g{x���� ��W!���t\�����JA2[�u^�ĆZ�|��惼�D�2z˱?���o��_����81�W��#B%�&ؒ�^a.:.����)>��$�UG���9�i�!4`$Aͩ���Z9d�SO�η������p�A��pp��߂r�A[������� V�Ī�Q����dg��Aov�_A��yJ�>	����:rx�S��&��9�7��9�i��kG,�jb��1A�hC?�sV�
~�u���H�Q����̓lI~ ������U�ߠ�0��E��զG1+��^R�ς����5��D�}��Nd�k���A�FDڛ�L5��I�0�����������.�C��n��, Vt^��L��Oxd	n�B��x�c4(��j7/���.��&�n?���lHe�G��^h;�hDJ'���hoP��
P��X*ͳ��{�4"Pْm�/��%��u��8 �I�-9%r�?�Wi̛L	�"mM�&��$ژ
~�u��_l/�3�C�!��3��;� �Q�1eH���ǔKLF-���JC裱K~��L��防q��,Q��󱃉'��5���8S�a��Ŧ��v�z���� Q��C��r�g��Ë�34A�AV�h:�;N�/ƞH�]�&�X�)���N�+��뮺뮺뮺뮺뮞�z�O3����c ���d�mH����G�%��ޟ�vA�ӻ=h"iG�sLWFxMa_�����=\�z�v\jxa���?6p��y�4���|�>��iYKn�����뮺��?Qk~a���	��TUDN������uTL��b9�Q.(�XԠyM���v �m�"3��� ,w0h�������뮺뮺�������\zͩ��s��Ξ����}{vh�H��t[���3Cب����x8�^P�ļ��k�]��vE�ӗ�pvȌ�ן�Mhi����Z�k���<W�YM_�?2�i���  �C�k��kG'~M6�����e�����Z�  ���5g���Q˖��̴8���Nz
;���!�L��}�{o��9?,��^��޼)�خ��
�mX�.��$=��,{q1���n�����0(m� ��[�n�{�����`���	xD�]�f���倕��wv��%�Y��ݧ���� �+��n^���kn�GZ���<TL��\@�m���";��w����ɘMC��I�3��X���!�%���[{�ܼ^�w~�w�i��1���u�h��/�z���ٿ����c�}>`��&=������к��[�OoS���}o�W�Ξ���j贷����b�D0�7�y~��p�k0��??5�z������f?aږ���h����T��Gʆ�bv7�����of��:��0���v���7���U<!��YO��hi���d��^6����<��n�����Oy�c�������7�>zM&�������������%TXd�߿���^����<9�(�/Pp�Cu�L.�wƐUcj�w0���lRǸ���P�OM���9���d�ן�2���6�Ry���Q����F�� ��!�%�������n"��'q3������kF�I��Ů���vE�iʬʇd%T���SFZe��
��~|�?�� ��k֞�08��hx d��%tP�ҌQ�K�/��Fx'�̴9�~�R2)�����>����������sןr����[�$q_�5���O���8m����і���:6*������ඈ�>���T��A��mh�w�p5Ľ��\0�j�gF�A���y���hz,.�a��#"��>/��~�����?���|�ڻ"д�VeC�J���S��<�������^N��_�?4�4���ӷ��V�^�x*�V���xc3j��YϨ�A�h���0¨ho.������������ �M0�~�7�7k�=�����z
;�����������/[�n�)�خ��
�mX�.���M�X�_J����6B^���,��:����TC}�݂��b
O5��1����Px`;ļB�Q���-�S��&r4�uU�h�i1����>��ȴ-9U�P섪����h�CL��AW��Ϛ`��W��ַd웮�f��Hr����ڳ������vh�H��u7���f��P�����������!��]?����6';:���<9 ��z�mL����Э�ē< ��A,@&/2�1%O�u(LL��~��1&�������������������������932��=J'�9���c��t����A���!��f���P�7�5���$�!F���N�.��뮺�������\�BXY��!M{��z��ak���tX�jzx03%F��ՌU6�΅�7���~#hّ���(=���z�T����+��gIy��͚]u�]u�_ǩ�9(������ ?!����%É�]�]��[����{���jf�=^aƝ�xI9��v�N �L��8=@**;�Xa�B$��e�!4�l,��]�pw�? m�p�&.�"���������х���@={����x�:�4�F%�`E��^��}�����?x��,ƅ���"&f1uu}�C��@v�a#�,qOל�#|r=Q�u*�f� ����{
w��2e�������.�B-$�p;R��ٵ��:k��S�)��\L� vr�� 5�M4yf ��a���~ <,˱22���,x��:R��n�����D'��,��/�2��dͯ�f'�b��ř�ݫs.BWP
��###1J݃|ѴA�}mN ���*�y�L���tPޏsҏ� 3������C�x3�[B�������M<2��dצּ�p�������7W5���W
;����(�lМ���M���(��F���/s��<HB��x�	�q�"�7��O���� �į[�������`F-�ڴ_� ��@�f��+\yz���Y�3(;� �X��QH朞%GCjlMk�{�X��QH��� @8����S,!��񣸎�rİ�~�����H��0Ox)0���\fU9����m�?��\`wC(����%�?��}�V�/������XmLm�%��c��U+b_�g��G�C�E-���yާ���� ��zeA�%S�/��a=�'���8s��o����B������ �;�Ч��aRF~+?�SQ��6�_W�PW��&�mp�,�-�P�S�"�Ƭ�f��K�I���N��t�:��e�����/�
/������`9�6�m!fԡo�;t�����H���s�[c�D8�4;�9�E�A  �F;B��	Y{L�:��|O�儬5��,�k�fG����"�߁[�s�߀R��b�G5ݤ�#�
 �����!��{f:O����6[W��؉�{�__{>j�X���XZ��6�����a������W:��*����"��y�oY�ﻤ��]/�(�Jf�q�9:CO6��jP��MxȈ�Xj�s�#h3����ԏ4 FߘDYq�̈q�lW�whR5�+/.�p�$\��rq �6������� ��*�*����~0�َ����
<�x�ھ��"�H�����t�=W/�O�x +��n3P�iN��x /�4���:K!����`�z~��aDe�����ܚLj���)$��S�졔���@[�@�K?b��4a���8q��?���D��i�6.�L��O�s�/�i�;�љA߀R��b�G4��*:S`2k^�����b�G5�}�  1�g`���a�u����t��%���֞�NBD�(n؉�{ÓOz��a%S��_�8�����c#��c"e�x ���\��]o��)�I�N ����V��\��8|�R��K�lݹ%��Ka,��w����` �:�zeA�%S�/��a=�'���8s��o����B���:��� -�¢d���%ӰX���� P[���8$�<�����x�5����p�2BO�0.d���g��i�}�!(�s���^�}87�J���?�#��n��K�߀:��rU�@ (����:��|O��D?Ol�I��~�C
��S���4������}*T�BG�^ߊ�q��UχFwp���|W3=���� �L}�n��4ݚ,��7�q�_�/s0/33l7���{{6f�u7���˖�Z�9�c ك�%��V�(S(��!�c��Ј`c�ǆӇ ��"��y�oY�ﻤ��]/�=<�BͩB߮ȴE1�"�rDmc��۝�H�@m�<�@�f��̈q�hw�vC����!��Ƹ��Rl��ј� 2�&�R9�'�Q�ڛ�-f�~� [��}�  1�g`���a�u����t��%���֞�D�(d�Y����߻"д�VE]a%�9P���7�?��� Û Z��f>�ڌ���{ �I�J���a"�㕏\?�<��Չ�M�-�]ս!1.��d�\�׸K�bnk�O�kOV lM�����Xa�1D�cz���_/�BZ��D�PsEFm�%�����c  P��n?��A�%S��C���t�����4���P�#����d#c.k�7��)< !�[�r��sB��f{�S�`��p�Q,5̆�������� ��}Fྕ*_����_���{{6f��a'��#Nz9bU��-�9*��u�����_a�K��N��v� 
�4��ŗ �H\���v7�H/�َ����"Z��L��Q���`ś��A�W�qa�g�D[�BWƄG���� �� �<c��X$)K��pE)���4&���M�'m4�/��}��<l&מ�]��O_��Sw�U�V������������������Mt�������x?6h:�>�jr�O�����?���;����:뮺뮺�����]u�]u��~������+��J<��+� v��$m׿ V�ŕ��Å� `z�;5���� ��s������&�R9�	Z�p�:/���ݴ�����1�/��0𠯀+Fb����W�h�������Ӟ@0�C� W��#�\=@(��ڟ���i�? E�\ȏ�v ���R��D������D訟�a��<�G�������$����&���@jX��QH�d%j-�0���^Z������Ӟk�C��@�}��s�
�����4dL�o`k�w���P�&�f����8�.#����4���>������ʹ��~nn�jC���f���Q2�>����'��!����Z3W�� �!��\>�M����?����2t�0Ƃ��&�g�n�o��ͤrN��0��eϡ8F�S9����13I�w">�i�I����i�άb@�u&]���.�����wxW�=�;� ��/oQ�LHښ7������t��Faz�`ےMÂs �� `$Cm�Ǒ������_��&���^�07諠V{���F�| Ǐ�(͎�_{�2n�A�ES�T|��'V��V�R�m[����|ʺ��Q�E��*g80����g�����#4����~o�L���.H?.���]��
o��ܹl��]]˒r������UvOɹ��x+����B�����ݽaե'���l�:u&C��+��ؿ�齣���6Ǌ2��޺뮺뮺뮺��*/����J[L�����'!E(�0�.+�Mn�j�il�z>l~��`��)*�{��"��ͱ��  � q������.p��#k�G�������~�=�GO]u�_���p��������A �t�ڝ�(i�56�����{�Rdd 5�c��z뮺뮺�bb�NX� d�I�"�X�|�������-�;�{}�h�/��a�* �'-7�M�0?#*�������u �K[o���-��S�  ������b�!�|6L���&Y��;g���
IM����dF� �HǞ朓9��f>{U�ɝ���.��Vy]��c�~pp@g}�m��=FȌ���!$^��Y�$��p��ya.�`��m	N'Ŝ���/�YPw��s��^���9�[�j��}��>��l��xc��M���2Ry�sM2��i�JF�v�&�v��S]�s[NwS�4��L�u}eXۥy���k޶M-=��k߈0��.?q~m���\���3 	)zۼ���&^A��D<�?נ?��, �Ӯ��*��qɺ����n�^��D�V���L��6��͖G����x���=��"i�����נ9�< nͼ!�6Dg���	�ҋ8Ę��MF�s��]�͖���g1M��YP��s��
K�qN}�"��z�jE��o��G~�4�	�ʞǙ�	�M��*_8���o;�A�5,���3_ߊ�p�f���`��^������������0<��]؈ wo��;����6�(�z��d�(�L�	+g���
IM�����vT�V��0�>{U�C�i�ӳ���V�#���R�J��5���bn������ܸ���%����)���#�K�IO߸l�L9��1��Q�9R$v�����!����F��l�����%`���`������D��2�o����\i�z_��L�?�]m4����L����?�����\��?���1��~�u���%/[w��LN�ő��=c"���##�`QA � ���������ez߈�����\��^[1[��� `��7����KO�D̿�_��T^f�����|� ����u��v/��W�3�4ߩ;ˮ�(�W�����j���.��l�)����!e�Q���~��l�Iʡ���g��<�4�����)8fT�� d�n�z7��z�u���I��������<�g�]�gI�г�ߟ���d*<fQc��Z!����\����~r lM���~�)�C?��Rm	Cχ�}� �ވES[�`	���C�}A��Ц�1M/u� sռH��$��]��R�17v���l��ǯ����1Go����<��2�����ac�n�5��\_�C,9�~F�mr���r��1��ǉ�Η[N�G�P�X<JO[w��6Q����C3�6X]� �Ѷ����'��
��n9,��v�b�<q�sr�����ن��IfVQ��>��k��_#$Z�d~�h}���n �	���@s���!_�����%����"`�������9��*������6�P��-r=��X�%������M�=[Ċ��zMK���]w� �����Ȍ?��I8��F.�t��F��S������)m{���?���_߿�!dbR�<",է�ݓ�	,/��Q/�3���)tx1l���yJP5O�3˚a��>�.�ބVr2�w�lG=�4��~����VŠ4/&A0k`_��r��#׽G��d6�)_�V�ey����H�n��:d������ӳ�|օ�ʸ$Sq�}�EXӧ���~�u�������v��6Dc��3\�~t,Rè՛'x�v舷��f���=j~��/O�!N� ò�G;�?ۮW��~�Y��ǃo��4z����6�m&�M���X�Ez���X8|c�_�o��$!O\���"m�7��RSx *�+l�c��W��C���Z�k������p,�����~���}��}��}����|��=u�OO������^��k���*w?뮺뮵]�'��!H0�,�{��\I�j��\���W�PBc		���&�B�kk-��+Ǔ��6>��&eq/�ӆ�뮺뮿��ø �zp�Dؑ�t��ɿ���˟ȉ�o�Y�!��y���>v��f�f� L�3�=`p��Y������
����(���}�y7�!��ld3����9f��O�+��Htd���}|B��w��$���x��v 	��I&�O�� �[H�~����^RK*�\ߒ�,����Q�����)v�����w 0�NhN��FG���?O�-����n�~��t���_����3xW���9H�7���P"6��b�&{��zբF2�������~�=i�?�"ߖ��C����Q��H�As%�7����
�&{��z�_M1W_탖�� ��dP�����������	�$���Ҿ!Zϻ���K��箇��Ŷ�H�{��2�`��b��&H��0>ę<��W�+Y�{�`Hz�����������$����Ӳ��|*إ78���M���a�A�tA&�-;������� 7�"�ˢ�����Y���y���	�!�����Ȏ�o�0/���[���ؔ3J��_��n�̌?��+�y�ˡ����;a�F2#����Br����g�lJ|����FDg�y�3GO	����}��׮����$呻��z�xH�~����Z��w���3¼��I�y��v�Z�b�Z��_��;2Dc|�_�g���	$�m� �v�6�J��i[��.����ð
�V$���^����0*���+ ���	9i��))T�1���D����<;��%����?�����&����7��`u������Ӆ�&Čˤ6�M����\�DL�~Z�)��7����¿�9,�ף`	��v�g��<�7ן��W��e���FG���ɿ���`+!�����2r�瀟lWkR��������k>��4��m�]P�=q��Q}�|��{�-����Q�}�mmqZ|?!�[[[[[[[[[[[[ZZ��;��]=?��,;�9�L�f,��&��R�V6 ����VkL;�0m������[~x��pv���뮺뮺��<�
�L-O?���U�(�����פ{��f�-���|+����:��C��NR�/�{��M��-�ÜV�{��΢39N]���]u�]u��,��/���F��&	V��:��f���LB��	e_d~��0c]�j�ZH����Ų��|�Az)��D�X]���A�j��-��n ��7��Wx�� ��g~��.P6%�����/&B»��21B����YD>%U�"�Xӓ�0�V��y��A��)`�v�ڣ��� 0�V�ϓ��#NFF�h�za����0ק�4d�&Fg���sF���˅&��P6�U�<O�mj�+������8���j�[�H~O�������㏅?��h�@�LÆ�بp��xQ[^����R��!�h����,������_{��TH��v"�	C�^Į�{��	u=���w3�7IT��������q�#|�ei��(L��s��ͯ��B�%u��A�u=�����㷱��K��IT��־��F�6�y�C�x1��Zɯ,���ptsˈ��������	a��M��~���^��iJR�	�m����B6M�Ĺ�{L���٩��`�wsG���JX 5�t��:��G����k�o��G�"�m�o��T�ɶ��ց�0�q��|�����Uz�V*"	l����<%3bIm[��$R�M��ٷ�Q�r��_{���!y2;��b��1P��'˟�>R~JfF(Z>?X?���+߇�1���1�jm������? �������.�߁}������C��ڏ�^�TX�Z�ɿ�C"�[�x ��:��JU��@P�������lh3McuBƊO����{T�����%���?P�,(��f��P�
g%�Ϩx�5?l����y�YĹ���F�����:�M;���M.{k�����>������s��E�0s�����?g���P�I�m���g^��*�M�l֣S4���i�?~w����ε6���SW�_�= +�2W�{a�S���/���F��&	V��:��f���LB���YW��`�G��گ�V�-wt1l���8�^��G�Q?G(���h���Kg.ۈ'~�*C��+��@*��߼�!/��l������ɐ��?JfF(�|~�Y?�:��D����'�a��������qٱ�<�5r�zz���>7��)3+��	����
�0�F��9��<��]����4c"��c�k	�Z������7�iԥ>Ʊ����2�pFfJ�"~�k�x������^�6��ғ�#�/�$����tMu�]u�]u�]u�\w����؝�]=?4�TxC�l�Lo�}:��CiǾ-��x��z}�,ۡ���}��W��Y��tO`����d�>���m�O]u�]u����T?��7�����u���N҇S���	��u{�(������&_ˆ�~���Z�뮺����`�3�Z�_����ǃL��O{h�K<��+~h2�����	{��`g@��
�q����~ 
����Xx0Tȁ�����(&�����}�x��!�z��Go�$W��W-�D�[s�a�\X���)�R�޶ֽsZR��C/��h�":5b�4"Pْm�/��RӒW*��͖A��y���L'Q�u�L�:.�T���������v���'\���ğ�#8:�H=A!��(-k�`��������7����A?����bԂ�/�hh�	�"mM� =�.71���n�e��|q0֎Y&��S�s�������vE�iʬ�R�C$������!�gDＡ��2��(�<�ŭ���+I�E��6#@�v�QWj ��B ��Ԭ�X6N9��=^�����8��h���ƦDE���DD�r�}N���������.�Pq��ye��uC��g�3���0��#FS(l�6ė�aQ��g�A�	�i���RӒW*��_�P��3���l�c\��11-A�K��D0��hD9�K2#xd	n�B�� �L���Z}���s¨��Ml;�ql�VN����,�[����������fmS���ƨ���O��r�?���Q����z�C���� �Ӝ?�1?�����S< \[f{��0���m�tR�D�S���$@#��p���)��4���]�W�q�`���������@%i��J����s���7�3�h8��t8����<!� ٲ�$.r��9�'�=�k�F:��`�͠��0�	�e���a�^x�����5��W�(}�&}���9�T��Ҕck�.��Y��[�n�e��|�ݰ��Uڈ6���Ј$k5+;�j�ǡ�C���0:?��D�y�Qޱ��Apq��k?��F\��RȲ�x��j��9d^��P3Gc�6N9��=^�����" �%����v��]DG�?�H�Q��F�J2M�%�Tj�̳b�^!3���UA�,��D-9c04"?�	fa�
O�i�+�Q���d����L'f&%�8�Jg�*����+��E��ka�p���g%²w���\ل5Gu������" u� 
��ϓ��b��`^����۪���$������$C��k;�xMc�(p��K9����y��}�y$c�GgU��u�Q����x8i�o�9tfY��+M�c:����O�dV�(��������[y��l�9nj×�aė�����+q3r�7� l�N9@��0O��2��mq�� �L�.O/�B��8�O��y�b��U�C�y3��7	�.7	S���_�M�x�`g@�ꀍ����;/-a��`��ȁ���j	�Z~�xeoΰ�G���/��@�����1OZ�֠�fJs���15���<dI������ �PHI�"�����`:3��������E����l!���G3����ӣcuw=^�2hк�|�����Q�O����=Ԭh8�-��q�3�~� 6S���P �i��S�F:��4��3��<�u�AGT3<����U��y�['�X;r���g��ǅ�X�v�hD���a� 1�LFsߴ�F�����72dz�	a~S,���P��C��� �D�!8�5������ � �QJe���^%�3�>����_��^�6�]�x"�w�Y���ȕ��ߊjȦ1�f��J���F,�z���/b8]&�����ݨ�KW�u�>���=[�%��B0ox2f�4)���~l��u׀ǋ��Y,tz�L~�g�֓@��펌��d�����w������R����`�)U�
�,~��2��]����:w�>$kf���3P�s����T �����ɛX����G���A$ ����LU�wGQ��� ; 6�,��YF��~mLq��u\�X~��#t�'�wٝ�_��(Y����,�r�Y#�����P�RW�Pf�!�Vq�Nޢ�)��pѬ���"���7{3@�1�)�65��B}ĭ_9ې�X�S�ۢ/�+mT��]����)I�̽��d[)��H&L1�J��[� 3���th���a�'���S� ݒ�[[^�"뮺뮺뮺뮺맧����뮾�w��#����C��-`ĥ��w2�i������4��� ;�싯����H���w�7�ݯ�K����_���,��{%k����X}o�1o���k�t앯o��� `0y&×OC[���%�����_�4������R�wU��I���r�M�jnը�b�;��2�ܪ}�L�BWM���Ñ@���������?��2��.��@%k'2m8s��%����ߦ�k !K&[�n��%���eD7���\֍I������5�Qg�%rշx�+/����<����/���@��� ֧���8C��
 6J�$��tHɶ��`�����e� �45G.[��S2��/���>�����Hh�1����o��>�RA�=�Dzf����0��	a,�͝y��N��������k�n��% ��-��P�&T��A�������kF�#Ʀ*,�D�Z��%e^�`�z��6�%�
b�]6A�W5�SK�v Ev�ɴ���w�A�o2X�=8g����0L5����1��p<��R4>�/�PL?A-[/�(�H2ǿ�h�LѴ/�;�������μ� �%k�������WexkO��7?���s�|�� 6��	���Uv���� ���o��t��x�
Y2ߺ���%��3qF�A�=���Dzf��}	fff���o����֮�O������<�+V4�����b�7��MDqE��"�^@}u_v��?�5��k�Q��;��s&�u[Z55��I���P�::/i{~(����%�����5�����:2��\b�wg]�������I2%��#��}o�4��������k�:�ٱ���`�H2���b�^?��o��j�1~�������o����]�������u�]��]u�]u�]u�]u������Nc�l�&m�O�0K�b��5�V���.V��ɰuj�_P�O�O��cy�sU��8������$�뮺��eC�����Fr��PK�wܨZ"*���}�ɱ��u��_ P�n�珃�9om݁�/a�� �-�Ie�@��O�{�u��o��f*��Jߨ��)�Jά�6��r#���x���o�N$���1���#H�A���Ǽu�Ot�xC���뮺뮺뮺뮺뮺뮺뮞��ʥt��]u�]u�]u�]u�]u�u�OO�������'��I����s�h~y⨠=-�����gi���뮺�u�]=u��?�_���Z뮺뮺뮺뮺뮺뮺뮺�����k�����뮺뮺뮺뮺뮸���_����뮺뮺뮞��/]u�]u�]u�]u�]u�]u�]u�]u�]==q���޺z뮺뮺뮺뮺뮺�*/���z��S� �L���c�ɽx�nٖ�N��o8� $$=��,U���^2���z��]u�]u�]=u�� =�՞[^�`ꜰ#��#�<:|?�|tΎ��_�i�C� ������<�,�X�l��`�`rE����X;U.��  �Fs�z��05,���%ٍ�dU�=�͍���4��`
6]��a�!���r�
4�y!i�ʻ�{"a����?�7���Q�do��x���u���PD'_�J��Q?�A�KP=�+��̚��D�'��y��{p �&�K0 D >)(���U��3�-`�tN6���W�!���E�+��JF|��F1�=4��ȟsB�P�1��}��>�9�q��u| H&�K0 D <iN)(���U��Gmc
B8΃�mO&x�\Π,���1��; ]? �@����Js�o���c���Ε6��(hQJ����۠�qJ��q��:����sm��#0� ��X�pK�$� U�~�5O2N0$ϓ�|�vb�"�6Nŀt���8����ðSp���O��i�GH�vWRՀ/LsL�7��{X`���1��m�'0j6o�I��"�Β����GΦ�jD���>�c��>3�ʀ\D��t_�7"Y� �@⒉}�^����G�����=2}w��O��?0\ξ0��N���~�m��cMb;x�� �a� ���b�q�E����l]�����B�C��v���d�
�< j*o2ѭ9��F�Ȗ���ea��� 1�d�_[�O�
��s�2�Kh�����)0�t��.Z��!����C������_��O�{����@��{��)�~���a��:�\��3�!�5_�~�x�?���}%�Ɓ���������}�_�_��O�{�92�����=�Ofr�	7-��lj'n3�'�~�W�Y[�s�@�۵����Z������P��w����
�A)^�5 F�5���N��h6{�N�؍��y_%��b^���,ϱ�>��l�N[�lRf{�n�� ��f*E%�~�q�(?|���a��8q�} Pb���`� ��7!o0,�!rĂ���h�s�h�r�}h���ݎ0[�)b1���Y�B�KUS��'l5�fr����k�ܣ������˼6��]@,;d�f��v� ڠ�Y���C�)S��^ �0D�@4�N�_\k�����2��=�l�yss�`'8� �� 1bW+3�DI���"?�V!��?^B�_�� "!<��:���&A���8�c 9�3�� X���Ƭ�,u�u���;>���1�b������-�%
S��sD�gD�n��^�xn�>_� ���kĜb�Wz�D?p�3��P�ߪ42�4R������v���<3��������CVwgt^_��O�{��LҊ��}�A[��6ߣVF�u6g �`��@Y���)���`;U���4�����׀�L<��sNe�`��b�������Iy������9�N+�@���]p ����[h
�Y�m����#�����D#n$���l�)��=ĸ�^�r�DyF� �f�`�6{sv{�0h��"R��!Y��Wy�5�ʑɃ	� ��E)N���ֳ��\!����p�82���":9TA�7vwAխ� .���7�R���}�E��a[�n0��*Ŀ��m�5dm� �"y�J.r���
%(�AP���)���HQ;!=���'���F���\әf��ك�?����Iy������#����8��_r��SL{�qs�����*G���� �eي{���	ޢ�^���ym�E���@�J�ǿv*47w�82ſܧ���Þ g��;q� ���ys+�/49a��a���d2�������NI���������t��]u�]u�]u�]u�]u�tT_EE���ߪ���{��]2�m���]u�]u�O]x���!;�G����>��u�Af�=���`���S������sIw�g4R�������$�����͌������0x��&d��:?RR?g���
-�������7����+R�
��`�|�ؕ%�������� ge������0���1e���"V_��l�Fn�|E�C�nPJ�O�9��k�ag��[.���6m�?�m�����8�,�sFO�-���(�o��xw������CZ��a�O����������K�0\��{��~����*y���v��jD�� ��vdo�����}����$��������x���W�\�������B�+U[��@������/��_d��f-����fQ�1?���ݿ��A/��jvfU��@��1���?
$I�gנ )-�&	��`���������e�ͩ��� ��e�#�׷��߼<x�^T�o��\���ż�O�Ե8Ee����{�`�a��5)�f�3���!Z0�~��QQ�B���J��D�_��j��</���5�؛/v/�p�x������й?�_�u`L$�d����\�����	_J~i2LǓ�K����29>_����6�7uo�p��vj��A�]�V�]�@�!��B�|��f�&��DщY�W�W)����������#׋�0�?�KK�@ J[�>� ����N�
�����:����d�3N���F���������~�{���6� �M�3�����yK�����j��<;����_��'��	acF%e=^�*D�s6��L3��E��(B R�3�����h���Rh{��id�3N�������p�C#�����~�������m�A��g��Y6��~����׳e,?��(P�]�#�� Ȗ�$f>����Y���,�X�9��_�W� �S3)gR�(j�O�D�z맧���뮺뮺뮺뮺뮺뮺zz뮺뮺뮺z�N������?H�x8i�o�9yn&b�Rf�� !Zds�/ X s�(|@�S#���C��j� ��#��N�����*��&�O��Mc���8Go�M	sjo��s&�q0֎Y&���r��L�C�g��#"��>,��wϭ�~�����d%\��1A��n?@`�9�[�ԐI�o���������)�#B%�&ؒ�I�-9%r�?���m���3�g}�E4e��.���x��/�;�-�)��(>�!�Pwu[Z4��t��%�L:紗E���L�bWE༥{��i���k���v��v�ɴ�L�ԃ�?Ֆ/9?o��-E��1��dR����o��[��>*9c�M	sjoq0֎Y&��S�s�������vE�iʬʇЕ�k��hy;M5�O@���W���Ї3L��i�! '�b��N�����x���Z����5WS��6���Rɖ��u�3�D`�)�G�� � ��G1*��^R�ςo����9�'�=���Nd�a�� �9��9r߷�����c~)f8����������9�Eۀ!4`$Aͩ���Z9d�SO�η��/�F:��4"Pْm�/�;]��j���O��>���^E8�CȺg6���b�^1:K��ڤ7�P1x�$
��~h$�C��`���uM@BX��RӒW*���i��J��+��'�M��Mc���<���E1�Eq3�R�궴i;�赋�N��.Ӻ)�hs,���4I���րx�w�?�;�ļ	�"mM��Nd�n&��$ڛ�S�s����0k�}m]����C�F4Z�-NUfWi��i�覌�=�%(!����`�4K���0� �CE���m��i��J�����?�O�JA2[�u^������ a�� �q����6f6fo��2p a8���I	�|h�Ƭ�����cl\�����۾�99��2X�������[��RȤ%TX�6m�@&��/�߸�{_���s084�zh'����`�/��`��'��4L�O�߂��3B�{�,��!)boW����[�v��w��2�2d���w��M>��Df/���i����`��\%�jQe5� ��W}o��N�1���]sʞ��_a�|?��=�|�`./$�#`�T���W�d�̎ρ����$2������u���I���|���~q �p��߂r�
�L���� B���%T^���hu AL�bWEl�\d"1C����]W���༥[��i����9<P���FDڛ�v�ɴ�L5��I�0������2�ߊFE!|X� v���տ~���ò�z�PC�/��,�h���5$q[�?w:����$c��fЉCfI�$� R}KNI\����[t������}��Mhh���b�^1:K���h�c��Ho�V֍'~]�k�a��%�p�����#���x/)^��?�o�����yݾ�]�2m7:5 ��e��O��E8�C�av�~)�q�}������d�������0 ����a��M�����[�����<k�}m]�hZr�2��%tZ��)�ZEN�Mz�˯'P@���W���PЇ3L�퇧0x�`g@��0Tȁ���������+q3r�7=h�K<�+[��� �yv5J>6��t�v��F.����4=u� `�� B���%T^�U��M����' t��B���Wi̛L1� 29�]�̴9�~��R2)�������������J(��	�"mM�&��$ژ
~�u���1�e0��̓lI~��[Vp\��~���	W=y�і���g6���b�^1:K��ڤ7���C�_�?4t!��0s�ĺ��!,�
O�i�+�Q�����%t_���|����&��z�wo���"��"��ѩWu[Z4���Z��'T�i�̴9�~�R$�Q�k@<h;���bO�!4`$Aͩ�Wi̛M��Z9d�S|
~�u��� �wϭ���~��v�Ƌ^vE�iʬ��4׭=�і���D��>B����o���ِa� ���ꂨ�m�5ݛ����h�n��o��'��;�����2Lݭ��!��c�W#4�}���"�ۆ�Y�%�C$6�hnN;�o�R��_�� �Z*�W��X�w !H�7�m��N��?�9N�%j�4(��J�S���f��Y�	�YR}`!��}/�޺n�ߚ�&�����R-�}���D�x1q�x7�0�.X!���m����H�Ao�^&$Wtu7�y��YF��~��t,���"Y��]�,��z��ai�j�]vK d��3�)w�[Z�
�J��{��<g�����'��o5Ѥ%�f�޵E�H'��]=u�]u�]u�]u�]u�]u�������a�%���3<H$Z���[�q4�R`��#mϤ�������i��:��`8��4�jg���'��뮺뮺z뮺����]|x|�� ��c�"�ρH��s�t�ɦ�q1�WT@[DS�*����;��oY�ﮓ�Et��(�Jf�nN ������k�e?����+o�.�� �X��QH滴�DbU�}����ŴE1�"��(�-�wI��"�_ Q|�ͤ�К������ژ
��K��^8s��~�!��Ma�7,|��������^ e,M�(�s_v��J��|�ͤ��w�8�V�S[�s���ә6��}�D����G������a߅�d��2�~iRn=�ׂ�N�%}�	Yy�K��`_�0� ��)�I�8�V�S`V��\���	Xk��o��� ��p�Q+�8J������!� +��n3P�iN����r���!]���"�#�A��r�����Sͤ?�w����s��	�[�r��\о+���S�fE_�o*����� �L}�n��4ݚ,��7�q�_�/s��������p$��<ژ���2g/��p�
���[&�������Ese������ H*r��7h�oX�[�kH����b�V����
�f,�+���
-�)�Q�����] r�M�b�6m!i���^K?����� ��h ��  �2q�;�-p4�,ҩ��t�Xw#�|?��y�E!�а̋�S!G���Uo�8����}����p�Ce�W47-��&��� �XEFx�0����;��Y��3���߁� �j�^Zo߄x����-�@ �����#m�����+#t%�B��Ю�l����%�}�g`���\~J��_�������ĸqX
L�Ж��.B�Ó�E}g?����*~�� �h�ab� .�0��%pNȹ�/K��(�q�Z�O]u��]u�]u�]u�]u�]u�Y�]==���뮺뮺�뮺����u��&������� �`�Ic�z�V�B�D�ݑh�cVGH#W\�ۄ�ϊ� �8k��HY�([���$y�6�s�#h3�����1M��ae�P@ (�Фk�V^�*�*���^*���2=��E���3''oVC���t���תl����������8|�R�F%������m�	?���b)l%��� *�t/����!T�0���9:CO6��jP��MxȈ�Xj�s�#h3����ԏ4 FߘDYq�̈q�lW�whR5�+/.a��H����8j  �.�Pu	T����C���t�����M��k�ÎV 1��׷���q���0���U�W�J`/���w�6�)�7��^ɋ�m��
*�HbP�������A�$ᨩ������'����8n���=ak�����Վ5T�Q�ퟳ�Y��4����S��?��dq�Tèt�?�88H ��zeA�%S�/��a=�'���`�l��Du��x[z��OP����z�~ ���CN��z
>�/��p�\���O3�V?�2���{�Z���@�/f:E<o���E��C��!�Æ�S�u��@�~KQ�dɽ2����?!��{f:O���`�L�yYP�ո���O�_�H�8�c�!C.8��繵����(������c�S��0
<�{�Z��L�����n�`���0�0g�?`��˳�����?�2Җ����LP_�u�J]�����#���\��������	�E��C
��T{�7��9R����Ͱ߻�-��ٛ��ފ`/�7���]}�}�`}�9�8p���1� l�Β��+y)�N v�9X�������0Z|�������+�ׁ1��U	���_�Q�x�ai����a��0����� �RI��SPNwS�����`�r8J2�[�Fm�a����$��66��B���j�� �o��CEd�-37�l����9c�\+�	1�j����\i1UEoҴk��5�Ua�Hn�{=a�	[����-�UTaJ���+dt��Ę��E^��du�A�o���w�"]�uB!@��a��Z�_(t�_�7���zy���)9�1�5w��y耚2��'|�� s���-h�?�/D����P?����[�I��:����a��H�a�3��(����3ޟ�A��go�����&~��N��C�~�
����	
R�7�R�o_���������G��� �w�m^�=�>wN 6H��"TqO�5��l��gu>_{F��v8�!��*��Q�\X���k���ɰh$>���,���a�`j1l�ػ�u�Y�*i����Y��e�Tn�������c�m��Qǯi���������1~i�d/Zs�S����j~ĮQ�C��ߑ�������󳉤5�"ݩ\S^���HR�K�D�&�n^/�6W,�e���]�"��z��w~_�K�� ��P �ɺ�_gD9�20Wx>y^� �҄A?��Α�[J6]@Ă5qE�����џàY�����ݷ�5�S4���4�w�,��%𳗓
8����S��7dS�ŭ���BOF昽�(C�ߵ1}� ,�*u�a�1/;,��� �2���3�	Sɒ<�����'��|vp~�M5�Y�{_�DDF3 ����������Aq�Y]��	���o �o�I����#��w޳��yϰ��m�=P�z}u�O]u�]u�]u�]u�]u�]g맧��!�4� 1&�#����[�<<+�Bq�y鮺뮺뮺z뮺����]��Y~�C�N[}0x��8���AЕd�2/�Q0�]�M̰�?��� �����Sa�-�~��	��3~	-���Ӯ�פ?D�=I�$ �6�נ0u?�0=�?�-XXvE�������!f!� -lq�3
7{�5���V��^� ~؁����V��1�W�˚%��k�[
���J�~�}�m�h+�*�LѿVc���'����M���k��t�&�삫�tH��#�� BH��ͩ�� ��y�0__���\�����p�1_D� �d�T�a?�Fƕ�L�ٛc,��d��\��5���0vZ�� ~��'�n��$C{駯����v�V�3�������myh�{	�e7��v�Ğ���? �qz{�t���fa� >N{��"���˚�jZ��ۛ<�/�T��d��� ��E⢈���MB�-�f�T��C�U�[��������;�h3.jI�k��S��4���F?N� M0Ř��A~�3A��z+�ߝH���9�,����|�cX�I���?�̱������<FaF�|��B����l`��O���t���[�����1Hs�����o�Թ���jp7���� >����J7��5fQb"����h�][�� HA��������`/��
�mLj��OЕd�2)?��?���@Z��Ϣ�������u6��88�e���GL �304��@�Еd�2.�B�P�w��/q���9lpq�@/�S�� BH��ͩ����ϙ�� ��7ORn�d^�n	 =�Cͩ���������_s��W���bL;�k`#��Q�� �ν��3c �������v�o��	VO�"�\<�)
z}Uz�7��]h����4?o��'���!$ddf��C�mCA߸d�m���_�-���Ӯ�W�?D�=I�$ �6��`0u?�0=�?�/�A��������Ww Х;��>������Wu�� 2�e�>f��~�"�Ҍ͵����Ʒd���W:P�&/�����G�I���������Vx���H~-��!��Ԅ@�Q:�����4��4 ��v�!جk���������BW���\^LC��� ̔3��b\��eq����~�Dj���ؿ��aa v�Jʵ�7w��?E�5�˿����o���EK4� �S�
M`#A�O�;�둁�p�p��i��v���o/����K���D��F�����F���a)a���ϴ�5$�E�9���P���(A���~ x)d�΂�F�⳻�lUp�	�(�ϯ��/���e�Gu���|X�}���,x=䨃���cY`d\ř�Ax����t�)����f�ñ������[u����?����Ip-5z��p�hgA��n����1z�f���.���?�NvHvۮ/�!�ۗ ��t�bVr�!��w��ٺ�!
����34����l�䈱K��>�O��Xv� ���&�Y��#����������]׿0�"[��C�k��ؐ��7؍y�^���j�Xv����#�r!
�ZyCR#hb�����5C׀�5ɟ����� e#�a<��I[vv�_^�^���g`�O]u��]u�]u�]u�]u�]u�]t������-�&��MK� ��G�-���[t��]u�]u��]u�_��"�� C��@ /��K+�f�q�l�A�N�~��5�?��x�M�ӮQ���/h��w��a����&U�!���뀟�w�hk�i��x��{@�aہE�����c<꾉2k�C
�y����aoyo�`����3��I�u�5_��{@5Y�i�����_�*�a�|?��Hy;�%%���
����
�_��:�E���l���,�'�Q6�R������;�U����ao� �ᮧ��~Qb���3e�U����^�V27��>��6�؟�a������pl�G-R�=l���+3Ym�5��5�$I,�L�rY��ano-�K�lD1]��\Y��q�YL{�r�-���C���}_�ᮃ�t��Y��mC<꾚�������6_�΄�(�����$t;������f�L�_�6���B�@  ��7Y,�S�f8�&o� �'Y?L��e&�i�(տ����||]� ��5�/h��{��>A�K�e^=!����P*�����辞�=�?��R������g��W�w_�����EĞ����V��y����
���\�V���^�Wd������7I~L��C��))-���ߎ���8`��<B�U��}��!RK�����:�b��;�_�������Ľ"/��_X{�K5���VoG���&l����r���}��֖�B���WPZߟ����ML�5R���� �����=n�q~�"���ܿ���E� ��W���-B��4 �~�Q��=�0^��?�o�D7Ij&U�0�w!Z�C��6�1� 1
�Һ����t?��Lm�b��e[������	�N���<���B�������������P/ohl8	M#c�L��
�L����4�+���� _�������Q�M��[����6?��- j��Ͻ�?m��7��V-޷����.[����/߽�B��n����߾���o"��HI������YMB�5R���o��[������d���J�N8�O� |�����`�ᯒ�kW�U�, �L!�[��?���T�w�廡4==u�.��뮺뮺뮺뮺뮸��}������Z뮺뮺맮�뮿��E��Oa��|g=�@�nD�  $@���݊�:��H����m���) \hĬ���@�d0��� ���}^�Hd|���{�ޙ'��`m�#�� ��e���R�  Gp"� #�T%a �Ⴣ�
��Z�rĎ�u_$�Y;��`&�����m��}�a�%����9��ߜ�j΢�sD�eD�	��:o�{��Щ�?+����o�enn0V0M������{��6+�L5v�����;��t��Y�+���@V	3>o�}36J��P�|�~�j1��f9��������X�T7U�?�6c(����blb?���6؍�X���5a�Э�n9�o��Z7&������MLF�� <�k�V����#��e��>�1] U�xֹ�8H~2^mM_[�O��t�P�[��فi�^����-#-�ŠƼ҇���*t���5?s
]-���D��=
<�
J����GG!���>&���:��� ]5	�o~�2����9�I������m���lI��@ R[�l? �{{4N��-È�}��ٌ�C��1��=��=�4x�)�v�g2�r`�{��!*�JS��r���w�V5�����ƌ�Jz�t�kY����Ig3oܔў��m��@��Xn���� Dtr�:��n�[� ]5	�o~�2�����r� ����Zn _���S�=�  %-�>�.�of���u�}����ӧI>P[�f����Qt�����C�a��o�s�h���RW]���ː�l�T�@I�IY�	�eH��bltC�gs����7}�{x+�Yfw�t���1B��z�I�7r��������[4-��@n�3| /րN.�E�����M�NW�t��P1�ȳ����2���m;M������|۫�E��%���d�"̑������5��5����فi�o����΁��`���y�khgq'?׆a�<8[���C�O~���D��՚�O��!%��C�\D���5��p�����Y��T��w��5���}���8ђf���3,G�=���*.U3���a�wB��#*.�C�� ��`4��5���H��ށH,��¯�%Q�w\ŧ��n��DO��$��_��g؍�r��^���9[�����B��z
�֜`Gb�g��Sf�V,h +��~�eƅ��v{����G� ^I.�)�~���{�|�	S�:��;���r{���B�%F����\�/�g�Ctj�������S]c1�~�+DE�������q�>F=#���C�Kp��d�ژ
J����a�[!��I=��ĜM�������]��n�~����EG?���噻��>�ߵ'�oa1c8 ;�2�ذ�� �i��dֽi��fbˏ���۞�$�m/�D<�q'>�����Y�F\ Y��ڍc���ŉ�-��#��>h|�#(�pv��� ���H�P�ɱ�3���#7��N*�D���+'y��<͛	m�Y� ���V���g��q�q)Ƃ	x��Xhxgj]����\*�3���6�� ���V>z��]lXb
���lO:�{�� 3,��\:i����(��{�����-�6ƪ�ĉ l�hX��+�J9�|�y�[ ��4��,M��m� 
F΋Xg����-	{֥v`�Н,��X ����G��6<�s8�������4��o�u;��Fm������B�׷w�FU)Wh��jHB����^]���r�B�]^&�
�ʂO� �-�j̫�1"�JSv����n���P ��l� G�䅢�hR5A+H���J6l�	dq��RD���`Y!D\N��s	D1"����r������t�6��xjЏ� �Ư�������\*�3���6�� ���V>z����lO:�{��P��#�t�-7�(P�;=�������j�� ��.YJ����7 ���Jp�	�Ρ�~LI�'�� ���Ņr�| A =�Rݭ��2p���g "UN�w�7��^�+!2z�:��H��������r� $�b`����P�ߥE�^.p���!�r�h@$
� vw��o]� ��J�~��"�W��t,y��ȯP�YЕ]���]8���رĘ?�xaPʾC�073�	�a���L ,@Q:�i���?���n����5t���&�gj^���#mp���G���gl֛MX��A� L��s�c�a�'�e����3ɑ�k��M2ѻ����}VP�h{��Ƶ_��= N�<��oJ5#8ZG�u �l��$d� ��2R��aX�;x����ZnV N�����A�Q9iy���<����B%�x���SC^�Ґ �����j���=�u~�'}����]���R��HwL.��t��w�*���"���Pl�����U����֛	�BM�R�~+.!d����z{d
X�W?~ ��.�9�@���������^�Z$��ms��6������5acv� WJ�q}��
�h2��������N��q4��G�'���?@4T"���UF>�H�q�K'���l\hE�W��%�9C}�ѕL�0	�j@�Z�LL�i��i���LJ�/�PY-\�M�DXd�w�� uTGc��=��=���O�m�����h�EO��
��ѕL�q�K'���/���5h;�� @�6�����U)��3�8�g@�{C?�����g�79f�`��� ��.w�Nk#u�C���06��{�h����$�g����v^Jޖp"�Y.���D&;��pMP�,�f= ��[k���뮺뮺뮺뮺뮺��ba��T�����Q�|C��O�k�� p���fP��f��I� ���lwf��v�d) �4s��;�)�(���"V����_Ӆ�=q���3�������y��o����HtOq�%3O�Qo��0 �%�t<X{���c���A�"_���n�W�_��o���V����-D~LA+��wY2W����+DE��g����lŷ�ʁ^Xdj�Xxj��TD�7�V@�����r[F�u ���Z��x` �J�f�)
�whKH�b�n�fQ�1?�Ƿ -�)�D]���C����#3Qo��{y�]�2�PԺ����l���D�|��;U%��v��T�d����� ^I.�)�~���v^JޓW�g�fa��:�|���iJ!"�#M�Y�1���4�����!�5_�~�xĠ�����b�~┉{@�˘q4:�]HqW�5ï��0�d��	@�B*�50_���b+�����N�b����5ȗ;f�'�r}�;
�}�6�p�DFC:Ën��5i�� /�`��ɒf�$��y;��t���E
շ�]Ah���� v�?E:F��i�(���ڷ�T�>��dY�K��t!��X5�`��G����s,Ӽ��=^�5�O���98e#�H�>�]P�Z�)q�p�����l!�5_�����'�yԽ�r�#Y�Iy@i�)a��e�&�`�� %$$�!���`
� ɇ�Ƙ�~�����fzL�m�j��'M���b3,�T��[�0	m����V#4R*��~�Z��d1�@�^����gh��|4\q�=u��]u�_��"����=�?F��� ������̱����_k�r��K��F�9ië��B�o��F�[���}�����G�H����{xkKl���#����7��kk�}������@���Bhzz�c���O]u�]u�]u�]u�]u�]g���?�N�$���\��'��E�~yE#5<�����s��%V���ƶ������)����\@���|ES?��s8�u���my�C��]t��]u���Ⱥ뮺뮺뮺뮺뮺뮺뮺zz뮞�뮺뮺뮺뮺뮺���a�0A��s&�?�Ͽ��0!� l�8ɐ�]w�]u�O]u�]��������i2Xv g��v��c�+[�n��}e�2°�����߶�%f3�n��B�:�H��E' ��;4�?<i �����ðm��)���B܆N��P���I]_u=�Qo(� �h��� ~�����׶cC����*܂	!"^tی
4G?�b�aܰ�C���5Х+����P�k��h�����}���1'����~��q�"��'e��Խ̼���A&Nñ�~���b�@ĕ�]^���-��/���o��DzDf2g��R!R�;��V@0�(��_� �*�ʽ�1}�x�+o�00ч`m,��F�J��x��Xb"���f�WT�~� ����5DV��q�w;a;9��	i9��*�)�2������vM7~��&̡���]u�]u�]u�]u�]==u�O]u�]u�]u�]u�]u�]g]t���뮺뮺맮�뮿��E���"���)����1���ݍ���o��i2M]�FM���)!�9���an�y�Ah�Mzp���Ohķ��:�3A4HG����*db�u\�v�c�T׆�h���6u��;=Wx*�����p��N�Q�_�3���V��ub_��������9��h���f�����Y�U��Ic�e��������z@*ci�R�v���u�:�/3��������n�?\�!��ԣa���_/�]�C��BA����֍\�� +�QG^n����C{!>?)����~͘}���뮺뮺뮺뮺뮞��맮�뮺뮺뮺뮺뮳����]u�]u�]u��]u�_��"��i�� �ȟ�B�6C�*8a��	��5���]_�/V��F���f:�j��%�d��,��]u�]u�]u�]u�]u�]u���]t��]u�]u�]u�]u�]u�]==u�]u�]u�]=u�]u���.������䱐���_��� }w�����@�\4�/8�p� 	���Mo��{�����;�˂G�����'�8M�J�]�#���͑_�� �������f ]:������8�i�S����C ��D���ux� "?U���":9��-�"�m07���7vt_�{��^_�8�x[ �i&�M7�����^5gP��n������
� 5r-�'E�6x�uwz뮸[ DddFFddg�����	���[�[�u�]u�]u�����%�t��]u�]u�]u�]u�]u�]==u�]u�]u�]=u�]u���.�����~ g���2�N�KjanV�`4�Ro!{�nF�9i�_)ET�6����_���"�b&7�=��w�{8�1������3�� _��ͩ������1��_�y$�'��g����ub��� V�h��E�D<�q'o����R{����\������-������I�bS4���>��U���x VC@ȏ�U�	�;G�A��� F,��] Z�ܘ��_�
&i���{���@��Z/Wl��]�|�����) !����|T'(��� ��y�7�`RW]���� 3m��� j�:H���9�I�����8nj�nK���	&F��~����Ѯ�� 6	3>m��7�1�$��c1P�V����-s�������1�kvW����������16#���?�ob6��ˤ���lŷ����c�_
����ޢ�~��S ���~d�9�}�T.��Z�tyݾ�4��e� _��ͩ������1��فi�^�������CEN�>z!�3�8��~���{Az�x��`��� �j���ę�2���=��=�~�m��^� ���$~����h�����������nx�@��M�`��D�>�4k9�#�?�!Y��o���;��BU"��y�� .���?�e���cFF%=^�Q%�fo����?&` 5(f���(���9���=B�u� 	 @����fC_P	�|��H~2K6������`_7�I�ƾ������t�#�s8��/��� ��!}���s�`�cJ�.CE��S��������
���#��	�eH��bl�L$ǫ������v����������$7��绑��Zuq�\m��|ݛs蠈׷w��JHgȢƐ^�7���~)Q0�̉ gD�	��2o��e��K\�x2�����;��+�wI�x�t*aG���WSs	�P-����?U��	���P�Z��(�������'<#?��m3A�yݠ-#-�ż0�xW�_p�DT�{c�.d�OS�(�������{5o��vd����3��V2�^�?U�`;���� ��;k Yn����=���Cң�}i\(�!�����5�W�ښ����;�_sj�%�?� 1>c)se���p!�PۘliL��P�k|hh�k�t
�n�����Ϣk����2'���ח֕_�|bS�`��dt�V'}[�?U�>Ȳ�L-�^��H����G�����dMCf���U͂B��&7�5��w�.�!-�ԌG��X���JAb-�!o{�>��;B�J*�	���]��I�x�`;U���4�����׀�L<��sNe�z{8�1ل�5'���$��y:9�a�G'ʱ��� �Y���r�zB�C ��d4��%X������ F,����jd����:䎼1���7=����5m� �_�˶J���ê3{x:*O@ )��|��N��J�Ƕn�x >�����NӢl��/~�JK]�'����m�Fc��ö5�i����.���m��B�K=��_�`��^����߭��#d+̄�5$<���]u�]u���]t��]u�]u�]u�]u�]u�]==u�]u�]u�]=u��\w�������������S��"o���A���*�����O� �qob�����?�?ŝfQ0���2�	�����imCk}���� �� 	�J�/L�`E���+���� ������Eb1;����]u�]u�OO\w����z뮺뮺뮺뮺뮺뮞��뮺뮺뮞���<%�L����8I�{�1;�]�]��Ϳ����t���':FУ��d�$��H��_��\���8�U�뮺뮺뮺뮿��� '�~\���-�?*'���`����{���jwk����뮺뮞���C��F=t��]u�]u�]u�]u�]u�]==u�]u�]u�]=u�^�뾺뮺뮺뮺뮺뮺뮺뮺zz�1EE�TH	���� S�������Ս�7�}��}��}��}��}�[��� [��i�뮞��뮺뮺뮞��� �xOW]��Ǉ�0�~�����pH���PO�o�����#<������.��� +I��t��&�p����a��m0�z��m��'����~��������G=|��inO���/�~���� i��1��z�:�m}�5�39S񢖺� M&�I6����f#�)�F���3� ى�9����]}��-)L�?��¼s�����BԮ���w22g^f&������x�]| �D�jNd��ؿ���xB��)�Sv�4��DwK����m�iBvU��-�-bG;���6յ��\h]x��\v ������bG;���a�A��չ~�q� $�i4�i�� =7@���� D~��������h�뮺��뮷O]�ݚh�=���T�;p��i�~1MHj����@'��7*���-W���`���4��� �QVV!S\m���j?u�_��)� .^���C��^�>0|����m{����w\�z o�-'@��$����)�cr~��ݟ�T�7��������]u���8S� eW�!{�6���s��� h3�Z���%����뮺���Qz��뮺뮺�