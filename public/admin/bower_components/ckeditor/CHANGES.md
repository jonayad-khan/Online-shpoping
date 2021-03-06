<?php

namespace Faker\ORM\Propel;

use \PropelColumnTypes;
use \ColumnMap;

class ColumnTypeGuesser
{
    protected $generator;

    /**
     * @param \Faker\Generator $generator
     */
    public function __construct(\Faker\Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param ColumnMap $column
     * @return \Closure|null
     */
    public function guessFormat(ColumnMap $column)
    {
        $generator = $this->generator;
        if ($column->isTemporal()) {
            if ($column->isEpochTemporal()) {
                return function () use ($generator) {
                    return $generator->dateTime;
                };
            } else {
                return function () use ($generator) {
                    return $generator->dateTimeAD;
                };
            }
        }
        $type = $column->getType();
        switch ($type) {
            case PropelColumnTypes::BOOLEAN:
            case PropelColumnTypes::BOOLEAN_EMU:
                return function () use ($generator) {
                    return $generator->boolean;
                };
            case PropelColumnTypes::NUMERIC:
            case PropelColumnTypes::DECIMAL:
                $size = $column->getSize();

                return function () use ($generator, $size) {
                    return $generator->randomNumber($size + 2) / 100;
                };
            case PropelColumnTypes::TINYINT:
                return function () {
                    return mt_rand(0, 127);
                };
            case PropelColumnTypes::SMALLINT:
                return function () {
                    return mt_rand(0, 32767);
                };
            case PropelColumnTypes::INTEGER:
                return function () {
                    return mt_rand(0, intval('2147483647'));
                };
            case PropelColumnTypes::BIGINT:
                return function () {
                    return mt_rand(0, intval('9223372036854775807'));
                };
            case PropelColumnTypes::FLOAT:
                return function () {
                    return mt_rand(0, intval('2147483647'))/mt_rand(1, intval('2147483647'));
                };
            case PropelColumnTypes::DOUBLE:
            case PropelColumnTypes::REAL:
                return function () {
                    return mt_rand(0, intval('9223372036854775807'))/mt_rand(1, intval('9223372036854775807'));
                };
            case PropelColumnTypes::CHAR:
            case PropelColumnTypes::VARCHAR:
            case PropelColumnTypes::BINARY:
            case PropelColumnTypes::VARBINARY:
                $size = $column->getSize();

                return function () use ($generator, $size) {
                    return $generator->text($size);
                };
            case PropelColumnTypes::LONGVARCHAR:
            case PropelColumnTypes::LONGVARBINARY:
            case PropelColumnTypes::CLOB:
            case PropelColumnTypes::CLOB_EMU:
            case PropelColumnTypes::BLOB:
                return function () use ($generator) {
                    return $generator->text;
                };
            case PropelColumnTypes::ENUM:
                $valueSet = $column->getValueSet();

                return function () use ($generator, $valueSet) {
                    return $generator->randomElement($valueSet);
                };
            case PropelColumnTypes::OBJECT:
            case PropelColumnTypes::PHP_ARRAY:
            default:
            // no smart way to guess what the user expects here
                return null;
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Faker\Provider\pl_PL;

/**
 * Most popular first and last names published by Ministry of the Interior:
 * @link https://msw.gov.pl/pl/sprawy-obywatelskie/ewidencja-ludnosci-dowo/statystyki-imion-i-nazw
 */
class Person extends \Faker\Provider\Person
{
    protected static $lastNameFormat = array(
        '{{lastNameMale}}',
        '{{lastNameFemale}}',
    );

    protected static $maleNameFormats = array(
        '{{firstNameMale}} {{lastNameMale}}',
        '{{firstNameMale}} {{lastNameMale}}',
        '{{firstNameMale}} {{lastNameMale}}',
        '{{title}} {{firstNameMale}} {{lastNameMale}}',
        '{{firstNameMale}} {{lastNameMale}}',
        '{{title}} {{title}} {{firstNameMale}} {{lastNameMale}}',
    );

    protected static $femaleNameFormats = array(
        '{{firstNameFemale}} {{lastNameFemale}}',
        '{{firstNameFemale}} {{lastNameFemale}}',
        '{{firstNameFemale}} {{lastNameFemale}}',
        '{{title}} {{firstNameFemale}} {{lastNameFemale}}',
        '{{firstNameFemale}} {{lastNameFemale}}',
        '{{title}} {{title}} {{firstNameFemale}} {{lastNameFemale}}',
    );

    protected static $firstNameMale = array(
        'Adam', 'Adrian', 'Alan', 'Albert', 'Aleks', 'Aleksander', 'Alex', 'Andrzej', 'Antoni', 'Arkadiusz', 'Artur',
        'Bartek', 'Błażej', 'Borys', 'Bruno', 'Cezary', 'Cyprian', 'Damian', 'Daniel', 'Dariusz', 'Dawid', 'Dominik',
        'Emil', 'Ernest', 'Eryk', 'Fabian', 'Filip', 'Franciszek', 'Fryderyk', 'Gabriel', 'Grzegorz', 'Gustaw', 'Hubert',
        'Ignacy', 'Igor', 'Iwo', 'Jacek', 'Jakub', 'Jan', 'Jeremi', 'Jerzy', 'Jędrzej', 'Józef', 'Julian', 'Juliusz',
        'Kacper', 'Kajetan', 'Kamil', 'Karol', 'Kazimierz', 'Konrad', 'Konstanty', 'Kornel', 'Krystian', 'Krzysztof', 'Ksawery',
        'Leon', 'Leonard', 'Łukasz', 'Maciej', 'Maks', 'Maksymilian', 'Marcel', 'Marcin', 'Marek', 'Mariusz', 'Mateusz', 'Maurycy',
        'Michał', 'Mieszko', 'Mikołaj', 'Miłosz', 'Natan', 'Nataniel', 'Nikodem', 'Norbert', 'Olaf', 'Olgierd', 'Oliwier', 'Oskar',
        'Patryk', 'Paweł', 'Piotr', 'Przemysław', 'Radosław', 'Rafał', 'Robert', 'Ryszard', 'Sebastian', 'Stanisław', 'Stefan', 'Szymon',
        'Tadeusz', 'Tomasz', 'Tymon', 'Tymoteusz', 'Wiktor', 'Witold', 'Wojciech',
    );

    protected static $firstNameFemale = array(
        'Ada', 'Adrianna', 'Agata', 'Agnieszka', 'Aleksandra', 'Alicja', 'Amelia', 'Anastazja', 'Angelika', 'Aniela', 'Anita',
        'Anna', 'Anna', 'Antonina', 'Apolonia', 'Aurelia', 'Barbara', 'Bianka', 'Blanka', 'Dagmara', 'Daria', 'Dominika', 'Dorota',
        'Eliza', 'Elżbieta', 'Emilia', 'Ewa', 'Ewelina', 'Gabriela', 'Hanna', 'Helena', 'Ida', 'Iga', 'Inga', 'Izabela',
        'Jagoda', 'Janina', 'Joanna', 'Julia', 'Julianna', 'Julita', 'Justyna', 'Kaja', 'Kalina', 'Kamila', 'Karina', 'Karolina',
        'Katarzyna', 'Kinga', 'Klara', 'Klaudia', 'Kornelia', 'Krystyna', 'Laura', 'Lena', 'Lidia', 'Liliana', 'Liwia', 'Łucja',
        'Magdalena', 'Maja', 'Malwina', 'Małgorzata', 'Marcelina', 'Maria', 'Marianna', 'Marika', 'Marta', 'Martyna', 'Matylda',
        'Melania', 'Michalina', 'Milena', 'Monika', 'Nadia', 'Natalia', 'Natasza', 'Nela', 'Nicole', 'Nikola', 'Nina',
        'Olga', 'Oliwia', 'Patrycja', 'Paulina', 'Pola', 'Roksana', 'Rozalia', 'Róża', 'Sandra', 'Sara', 'Sonia', 'Sylwia',
        'Tola', 'Urszula', 'Weronika', 'Wiktoria', 'Zofia', 'Zuzanna',
    );

    protected static $lastNameMale = array(
        'Adamczyk', 'Adamski', 'Andrzejewski', 'Baran', 'Baranowski', 'Bąk', 'Błaszczyk', 'Borkowski', 'Borowski', 'Brzeziński',
        'Chmielewski', 'Cieślak', 'Czarnecki', 'Czerwiński', 'Dąbrowski', 'Duda', 'Dudek', 'Gajewski', 'Głowacki', 'Górski', 'Grabowski',
        'Jabłoński', 'Jakubowski', 'Jankowski', 'Jasiński', 'Jaworski', 'Kaczmarczyk', 'Kaczmarek', 'Kalinowski', 'Kamiński', 'Kaźmierczak',
        'Kołodziej', 'Konieczny', 'Kowalczyk', 'Kowalski', 'Kozłowski', 'Krajewski', 'Krawczyk', 'Król', 'Krupa', 'Kubiak', 'Kucharski', 'Kwiatkowski',
        'Laskowski', 'Lewandowski', 'Lis', 'Maciejewski', 'Majewski', 'Makowski', 'Malinowski', 'Marciniak', 'Mazur', 'Mazurek', 'Michalak',
        'Michalski', 'Mróz', 'Nowak', 'Nowakowski', 'Nowicki', 'Olszewski', 'Ostrowski', 'Pawlak', 'Pawłowski', 'Pietrzak', 'Piotrowski', 'Przybylski',
        'Rutkowski', 'Sadowski', 'Sawicki', 'Sikora', 'Sikorski', 'Sobczak', 'Sokołowski', 'Stępień', 'Szczepański', 'Szewczyk', 'Szulc', 'Szymański', 'Szymczak',
        'Tomaszewski', 'Urbański', 'Walczak', 'Wasilewski', 'Wieczorek', 'Wilk', 'Wiśniewski', 'Witkowski', 'Włodarczyk', 'Wojciechowski',
        'Woźniak', 'Wójcik', 'Wróbel', 'Wróblewski', 'Wysocki', 'Zając', 'Zakrzewski', 'Zalewski', 'Zawadzki', 'Zieliński', 'Ziółkowski',
    );

    protected static $lastNameFemale = array(
        'Adamczyk', 'Adamska', 'Andrzejewska', 'Baran', 'Baranowska', 'Bąk', 'Błaszczyk', 'Borkowska', 'Borowska', 'Brzezińska',
        'Chmielewska', 'Cieślak', 'Czarnecka', 'Czerwińska', 'Dąbrowska', 'Duda', 'Dudek', 'Gajewska', 'Głowacka', 'Górecka', 'Górska', 'Grabowska',
        'Jabłońska', 'Jakubowska', 'Jankowska', 'Jasińska', 'Jaworska', 'Kaczmarczyk', 'Kaczmarek', 'Kalinowska', 'Kamińska', 'Kaźmierczak',
        'Kołodziej', 'Kowalczyk', 'Kowalska', 'Kozłowska', 'Krajewska', 'Krawczyk', 'Król', 'Krupa', 'Kubiak', 'Kucharska', 'Kwiatkowska',
        'Laskowska', 'Lewandowska', 'Lis', 'Maciejewska', 'Majewska', 'Makowska', 'Malinowska', 'Marciniak', 'Mazur', 'Mazurek', 'Michalak',
        'Michalska', 'Mróz', 'Nowak', 'Nowakowska', 'Nowicka', 'Olszewska', 'Ostrowska', 'Pawlak', 'Pawłowska', 'Pietrzak', 'Piotrowska', 'Przybylska',
        'Rutkowska', 'Sadowska', 'Sawicka', 'Sikora', 'Sikorska', 'Sobczak', 'Sokołowska', 'Stępień', 'Szczepańska', 'Szewczyk', 'Szulc', 'Szymańska', 'Szymczak',
        'Tomaszewska', 'Urbańska', 'Walczak', 'Wasilewska', 'Wieczorek', 'Wilk', 'Wiśniewska', 'Witkowska', 'Włodarczyk', 'Wojciechowska',
        'Woźniak', 'Wójcik', 'Wróbel', 'Wróblewska', 'Wysocka', 'Zając', 'Zakrzewska', 'Zalewska', 'Zawadzka', 'Zielińska', 'Ziółkowska',
    );

    /**
     *
     * Unisex academic degree
     *
     * @var string
     */
    protected static $title = array('mgr','inż.', 'dr', 'doc.');

    /**
     * @param string|null $gender 'male', 'female' or null for any
     * @example 'Adamczyk'
     */
    public function lastName($gender = null)
    {
        if ($gender === static::GENDER_MALE) {
            return static::lastNameMale();
        } elseif ($gender === static::GENDER_FEMALE) {
            return static::lastNameFemale();
        }

        return $this->generator->parse(static::randomElement(static::$lastNameFormat));
    }

    public static function lastNameMale()
    {
        return static::randomElement(static::$lastNameMale);
    }

    public static function lastNameFemale()
    {
        return static::randomElement(static::$lastNameFemale);
    }

    public function title($gender = null)
    {
        return static::randomElement(static::$title);
    }

    /**
     * replaced by specific unisex Polish title
     */
    public static function titleMale()
    {
        return static::title();
    }

    /**
     * replaced by specific unisex Polish title
     */
    public static function titleFemale()
    {
        return static::title();
    }

    /**
     * PESEL - Universal Electronic System for Registration of the Population
     * @link http://en.wikipedia.org/wiki/PESEL
     * @param  DateTime $birthdate
     * @param  string   $sex       M for male or F for female
     * @return string   11 digit number, like 44051401358
     */
    public static function pesel($birthdate = null, $sex = null)
    {
        if ($birthdate === null) {
            $birthdate = \Faker\Provider\DateTime::dateTimeThisCentury();
        }

        $weights = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
        $length = count($weights);

        $fullYear = (int) $birthdate->format('Y');
        $year = (int) $birthdate->format('y');
        $month = $birthdate->format('m') + (((int) ($fullYear/100) - 14) % 5) * 20;
        $day = $birthdate->format('d');

        $result = array((int) ($year / 10), $year % 10, (int) ($month / 10), $month % 10, (int) ($day / 10), $day % 10);

        for ($i = 6; $i < $length; $i++) {
            $result[$i] = static::randomDigit();
        }
        if ($sex == "M") {
            $result[$length - 1] |= 1;
        } elseif ($sex == "F") {
            $result[$length - 1] ^= 1;
        }
        $checksum = 0;
        for ($i = 0; $i < $length; $i++) {
            $checksum += $weights[$i] * $result[$i];
        }
        $checksum = (10 - ($checksum % 10)) % 10;
        $result[] = $checksum;

        return implode('', $result);
    }

    /**
     * National Identity Card number
     * @link http://en.wikipedia.org/wiki/Polish_National_Identity_Card
     * @return string 3 letters and 6 digits, like ABA300000
     */
    public static function personalIdentityNumber()
    {
        $range = str_split("ABCDEFGHIJKLMNPRSTUVWXYZ");
        $low = array("A", static::randomElement($range), static::randomElement($range));
        $high = array(static::randomDigit(), static::randomDigit(), static::randomDigit(), static::randomDigit(), static::randomDigit());
        $weights = array(7, 3, 1, 7, 3, 1, 7, 3);
        $checksum = 0;
        for ($i = 0, $size = count($low); $i < $size; $i++) {
            $checksum += $weights[$i] * (ord($low[$i]) - 55);
        }
        for ($i = 0, $size = count($high); $i < $size; $i++) {
            $checksum += $weights[$i+3] * $high[$i];
        }
        $checksum %= 10;

        return implode('', $low).$checksum.implode('', $high);
    }

    /**
     * Taxpayer Identification Number (NIP in Polish)
     * @link http://en.wikipedia.org/wiki/PESEL#Other_identifiers
     * @link http://pl.wikipedia.org/wiki/NIP
     * @return string 10 digit number
     */
    public static function taxpayerIdentificationNumber()
    {
        $weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
        $result = array();
        do {
            $result = array(
                static::randomDigitNotNull(), static::randomDigitNotNull(), static::randomDigitNotNull(),
                static::randomDigit(), static::randomDigit(), static::randomDigit(),
                static::randomDigit(), static::randomDigit(), static::randomDigit(),
            );
            $checksum = 0;
            for ($i = 0, $size = count($result); $i < $size; $i++) {
                $checksum += $weights[$i] * $result[$i];
            }
            $checksum %= 11;
        } while ($checksum == 10);
        $result[] = $checksum;

        return implode('', $result);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php
namespace Hamcrest\Core;

class EveryTest extends \Hamcrest\AbstractMatcherTest
{

    protected function createMatcher()
    {
        return \Hamcrest\Core\Every::everyItem(anything());
    }

    public function testIsTrueWhenEveryValueMatches()
    {
        assertThat(array('AaA', 'BaB', 'CaC'), everyItem(containsString('a')));
        assertThat(array('AbA', 'BbB', 'CbC'), not(everyItem(containsString('a'))));
    }

    public function testIsAlwaysTrueForEmptyLists()
    {
        assertThat(array(), everyItem(containsString('a')));
    }

    public function testDescribesItself()
    {
        $each = everyItem(containsString('a'));
        $this->assertEquals('every item is a string containing "a"', (string) $each);

        $this->assertMismatchDescription('an item was "BbB"', $each, array('BbB'));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

namespace Illuminate\Database\Migrations;

use Illuminate\Database\ConnectionResolverInterface as Resolver;

class DatabaseMigrationRepository implements MigrationRepositoryInterface
{
    /**
     * The database connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface
     */
    protected $resolver;

    /**
     * The name of the migration table.
     *
     * @var string
     */
    protected $table;

    /**
     * The name of the database connection to use.
     *
     * @var string
     */
    protected $connection;

    /**
     * Create a new database migration repository instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
     * @param  string  $table
     * @return void
     */
    public function __construct(Resolver $resolver, $table)
    {
        $this->table = $table;
        $this->resolver = $resolver;
    }

    /**
     * Get the ran migrations.
     *
     * @return array
     */
    public function getRan()
    {
        return $this->table()
                ->orderBy('batch', 'asc')
                ->orderBy('migration', 'asc')
                ->pluck('migration')->all();
    }

    /**
     * Get list of migrations.
     *
     * @param  int  $steps
     * @return array
     */
    public function getMigrations($steps)
    {
        $query = $this->table()->where('batch', '>=', '1');

        return $query->orderBy('batch', 'desc')
                     ->orderBy('migration', 'desc')
                     ->take($steps)->get()->all();
    }

    /**
     * Get the last migration batch.
     *
     * @return array
     */
    public function getLast()
    {
        $query = $this->table()->where('batch', $this->getLastBatchNumber());

        return $query->orderBy('migration', 'desc')->get()->all();
    }

    /**
     * Log that a migration was run.
     *
     * @param  string  $file
     * @param  int     $batch
     * @return void
     */
    public function log($file, $batch)
    {
        $record = ['migration' => $file, 'batch' => $batch];

        $this->table()->insert($record);
    }

    /**
     * Remove a migration from the log.
     *
     * @param  object  $migration
     * @return void
     */
    public function delete($migration)
    {
        $this->table()->where('migration', $migration->migration)->delete();
    }

    /**
     * Get the next migration batch number.
     *
     * @return int
     */
    public function getNextBatchNumber()
    {
        return $this->getLastBatchNumber() + 1;
    }

    /**
     * Get the last migration batch number.
     *
     * @return int
     */
    public function getLastBatchNumber()
    {
        return $this->table()->max('batch');
    }

    /**
     * Create the migration repository data store.
     *
     * @return void
     */
    public function createRepository()
    {
        $schema = $this->getConnection()->getSchemaBuilder();

        $schema->create($this->table, function ($table) {
            // The migrations table is responsible for keeping track of which of the
            // migrations have actually run for the application. We'll create the
            // table to hold the migration file's path as well as the batch ID.
            $table->increments('id');
            $table->string('migration');
            $table->integer('batch');
        });
    }

    /**
     * Determine if the migration repository exists.
     *
     * @return bool
     */
    public function repositoryExists()
    {
        $schema = $this->getConnection()->getSchemaBuilder();

        return $schema->hasTable($this->table);
    }

    /**
     * Get a query builder for the migration table.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function table()
    {
        return $this->getConnection()->table($this->table)->useWritePdo();
    }

    /**
     * Get the connection resolver instance.
     *
     * @return \Illuminate\Database\ConnectionResolverInterface
     */
    public function getConnectionResolver()
    {
        return $this->resolver;
    }

    /**
     * Resolve the database connection instance.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return $this->resolver->connection($this->connection);
    }

    /**
     * Set the information source to gather data.
     *
     * @param  string  $name
     * @return void
     */
    public function setSource($name)
    {
        $this->connection = $name;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010-2014 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */
namespace Mockery;

interface ExpectationInterface
{
    /**
     * @return int
     */
    public function getOrderNumber();

    /**
     * @return MockInterface
     */
    public function getMock();

    /**
     * @return self
     */
    public function andReturn();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             �PNG

   IHDR  {  h   ���   sRGB ���   gAMA  ���a   	pHYs  �  ��o�d  /�IDATx^��ۏmYY7�V� �	jh҉�	7�+��!rabl A��nL���n�J@0!^4�!��!�4ghQ0
&Ч�{Ms>����_�c9k�QU��֚c̱�'y���fUW�Z��o�9f]w   �p�=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��ǐ���g� �P������=�Tk0�}�j� վ���ǐJS��O~�:(M�9��*s@;�C*M��?���4y �d���{I����q�ҥU}��|����2�U�v�=�T�ʏ~�#�A��#�}Z �怾�Ў�ǐ4��J�`N怾�Ў�ǐJS���:(M�9��*s@;�C���*M�9��*s@;�C���*M�9��*s@;�C*M�?���4y �d���{I��4y �d���{�4����������9��2�#�1$M������9��2�#�1$M������9��2�#�1��T����J�`N怾�Ў�ǐ4��J�`N怾�Ў�ǐJS��w��:(M�9��*s@;�C���*M�9��*s@;�C���*M�9��*s@;�C*M�;����4y �d���{I��4y �d���{�4�o�۪�����9��2�#�1$M������9��2�#�1��7�׼�5�]w�a=�O<���?]�n)��0�^�m��������o\}�i����~N�2�#�1��T���o-�>���_Ӹ���7W�]Ji� ̩�9`�����:��j_c�2�#�1����������F}�7|�K_�n�����S�s������G��:�U��ghG�cH��|��\T}��_?x�K^rؘ������U��뮻�������Sos����<������������7]��w�qd��?�^�z�vs�9�a�!���7��}�s��2^���}�ݫF�򗿼�9K(M�9�6lk�����m�yY��o��o��R��GVۦj�p�2�#�1��T��o,��M<My�sHS��{���{i� ̩�9`���}�k�����Զ���_B�W���v�.s@;�C��oR_��WW�f�����ci� ̩�9`[�����ë�G.�|衇������{��&�iM�����h`ˣr)M�9�4lk�>{���|�.�Ў�ǐJSɂ����߾j����z��?|��>��#������SOs@����>����;a�ʕ+��v]�v�=��S�ߤNk���m��v�cK(M�9�2�޿�2?���Ri*�&~	5=����?��o�����|���^�< s�eh�������%�����=���(s@;�C��oRY����xՌ���7^�M��/G[7��&��z�Z����ߵ�9g���RM~Ӛy�%���'�۽�կ�i��4y ����j���N��U�v�=�T��#�<�}��?��&����vi�����O|��]���0�����|ы^��z�w����m�,s@;�C��oR�M9�xԶK}��_>r��I��V�< sj=�ؿ��R�v�=�T�J.e�>��i�g�'?��<�@���V�< sj=̽ϥ�7�tӑ��w���m�2�#�1��M~�zի^u�1��zj�'�&��Z�s����?���O}��s˥��m[�9�a�!�n�T�(�Y��[o�~��J�`N-�9���g{���Ў�ǐJS�����w�}�9�������o}���������n�Si� ̩�0��}�}��o>�r�Ju��ehG�cH-���5���e/{Yu�Z}���=r������v=�&��Z�s��׃�Y�?-�Ў�ǐJS�+��>��i��|�;���*���r�-��͑�˗/W���4y ��j�c�^z���V�v�=�Ԫ�oZ�F�K<���v��z�?�ΤEi� ̩���������#_B�K���R�&�I��;O�^?r�{����S�9`���%^�S�Ў�ǐJS�*����?��H#�����v'�իW�4�=���{���P�< sj1�z��~Vﬕ��|�����9G���R�&�i�y睫�{�����ϳS��4y ��b������|�������$�1��Tr�CO��-���g���ٟU�ֿۤ����ÿ�S۶ui� �i�9`�������?�����S	{��Ǫ��]�9�a�!����ɥ�0's@_ehG�cH����wվ4y �d���{I��4y �d���{I��4y �d���{�4��zHuP�< s2�U�v�=����U�< s2�U�v�=�T�ʕ+WT��0's@_ehG�cH�|_��0's@_ehG�cH�|_��0's@_ehG�cH��\�|YuP�< s2�U�v�=����U�< s2�U�v�=�T�ʃ>�:(M�9��*s@;�C���*M�9��*s@;�C���*M�9��*s@;�C*M�P�&���}�9�a�!i�}�&���}�9�a�!��r����J�`N怾�Ў�ǐ4��J�`N怾�Ў�ǐ4��J�`N怾�Ў�ǐJS���T��0's@_ehG�cH�|_��0's@_ehG�cH���{ｪ�����9��2�#�1$M������9��2�#�1��T���/�J�`N怾�Ў�ǐ4��J�`N怾�Ў�ǐJS��n�馃o�����*�c����v]�< s��vUO{��n�ᆃ믿��	OxBu�����?��{l����'�1�Z��u��^w�uOy�S����{����]�&�j��mTBS��Ozғ����S�+��>w�J�����<����0?a����׾��&�������U������6=��_����y�-�T��� `.g��������o?�_>��8��_���>tZy�s������}�{�[�zsTf��$��˿|�����/��/�~���	{�]��4��H�vm����� �r�� �����PTK���]�`a���Y�>j/!��~��?�S���'�7.]�����;VM�w�w���X��;�s�=?���=�j��4y �4���_��������~m�/_�����:ܿ���/m����m��v��g?>�~��y>^����0a��GY��{�_��{���}������?�����|�_8x�;�q��W���e�p4�|,��-oy��=����g��}�{���Wf�RYC��-�u��C�Q�a��%��~ �ʁ؄�׽�u����J@ʁ�l�`��>0�SBj������� '��J��ѵ�X�*;�r�0G`)��J�[?�U*��ǳ]�`�7<�M؃3J�-�w���e�y�#�e�K,�|ʾk�첯NhZ��|���jg"s�M>��˴%��d�Qp�Ũ? ˔��	9��,9�U>�m��Z���j?���6	{���DJ#���dg��-���D��$�$�eߺ�:��o�r��[sM-�����@�cۄ=�@tY��<������5 ,S���*'����6��z�Md~H��]vZ��-�$��)҄�Q��;rS��VvH�Y༲O)7PI�9m�]�K\�٭�^l��T�c.�����J�އ�<=��� l��@�uvٯ��d�3������g*K��ǡaN�]��(;�Md�TvT�q�T��e��I�.˾t���N"��#;�Ҹ���Ɏ���vX �k}�]�7�W.[a��q��d�ϸ��'��Ӂa�A؃��J�Nk_��M�}���n=Ԕ�����F]�0x��%�`M�vٹ%��ryNvj����UYg��T�:���<@~��;Y�=d���	x,��	3%��_��'e ���eJ@IXˁ̲��U>�m�)Ԕ�W���}���!�1	{0�ow�ܔ�� ˒`�`��q���K��*�ɾ���W~'K'����O;Y�d��`v� �!'�7P)��+�/��F���&�O �]������`/#���Ks/�>oS��W~O��	0���TN[gWn���g��x	����{�3V�)r2g@�Sn���:�r����^-���X�/�=�Zv��r�46S���h(�vd���v�:�����m��IJ�+��R�L�co%��#~�q������4	 g��*>�:�i8�V�S��p���'����Z���-�Yf�	{�rv*;;ϳsV`3��L�٭�Ry�uv'+/����_	x.c��#챗Nʎ�N����-;ټ�?T�m���r�6�ؾ�=��;JnWv����r`ߔuv9�X���t��`r����j�Ӽ/��t�{%��,��`;�)�A9�t�T�:��g��I/�o�N�co$�Xc�YCQv���H`��Ǧ7P�d�]���w6�7'<�^sµ�)����^Ȏ��������C| �"�kz����e;7P9��j�g�K�c/�#�ٱ؁쎳����l�ή�@�%��p\x�g�q���a��=�g=ټ2��x�h)}?��uv	v�_Xg�=	p��������-a��M�i�2���]���*��ӃN
v9�����uvۓ��q/��n�b���ǰ�aj+�T~���[�l[��t��z�(��[g�;y��-=Z%�9��{);����F����ɿ��Q��%T����V�]Yg'���I��s����N����i'�Vy,2 l������rШV�uv��n����\{<�|L���{�٤�d +A��L% $إ?l���T�#���	{%Gx���$Gy��A�y�O9 7��J9�^yYg�*�ʾ3��Z�K�N�x�r{#;��CrԷ?9j_AƗ@0���i�첝�����]{�<X6a�!8s��娽��Rn���:���j~���Ux��y<����eX(�eE�28�!0�$`��wN[g��y���+.�;�o����o��x�=-a��2pп��+�Y��}�kv��n�Un�������q/�����X,g��+g�����C��t��z@(��[gק<�9�Z.��V^�ƺ|����bM��q-O��2��m`~e�]�i�����:;��?pa�Eʎ������+��1�a��K ��\Q��:;��~%t��^{�1��Xg��R� %��#C~��i7P)���@eJ���u��X�e.;�1,_^\��g����*���s���~︀W���G�c1�3+CLvp�#�Lyls�p��TN[g�*˔�����7�{��
��&�=�ٟ�e�-�LT�*�'������X����N��qe�)Nކ}�a?��M�ٕ�Xg�l����w��o�%�ѽ>e���2��a��ͨr�j�uv�*�ٍC��$��5gz�S9����p���9<]gw\�����O��j�}�|h:�슰G���+;������d����j7�(�`�ޖ `��4�?�0'a�.e'X��fg���>24C��<�P���i7P�6	���1�L�q/���hAأ;��P�I�2(AKe�]�ʜv��e���s"���K�s9.В�Gw��b*�R�ܸ������v�T�����T��I/�艰GWr�S�\�B�y��Mo���:;7P�/�;y�kύ<gr����Hأ�Y��gކ�r=Ö�����@�vv�T>�*�K�F �х�ڬ]�u��Е!6��=C�&���T���_9c���z��Uy�KɁ��h.�XY��)�s����M��e���@�ٙ�V���E�F ��T��rU�5tq�^e�Y�Sz�t��q�.�/7P�s�:;��9.��@@�;��Bأ�rYUv���J�+Ù���!�wYg�~�ݴ�T��c*��<'r``�9S��0"a�f2�eG��g'�Yy��+�g�<Ƨ�@%�$z��玀�a�&�.;ݼ�Q�@��;3�Le��&7P�����<��k	�|̥��>���t�U78��rI_�}���^�y���K������yN"�O�cV�d�x��
.�s�_��l��.A�P�&��s���|�# {�hz&;h���7��Jm /��eH��d�gQ^����P'�1�2 fGm�̶�R���ڭ��7YgWn��1�<�z������yn���' ���Ev�e�h>��y�}��r�uvƧ7P1�s^y�嵼�\�< 6#�s9�_v�v��RF9������k���`�����5m�u\��A��ٳ� 8a������`�X���@�����/��V���uvlK^�y>����<�5���ؙ��Нa��w��N2\��q�T�MB�a�m� �'�٩�3an*� ���IYg�����L����幘��a���ˀvG�c'ʙ��	~�BBL,G3y}%��g�@���Tޟ��`�uɮ��W;�,��K�c�r	X.]�Ck�����*��y��:�A�5��^��e-�幚�랇 ��ت�wO�9�U����3Z��Ԇ�R���0�<��t(�d���=�f��Hѷ�Q(�7f�Q�n6YgWn�b�s;.����祀�a��� P����7y���4�jK	�����@=���!��\M__����*�~	{\X�2dp�^�8����t��q�.�/7P�Ύ�<�1{\H٥��b?�^\s�oۦ��6��JB�.�8���<k$�<�s��`y�=.$m���"my�^�Z���3�v��V�N��4�?g<�1{���Λn����tYg����L��AO�<�A�Z��k�	��{�K��!o��d�-��e�J�+��N��J�?]g�Ih����W;�\�E�p�/a�3�Q�2���4X�<������<�0�m���T�]����<�<�� �q&9sQ�^_X�2�@Em.��e���vYK��iF�X$����3�~��X��2�_C�����uv���Wo���o������� ��X�2D8�AorIZ.��d�]���*e�>���,��u���?���H���BУ���r������e���@�5J���\ӫ��bx �D��T��y�`W��mr�<O�sP"�S������l������ܟ� �4�'��[��ky�e���i�U>�A8!p�Co�V�� ̥�rI�J�se g!�q�\�V�(g��m+��2Ğt���uv�������6�J^����s^�༄=��_b��JP��z�T���Z=�rְ|?�m�)︿����x l��GU9ʜA���y�`���&��N��J�lc^xp'�<�< vA��������$�jΆՆ�R�X��ekKxn9��E�9~������s
�]�8�Z%N�6ύM����*s��[.9��')�v6[�`n�+R�P�arYY.��d�]�l�`7�0������a��dh=��u�-מ�߄=M�^dhg�d�d�]�'	~ٮ�uv�2=띟����@����i��ք=�|��O�]Yg��TvrP`��w��I�}�]����^^?y�x �F�c��*��7���ήv��R�X�٥��ۥ��ˀ��2�<�y��L��k�<���	{{Ι��uvDO���t��I (gB��I/�����{{l�)o�<L�:��n�2]g���d�/��0a�N�xy_>�o��D�ޞJ@(�L �P��I7PI�uv	v�������X�} ��!g%�!�S�<F���T>�mrv��e���S7��_^9XR{=� J^C�z0ao�d�)�N�5��!Ch�M��%�%dXgׇ<yl�{�S���jg�< F'��$2�p�ȥa9��:��T<^�*P(<N���RxyM���' ����G���_�M���1��@�Z�e��\�?��Mz�����\f�>��D�d��'o�	ve��q�.Un���B�C�4���{����< ��B�2��ۑ�>a-��vÇR�XO���7}�9��}9���kΒO_c���<��#��ن�(��2L�v��:;�O��|��8 �O��uD�3]gw�T����y9�R�#��ٕ��Wx�e��u� p:ao`���>A�x%؝t�TYg�`g��$y���_���;]	x��6- �G��3u�]dh��6T��ǲ��p^	x�pp��z��s�E������L9��2$�����.�.�7k�ئ�����'yM�΢'��5�L( l��7��� ^�E�]~�M��e��v	v�Jv-�<���>:.��ף� �!�d_�"d(<�:�r���J���9�/g��KZ?������� ���7��z��e$�s�2�I���Tr� �z��o��	;�>?< 苰7����|9T��������]>���:;�"���ο#\���!�לa_x�Ey;� �{X���uv�AqZ��cy�P���M^��*�@?���������e��i7P����M�Py�'-A��m-��,eΰx �ao�2|��+o������*e����/z~�y=�5\���<�Y 蛰�9j�!+��w9;��8[����/�Gm0,��e�����r���6�로9k��8)����� �"�-D�Z��ɠ����'���08���.á�@]	wy=�U���yyg�e��3����zw95 ,���e{��߽:�w9�e���@�����3��
�M^+��s^�y;��M��2P ���� �2�%T�#�y;��@������dث����T\���P9���^y{�K9K?���4y�f���v�+��# @_��(�pN��$��������������,��&��������+�.��h)tR��ۿ}��i�r��w���J�,%��~�`�H������A�g~�gV���_�� Y�ٝ������n��U^w	^ym�u=}=�t)�qA����|����`{�+G�K������#�c�����\N���n���2�%0Zg���4�k=���z�jg�׃^*s�z�~n�<g�`?	{����[��R?��?������W�n}p,��O��	vЇ�s&}��}�?��?yt��U��3��;Ｓ�<  �����/��/����j���T`�z]?������{�csd�T^B��; 0%�u�\�yR�uvn�c�e�%إ��w�_��_9��?�Ӄ���k �2�=����n��ƃ��ٟ�f�+�#��_��7�p���կ�S�\jϿ��ӟ�������������  ��P9{��W�W/��z�ڐ�z�ӞV�=̥��[r������'=�I�{����~��V= �־F �k�����d��ڜܜ����n����5|����Xݶu���>�%�  m�~���ʠ���J �6�=��*�ǥK�V����+z@_� @C����G��*�G��i���}�  m{j�e�cnz@_� @C�������2�17=��� �aO��z�M��  hC�S;/�s��*=  �:���?P�A���}�  m{j�e�cnz@_� @C�������2�17=��� �aO��z�M��  hC�S;/�s��*=  �:�}�{�S�A���}�  m{j�e�cnz@_� @C���~����2�17=��� �aO��z�M��  hC�S;/�s��*=  �:�}�;�Q�A���}�  m{j�e�cnz@_� @C��o�۪�2�17=��� �aO��z�M��  hC�kT������3���ăO��կ�s���z�I��׼��R�wW���K �6�{��ַ���~���An�*���u{,�s[BX����7�xc�5_�?��?�~�K �6��Fu���ZR�3�1�%�i�t&鷺����/U�fO� @C��o~���G>����������n7����m�zW�^�n�S���z@��_���K^�#���q=�s���5g����  hC�kT�	{��a﮻�n�S���z@�;�X���������/�n�K� ���a���F����Ȁ���|��]��b���6=�A��-���9k��\�}�=�T���  hC�kT	{�!O؃k�������|3�b>��C�m���~���zֳ��  hC�kTA������{ӛ�T����~�9J �6�{��A���}h5�=���?��\ݮV��~��s���T��z̭�p�ҥ�k8�`~�S��n7J� І�ר������{uF �~]�r��]Oe�c[^����-o9��O��{�z��6g=س�� ����^���Z�a/+��ݴ^��W�>'��z��z+�ې��������W���<�ȣ=����v/~�W?�m��V�n�� �a�QM��Y+�}}򓟬~�ˠ�6$�%�%�M_/}�K��T�= �s�7Vy��X�n�� �a�Q]$쥖4 �ئ\K9��yM<���=x�;�q�M�=@�� `.C���	�2�L��T��=���կ�S屨}�J��S�����[{��F�ғ�= ���ר�a/k��^�Z�nZ�C�Y>�e屘~�J������n{��'��\�{�B���|`5��|�͇P��]����a���w��]��z)����/|�p���u��|y�4\Ԟ��+�q��E/Z}߷�zku��J �6��Fu���;w�t�M����ˠǶ��}�;\�W���\���׽�ȟc���U�Z��w� @�^��H�KM��'?��<�@u�ʠ�6��+�9���rC�u�����?w���'>Q��Z?K��7���]�� ������?�m�}�ݫ-a/���q�ַ�u��	{��u�ʠǶ�R��a��?�����u�ӳ�	i��N��~��O}�SW_��|gu�֥ @�^��h�[�쬟?g���z������YJ� ����^.q������._�\ݮV��szV�e/{Yu�^ʠ�ܖ�>��9+w�>0�!�׿����z(=  ���E��+_��#C^.ݪm�K���z@j���3|��w_u�iM/�N����]z  �!�5���3zK�R=涄�ʝuo��#��^��gS�����/�rͶ=�  m��ǋ{��K��S�>��W�~Oe�cnK��r��Z�ۤ�  �$�^��h���^��{o�k�V=涄�^w�yg��~\=�y�;x���_��� ����^.���ǡk�i�/S��5{-�s[B8�r��3�����?�7�7����  hC�S;/�s��*=  �:�e-�j_=��Uz  �!쩝�A���}�  m{j�e�cnz@_� @C���]:վz�M��  hC�S;/�s��*=  �:�]�rEuP=��Uz  �!쩝�A���}�  m{j�e�cnz@_� @C��˗/�ʠ���J �6�=��2�17=��� ����ރ>�:(�s��*=  ����ˠ���J �6�=��2�17=��� �����<�:(�s��*=  ����ˠ���J �6�{����z�M��  hC�S;/�s��*=  ����ˠ���J �6�{��w��z�M��  hC�S;/�s��*=  �:��{ｪ�2�17=��� �aO��z�M��  hc���/~QuP=��Uz  �!쩝�A���}�  m�T_e�c.��j_z  �K�S��A��Ԟ�}� 0�!�^�k_��kն`Nz@ 얰���I� ��ڛ�w��%�Q��[�y�ڕ  ��7a  `�{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  H�  ��  0 a  `@�  ���=  �	{   �   $�  ����(���$�    IEND�B`�                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name\FullyQualified as FullyQualifiedName;

class ExitPass extends CodeCleanerPass
{
    /**
     * Converts exit calls to BreakExceptions.
     *
     * @param \PhpParser\Node $node
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Exit_) {
            return new StaticCall(new FullyQualifiedName('Psy\Exception\BreakException'), 'exitShell');
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/*
 * This file is part of sebastian/global-state.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SebastianBergmann\GlobalState;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\GlobalState\TestFixture\BlacklistedChildClass;
use SebastianBergmann\GlobalState\TestFixture\BlacklistedClass;
use SebastianBergmann\GlobalState\TestFixture\BlacklistedImplementor;
use SebastianBergmann\GlobalState\TestFixture\BlacklistedInterface;

/**
 * @covers \SebastianBergmann\GlobalState\Blacklist
 */
class BlacklistTest extends TestCase
{
    /**
     * @var \SebastianBergmann\GlobalState\Blacklist
     */
    private $blacklist;

    protected function setUp()
    {
        $this->blacklist = new Blacklist;
    }

    public function testGlobalVariableThatIsNotBlacklistedIsNotTreatedAsBlacklisted()
    {
        $this->assertFalse($this->blacklist->isGlobalVariableBlacklisted('variable'));
    }

    public function testGlobalVariableCanBeBlacklisted()
    {
        $this->blacklist->addGlobalVariable('variable');

        $this->assertTrue($this->blacklist->isGlobalVariableBlacklisted('variable'));
    }

    public function testStaticAttributeThatIsNotBlacklistedIsNotTreatedAsBlacklisted()
    {
        $this->assertFalse(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedClass::class,
                'attribute'
            )
        );
    }

    public function testClassCanBeBlacklisted()
    {
        $this->blacklist->addClass(BlacklistedClass::class);

        $this->assertTrue(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedClass::class,
                'attribute'
            )
        );
    }

    public function testSubclassesCanBeBlacklisted()
    {
        $this->blacklist->addSubclassesOf(BlacklistedClass::class);

        $this->assertTrue(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedChildClass::class,
                'attribute'
            )
        );
    }

    public function testImplementorsCanBeBlacklisted()
    {
        $this->blacklist->addImplementorsOf(BlacklistedInterface::class);

        $this->assertTrue(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedImplementor::class,
                'attribute'
            )
        );
    }

    public function testClassNamePrefixesCanBeBlacklisted()
    {
        $this->blacklist->addClassNamePrefix('SebastianBergmann\GlobalState');

        $this->assertTrue(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedClass::class,
                'attribute'
            )
        );
    }

    public function testStaticAttributeCanBeBlacklisted()
    {
        $this->blacklist->addStaticAttribute(
            BlacklistedClass::class,
            'attribute'
        );

        $this->assertTrue(
            $this->blacklist->isStaticAttributeBlacklisted(
                BlacklistedClass::class,
                'attribute'
            )
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          -----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQDZeUdi1RKnm9cRYNn6E24xxrRTouh3Va8JOEHQ5SB018lvbjwH
2lW5mZ/I0kh/dHsTN0zcN0VE62WIbnLreMk/af/4Pg1i93+c9TmfXmoropsmdLos
w0tjq50jGbBqtHZNJYAokP/u3uUuRw8g0V/O4zlQ3GlO/PDH7xDQzekl9wIDAQAB
AoGAaoCBXD5a72hbb/BNb7HaUlgscZUjYWW93bcGTGYZef8/b+m9Tl83gjhgzvlk
db62k1eOtX3/11uskp78eqLhctv7yWc0mQQhgOogY2qCwHTCH8wja8kJkUAnKQhs
P9sa5iJvgckiuX3SdxgTMwib9d1VyGq6YywiORiZF9rxyhECQQD/xhiZSi7y0ciB
g4bassy0GVMS7EDRumMHc8wC23E1H2mj5yPE/QLqkW4ddmCv2BbJnYmyNvOaK9tk
T2W+mn3/AkEA2aqDGja9CaTlY4BCXfiT166n+xVl5+d+1DENQ4FK9O2jpSi1265J
tjEkXVxUOpV1ZEcUVOdK6RpvsKpc7vVICQJBALEFO5UsQJ4SD0GD9Ft8kCy9sj9Q
f/Qnmc5YmIQJuKpZmVW07Y6yxcfu61U8zuIlHnBftiM/4Q18+RTN1s86QaUCQHoL
9MTfCnH85q46/XuJZQRbp07O+bvlfqTl+CTwuyHImaiCwi2ydRxWQ6ihm4zZvuAC
RvEwWz2HGDc73y4RlFkCQDDdnN9e46l1nMDLDI4cyyGBVg4Z2IZ3IAu5GaoUCGjM
a8w6kxE8f1d8DD5vvqVbmfK89TA/DjT+7/arBNBCiCM=
-----END RSA PRIVATE KEY-----
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         --TEST--
Test symfony_debug_backtrace in case of fatal error
--SKIPIF--
<?php if (!extension_loaded('symfony_debug')) print 'skip'; ?>
--FILE--
<?php

function bar()
{
    foo();
}

function foo()
{
    notexist();
}

function bt()
{
    print_r(symfony_debug_backtrace());
}

register_shutdown_function('bt');

bar();

?>
--EXPECTF--
Fatal error: Call to undefined function notexist() in %s on line %d
Array
(
    [0] => Array
        (
            [function] => bt
            [args] => Array
                (
                )

        )

    [1] => Array
        (
            [file] => %s
            [line] => %d
            [function] => foo
            [args] => Array
                (
                )

        )

    [2] => Array
        (
            [file] => %s
            [line] => %d
            [function] => bar
            [args] => Array
                (
                )

        )

)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Exception;

/**
 * GoneHttpException.
 *
 * @author Ben Ramsey <ben@benramsey.com>
 */
class GoneHttpException extends HttpException
{
    /**
     * Constructor.
     *
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param int        $code     The internal exception code
     */
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(410, $message, $previous, array(), $code);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Translation\Dumper;

use Symfony\Component\Translation\MessageCatalogue;

/**
 * QtFileDumper generates ts files from a message catalogue.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class QtFileDumper extends FileDumper
{
    /**
     * {@inheritdoc}
     */
    public function formatCatalogue(MessageCatalogue $messages, $domain, array $options = array())
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = true;
        $ts = $dom->appendChild($dom->createElement('TS'));
        $context = $ts->appendChild($dom->createElement('context'));
        $context->appendChild($dom->createElement('name', $domain));

        foreach ($messages->all($domain) as $source => $target) {
            $message = $context->appendChild($dom->createElement('message'));
            $message->appendChild($dom->createElement('source', $source));
            $message->appendChild($dom->createElement('translation', $target));
        }

        return $dom->saveXML();
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtension()
    {
        return 'ts';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="add-category.php">Add About<span class="sr-only">(current)</span></a></li>
                <li><a href="">Manage Manage</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li>
                        <li class="text-center"><a href="?status=logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\XPath\Extension;

use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use Symfony\Component\CssSelector\Exception\SyntaxErrorException;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Symfony\Component\CssSelector\Parser\Parser;
use Symfony\Component\CssSelector\XPath\Translator;
use Symfony\Component\CssSelector\XPath\XPathExpr;

/**
 * XPath expression translator function extension.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class FunctionExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctionTranslators()
    {
        return array(
            'nth-child' => array($this, 'translateNthChild'),
            'nth-last-child' => array($this, 'translateNthLastChild'),
            'nth-of-type' => array($this, 'translateNthOfType'),
            'nth-last-of-type' => array($this, 'translateNthLastOfType'),
            'contains' => array($this, 'translateContains'),
            'lang' => array($this, 'translateLang'),
        );
    }

    /**
     * @throws ExpressionErrorException
     */
    public function translateNthChild(XPathExpr $xpath, FunctionNode $function, bool $last = false, bool $addNameTest = true): XPathExpr
    {
        try {
            list($a, $b) = Parser::parseSeries($function->getArguments());
        } catch (SyntaxErrorException $e) {
            throw new ExpressionErrorException(sprintf('Invalid series: %s', implode(', ', $function->getArguments())), 0, $e);
        }

        $xpath->addStarPrefix();
        if ($addNameTest) {
            $xpath->addNameTest();
        }

        if (0 === $a) {
            return $xpath->addCondition('position() = '.($last ? 'last() - '.($b - 1) : $b));
        }

        if ($a < 0) {
            if ($b < 1) {
                return $xpath->addCondition('false()');
            }

            $sign = '<=';
        } else {
            $sign = '>=';
        }

        $expr = 'position()';

        if ($last) {
            $expr = 'last() - '.$expr;
            --$b;
        }

        if (0 !== $b) {
            $expr .= ' - '.$b;
        }

        $conditions = array(sprintf('%s %s 0', $expr, $sign));

        if (1 !== $a && -1 !== $a) {
            $conditions[] = sprintf('(%s) mod %d = 0', $expr, $a);
        }

        return $xpath->addCondition(implode(' and ', $conditions));

        // todo: handle an+b, odd, even
        // an+b means every-a, plus b, e.g., 2n+1 means odd
        // 0n+b means b
        // n+0 means a=1, i.e., all elements
        // an means every a elements, i.e., 2n means even
        // -n means -1n
        // -1n+6 means elements 6 and previous
    }

    public function translateNthLastChild(XPathExpr $xpath, FunctionNode $function): XPathExpr
    {
        return $this->translateNthChild($xpath, $function, true);
    }

    public function translateNthOfType(XPathExpr $xpath, FunctionNode $function): XPathExpr
    {
        return $this->translateNthChild($xpath, $function, false, false);
    }

    /**
     * @throws ExpressionErrorException
     */
    public function translateNthLastOfType(XPathExpr $xpath, FunctionNode $function): XPathExpr
    {
        if ('*' === $xpath->getElement()) {
            throw new ExpressionErrorException('"*:nth-of-type()" is not implemented.');
        }

        return $this->translateNthChild($xpath, $function, true, false);
    }

    /**
     * @throws ExpressionErrorException
     */
    public function translateContains(XPathExpr $xpath, FunctionNode $function): XPathExpr
    {
        $arguments = $function->getArguments();
        foreach ($arguments as $token) {
            if (!($token->isString() || $token->isIdentifier())) {
                throw new ExpressionErrorException(
                    'Expected a single string or identifier for :contains(), got '
                    .implode(', ', $arguments)
                );
            }
        }

        return $xpath->addCondition(sprintf(
            'contains(string(.), %s)',
            Translator::getXpathLiteral($arguments[0]->getValue())
        ));
    }

    /**
     * @throws ExpressionErrorException
     */
    public function translateLang(XPathExpr $xpath, FunctionNode $function): XPathExpr
    {
        $arguments = $function->getArguments();
        foreach ($arguments as $token) {
            if (!($token->isString() || $token->isIdentifier())) {
                throw new ExpressionErrorException(
                    'Expected a single string or identifier for :lang(), got '
                    .implode(', ', $arguments)
                );
            }
        }

        return $xpath->addCondition(sprintf(
            'lang(%s)',
            Translator::getXpathLiteral($arguments[0]->getValue())
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'function';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

use Symfony\Component\Console\Output\ConsoleSectionOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * Provides helpers to display a table.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Саша Стаменковић <umpirsky@gmail.com>
 * @author Abdellatif Ait boudad <a.aitboudad@gmail.com>
 * @author Max Grigorian <maxakawizard@gmail.com>
 * @author Dany Maillard <danymaillard93b@gmail.com>
 */
class Table
{
    private const SEPARATOR_TOP = 0;
    private const SEPARATOR_TOP_BOTTOM = 1;
    private const SEPARATOR_MID = 2;
    private const SEPARATOR_BOTTOM = 3;
    private const BORDER_OUTSIDE = 0;
    private const BORDER_INSIDE = 1;

    /**
     * Table headers.
     */
    private $headers = array();

    /**
     * Table rows.
     */
    private $rows = array();

    /**
     * Column widths cache.
     */
    private $effectiveColumnWidths = array();

    /**
     * Number of columns cache.
     *
     * @var int
     */
    private $numberOfColumns;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var TableStyle
     */
    private $style;

    /**
     * @var array
     */
    private $columnStyles = array();

    /**
     * User set column widths.
     *
     * @var array
     */
    private $columnWidths = array();

    private static $styles;

    private $rendered = false;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;

        if (!self::$styles) {
            self::$styles = self::initStyles();
        }

        $this->setStyle('default');
    }

    /**
     * Sets a style definition.
     *
     * @param string     $name  The style name
     * @param TableStyle $style A TableStyle instance
     */
    public static function setStyleDefinition($name, TableStyle $style)
    {
        if (!self::$styles) {
            self::$styles = self::initStyles();
        }

        self::$styles[$name] = $style;
    }

    /**
     * Gets a style definition by name.
     *
     * @param string $name The style name
     *
     * @return TableStyle
     */
    public static function getStyleDefinition($name)
    {
        if (!self::$styles) {
            self::$styles = self::initStyles();
        }

        if (isset(self::$styles[$name])) {
            return self::$styles[$name];
        }

        throw new InvalidArgumentException(sprintf('Style "%s" is not defined.', $name));
    }

    /**
     * Sets table style.
     *
     * @param TableStyle|string $name The style name or a TableStyle instance
     *
     * @return $this
     */
    public function setStyle($name)
    {
        $this->style = $this->resolveStyle($name);

        return $this;
    }

    /**
     * Gets the current table style.
     *
     * @return TableStyle
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Sets table column style.
     *
     * @param int               $columnIndex Column index
     * @param TableStyle|string $name        The style name or a TableStyle instance
     *
     * @return $this
     */
    public function setColumnStyle($columnIndex, $name)
    {
        $columnIndex = (int) $columnIndex;

        $this->columnStyles[$columnIndex] = $this->resolveStyle($name);

        return $this;
    }

    /**
     * Gets the current style for a column.
     *
     * If style was not set, it returns the global table style.
     *
     * @param int $columnIndex Column index
     *
     * @return TableStyle
     */
    public function getColumnStyle($columnIndex)
    {
        if (isset($this->columnStyles[$columnIndex])) {
            return $this->columnStyles[$columnIndex];
        }

        return $this->getStyle();
    }

    /**
     * Sets the minimum width of a column.
     *
     * @param int $columnIndex Column index
     * @param int $width       Minimum column width in characters
     *
     * @return $this
     */
    public function setColumnWidth($columnIndex, $width)
    {
        $this->columnWidths[(int) $columnIndex] = (int) $width;

        return $this;
    }

    /**
     * Sets the minimum width of all columns.
     *
     * @param array $widths
     *
     * @return $this
     */
    public function setColumnWidths(array $widths)
    {
        $this->columnWidths = array();
        foreach ($widths as $index => $width) {
            $this->setColumnWidth($index, $width);
        }

        return $this;
    }

    public function setHeaders(array $headers)
    {
        $headers = array_values($headers);
        if (!empty($headers) && !is_array($headers[0])) {
            $headers = array($headers);
        }

        $this->headers = $headers;

        return $this;
    }

    public function setRows(array $rows)
    {
        $this->rows = array();

        return $this->addRows($rows);
    }

    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function addRow($row)
    {
        if ($row instanceof TableSeparator) {
            $this->rows[] = $row;

            return $this;
        }

        if (!is_array($row)) {
            throw new InvalidArgumentException('A row must be an array or a TableSeparator instance.');
        }

        $this->rows[] = array_values($row);

        return $this;
    }

    /**
     * Adds a row to the table, and re-renders the table.
     */
    public function appendRow($row): self
    {
        if (!$this->output instanceof ConsoleSectionOutput) {
            throw new RuntimeException(sprintf('Output should be an instance of "%s" when calling "%s".', ConsoleSectionOutput::class, __METHOD__));
        }

        if ($this->rendered) {
            $this->output->clear($this->calculateRowCount());
        }

        $this->addRow($row);
        $this->render();

        return $this;
    }

    public function setRow($column, array $row)
    {
        $this->rows[$column] = $row;

        return $this;
    }

    /**
     * Renders table to output.
     *
     * Example:
     * <code>
     * +---------------+-----------------------+------------------+
     * | ISBN          | Title                 | Author           |
     * +---------------+-----------------------+------------------+
     * | 99921-58-10-7 | Divine Comedy         | Dante Alighieri  |
     * | 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |
     * | 960-425-059-0 | The Lord of the Rings | J. R. R. Tolkien |
     * +---------------+-----------------------+------------------+
     * </code>
     */
    public function render()
    {
        $rows = array_merge($this->headers, array($divider = new TableSeparator()), $this->rows);
        $this->calculateNumberOfColumns($rows);

        $rows = $this->buildTableRows($rows);
        $this->calculateColumnsWidth($rows);

        $isHeader = true;
        $isFirstRow = false;
        foreach ($rows as $row) {
            if ($divider === $row) {
                $isHeader = false;
                $isFirstRow = true;

                continue;
            }
            if ($row instanceof TableSeparator) {
                $this->renderRowSeparator();

                continue;
            }
            if (!$row) {
                continue;
            }

            if ($isHeader || $isFirstRow) {
                $this->renderRowSeparator($isFirstRow ? self::SEPARATOR_TOP_BOTTOM : self::SEPARATOR_TOP);
                if ($isFirstRow) {
                    $isFirstRow = false;
                }
            }

            $this->renderRow($row, $isHeader ? $this->style->getCellHeaderFormat() : $this->style->getCellRowFormat());
        }
        $this->renderRowSeparator(self::SEPARATOR_BOTTOM);

        $this->cleanup();
        $this->rendered = true;
    }

    /**
     * Renders horizontal header separator.
     *
     * Example: <code>+-----+-----------+-------+</code>
     */
    private function renderRowSeparator(int $type = self::SEPARATOR_MID)
    {
        if (0 === $count = $this->numberOfColumns) {
            return;
        }

        $borders = $this->style->getBorderChars();
        if (!$borders[0] && !$borders[2] && !$this->style->getCrossingChar()) {
            return;
        }

        $crossings = $this->style->getCrossingChars();
        if (self::SEPARATOR_MID === $type) {
            list($horizontal, $leftChar, $midChar, $rightChar) = array($borders[2], $crossings[8], $crossings[0], $crossings[4]);
        } elseif (self::SEPARATOR_TOP === $type) {
            list($horizontal, $leftChar, $midChar, $rightChar) = array($borders[0], $crossings[1], $crossings[2], $crossings[3]);
        } elseif (self::SEPARATOR_TOP_BOTTOM === $type) {
            list($horizontal, $leftChar, $midChar, $rightChar) = array($borders[0], $crossings[9], $crossings[10], $crossings[11]);
        } else {
            list($horizontal, $leftChar, $midChar, $rightChar) = array($borders[0], $crossings[7], $crossings[6], $crossings[5]);
        }

        $markup = $leftChar;
        for ($column = 0; $column < $count; ++$column) {
            $markup .= str_repeat($horizontal, $this->effectiveColumnWidths[$column]);
            $markup .= $column === $count - 1 ? $rightChar : $midChar;
        }

        $this->output->writeln(sprintf($this->style->getBorderFormat(), $markup));
    }

    /**
     * Renders vertical column separator.
     */
    private function renderColumnSeparator($type = self::BORDER_OUTSIDE)
    {
        $borders = $this->style->getBorderChars();

        return sprintf($this->style->getBorderFormat(), self::BORDER_OUTSIDE === $type ? $borders[1] : $borders[3]);
    }

    /**
     * Renders table row.
     *
     * Example: <code>| 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |</code>
     */
    private function renderRow(array $row, string $cellFormat)
    {
        $rowContent = $this->renderColumnSeparator(self::BORDER_OUTSIDE);
        $columns = $this->getRowColumns($row);
        $last = count($columns) - 1;
        foreach ($columns as $i => $column) {
            $rowContent .= $this->renderCell($row, $column, $cellFormat);
            $rowContent .= $this->renderColumnSeparator($last === $i ? self::BORDER_OUTSIDE : self::BORDER_INSIDE);
        }
        $this->output->writeln($rowContent);
    }

    /**
     * Renders table cell with padding.
     */
    private function renderCell(array $row, int $column, string $cellFormat)
    {
        $cell = isset($row[$column]) ? $row[$column] : '';
        $width = $this->effectiveColumnWidths[$column];
        if ($cell instanceof TableCell && $cell->getColspan() > 1) {
            // add the width of the following columns(numbers of colspan).
            foreach (range($column + 1, $column + $cell->getColspan() - 1) as $nextColumn) {
                $width += $this->getColumnSeparatorWidth() + $this->effectiveColumnWidths[$nextColumn];
            }
        }

        // str_pad won't work properly with multi-byte strings, we need to fix the padding
        if (false !== $encoding = mb_detect_encoding($cell, null, true)) {
            $width += strlen($cell) - mb_strwidth($cell, $encoding);
        }

        $style = $this->getColumnStyle($column);

        if ($cell instanceof TableSeparator) {
            return sprintf($style->getBorderFormat(), str_repeat($style->getBorderChars()[2], $width));
        }

        $width += Helper::strlen($cell) - Helper::strlenWithoutDecoration($this->output->getFormatter(), $cell);
        $content = sprintf($style->getCellRowContentFormat(), $cell);

        return sprintf($cellFormat, str_pad($content, $width, $style->getPaddingChar(), $style->getPadType()));
    }

    /**
     * Calculate number of columns for this table.
     */
    private function calculateNumberOfColumns($rows)
    {
        $columns = array(0);
        foreach ($rows as $row) {
            if ($row instanceof TableSeparator) {
                continue;
            }

            $columns[] = $this->getNumberOfColumns($row);
        }

        $this->numberOfColumns = max($columns);
    }

    private function buildTableRows($rows)
    {
        $unmergedRows = array();
        for ($rowKey = 0; $rowKey < count($rows); ++$rowKey) {
            $rows = $this->fillNextRows($rows, $rowKey);

            // Remove any new line breaks and replace it with a new line
            foreach ($rows[$rowKey] as $column => $cell) {
                if (!strstr($cell, "\n")) {
                    continue;
                }
                $lines = explode("\n", str_replace("\n", "<fg=default;bg=default>\n</>", $cell));
                foreach ($lines as $lineKey => $line) {
                    if ($cell instanceof TableCell) {
                        $line = new TableCell($line, array('colspan' => $cell->getColspan()));
                    }
                    if (0 === $lineKey) {
                        $rows[$rowKey][$column] = $line;
                    } else {
                        $unmergedRows[$rowKey][$lineKey][$column] = $line;
                    }
                }
            }
        }

        return new TableRows(function () use ($rows, $unmergedRows) {
            foreach ($rows as $rowKey => $row) {
                yield $this->fillCells($row);

                if (isset($unmergedRows[$rowKey])) {
                    foreach ($unmergedRows[$rowKey] as $row) {
                        yield $row;
                    }
                }
            }
        });
    }

    private function calculateRowCount(): int
    {
        $numberOfRows = count(iterator_to_array($this->buildTableRows(array_merge($this->headers, array(new TableSeparator()), $this->rows))));

        if ($this->headers) {
            ++$numberOfRows; // Add row for header separator
        }

        ++$numberOfRows; // Add row for footer separator

        return $numberOfRows;
    }

    /**
     * fill rows that contains rowspan > 1.
     *
     * @throws InvalidArgumentException
     */
    private function fillNextRows(array $rows, int $line): array
    {
        $unmergedRows = array();
        foreach ($rows[$line] as $column => $cell) {
            if (null !== $cell && !$cell instanceof TableCell && !is_scalar($cell) && !(is_object($cell) && method_exists($cell, '__toString'))) {
                throw new InvalidArgumentException(sprintf('A cell must be a TableCell, a scalar or an object implementing __toString, %s given.', gettype($cell)));
            }
            if ($cell instanceof TableCell && $cell->getRowspan() > 1) {
                $nbLines = $cell->getRowspan() - 1;
                $lines = array($cell);
                if (strstr($cell, "\n")) {
                    $lines = explode("\n", str_replace("\n", "<fg=default;bg=default>\n</>", $cell));
                    $nbLines = count($lines) > $nbLines ? substr_count($cell, "\n") : $nbLines;

                    $rows[$line][$column] = new TableCell($lines[0], array('colspan' => $cell->getColspan()));
                    unset($lines[0]);
                }

                // create a two dimensional array (rowspan x colspan)
                $unmergedRows = array_replace_recursive(array_fill($line + 1, $nbLines, array()), $unmergedRows);
                foreach ($unmergedRows as $unmergedRowKey => $unmergedRow) {
                    $value = isset($lines[$unmergedRowKey - $line]) ? $lines[$unmergedRowKey - $line] : '';
                    $unmergedRows[$unmergedRowKey][$column] = new TableCell($value, array('colspan' => $cell->getColspan()));
                    if ($nbLines === $unmergedRowKey - $line) {
                        break;
                    }
                }
            }
        }

        foreach ($unmergedRows as $unmergedRowKey => $unmergedRow) {
            // we need to know if $unmergedRow will be merged or inserted into $rows
            if (isset($rows[$unmergedRowKey]) && is_array($rows[$unmergedRowKey]) && ($this->getNumberOfColumns($rows[$unmergedRowKey]) + $this->getNumberOfColumns($unmergedRows[$unmergedRowKey]) <= $this->numberOfColumns)) {
                foreach ($unmergedRow as $cellKey => $cell) {
                    // insert cell into row at cellKey position
                    array_splice($rows[$unmergedRowKey], $cellKey, 0, array($cell));
                }
            } else {
                $row = $this->copyRow($rows, $unmergedRowKey - 1);
                foreach ($unmergedRow as $column => $cell) {
                    if (!empty($cell)) {
                        $row[$column] = $unmergedRow[$column];
                    }
                }
                array_splice($rows, $unmergedRowKey, 0, array($row));
            }
        }

        return $rows;
    }

    /**
     * fill cells for a row that contains colspan > 1.
     */
    private function fillCells($row)
    {
        $newRow = array();
        foreach ($row as $column => $cell) {
            $newRow[] = $cell;
            if ($cell instanceof TableCell && $cell->getColspan() > 1) {
                foreach (range($column + 1, $column + $cell->getColspan() - 1) as $position) {
                    // insert empty value at column position
                    $newRow[] = '';
                }
            }
        }

        return $newRow ?: $row;
    }

    private function copyRow(array $rows, int $line): array
    {
        $row = $rows[$line];
        foreach ($row as $cellKey => $cellValue) {
            $row[$cellKey] = '';
            if ($cellValue instanceof TableCell) {
                $row[$cellKey] = new TableCell('', array('colspan' => $cellValue->getColspan()));
            }
        }

        return $row;
    }

    /**
     * Gets number of columns by row.
     */
    private function getNumberOfColumns(array $row): int
    {
        $columns = count($row);
        foreach ($row as $column) {
            $columns += $column instanceof TableCell ? ($column->getColspan() - 1) : 0;
        }

        return $columns;
    }

    /**
     * Gets list of columns for the given row.
     */
    private function getRowColumns(array $row): array
    {
        $columns = range(0, $this->numberOfColumns - 1);
        foreach ($row as $cellKey => $cell) {
            if ($cell instanceof TableCell && $cell->getColspan() > 1) {
                // exclude grouped columns.
                $columns = array_diff($columns, range($cellKey + 1, $cellKey + $cell->getColspan() - 1));
            }
        }

        return $columns;
    }

    /**
     * Calculates columns widths.
     */
    private function calculateColumnsWidth(iterable $rows)
    {
        for ($column = 0; $column < $this->numberOfColumns; ++$column) {
            $lengths = array();
            foreach ($rows as $row) {
                if ($row instanceof TableSeparator) {
                    continue;
                }

                foreach ($row as $i => $cell) {
                    if ($cell instanceof TableCell) {
                        $textContent = Helper::removeDecoration($this->output->getFormatter(), $cell);
                        $textLength = Helper::strlen($textContent);
                        if ($textLength > 0) {
                            $contentColumns = str_split($textContent, ceil($textLength / $cell->getColspan()));
                            foreach ($contentColumns as $position => $content) {
                                $row[$i + $position] = $content;
                            }
                        }
                    }
                }

                $lengths[] = $this->getCellWidth($row, $column);
            }

            $this->effectiveColumnWidths[$column] = max($lengths) + strlen($this->style->getCellRowContentFormat()) - 2;
        }
    }

    private function getColumnSeparatorWidth(): int
    {
        return strlen(sprintf($this->style->getBorderFormat(), $this->style->getBorderChars()[3]));
    }

    private function getCellWidth(array $row, int $column): int
    {
        $cellWidth = 0;

        if (isset($row[$column])) {
            $cell = $row[$column];
            $cellWidth = Helper::strlenWithoutDecoration($this->output->getFormatter(), $cell);
        }

        $columnWidth = isset($this->columnWidths[$column]) ? $this->columnWidths[$column] : 0;

        return max($cellWidth, $columnWidth);
    }

    /**
     * Called after rendering to cleanup cache data.
     */
    private function cleanup()
    {
        $this->effectiveColumnWidths = array();
        $this->numberOfColumns = null;
    }

    private static function initStyles()
    {
        $borderless = new TableStyle();
        $borderless
            ->setHorizontalBorderChars('=')
            ->setVerticalBorderChars(' ')
            ->setDefaultCrossingChar(' ')
        ;

        $compact = new TableStyle();
        $compact
            ->setHorizontalBorderChars('')
            ->setVerticalBorderChars(' ')
            ->setDefaultCrossingChar('')
            ->setCellRowContentFormat('%s')
        ;

        $styleGuide = new TableStyle();
        $styleGuide
            ->setHorizontalBorderChars('-')
            ->setVerticalBorderChars(' ')
            ->setDefaultCrossingChar(' ')
            ->setCellHeaderFormat('%s')
        ;

        $box = (new TableStyle())
            ->setHorizontalBorderChars('─')
            ->setVerticalBorderChars('│')
            ->setCrossingChars('┼', '┌', '┬', '┐', '┤', '┘', '┴', '└', '├')
        ;

        $boxDouble = (new TableStyle())
            ->setHorizontalBorderChars('═', '─')
            ->setVerticalBorderChars('║', '│')
            ->setCrossingChars('┼', '╔', '╤', '╗', '╢', '╝', '╧', '╚', '╟', '╠', '╪', '╣')
        ;

        return array(
            'default' => new TableStyle(),
            'borderless' => $borderless,
            'compact' => $compact,
            'symfony-style-guide' => $styleGuide,
            'box' => $box,
            'box-double' => $boxDouble,
        );
    }

    private function resolveStyle($name)
    {
        if ($name instanceof TableStyle) {
            return $name;
        }

        if (isset(self::$styles[$name])) {
            return self::$styles[$name];
        }

        throw new InvalidArgumentException(sprintf('Style "%s" is not defined.', $name));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

namespace Faker\Test\Provider\zh_TW;

use Faker\Generator;
use Faker\Provider\zh_TW\Person;

class PersonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new Person($faker));
        $this->faker = $faker;
    }

    /**
     * @see https://zh.wikipedia.org/wiki/%E4%B8%AD%E8%8F%AF%E6%B0%91%E5%9C%8B%E5%9C%8B%E6%B0%91%E8%BA%AB%E5%88%86%E8%AD%89
     */
    public function testPersonalIdentityNumber()
    {
        $id = $this->faker->personalIdentityNumber;

        $firstChar = substr($id, 0, 1);
        $codesString = Person::$idBirthplaceCode[$firstChar] . substr($id, 1);

        // After transfer the first alphabet word into 2 digit number, there should be totally 11 numbers
        $this->assertRegExp("/^[0-9]{11}$/", $codesString);

        $total = 0;
        $codesArray = str_split($codesString);
        foreach ($codesArray as $key => $code) {
            $total += $code * Person::$idDigitValidator[$key];
        }

        // Validate
        $this->assertEquals(0, ($total % 10));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               # Change Log

All notable changes to this project will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).

## [2.0.1] - 2018-06-11

### Fixed

* Fixed [#46](https://github.com/sebastianbergmann/php-file-iterator/issues/46): Regression with hidden parent directory

## [2.0.0] - 2018-05-28

### Fixed

* Fixed [#30](https://github.com/sebastianbergmann/php-file-iterator/issues/30): Exclude is not considered if it is a parent of the base path

### Changed

* This component now uses namespaces

### Removed

* This component is no longer supported on PHP 5.3, PHP 5.4, PHP 5.5, PHP 5.6, and PHP 7.0

## [1.4.5] - 2017-11-27

### Fixed

* Fixed [#37](https://github.com/sebastianbergmann/php-file-iterator/issues/37): Regression caused by fix for [#30](https://github.com/sebastianbergmann/php-file-iterator/issues/30)

## [1.4.4] - 2017-11-27

### Fixed

* Fixed [#30](https://github.com/sebastianbergmann/php-file-iterator/issues/30): Exclude is not considered if it is a parent of the base path

## [1.4.3] - 2017-11-25

### Fixed

* Fixed [#34](https://github.com/sebastianbergmann/php-file-iterator/issues/34): Factory should use canonical directory names

## [1.4.2] - 2016-11-26

No changes

## [1.4.1] - 2015-07-26

No changes

## 1.4.0 - 2015-04-02

### Added

* [Added support for wildcards (glob) in exclude](https://github.com/sebastianbergmann/php-file-iterator/pull/23)

[2.0.1]: https://github.com/sebastianbergmann/php-file-iterator/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4...master
[1.4.5]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4.4...1.4.5
[1.4.4]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4.3...1.4.4
[1.4.3]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4.2...1.4.3
[1.4.2]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4.1...1.4.2
[1.4.1]: https://github.com/sebastianbergmann/php-file-iterator/compare/1.4.0...1.4.1
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process;

use Symfony\Component\Process\Exception\RuntimeException;

/**
 * Provides a way to continuously write to the input of a Process until the InputStream is closed.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class InputStream implements \IteratorAggregate
{
    /** @var null|callable */
    private $onEmpty = null;
    private $input = array();
    private $open = true;

    /**
     * Sets a callback that is called when the write buffer becomes empty.
     */
    public function onEmpty(callable $onEmpty = null)
    {
        $this->onEmpty = $onEmpty;
    }

    /**
     * Appends an input to the write buffer.
     *
     * @param resource|string|int|float|bool|\Traversable|null The input to append as scalar,
     *                                                         stream resource or \Traversable
     */
    public function write($input)
    {
        if (null === $input) {
            return;
        }
        if ($this->isClosed()) {
            throw new RuntimeException(sprintf('%s is closed', static::class));
        }
        $this->input[] = ProcessUtils::validateInput(__METHOD__, $input);
    }

    /**
     * Closes the write buffer.
     */
    public function close()
    {
        $this->open = false;
    }

    /**
     * Tells whether the write buffer is closed or not.
     */
    public function isClosed()
    {
        return !$this->open;
    }

    public function getIterator()
    {
        $this->open = true;

        while ($this->open || $this->input) {
            if (!$this->input) {
                yield '';
                continue;
            }
            $current = array_shift($this->input);

            if ($current instanceof \Iterator) {
                foreach ($current as $cur) {
                    yield $cur;
                }
            } else {
                yield $current;
            }
            if (!$this->input && $this->open && null !== $onEmpty = $this->onEmpty) {
                $this->write($onEmpty($this));
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Output;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * ConsoleOutput is the default class for all CLI output. It uses STDOUT and STDERR.
 *
 * This class is a convenient wrapper around `StreamOutput` for both STDOUT and STDERR.
 *
 *     $output = new ConsoleOutput();
 *
 * This is equivalent to:
 *
 *     $output = new StreamOutput(fopen('php://stdout', 'w'));
 *     $stdErr = new StreamOutput(fopen('php://stderr', 'w'));
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ConsoleOutput extends StreamOutput implements ConsoleOutputInterface
{
    private $stderr;
    private $consoleSectionOutputs = array();

    /**
     * @param int                           $verbosity The verbosity level (one of the VERBOSITY constants in OutputInterface)
     * @param bool|null                     $decorated Whether to decorate messages (null for auto-guessing)
     * @param OutputFormatterInterface|null $formatter Output formatter instance (null to use default OutputFormatter)
     */
    public function __construct(int $verbosity = self::VERBOSITY_NORMAL, bool $decorated = null, OutputFormatterInterface $formatter = null)
    {
        parent::__construct($this->openOutputStream(), $verbosity, $decorated, $formatter);

        $actualDecorated = $this->isDecorated();
        $this->stderr = new StreamOutput($this->openErrorStream(), $verbosity, $decorated, $this->getFormatter());

        if (null === $decorated) {
            $this->setDecorated($actualDecorated && $this->stderr->isDecorated());
        }
    }

    /**
     * Creates a new output section.
     */
    public function section(): ConsoleSectionOutput
    {
        return new ConsoleSectionOutput($this->getStream(), $this->consoleSectionOutputs, $this->getVerbosity(), $this->isDecorated(), $this->getFormatter());
    }

    /**
     * {@inheritdoc}
     */
    public function setDecorated($decorated)
    {
        parent::setDecorated($decorated);
        $this->stderr->setDecorated($decorated);
    }

    /**
     * {@inheritdoc}
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        parent::setFormatter($formatter);
        $this->stderr->setFormatter($formatter);
    }

    /**
     * {@inheritdoc}
     */
    public function setVerbosity($level)
    {
        parent::setVerbosity($level);
        $this->stderr->setVerbosity($level);
    }

    /**
     * {@inheritdoc}
     */
    public function getErrorOutput()
    {
        return $this->stderr;
    }

    /**
     * {@inheritdoc}
     */
    public function setErrorOutput(OutputInterface $error)
    {
        $this->stderr = $error;
    }

    /**
     * Returns true if current environment supports writing console output to
     * STDOUT.
     *
     * @return bool
     */
    protected function hasStdoutSupport()
    {
        return false === $this->isRunningOS400();
    }

    /**
     * Returns true if current environment supports writing console output to
     * STDERR.
     *
     * @return bool
     */
    protected function hasStderrSupport()
    {
        return false === $this->isRunningOS400();
    }

    /**
     * Checks if current executing environment is IBM iSeries (OS400), which
     * doesn't properly convert character-encodings between ASCII to EBCDIC.
     *
     * @return bool
     */
    private function isRunningOS400()
    {
        $checks = array(
            \function_exists('php_uname') ? php_uname('s') : '',
            getenv('OSTYPE'),
            PHP_OS,
        );

        return false !== stripos(implode(';', $checks), 'OS400');
    }

    /**
     * @return resource
     */
    private function openOutputStream()
    {
        if (!$this->hasStdoutSupport()) {
            return fopen('php://output', 'w');
        }

        return @fopen('php://stdout', 'w') ?: fopen('php://output', 'w');
    }

    /**
     * @return resource
     */
    private function openErrorStream()
    {
        return fopen($this->hasStderrSupport() ? 'php://stderr' : 'php://output', 'w');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Illuminate\Http\Exceptions;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class HttpResponseException extends RuntimeException
{
    /**
     * The underlying response instance.
     *
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    /**
     * Create a new HTTP response exception instance.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the underlying response instance.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Illuminate\Translation;

use Illuminate\Contracts\Translation\Loader;

class ArrayLoader implements Loader
{
    /**
     * All of the translation messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $namespace = $namespace ?: '*';

        if (isset($this->messages[$namespace][$locale][$group])) {
            return $this->messages[$namespace][$locale][$group];
        }

        return [];
    }

    /**
     * Add a new namespace to the loader.
     *
     * @param  string  $namespace
     * @param  string  $hint
     * @return void
     */
    public function addNamespace($namespace, $hint)
    {
        //
    }

    /**
     * Add a new JSON path to the loader.
     *
     * @param  string  $path
     * @return void
     */
    public function addJsonPath($path)
    {
        //
    }

    /**
     * Add messages to the loader.
     *
     * @param  string  $locale
     * @param  string  $group
     * @param  array  $messages
     * @param  string|null  $namespace
     * @return $this
     */
    public function addMessages($locale, $group, array $messages, $namespace = null)
    {
        $namespace = $namespace ?: '*';

        $this->messages[$namespace][$locale][$group] = $messages;

        return $this;
    }

    /**
     * Get an array of all the registered namespaces.
     *
     * @return array
     */
    public function namespaces()
    {
        return [];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       Removing subnodes by setting them to null
-----
<?php
function
foo (
    Bar $foo
        = null,
    Foo $bar) : baz
{}

function
()
: int
{};

class
Foo
extends
Bar
{
    public
    function
    foo() : ?X {}

    public
      $prop = 'x'
    ;

    use T {
        T
        ::
        x
        as
        public
        y
        ;
    }
}

$foo [ $bar ];
exit ( $bar );
$foo
? $bar :
$baz;
[ $a => $b
, $c => $d];

yield
$foo
=>
$bar;
yield
$bar;

break
2
;
continue
2
;

foreach(
    $array
as
    $key
 =>
    $value
) {}

if
($x)
{
}

else {}

return
$val
;
static
  $x
  =
  $y
;

try {} catch
  (X $y)
  {}
finally
{}
-----
$stmts[0]->returnType = null;
$stmts[0]->params[0]->default = null;
$stmts[0]->params[1]->type = null;
$stmts[1]->expr->returnType = null;
$stmts[2]->extends = null;
$stmts[2]->stmts[0]->returnType = null;
$stmts[2]->stmts[1]->props[0]->default = null;
$stmts[2]->stmts[2]->adaptations[0]->newName = null;
$stmts[3]->expr->dim = null;
$stmts[4]->expr->expr = null;
$stmts[5]->expr->if = null;
$stmts[6]->expr->items[1]->key = null;
$stmts[7]->expr->key = null;
$stmts[8]->expr->value = null;
$stmts[9]->num = null;
$stmts[10]->num = null;
$stmts[11]->keyVar = null;
$stmts[12]->else = null;
$stmts[13]->expr = null;
$stmts[14]->vars[0]->default = null;
$stmts[15]->finally = null;
-----
<?php
function
foo (
    Bar $foo,
    $bar)
{}

function
()
{};

class
Foo
{
    public
    function
    foo() {}

    public
      $prop
    ;

    use T {
        T
        ::
        x
        as
        public
        ;
    }
}

$foo [];
exit ();
$foo
?:
$baz;
[ $a => $b
, $d];

yield
$bar;
yield;

break;
continue;

foreach(
    $array
as
    $value
) {}

if
($x)
{
}

return;
static
  $x
;

try {} catch
  (X $y)
  {}
-----
<?php

namespace
A
    {
    }
-----
$stmts[0]->name = null;
-----
<?php

namespace
    {
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2018 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Test;

use Psy\CodeCleaner;

class CodeCleanerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider semicolonCodeProvider
     */
    public function testAutomaticSemicolons(array $lines, $requireSemicolons, $expected)
    {
        $cc = new CodeCleaner();
        $this->assertSame($expected, $cc->clean($lines, $requireSemicolons));
    }

    public function semicolonCodeProvider()
    {
        return [
            [['true'],  false, 'return true;'],
            [['true;'], false, 'return true;'],
            [['true;'], true,  'return true;'],
            [['true'],  true,  false],

            [['echo "foo";', 'true'], true,  false],

            [['echo "foo";', 'true'], false, "echo \"foo\";\nreturn true;"],
        ];
    }

    /**
     * @dataProvider unclosedStatementsProvider
     */
    public function testUnclosedStatements(array $lines, $isUnclosed)
    {
        $cc  = new CodeCleaner();
        $res = $cc->clean($lines);

        if ($isUnclosed) {
            $this->assertFalse($res);
        } else {
            $this->assertNotFalse($res);
        }
    }

    public function unclosedStatementsProvider()
    {
        return [
            [['echo "'],   true],
            [['echo \''],  true],
            [['if (1) {'], true],

            [['echo "foo",'], true],

            [['echo ""'],   false],
            [["echo ''"],   false],
            [['if (1) {}'], false],

            [['// closed comment'],    false],
            [['function foo() { /**'], true],

            [['var_dump(1, 2,'], true],
            [['var_dump(1, 2,', '3)'], false],
        ];
    }

    /**
     * @dataProvider moreUnclosedStatementsProvider
     */
    public function testMoreUnclosedStatements(array $lines)
    {
        if (\defined('HHVM_VERSION')) {
            $this->markTestSkipped('HHVM not supported.');
        }

        $cc  = new CodeCleaner();
        $res = $cc->clean($lines);

        $this->assertFalse($res);
    }

    public function moreUnclosedStatementsProvider()
    {
        return [
            [["\$content = <<<EOS\n"]],
            [["\$content = <<<'EOS'\n"]],

            [['/* unclosed comment']],
            [['/** unclosed comment']],
        ];
    }

    /**
     * @dataProvider invalidStatementsProvider
     * @expectedException \Psy\Exception\ParseErrorException
     */
    public function testInvalidStatementsThrowParseErrors($code)
    {
        $cc = new CodeCleaner();
        $cc->clean([$code]);
    }

    public function invalidStatementsProvider()
    {
        // n.b. We used to check that `var_dump(1,2,)` failed, but PHP Parser
        // 4.x backported trailing comma function calls from PHP 7.3 for free!
        // so we're not going to spend too much time worrying about it :)

        return [
            ['function "what'],
            ["function 'what"],
            ['echo }'],
            ['echo {'],
            ['if (1) }'],
            ['echo """'],
            ["echo '''"],
            ['$foo "bar'],
            ['$foo \'bar'],
        ];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

namespace Faker\Provider\ko_KR;

class Address extends \Faker\Provider\Address
{
    protected static $postcode = array('#####');
    protected static $buildingNumber = array('####', '###');
    protected static $metropolitanCity = array(
        '서울특별시', '부산광역시', '대구광역시', '인천광역시', '광주광역시', '대전광역시', '울산광역시',
    );
    protected static $province = array(
        '경기도', '강원도', '충청북도', '충청남도', '전라북도', '전라남도', '경상북도', '경상남도', '제주특별자치도',
    );
    protected static $city = array(
        '파주시', '수원시', '수원시 권선구', '수원시 팔달구', '수원시 영통구', '성남시', '성남시 수정구', '성남시 중원구', '화성시',
        '성남시 분당구', '안양시', '안양시 만안구', '안양시 동안구', '부천시', '부천시 원미구', '부천시 소사구', '부천시 오정구', '광명시',
        '평택시', '이천시', '동두천시', '안산시', '안산시 상록구', '안산시 단원구', '안성시', '고양시', '고양시 덕양구', '고양시 일산동구',
        '고양시 일산서구', '과천시', '구리시', '남양주시', '오산시', '시흥시', '군포시', '의왕시', '하남시', '김포시', '용인시', '용인시 처인구',
        '용인시 기흥구', '용인시 수지구', '연천군', '가평군', '양평군', '광주시', '포천시', '양주시', '수원시 장안구', '의정부시', '여주시',
    );
    protected static $borough = array(
        '종로구', '중구', '용산구', '성동구', '광진구', '동대문구', '중랑구', '성북구', '강북구', '도봉구', '노원구', '은평구', '서대문구',
        '마포구', '양천구', '강서구', '구로구', '금천구', '영등포구', '동작구', '관악구', '서초구', '강남구', '송파구', '강동구',
        '동구', '서구', '남구', '북구', '중구',
    );
    protected static $streetName = array(
        '압구정로', '도산대로', '학동로', '봉은사로', '테헤란로', '역삼로', '논현로', '언주로', '강남대로', '양재천로', '삼성로', '영동대로',
        '개포로', '선릉로', '반포대로', '서초중앙로', '서초대로', '잠실로', '석촌호수로', '백제고분로', '가락로', '오금로',
    );
    protected static $country = array(
        '가나', '가봉', '가이아나', '감비아', '과테말라', '그레나다', '그리스', '기니', '기니비사우', '나고르노카라바흐 공화국', '나미비아',
        '나우루', '나이지리아', '남수단', '남아프리카 공화국', '남오세티야', '네덜란드', '네팔', '노르웨이', '뉴질랜드', '니제르', '니카라과',
        '대한민국', '덴마크', '도미니카', '도미니카 공화국', '독일', '동티모르', '라오스', '라이베리아', '라트비아', '러시아', '레바논', '레소토',
        '루마니아', '룩셈부르크', '르완다', '리비아', '리투아니아', '리히텐슈타인', '마다가스카르', '마셜 제도', '마케도니아 공화국', '말라위',
        '말레이시아', '말리', '멕시코', '모나코', '모로코', '모리셔스', '모리타니', '모잠비크', '몬테네그로', '몰도바', '몰디브', '몰타', '몽골',
        '미국', '미얀마', '미크로네시아 연방', '바누아투', '바레인', '바베이도스', '바티칸', '바하마', '방글라데시', '베냉', '베네수엘라',
        '베트남', '벨기에', '벨라루스', '벨리즈', '보스니아 헤르체고비나', '보츠와나', '볼리비아', '부룬디', '부르키나파소', '부탄', '북키프로스',
        '불가리아', '브라질', '브루나이', '사모아', '사우디아라비아', '사하라 아랍 민주 공화국 (서사하라)', '산마리노', '상투메 프린시페', '세네갈',
        '세르비아', '세이셸', '세인트 루시아', '세인트 키츠 네비스', '세인트빈센트 그레나딘', '소말리아', '소말릴란드 (소말리아 영토)',
        '솔로몬 제도', '수단', '수리남', '스리랑카', '스와질란드', '스웨덴', '스위스', '스페인', '슬로바키아', '슬로베니아', '시리아',
        '시에라리온', '싱가포르', '아랍에미리트', '아르메니아', '아르헨티나', '아이슬란드', '아일랜드', '아제르바이잔', '아프가니스탄', '안도라',
        '알바니아', '알제리', '압하스', '앙골라', '앤티가 바부다', '에리트레아', '에스토니아', '에콰도르', '에티오피아', '엘살바도르', '영국',
        '예멘', '오만', '오스트레일리아', '오스트리아', '온두라스', '요르단', '우간다', '우루과이', '우즈베키스탄', '우크라이나', '이란', '이라크',
        '이스라엘', '이집트', '이탈리아', '인도', '인도네시아', '일본', '자메이카', '잠비아', '적도 기니', '조선민주주의인민공화국', '조지아',
        '중앙아프리카 공화국', '중화민국', '중화인민공화국', '지부티', '짐바브웨', '차드', '체코', '칠레', '카메룬', '카보베르데', '카자흐스탄',
        '카타르', '캄보디아', '캐나다', '케냐', '코모로', '코소보 공화국', '코스타리카', '코트디부아르', '콜롬비아', '콩고 공화국',
        '콩고 민주 공화국', '쿠바', '쿠웨이트', '크로아티아', '키르기스스탄', '키리바시', '키프로스', '타이', '타지키스탄', '탄자니아', '터키',
        '토고', '통가', '투르크메니스탄', '투발루', '튀니지', '트란스니스트리아', '트리니다드 토바고', '파나마', '파라과이', '파키스탄',
        '파푸아 뉴기니', '팔라우', '팔레스타인국', '페루', '포르투갈', '폴란드', '프랑스', '피지', '핀란드', '필리핀', '헝가리',
    );
    protected static $addressFormats = array(
        '{{metropolitanCity}} {{borough}} {{streetName}} {{buildingNumber}}',
        '{{province}} {{city}} {{streetName}} {{buildingNumber}}',
    );

    /**
     * @example '서울특별시'
     */
    public function metropolitanCity()
    {
        return static::randomElement(static::$metropolitanCity);
    }

    /**
     * @example '경기도'
     */
    public static function province()
    {
        return static::randomElement(static::$province);
    }

    /**
     * @example '고양시'
     */
    public function city()
    {
        return static::randomElement(static::$city);
    }

    /**
     * @example '강남구'
     */
    public function borough()
    {
        return static::randomElement(static::$borough);
    }

    /**
     * @example '강남대로'
     */
    public function streetName()
    {
        return static::randomElement(static::$streetName);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops\Exception;

use InvalidArgumentException;
use Serializable;

class Frame implements Serializable
{
    /**
     * @var array
     */
    protected $frame;

    /**
     * @var string
     */
    protected $fileContentsCache;

    /**
     * @var array[]
     */
    protected $comments = [];

    /**
     * @var bool
     */
    protected $application;

    /**
     * @param array[]
     */
    public function __construct(array $frame)
    {
        $this->frame = $frame;
    }

    /**
     * @param  bool        $shortened
     * @return string|null
     */
    public function getFile($shortened = false)
    {
        if (empty($this->frame['file'])) {
            return null;
        }

        $file = $this->frame['file'];

        // Check if this frame occurred within an eval().
        // @todo: This can be made more reliable by checking if we've entered
        // eval() in a previous trace, but will need some more work on the upper
        // trace collector(s).
        if (preg_match('/^(.*)\((\d+)\) : (?:eval\(\)\'d|assert) code$/', $file, $matches)) {
            $file = $this->frame['file'] = $matches[1];
            $this->frame['line'] = (int) $matches[2];
        }

        if ($shortened && is_string($file)) {
            // Replace the part of the path that all frames have in common, and add 'soft hyphens' for smoother line-breaks.
            $dirname = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
            if ($dirname !== '/') {
                $file = str_replace($dirname, "&hellip;", $file);
            }
            $file = str_replace("/", "/&shy;", $file);
        }

        return $file;
    }

    /**
     * @return int|null
     */
    public function getLine()
    {
        return isset($this->frame['line']) ? $this->frame['line'] : null;
    }

    /**
     * @return string|null
     */
    public function getClass()
    {
        return isset($this->frame['class']) ? $this->frame['class'] : null;
    }

    /**
     * @return string|null
     */
    public function getFunction()
    {
        return isset($this->frame['function']) ? $this->frame['function'] : null;
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        return isset($this->frame['args']) ? (array) $this->frame['args'] : [];
    }

    /**
     * Returns the full contents of the file for this frame,
     * if it's known.
     * @return string|null
     */
    public function getFileContents()
    {
        if ($this->fileContentsCache === null && $filePath = $this->getFile()) {
            // Leave the stage early when 'Unknown' is passed
            // this would otherwise raise an exception when
            // open_basedir is enabled.
            if ($filePath === "Unknown") {
                return null;
            }

            // Return null if the file doesn't actually exist.
            if (!is_file($filePath)) {
                return null;
            }

            $this->fileContentsCache = file_get_contents($filePath);
        }

        return $this->fileContentsCache;
    }

    /**
     * Adds a comment to this frame, that can be received and
     * used by other handlers. For example, the PrettyPage handler
     * can attach these comments under the code for each frame.
     *
     * An interesting use for this would be, for example, code analysis
     * & annotations.
     *
     * @param string $comment
     * @param string $context Optional string identifying the origin of the comment
     */
    public function addComment($comment, $context = 'global')
    {
        $this->comments[] = [
            'comment' => $comment,
            'context' => $context,
        ];
    }

    /**
     * Returns all comments for this frame. Optionally allows
     * a filter to only retrieve comments from a specific
     * context.
     *
     * @param  string  $filter
     * @return array[]
     */
    public function getComments($filter = null)
    {
        $comments = $this->comments;

        if ($filter !== null) {
            $comments = array_filter($comments, function ($c) use ($filter) {
                return $c['context'] == $filter;
            });
        }

        return $comments;
    }

    /**
     * Returns the array containing the raw frame data from which
     * this Frame object was built
     *
     * @return array
     */
    public function getRawFrame()
    {
        return $this->frame;
    }

    /**
     * Returns the contents of the file for this frame as an
     * array of lines, and optionally as a clamped range of lines.
     *
     * NOTE: lines are 0-indexed
     *
     * @example
     *     Get all lines for this file
     *     $frame->getFileLines(); // => array( 0 => '<?php', 1 => '...', ...)
     * @example
     *     Get one line for this file, starting at line 10 (zero-indexed, remember!)
     *     $frame->getFileLines(9, 1); // array( 10 => '...', 11 => '...')
     *
     * @throws InvalidArgumentException if $length is less than or equal to 0
     * @param  int                      $start
     * @param  int                      $length
     * @return string[]|null
     */
    public function getFileLines($start = 0, $length = null)
    {
        if (null !== ($contents = $this->getFileContents())) {
            $lines = explode("\n", $contents);

            // Get a subset of lines from $start to $end
            if ($length !== null) {
                $start  = (int) $start;
                $length = (int) $length;
                if ($start < 0) {
                    $start = 0;
                }

                if ($length <= 0) {
                    throw new InvalidArgumentException(
                        "\$length($length) cannot be lower or equal to 0"
                    );
                }

                $lines = array_slice($lines, $start, $length, true);
            }

            return $lines;
        }
    }

    /**
     * Implements the Serializable interface, with special
     * steps to also save the existing comments.
     *
     * @see Serializable::serialize
     * @return string
     */
    public function serialize()
    {
        $frame = $this->frame;
        if (!empty($this->comments)) {
            $frame['_comments'] = $this->comments;
        }

        return serialize($frame);
    }

    /**
     * Unserializes the frame data, while also preserving
     * any existing comment data.
     *
     * @see Serializable::unserialize
     * @param string $serializedFrame
     */
    public function unserialize($serializedFrame)
    {
        $frame = unserialize($serializedFrame);

        if (!empty($frame['_comments'])) {
            $this->comments = $frame['_comments'];
            unset($frame['_comments']);
        }

        $this->frame = $frame;
    }

    /**
     * Compares Frame against one another
     * @param  Frame $frame
     * @return bool
     */
    public function equals(Frame $frame)
    {
        if (!$this->getFile() || $this->getFile() === 'Unknown' || !$this->getLine()) {
            return false;
        }
        return $frame->getFile() === $this->getFile() && $frame->getLine() === $this->getLine();
    }

    /**
     * Returns whether this frame belongs to the application or not.
     *
     * @return boolean
     */
    public function isApplication()
    {
        return $this->application;
    }

    /**
     * Mark as an frame belonging to the application.
     *
     * @param boolean $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class DataProviderTestDoxTest extends TestCase
{
    /**
     * @dataProvider provider
     * @testdox Does something with
     */
    public function testOne(): void
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider provider
     */
    public function testDoesSomethingElseWith(): void
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider placeHolderprovider
     * @testdox ... $value ...
     */
    public function testWithPlaceholders($value): void
    {
        $this->assertTrue(true);
    }

    public function provider()
    {
        return [
            'one' => [1],
            'two' => [2]
        ];
    }

    public function placeHolderprovider(): array
    {
        return [
            'boolean'          => [true],
            'integer'          => [1],
            'float'            => [1.0],
            'string'           => ['string'],
            'array'            => [[1, 2, 3]],
            'object'           => [new \stdClass],
            'stringableObject' => [new class {
                public function __toString()
                {
                    return 'string';
                }
            }],
            'resource'         => [\fopen(__FILE__, 'rb')],
            'null'             => [null]
        ];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util;

use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

class GetoptTest extends TestCase
{
    public function testItIncludeTheLongOptionsAfterTheArgument(): void
    {
        $args = [
            'command',
            'myArgument',
            '--colors',
        ];
        $actual = Getopt::getopt($args, '', ['colors==']);

        $expected = [
            [
                [
                    '--colors',
                    null,
                ],
            ],
            [
                'myArgument',
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testItIncludeTheShortOptionsAfterTheArgument(): void
    {
        $args = [
            'command',
            'myArgument',
            '-v',
        ];
        $actual = Getopt::getopt($args, 'v');

        $expected = [
            [
                [
                    'v',
                    null,
                ],
            ],
            [
                'myArgument',
            ],
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testShortOptionUnrecognizedException(): void
    {
        $args = [
            'command',
            'myArgument',
            '-v',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('unrecognized option -- v');

        Getopt::getopt($args, '');
    }

    public function testShortOptionRequiresAnArgumentException(): void
    {
        $args = [
            'command',
            'myArgument',
            '-f',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('option requires an argument -- f');

        Getopt::getopt($args, 'f:');
    }

    public function testShortOptionHandleAnOptionalValue(): void
    {
        $args = [
            'command',
            'myArgument',
            '-f',
        ];
        $actual   = Getopt::getopt($args, 'f::');
        $expected = [
            [
                [
                    'f',
                    null,
                ],
            ],
            [
                'myArgument',
            ],
        ];
        $this->assertEquals($expected, $actual);
    }

    public function testLongOptionIsAmbiguousException(): void
    {
        $args = [
            'command',
            '--col',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('option --col is ambiguous');

        Getopt::getopt($args, '', ['columns', 'colors']);
    }

    public function testLongOptionUnrecognizedException(): void
    {
        // the exception 'unrecognized option --option' is not thrown
        // if the there are not defined extended options
        $args = [
            'command',
            '--foo',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('unrecognized option --foo');

        Getopt::getopt($args, '', ['colors']);
    }

    public function testLongOptionRequiresAnArgumentException(): void
    {
        $args = [
            'command',
            '--foo',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('option --foo requires an argument');

        Getopt::getopt($args, '', ['foo=']);
    }

    public function testLongOptionDoesNotAllowAnArgumentException(): void
    {
        $args = [
            'command',
            '--foo=bar',
        ];

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("option --foo doesn't allow an argument");

        Getopt::getopt($args, '', ['foo']);
    }

    public function testItHandlesLongParametesWithValues(): void
    {
        $command = 'command parameter-0 --exec parameter-1 --conf config.xml --optn parameter-2 --optn=content-of-o parameter-n';
        $args    = \explode(' ', $command);
        unset($args[0]);
        $expected = [
