<?php

namespace Faker\Provider\cs_CZ;

class Address extends \Faker\Provider\Address
{
    protected static $streetAddressFormats = array(
        '{{streetName}}',
        '{{streetName}} {{buildingNumber}}',
        '{{streetName}} {{buildingNumber}}',
        '{{streetName}} {{buildingNumber}}',
        '{{streetName}} {{buildingNumber}}',
    );

    protected static $addressFormats = array(
        "{{streetAddress}}\n{{region}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}",
        "{{streetAddress}}\n{{postcode}} {{city}}\nČeská republika",
    );

    protected static $buildingNumber = array('%', '%%', '%/%%', '%%/%%', '%/%%%', '%%/%%%');

    protected static $postcode = array('#####', '### ##');

    /**
     * Source: https://cs.wikipedia.org/wiki/Seznam_m%C4%9Bst_v_%C4%8Cesku_podle_po%C4%8Dtu_obyvatel
     */
    protected static $city = array(
        'Brno', 'Břeclav', 'Cheb', 'Chomutov', 'Chrudim', 'Černošice', 'Česká Lípa', 'České Budějovice',
        'Český Těšín', 'Děčín', 'Frýdek-Místek', 'Havlíčkův Brod', 'Havířov', 'Hodonín', 'Hradec Králové',
        'Jablonec nad Nisou', 'Jihlava', 'Karlovy Vary', 'Karviná', 'Kladno', 'Kolín', 'Krnov', 'Kroměříž',
        'Liberec', 'Litoměřice', 'Litvínov', 'Mladá Boleslav', 'Most', 'Nový Jičín', 'Olomouc', 'Opava', 'Orlová',
        'Ostrava', 'Pardubice', 'Plzeň', 'Praha', 'Prostějov', 'Písek', 'Přerov', 'Příbram', 'Sokolov', 'Šumperk',
        'Teplice', 'Trutnov', 'Tábor', 'Třebíč', 'Třinec', 'Uherské Hradiště', 'Ústí nad Labem',
        'Valašské Meziříčí', 'Vsetín', 'Zlín', 'Znojmo',
    );

    /**
     * Source: https://cs.wikipedia.org/wiki/Seznam_st%C3%A1t%C5%AF_sv%C4%9Bta
     */
    protected static $country = array(
        'Afghánistán', 'Albánie', 'Alžírsko', 'Andorra', 'Angola', 'Antigua a Barbuda', 'Argentina',
        'Arménie', 'Austrálie', 'Ázerbájdžán', 'Bahamy', 'Bahrajn', 'Bangladéš', 'Barbados', 'Belgie',
        'Belize', 'Benin', 'Bělorusko', 'Bhútán', 'Bolívie', 'Bosna a Hercegovina', 'Botswana', 'Brazílie',
        'Brunej', 'Bulharsko', 'Burkina Faso', 'Bu