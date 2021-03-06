    $this->generator->getClassMethods($this->type),
                $this->methodsExcept
            )
        );

        return $this;
    }

    /**
     * Specifies the arguments for the constructor.
     *
     * @param array $args
     *
     * @return MockBuilder
     */
    public function setConstructorArgs(array $args)
    {
        $this->constructorArgs = $args;

        return $this;
    }

    /**
     * Specifies the name for the mock class.
     *
     * @param string $name
     *
     * @return MockBuilder
     */
    public function setMockClassName($name)
    {
        $this->mockClassName = $name;

        return $this;
    }

    /**
     * Disables the invocation of the original constructor.
     *
     * @return MockBuilder
     */
    public function disableOriginalConstructor()
    {
        $this->originalConstructor = false;

        return $this;
    }

    /**
     * Enables the invocation of the original constructor.
     *
     * @return MockBuilder
     */
    public function enableOriginalConstructor()
    {
        $this->originalConstructor = true;

        return $this;
    }

    /**
     * Disables the invocation of the original clone constructor.
     *
     * @return MockBuilder
     */
    public function disableOriginalClone()
    {
        $this->originalClone = false;

        return $this;
    }

    /**
     * Enables the invocation of the original clone constructor.
     *
     * @return MockBuilder
     */
    public function enableOriginalClone()
    {
        $this->originalClone = true;

        return $this;
    }

    /**
     * Disables the use of class autoloading while creating the mock object.
     *
     * @return MockBuilder
     */
    public function disableAutoload()
    {
        $this->autoload = false;

        return $this;
    }

    /**
     * Enables the use of class autoloading while creating the mock object.
     *
     * @return MockBuilder
     */
    public function enableAutoload()
    {
        $this->autoload = true;

        return $this;
    }

    /**
     * Disables the cloning of arguments passed to mocked methods.
     *
     * @return MockBuilder
     */
    public function disableArgumentCloning()
    {
        $this->cloneArguments = false;

        return $this;
    }

    /**
     * Enables the cloning of arguments passed to mocked methods.
     *
     * @return MockBuilder
     */
    public function enableArgumentCloning()
    {
        $this->cloneArguments = true;

        return $this;
    }

    /**
     * Enables the invocation of the original methods.
     *
     * @return MockBuilder
     */
    public function enableProxyingToOriginalMethods()
    {
        $this->callOriginalMethods = true;

        return $this;
    }

    /**
     * Disables the invocation of the original methods.
     *
     * @return MockBuilder
     */
    public function disableProxyingToOriginalMethods()
    {
        $this->callOriginalMethods = false;
        $this->proxyTarget         = null;

        return $this;
    }

    /**
     * Sets the proxy target.
     *
     * @param object $object
     *
     * @return MockBuilder
     */
    public function setProxyTarget($object)
    {
        $this->proxyTarget = $object;

        return $this;
    }

    /**
     * @return MockBuilder
     */
    public function allowMockingUnknownTypes()
    {
        $this->allowMockingUnknownTypes = true;

        return $this;
    }

    /**
     * @return MockBuilder
     */
    public function disallowMockingUnknownTypes()
    {
        $this->allowMockingUnknownTypes = false;

        return $this;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Faker\Provider\sr_RS;

class Person extends \Faker\Provider\Person
{
    /**
     *
     * @link http://sr.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%B0%D0%BA_%D1%81%D1%80%D0%BF%D1%81%D0%BA%D0%B8%D1%85_%D0%B8%D0%BC%D0%B5%D0%BD%D0%B0
     */
    protected static $firstNameMale = array(
        'Александар', 'Бобан', 'Бранислав', 'Владимир', 'Владислав', 'Горан', 'Далибор', 'Данило', 'Дејан', 'Драган', 'Душан',
        'Живко', 'Зоран', 'Иван', 'Иво', 'Константин', 'Лука', 'Максим', 'Мартин', 'Милан', 'Милко', 'Милош', 'Мирослав', 'Миша',
        'Раде', 'Саша', 'Слободан', 'Срђан', 'Станислав', 'Филип', 'Ђенадије', 'Ђоко', 'Ђорђе', 'Ђорђије', 'Ђорђо',  'Ђукан',
        'Ђура', 'Ђурашин', 'Ђурађ', 'Ђурисав', 'Ђурица', 'Ђурко', 'Ђуро', 'Ђурђе', 'Јаблан', 'Јаворко', 'Јагош', 'Јадранко',
        'Јаков', 'Јакша', 'Јандре', 'Јандрија', 'Јанићије', 'Јанко', 'Јанча', 'Јарослав', 'Јасен', 'Јасенко', 'Јеврем', 'Јевта',
        'Јевтан', 'Јевтимије', 'Јевто', 'Језда', 'Јездимир', 'Јелашин', 'Јелен', 'Јеленко', 'Јелисије', 'Јеремија', 'Јерко',
        'Јеротије', 'Јеша', 'Јова', 'Јован', 'Јовица', 'Јовиша', 'Јовко', 'Јово', 'Јоко', 'Јоксим', 'Јордан','Јосиф', 'Југомир',
        'Југослав', 'Југољуб', 'Јулијан', 'Јуноша', 'Јуриша', 'Јустин', 'Љиљан', 'Љубан', 'Љубен', 'Љубенко', 'Љубивоје',
        'Љубинко', 'Љубисав', 'Љубислав', 'Љубиша', 'Љубо', 'Љубобрат', 'Љубодраг', 'Љубомир', 'Љубоја', 'Љубоје','Његомир',
        'Његош', 'Ћира', 'Ћирило', 'Ћирко', 'Ћиро', 'Ћирјак', 'Авакум', 'Аврам', 'Адам', 'Аксентије', 'Алекса', 'Александрон',
        'Алексеј', 'Алексије', 'Алимпије', 'Андреј', 'Андреја', 'Андрија', 'Андријаш', 'Антоније', 'Анђелко', 'Аранђел', 'Арса',
        'Арсен', 'Арсеније', 'Арсо', 'Атанасије', 'Атанацко', 'Аћим', 'Балша', 'Бане', 'Батрић', 'Бајко', 'Бајо', 'Бајчета',
        'Берисав', 'Берислав', 'Бериша', 'Берко','Бисерко', 'Биљан', 'Благомир', 'Благота', 'Благојa', 'Благоје', 'Блажа',
        'Блажен', 'Блажо', 'Блашко', 'Богдан', 'Богељ', 'Богиш