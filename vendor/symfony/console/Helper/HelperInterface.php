<?php

namespace Faker\Provider\de_CH;

class Address extends \Faker\Provider\Address
{
    protected static $buildingNumber = array('###', '##', '#', '##[abc]', '#[abc]');

    protected static $streetSuffixLong = array(
        'Gasse', 'Platz', 'Ring', 'Strasse', 'Weg', 'Allee'
    );
    protected static $streetSuffixShort = array(
        'gasse', 'platz', 'ring', 'strasse', 'str.', 'weg', 'allee'
    );

    protected static $postcode = array('####');

    /**
     * @link https://de.wikipedia.org/wiki/Liste_der_St%C3%A4dte_in_der_Schweiz
     */
    protected static $cityNames = array(
        'Aarau', 'Aarberg', 'Aarburg', 'Adliswil', 'Aesch', 'Affoltern am Albis', 'Agno', 'Aigle', 'Allschwil', 'Altdorf', 'Altstätten', 'Amriswil', 'Appenzell', 'Arbon', 'Arth', 'Ascona', 'Aubonne', 'Avenches',
        'Baar', 'Bad Zurzach', 'Baden', 'Basel', 'Bassersdorf', 'Bellinzona', 'Belp', 'Bern', 'Beromünster', 'Biasca', 'Biel/Bien