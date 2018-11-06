<?php

namespace Faker\Provider\ar_JO;

class Text extends \Faker\Provider\Text
{
    protected static function validStart($word)
    {
        return preg_match('/^\p{Arabic}/u', $word);
    }

    /**
     * License: Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)
     *
     * Title: حي بن يقظان
     * Author: ابن الطفيل
     * Language: Arabic
     *
     * @see https://ar.wikisource.org/wiki/%D8%A7%D8%A8%D9%86_%D8%A7%D9%84%D8%B7%D9%81%D9%8A%D9%84_-_%D8%AD%D9%8A_%D8%A8%D9%86_%D9%8A%D9%82%D8%B8%D8%A7%D9%86
     * @var string
     */
    protected static $baseText = <<<'EOT'
ذكر سلفنا الصالح - رضي الله عنهم - أن جزيرة من جزائر الهند التي تحت خط الاستواء، وهي الجزيرة ال�