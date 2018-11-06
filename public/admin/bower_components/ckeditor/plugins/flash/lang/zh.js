<?php

namespace Faker\Provider\da_DK;

/**
 * @author Antoine Corcy <contact@sbin.dk>
 */
class Address extends \Faker\Provider\Address
{
    /**
     * @var array Danish city suffixes.
     */
    protected static $citySuffix = array(
        'sted', 'bjerg', 'borg', 'rød', 'lund', 'by',
    );

    /**
     * @var array Danish street suffixes.
     */
    protected static $streetSuffix = array(
        'vej', 'gade', 'skov', 'shaven',
    );

    /**
     * @var array Danish street word suffixes.
     */
    protected static $streetSuffixWord = array(
        'Vej', 'Gade', 'Allé', 'Boulevard', 'Plads', 'Have',
    );

    /**
     * @var array Danish building numbers.
     */
    protected static $buildingNumber = array(
        '%##', '%#', '%#', '%', '%', '%', '%?', '% ?',
    );

    /**
     * @var array Danish building level.
     */
    protected static $buildingLevel = array(
        'st.', '%.', '%. sal.',
    );

    /**
     * @var array Danish building sides.
     