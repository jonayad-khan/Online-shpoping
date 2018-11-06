<?php

namespace Faker\Provider\ar_SA;

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
ذكر سلفنا الصالح - رضي الله عنهم - أن جزيرة من جزائر الهند التي تحت خط الاستواء، وهي الجزيرة التي يتولد بها الإنسان من غير أم ولا أب، وبها شجر يثمر نساء، وهي التي ذكر المسعودي أنها جزيرة الوقواق لان تلك الجزيرة اعدل بقاع الأرض هواء؛ أتممها لشروق النور الأعلى عليها استعدادً، وان كان ذلك خلاف ما يراه جمهور الفلاسفة وكبار الأطباء، فانهم يرون إن اعدل ما في المعمورة الإقليم الرابع، فان كانوا قالوا ذلك لأنه صح عندهم انه ليس على خط الاستواء عمارة لمانع من الموانع الأرضية، فلقولهم: أن الإقليم الر�