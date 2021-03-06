INDX( 	                 (   p  �                             �    x h     �    Cҗb����$Ƿ��Wҗb�
Cҗb�       �               C a c h e E v e n t M u t e x . p h p �    � r     �    �aҗb����$Ƿ�'vҗb��aҗb�       �               C a c h e S c h e d u l i n g M u t e x . p h p       �    x d     �    ��җb����$Ƿ���җb���җb�       �               C a l l b a c k E v e n t . p h p     �    x f     �    ��җb����$Ƿ��җb���җb�       1               C o m m a n d B u i l d e r . p h p   �    h T     �    }�җb����$Ƿ���җb�z�җb� @      �=              	 E v e n t . p h p     �    p ^     �    ��җb����$Ƿ��җb�x�җb�       �               E v e n t M u t e x . p h p   �    � n     �    ~ӗb����$Ƿ�l ӗb�vӗb� 0      �"               M a n a g e s F r e q u e n c i e s . p h p   �    p Z     �    �*ӗb����$Ƿ�"Bӗb��*ӗb�        �               S c h e d u l e . p h p       �     � t     �    �Lӗb����$Ƿ�!aӗb��Lӗb�                      S c h e d u l e F i n i s h C o m m a n d . p h p     �    � n     �    vlӗb����$Ƿ�*�ӗb�vlӗb�       
               S c h e d u l e R u n C o m m a n d . p h p   �    x h     �    ��ӗb����$Ƿ��ӗb���ӗb�       �               S c h e d u l i n g M u t e x . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

namespace Illuminate\Foundation\Testing;

use Mockery;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Application as Artisan;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use Concerns\InteractsWithContainer,
        Concerns\MakesHttpRequests,
        Concerns\InteractsWithAuthentication,
        Concerns\InteractsWithConsole,
        Concerns\InteractsWithDatabase,
        Concerns\InteractsWithExceptionHandling,
        Concerns\InteractsWithSession,
        Concerns\MocksApplicationServices;

    /**
     * The Illuminate application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The callbacks that should be run after the application is created.
     *
     * @var array
     */
    protected $afterApplicationCreatedCallbacks = [];

    /**
     * The callbacks that should be run before the application is destroyed.
     *
     * @var array
     */
    protected $beforeApplicationDestroyedCallbacks = [];

    /**
     * Indicates if we have made it through the base setUp function.
     *
     * @var bool
     */
    protected $setUpHasRun = false;

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    abstract public function createApplication();

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        if (! $this->app) {
            $this->refreshApplication();
        }

        $this->setUpTraits();

        foreach ($this->afterApplicationCreatedCallbacks as $callback) {
            call_user_func($callback);
        }

        Facade::clearResolvedInstances();

        Model::setEventDispatcher($this->app['events']);

        $this->setUpHasRun = true;
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        $this->app = $this->createApplication();
    }

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        if (isset($uses[RefreshDatabase::class])) {
            $this->refreshDatabase();
        }

        if (isset($uses[DatabaseMigrations::class])) {
            $this->runDatabaseMigrations();
        }

        if (isset($uses[DatabaseTransactions::class])) {
            $this->beginDatabaseTransaction();
        }

        if (isset($uses[WithoutMiddleware::class])) {
            $this->disableMiddlewareForAllTests();
        }

        if (isset($uses[WithoutEvents::class])) {
            $this->disableEventsForAllTests();
        }

        if (isset($uses[WithFaker::class])) {
            $this->setUpFaker();
        }

        return $uses;
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        if ($this->app) {
            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                call_user_func($callback);
            }

            $this->app->flush();

            $this->app = null;
        }

        $this->setUpHasRun = false;

        if (property_exists($this, 'serverVariables')) {
            $this->serverVariables = [];
        }

        if (property_exists($this, 'defaultHeaders')) {
            $this->defaultHeaders = [];
        }

        if (class_exists('Mockery')) {
            if ($container = Mockery::getContainer()) {
                $this->addToAssertionCount($container->mockery_getExpectationCount());
            }

            Mockery::close();
        }

        if (class_exists(Carbon::class)) {
            Carbon::setTestNow();
        }

        $this->afterApplicationCreatedCallbacks = [];
        $this->beforeApplicationDestroyedCallbacks = [];

        Artisan::forgetBootstrappers();
    }

    /**
     * Register a callback to be run after the application is created.
     *
     * @param  callable  $callback
     * @return void
     */
    public function afterApplicationCreated(callable $callback)
    {
        $this->afterApplicationCreatedCallbacks[] = $callback;

        if ($this->setUpHasRun) {
            call_user_func($callback);
        }
    }

    /**
     * Register a callback to be run before the application is destroyed.
     *
     * @param  callable  $callback
     * @return void
     */
    protected function beforeApplicationDestroyed(callable $callback)
    {
        $this->beforeApplicationDestroyedCallbacks[] = $callback;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       Some special methods cannot be static
-----
<?php class A { static function __construct() {} }
-----
Constructor __construct() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __construct
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)
-----
<?php class A { static function __destruct() {} }
-----
Destructor __destruct() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __destruct
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)
-----
<?php class A { static function __clone() {} }
-----
Clone method __clone() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __clone
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)
-----
<?php class A { static function __CONSTRUCT() {} }
-----
Constructor __CONSTRUCT() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __CONSTRUCT
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)
-----
<?php class A { static function __Destruct() {} }
-----
Destructor __Destruct() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __Destruct
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)
-----
<?php class A { static function __cLoNe() {} }
-----
Clone method __cLoNe() cannot be static from 1:17 to 1:22
array(
    0: Stmt_Class(
        flags: 0
        name: A
        extends: null
        implements: array(
        )
        stmts: array(
            0: Stmt_ClassMethod(
                flags: MODIFIER_STATIC (8)
                byRef: false
                name: __cLoNe
                params: array(
                )
                returnType: null
                stmts: array(
                )
            )
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

namespace Faker\Provider\ar_JO;

class Address extends \Faker\Provider\Address
{
    protected static $streetPrefix = array('شارع');

    protected static $cityPrefix = array('شمال', 'شرق', 'غرب', 'جنوب', 'وسط', );

    /**
     * @link http://ar.wikipedia.org/wiki/%D9%85%D9%84%D8%AD%D9%82:%D9%82%D8%A7%D8%A6%D9%85%D8%A9_%D9%85%D8%AF%D9%86_%D8%A7%D9%84%D8%A3%D8%B1%D8%AF%D9%86
     */
    protected static $cityName = array(
        'اربد', 'أبو نصير', 'الجبيهه', 'الحصن', 'الرصيفة', 'الرمثا', 'الزرقاء', 'السلط', 'الشهيد عزمي', 'الصريح', 'الضليل', 'الطفيلة', 'العقبة',     'القويسمة', 'الكرك', 'المشارع', 'المفرق', 'الهاشمية', 'ام قصير', 'ايدون',
        'بيت راس',
        'تلاع العلي',
        'جرش',
        'ساكب', 'سحاب',
        'شفا بدران',
        'صويلح',
        'عمان', 'عنجره', 'عين الباشا',
        'غور الصافي',
        'كريمه', 'كفرنجه',
        'مادبا', 'مخيم البقعه', 'مخيم حطين', 'مرج الحمام', 'معان',
        'ناعور',
        'وادي السير',
    );

    protected static $buildingNumber = array('#####', '####', '##');

    protected static $postcode = array('#####', '#####-####');

    /**
     * @link http://ar.wikipedia.org/wiki/%D9%85%D9%84%D8%AD%D9%82:%D9%82%D8%A7%D8%A6%D9%85%D8%A9_%D8%A7%D9%84%D9%88%D9%84%D8%A7%D9%8A%D8%A7%D8%AA_%D8%A7%D9%84%D8%A3%D9%85%D8%B1%D9%8A%D9%83%D9%8A%D8%A9_%D8%AD%D8%B3%D8%A8_%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%AD%D8%A9
     */
    protected static $state = array(
        'آيوا', 'أركنساس', 'أريزونا', 'ألاباما', 'ألاسكا', 'أوريغون', 'أوكلاهوما', 'أوهايو', 'أيداهو', 'إلينوي', 'إنديانا', 'الاباما', 'الجزر العذراء الأمريكية',
        'بنس    يلفانيا', 'بورتو ريكو',
        'تكساس', 'تينيسي',
        'جزر ماريانا الشمالية', 'جورجيا',
        'داكوتا الجنوبية', 'داكوتا الشمالية', 'ديلاوير', 'رود آيلاند',
        'ساموا الأمريكية',
        'غوام',
        'فرجينيا الغربية', 'فلوريدا', 'فيرجينيا', 'فيرجينيا الغربية', 'فيرمونت',
        'كارولاينا الجنوبية', 'كارولاينا الشمالية','كارولينا الشمالية', 'كاليفورنيا', 'كانساس', 'كنتاكي', 'كولورادو', 'كونيتيكت',
        'لويزيانا',
        'ماريلاند', 'ماساتشوستس', 'ماين', 'مسيسيبي', 'مونتانا', 'ميريلاند', 'ميزوري', 'ميشيغان', 'مين', 'مينيسوتا',
        'نبراسكا', 'نيفادا', 'نيو جيرسي', 'نيو ميكسيكو', 'نيوهامشير', 'نيويورك',
        'هاواي',
        'واشنطن', 'وايومنغ', 'ويسكنسن', 'يوتا',
    );

    protected static $stateAbbr = array(
       'AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY'
    );

    /**
     * @link http://www.nationsonline.org/oneworld/countrynames_arabic.htm
     */
    protected static $country = array(
        'الكاريبي', 'أمريكا الوسطى', 'أنتيجوا وبربودا', 'أنجولا', 'أنجويلا', 'أندورا', 'اندونيسيا', 'أورجواي', 'أوروبا', 'أوزبكستان', 'أوغندا', 'أوقيانوسيا', 'أوقيانوسيا النائية', 'أوكرانيا', 'ايران', 'أيرلندا', 'أيسلندا', 'ايطاليا',
        'بابوا غينيا الجديدة', 'باراجواي', 'باكستان', 'بالاو', 'بتسوانا', 'بتكايرن', 'بربادوس', 'برمودا', 'بروناي', 'بلجيكا', 'بلغاريا', 'بليز', 'بنجلاديش', 'بنما', 'بنين', 'بوتان', 'بورتوريكو', 'بوركينا فاسو', 'بوروندي', 'بولندا', 'بوليفيا', 'بولينيزيا', 'بولينيزيا الفرنسية', 'بيرو',
        'تانزانيا', 'تايلند', 'تايوان', 'تركمانستان', 'تركيا', 'ترينيداد وتوباغو', 'تشاد', 'توجو', 'توفالو', 'توكيلو', 'تونجا', 'تونس', 'تيمور الشرقية',
        'جامايكا', 'جبل طارق', 'جرينادا', 'جرينلاند', 'جزر الأنتيل الهولندية', 'جزر الترك وجايكوس', 'جزر القمر', 'جزر الكايمن', 'جزر المارشال', 'جزر الملديف', 'جزر الولايات المتحدة البعيدة الصغيرة', 'جزر أولان', 'جزر سليمان', 'جزر فارو', 'جزر فرجين الأمريكية', 'جزر فرجين البريطانية', 'جزر فوكلاند', 'جزر كوك', 'جزر كوكوس', 'جزر ماريانا الشمالية', 'جزر والس وفوتونا', 'جزيرة الكريسماس', 'جزيرة بوفيه', 'جزيرة مان', 'جزيرة نورفوك', 'جزيرة هيرد وماكدونالد', 'جمهورية افريقيا الوسطى', 'جمهورية التشيك', 'جمهورية الدومينيك', 'جمهورية الكونغو الديمقراطية', 'جمهورية جنوب افريقيا', 'جنوب آسيا', 'جنوب أوروبا', 'جنوب شرق آسيا', 'جنوب وسط آسيا', 'جواتيمالا', 'جوادلوب', 'جوام', 'جورجيا', 'جورجيا الجنوبية وجزر ساندويتش الجنوبية', 'جيبوتي', 'جيرسي',
        'دومينيكا',
        'رواندا', 'روسيا', 'روسيا البيضاء', 'رومانيا', 'روينيون',
        'زامبيا', 'زيمبابوي',
        'ساحل العاج', 'ساموا', 'ساموا الأمريكية', 'سانت بيير وميكولون', 'سانت فنسنت وغرنادين', 'سانت كيتس ونيفيس', 'سانت لوسيا', 'سانت مارتين', 'سانت هيلنا', 'سان مارينو', 'ساو تومي وبرينسيبي', 'سريلانكا', 'سفالبارد وجان مايان', 'سلوفاكيا', 'سلوفينيا', 'سنغافورة', 'سوازيلاند', 'سوريا', 'سورينام', 'سويسرا', 'سيراليون', 'سيشل',
        'شرق آسيا', 'شرق افريقيا', 'شرق أوروبا', 'شمال افريقيا', 'شمال أمريكا', 'شمال أوروبا', 'شيلي',
        'صربيا', 'صربيا والجبل الأسود',
        'طاجكستان',
        'عمان',
        'غامبيا', 'غانا', 'غرب آسيا', 'غرب افريقيا', 'غرب أوروبا', 'غويانا', 'غيانا', 'غينيا', 'غينيا الاستوائية', 'غينيا بيساو',
        'فانواتو', 'فرنسا', 'فلسطين', 'فنزويلا', 'فنلندا', 'فيتنام', 'فيجي',
        'قبرص', 'قرغيزستان', 'قطر',
        'كازاخستان', 'كاليدونيا الجديدة', 'كرواتيا', 'كمبوديا', 'كندا', 'كوبا', 'كوريا الجنوبية', 'كوريا الشمالية', 'كوستاريكا', 'كولومبيا', 'كومنولث الدول المستقلة', 'كيريباتي', 'كينيا',
        'لاتفيا', 'لاوس', 'لبنان', 'لوكسمبورج', 'ليبيا', 'ليبيريا', 'ليتوانيا', 'ليختنشتاين', 'ليسوتو',
        'مارتينيك', 'ماكاو الصينية', 'مالطا', 'مالي', 'ماليزيا', 'مايوت', 'مدغشقر', 'مصر', 'مقدونيا', 'ملاوي', 'منغوليا', 'موريتانيا', 'موريشيوس', 'موزمبيق', 'مولدافيا', 'موناكو', 'مونتسرات', 'ميانمار', 'ميكرونيزيا', 'ميلانيزيا',
        'ناميبيا', 'نورو', 'نيبال', 'نيجيريا', 'نيكاراجوا', 'نيوزيلاندا', 'نيوي',
        'هايتي', 'هندوراس', 'هولندا', 'هونج كونج الصينية',
        'وسط آسيا', 'وسط افريقيا',
    );

    protected static $cityFormats = array(
        '{{cityPrefix}} {{cityName}}',
        '{{cityName}}',
    );

    protected static $streetNameFormats = array(
        '{{streetPrefix}} {{firstName}} {{lastName}}',
    );

    protected static $streetAddressFormats = array(
        '{{buildingNumber}} {{streetName}}',
        '{{buildingNumber}} {{streetName}} {{secondaryAddress}}',
    );

    protected static $addressFormats = array(
        "{{streetAddress}}\n{{city}}",
    );

    protected static $secondaryAddressFormats = array('شقة رقم. ##', 'بناية رقم ##');

    /**
     * @example 'شرق'
     */
    public static function cityPrefix()
    {
        return static::randomElement(static::$cityPrefix);
    }

    /**
     * @example 'عمان'
     */
    public static function cityName()
    {
        return static::randomElement(static::$cityName);
    }

    /**
     * @example 'شارع'
     */
    public static function streetPrefix()
    {
        return static::randomElement(static::$streetPrefix);
    }

    /**
     * @example 'شقة رقم. 350'
     */
    public static function secondaryAddress()
    {
        return static::numerify(static::randomElement(static::$secondaryAddressFormats));
    }

    /**
     * @example 'كاليفورنيا'
     */
    public static function state()
    {
        return static::randomElement(static::$state);
    }

    /**
     * @example 'CA'
     */
    public static function stateAbbr()
    {
        return static::randomElement(static::$stateAbbr);
    }
}
                                                                                                                                                                                              