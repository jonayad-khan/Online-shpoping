'ميرال', 'ميران', 'ميرفت', 'ميس', 'ميسا', 'ميساء', 'ميسر', 'ميسره', 'ميسم', 'ميسون', 'ميلاء', 'ميناس', 'نائله', 'ناديا', 'نادية', 'نادين', 'ناديه', 'نانسي', 'نبال', 'نبراس', 'نبيله', 'نجاة', 'نجاح', 'نجلاء', 'نجود', 'نجوى', 'نداء', 'ندى',
        'ندين', 'نرمين', 'نسرين', 'نسيمة', 'نعمت', 'نعمه', 'نهاد', 'نهى', 'نهيدة', 'نوال', 'نور', 'نور الهدى', 'نورا', 'نوران', 'نيروز', 'نيفين', 'هادلين', 'هازار', 'هالة', 'هانيا', 'هايدي', 'هبة', 'هدايه', 'هدى', 'هديل', 'هزار', 'هلا', 'هنا', 'هناء', 'هنادي', 'هند', 'هيا', 'هيفا',
        'هيفاء', 'هيلين', 'وئام', 'وجدان', 'وداد', 'ورود', 'وسام', 'وسن', 'وسيم', 'وعد', 'وفاء', 'ولاء', 'ىمنة', 'يارا', 'ياسمين', 'يسرى',
    );

    protected static $lastName = array(
        'العتيبي', 'الشهري', 'العنزي', 'الخضيري', 'الحسين', 'العسكر', 'باشا', 'مدني', 'العرفج',
        'القحطاني', 'الفدا', 'المشيقح', 'العمرو', 'السالم', 'الشيباني', 'السهلي', 'المطرفي',
        'الأحمري', 'الفيفي', 'العقل', 'الفرحان', 'الحصين', 'الأسمري', 'الماجد', 'الخالدي', 'السيف',
        'الحنتوشي', 'الشهيل', 'الزامل', 'الصامل', 'السماعيل', 'الجريد', 'الحميد', 'المقبل',
        'الراجحي', 'المنيف', 'السويلم', 'السمير', 'الصقير', 'الصقيه', 'سقا', 'مكي', 'جواهرجي',
        'الجهني', 'الفريدي', 'برماوي', 'هوساوي', 'السعيد', 'الداوود', 'السليم', 'السماري',
    );

    protected static $titleMale = array('السيد', 'الأستاذ', 'الدكتور', 'المهندس');
    protected static $titleFemale = array('السيدة', 'الآنسة', 'الدكتورة', 'المهندسة');
    private static $prefix = array('أ.', 'د.', 'أ.د', 'م.');

    /**
     * @example 'أ.'
     */
    public static function prefix()
    {
        return static::randomElement(static::$prefix);
    }

    /**
     * @example 1010101010
     */
    public static function idNumber()
    {
        $partialValue = static::numerify(
            static::randomElement(array(1, 2)) . str_repeat('#', 8)
        );
        return Luhn::generateLuhnNumber($partialValue);
    }

    /**
     * @example 1010101010
     */
    public static function nationalIdNumber()
    {
        $partialValue = static::numerify(1 . str_repeat('#', 8));
        return Luhn::generateLuhnNumber($partialValue);
    }

    /**
     * @example 2010101010
     */
    public static function foreignerIdNumber()
    {
        $partialValue = static::numerify(2 . str_repeat('#', 8));
        return Luhn::generateLuhnNumber($partialValue);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\TextUI;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Runner\PhptTestCase;
use PHPUnit\Util\InvalidArgumentHelper;
use PHPUnit\Util\Printer;
use SebastianBergmann\Environment\Console;
use SebastianBergmann\Timer\Timer;

/**
 * Prints the result of a TextUI TestRunner run.
 */
class ResultPrinter extends Printer implements TestListener
{
    public const EVENT_TEST_START      = 0;
    public const EVENT_TEST_END        = 1;
    public con