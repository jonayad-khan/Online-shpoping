<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Doubler\Generator\Node;

use Prophecy\Exception\Doubler\MethodNotExtendableException;
use Prophecy\Exception\InvalidArgumentException;

/**
 * Class node.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ClassNode
{
    private $parentClass = 'stdClass';
    private $interfaces  = array();
    private $properties  = array();
    private $unextendableMethods = array();

    /**
     * @var MethodNode[]
     */
    private $methods     = array();

    public function getParentClass()
    {
        return $this->parentClass;
    }

    /**
     * @param string $class
     */
    public function setParentClass($class)
    {
        $this->parentClass = $class ?: 'stdClass';
    }

    /**
     * @return string[]
     */
    public function getInterfaces()
    {
        return $this->interfaces;
    }

    /**
     * @param string $interface
     */
    public function addInterface($interface)
    {
        if ($this->hasInterface($interface)) {
            return;
        }

        array_unshift($this->interfaces, $interface);
    }

    /**
     * @param string $interface
     *
     * @return bool
     */
    public function hasInterface($interface)
    {
        return in_array($interface, $this->interfaces);
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function addProperty($name, $visibility = 'public')
    {
        $visibility = strtolower($visibility);

        if (!in_array($visibility, array('public', 'private', 'protected'))) {
            throw new InvalidArgumentException(sprintf(
                '`%s` property visibility is not supported.', $visibility
            ));
        }

        $this->properties[$name] = $visibility;
    }

    /**
     * @return MethodNode[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    public function addMethod(MethodNode $method)
    {
        if (!$this->isExtendable($method->getName())){
            $message = sprintf(
                'Method `%s` is not extendable, so can not be added.', $method->getName()
            );
            throw new MethodNotExtendableException($message, $this->getParentClass(), $method->getName());
        }
        $this->methods[$method->getName()] = $method;
    }

    public function removeMethod($name)
    {
        unset($this->methods[$name]);
    }

    /**
     * @param string $name
     *
     * @return MethodNode|null
     */
    public function getMethod($name)
    {
        return $this->hasMethod($name) ? $this->methods[$name] : null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMethod($name)
    {
        return isset($this->methods[$name]);
    }

    /**
     * @return string[]
     */
    public function getUnextendableMethods()
    {
        return $this->unextendableMethods;
    }

    /**
     * @param string $unextendableMethod
     */
    public function addUnextendableMethod($unextendableMethod)
    {
        if (!$this->isExtendable($unextendableMethod)){
            return;
        }
        $this->unextendableMethods[] = $unextendableMethod;
    }

    /**
     * @param string $method
     * @return bool
     */
    public function isExtendable($method)
    {
        return !in_array($method, $this->unextendableMethods);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

namespace Faker\Provider\sr_Cyrl_RS;

class Address extends \Faker\Provider\Address
{
    protected static $postcode = array('#####');

    protected static $streetPrefix = array(
        'Булевар',
    );

    protected static $street = array(
        'Краља Милана', 'Цара Душана', 'Николе Тесле', 'Михајла Пупина', 'Николе Пашића',
    );

    protected static $streetNameFormats = array(
        '{{street}}',
        '{{streetPrefix}} {{street}}',
    );

    protected static $streetAddressFormats = array(
        '{{streetName}} {{buildingNumber}}',
    );

    protected static $cityFormats = array(
        '{{cityName}}',
    );

    /**
     * @link http://sr.wikipedia.org/wiki/%D0%93%D1%80%D0%B0%D0%B4%D0%BE%D0%B2%D0%B8_%D1%83_%D0%A1%D1%80%D0%B1%D0%B8%D1%98%D0%B8
     */
    protected static $cityNames = array(
        'Београд', 'Ваљево', 'Врање', 'Зајечар', 'Зрењанин', 'Јагодина', 'Крагујевац', 'Краљево', 'Крушевац', 'Лесковац', 'Лозница', 'Ниш', 'Нови Пазар', 'Нови Сад', 'Панчево', 'Пожаревац', 'Приштина', 'Смедерево', 'Сомбор', 'Сремска Митровица', 'Суботица', 'Ужице', 'Чачак', 'Шабац',
    );

    /**
     * @link https://github.com/umpirsky/country-list/blob/master/country/cldr/sr_Cyrl/country.php
     */
    protected static $country = array(
        'Острво Асенсион', 'Андора', 'Уједињени Арапски Емирати', 'Авганистан', 'Антигве и Барбуда', 'Ангвила', 'Албанија', 'Арменија', 'Холандски Антили', 'Ангола', 'Антарктик', 'Аргентина', 'Америчка Самоа', 'Аустрија', 'Аустралија', 'Аруба', 'Аландска острва', 'Азербејџан', 'Босна и Херцеговина', 'Барбадос', 'Бангладеш', 'Белгија', 'Буркина Фасо', 'Бугарска', 'Бахреин', 'Бурунди', 'Бенин', 'Свети Бартоломеј', 'Бермуда', 'Брунеј', 'Боливија', 'Бразил', 'Бахами', 'Бутан', 'Буве Острва', 'Боцвана', 'Белорусија', 'Белизе', 'Канада', 'Кокос (Келинг) Острва', 'Конго - Киншаса', 'Централно Афричка Република', 'Конго - Бразавил', 'Швајцарска', 'Обала Слоноваче', 'Кукова Острва', 'Чиле', 'Камерун', 'Кина', 'Колумбија', 'Острво Клипертон', 'Костарика', 'Србија и Црна Гора', 'Куба', 'Капе Верде', 'Божићна острва', 'Кипар', 'Чешка', 'Немачка', 'Дијего Гарсија', 'Џибути', 'Данска', 'Доминика', 'Доминиканска Република', 'Алжир', 'Сеута и Мелиља', 'Еквадор', 'Естонија', 'Египат', 'Западна Сахара', 'Еритреја', 'Шпанија', 'Етиопија', 'Европска Унија', 'Финска', 'Фиџи', 'Фолкландска Острва', 'Микронезија', 'Фарска Острва', 'Француска', 'Габон', 'Велика Британија', 'Гренада', 'Грузија', 'Француска Гвајана', 'Гурнси', 'Гана', 'Гибралтар', 'Гренланд', 'Гамбија', 'Гвинеја', 'Гваделупе', 'Екваторијална Гвинеја', 'Грчка', 'Јужна Џорџија и Јужна Сендвич Острва', 'Гватемала', 'Гуам', 'Гвинеја-Бисао', 'Гвајана', 'Хонг Конг С. А. Р. Кина', 'Херд и Мекдоналд Острва', 'Хондурас', 'Хрватска', 'Хаити', 'Мађарска', 'Канарска острва', 'Индонезија', 'Ирска', 'Израел', 'Острво Ман', 'Индија', 'Британска територија у Индијском океану', 'Ирак', 'Иран', 'Исланд', 'Италија', 'Џерси', 'Јамајка', 'Јордан', 'Јапан', 'Кенија', 'Киргизстан', 'Камбоџа', 'Кирибати', 'Коморска Острва', 'Сент Китс и Невис', 'Северна Кореја', 'Јужна Кореја', 'Кувајт', 'Кајманска Острва', 'Казахстан', 'Лаос', 'Либан', 'Сент Луција', 'Лихтенштајн', 'Шри Ланка', 'Либерија', 'Лесото', 'Литванија', 'Луксембург', 'Летонија', 'Либија', 'Мароко', 'Монако', 'Молдавија', 'Црна Гора', 'Сент Мартин', 'Мадагаскар', 'Маршалска Острва', 'Македонија', 'Мали', 'Мијанмар [Бурма]', 'Монголија', 'Макао С. А. Р. Кина', 'Северна Маријанска Острва', 'Мартиник', 'Мауританија', 'Монсерат', 'Малта', 'Маурицијус', 'Малдиви', 'Малави', 'Мексико', 'Малезија', 'Мозамбик', 'Намибија', 'Нова Каледонија', 'Нигер', 'Норфолк Острво', 'Нигерија', 'Никарагва', 'Холандија', 'Норвешка', 'Непал', 'Науру', 'Ниуе', 'Нови Зеланд', 'Оман', 'Панама', 'Перу', 'Француска Полинезија', 'Папуа Нова Гвинеја', 'Филипини', 'Пакистан', 'Пољска', 'Сен Пјер и Микелон', 'Питкерн', 'Порто Рико', 'Палестинске територије', 'Португал', 'Палау', 'Парагвај', 'Катар', 'Остала океанија', 'Реинион', 'Румунија', 'Србија', 'Русија', 'Руанда', 'Саудијска Арабија', 'Соломонска Острва', 'Сејшели', 'Судан', 'Шведска', 'Сингапур', 'Света Јелена', 'Словенија', 'Свалбард и Јанмајен Острва', 'Словачка', 'Сијера Леоне', 'Сан Марино', 'Сенегал', 'Сомалија', 'Суринам', 'Сао Томе и Принципе', 'Салвадор', 'Сирија', 'Свазиленд', 'Тристан да Куња', 'Туркс и Кајкос Острва', 'Чад', 'Француске Јужне Територије', 'Того', 'Тајланд', 'Таџикистан', 'Токелау', 'Источни Тимор', 'Туркменистан', 'Тунис', 'Тонга', 'Турска', 'Тринидад и Тобаго', 'Тувалу', 'Тајван', 'Танзанија', 'Украјина', 'Уганда', 'Мања удаљена острва САД', 'Сједињене Америчке Државе', 'Уругвај', 'Узбекистан', 'Ватикан', 'Сент Винсент и Гренадини', 'Венецуела', 'Британска Девичанска Острва', 'С.А.Д. Девичанска Острва', 'Вијетнам', 'Вануату', 'Валис и Футуна Острва', 'Самоа', 'Јемен', 'Мајоте', 'Јужноафричка Република', 'Замбија', 'Зимбабве',
    );

    public static function streetPrefix()
    {
        return static::randomElement(static::$streetPrefix);
    }

    public static function street()
    {
        return static::randomElement(static::$street);
    }

    public function cityName()
    {
        return static::randomElement(static::$cityNames);
    }
}
                                                                                                                                                                                                                                                                             <?xml version="1.0" encoding="UTF-8"?>
<project default="build">
    <!-- Set executables according to OS -->
    <condition property="phpunit" value="${basedir}/vendor/bin/phpunit.bat" else="${basedir}/vendor/bin/phpunit">
        <os family="windows" />
    </condition>

    <condition property="phpcs" value="${basedir}/vendor/bin/phpcs.bat" else="${basedir}/vendor/bin/phpcs">
        <os family="windows" />
    </condition>

    <condition property="parallel-lint" value="${basedir}/vendor/bin/parallel-lint.bat" else="${basedir}/vendor/bin/parallel-lint">
        <os family="windows" />
    </condition>

    <condition property="var-dump-check" value="${basedir}/vendor/bin/var-dump-check.bat" else="${basedir}/vendor/bin/var-dump-check">
        <os family="windows"/>
    </condition>

    <!-- Use colors in output can be disabled when calling ant with -Duse-colors=false -->
    <property name="use-colors" value="true" />

    <condition property="colors-arg.color" value="--colors" else="">
        <equals arg1="${use-colors}" arg2="true" />
    </condition>

    <condition property="colors-arg.no-colors" value="" else="--no-colors">
        <equals arg1="${use-colors}" arg2="true" />
    </condition>

    <!-- Targets -->
    <target name="prepare" description="Create build directory">
        <mkdir dir="${basedir}/build/logs" />
    </target>

    <target name="phplint" description="Check syntax errors in PHP files">
        <exec executable="${parallel-lint}" failonerror="true">
            <arg line='--exclude ${basedir}/vendor/' />
            <arg line='${colors-arg.no-colors}' />
            <arg line='${basedir}' />
        </exec>
    </target>

    <target name="var-dump-check" description="Check PHP files for forgotten variable dumps">
        <exec executable="${var-dump-check}" failonerror="true">
            <arg line='--exclude ${basedir}/vendor/' />
            <arg line='${colors-arg.no-colors}' />
            <arg line='${basedir}' />
        </exec>
    </target>

    <target name="phpcs" depends="prepare" description="Check PHP code style">
        <delete file="${basedir}/build/logs/checkstyle.xml" quiet="true" />

        <exec executable="${phpcs}">
            <arg line='--extensions=php' />
            <arg line='--standard="${basedir}/vendor/jakub-onderka/php-code-style/ruleset.xml"' />
            <arg line='--report-checkstyle="${basedir}/build/logs/checkstyle.xml"' />
            <arg line='--report-full' />
            <arg line='"${basedir}/src"' />
        </exec>
    </target>

    <target name="phpunit" depends="prepare" description="PHP unit">
        <delete file="${basedir}/build/logs/phpunit.xml" quiet="true" />

        <exec executable="${phpunit}">
            <arg line='--configuration ${basedir}/phpunit.xml' />
            <arg line='-d memory_limit=256M' />
            <arg line='--log-junit "${basedir}/build/logs/phpunit.xml"' />
            <arg line='${colors-arg.color}' />
        </exec>
    </target>

    <target name="phpunit-coverage" depends="prepare" description="PHP unit with code coverage">
        <delete file="${basedir}/build/logs/phpunit.xml" quiet="true" />
        <delete file="${basedir}/build/logs/clover.xml" quiet="true" />
        <delete dir="${basedir}/build/coverage" quiet="true" />
        <mkdir dir="${basedir}/build/coverage" />

        <exec executable="${phpunit}">
            <arg line='--configuration ${basedir}/phpunit.xml' />
            <arg line='-d memory_limit=256M' />
            <arg line='--log-junit "${basedir}/build/logs/phpunit.xml"' />
            <arg line='--coverage-clover "${basedir}/build/logs/clover.xml"' />
            <arg line='--cov