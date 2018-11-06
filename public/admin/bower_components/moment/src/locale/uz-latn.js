<?php

namespace Faker\Provider\uk_UA;

class Company extends \Faker\Provider\Company
{
    protected static $formats = array(
        '{{companyName}}',                                      // Вектор
        '{{companyPrefix}} "{{companyName}}"',                  // ТОВ "Інфоком"
        '{{companyName}}-{{companySuffix}}',                    // Сервіс-Плюс
        '{{companyPrefix}} "{{companyName}}-{{companySuffix}}"',// ПАТ "Альфа-Стиль"
    );

    protected static $urlFormats = array(
        '{{companyName}}',
        '{{companyName}}-{{companySuffix}}',
    );

    protected static $companyPrefix = array('ТОВ', 'ПП', 'ПАТ','ПрАТ');
    protected static $companySuffix = array('Сервіс','Плюс', 'Груп', 'Стиль', 'Дизайн');

    protected static $companyName = array(
        'Вектор', 'Едельвейс', 'Смарт', 'Альфа', 'Система', 'Універсал',
        'Інфоком', 'Макс', 'Планета', 'Вектор', 'Приват', 'Еко', 'Мега',
        'Мегамакс', 'Мульти', 'Майнер'
    );

    /**
     * @see list of Ukraine job title (2017-08-09), source: https://uk.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D0%BF%D1%80%D0%BE%D1%84%D0%B5%D1%81%D1%96%D0%B9
     */
    protected static $jobTitleFormat = array(
        'Агроном', 'Адвокат', 'Актор', 'Акушер', 'Антрополог', 'Аптекар', 'Архітектор', 'Археолог', 'Астронавт', 'Астрофізик', 'Автос�