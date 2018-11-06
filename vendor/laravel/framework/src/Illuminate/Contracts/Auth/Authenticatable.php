<?php

namespace Faker\Provider;

class Person extends Base
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    protected static $titleFormat = array(
      '{{titleMale}}',
      '{{titleFemale}}',
    );

    protected static $firstNameFormat = array(
      '{{firstNameMale}}',
      '{{firstNameFemale}}',
    );

    protected static $maleNameFormats = array(
        '{{firstNameMale}} {{lastName}}',
    );

    protected static $femaleNameFormats = array(
        '{{firstNameFemale}} {{lastName}}',
    );

    protected static $firstNameMale = array(
        'John',
    );

    protected static $firstNameFemale = array(
        'Jane',
    );

    protected static $lastName = array('Doe');

    protected static $titleMale = array('Mr.', 'Dr.', 'Prof.');

    protected static $titleFemale = array('Mrs.', 'Ms.', 'Miss', 'Dr.', 'Prof.');

    /**
     * @param string|null $gender 'male', 'female' or null for an