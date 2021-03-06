カマツ', 'ワタナベ',
    );

    /**
     * @param string|null $gender 'male', 'female' or null for any
     * @return string
     * @example 'アオタ アキラ'
     */
    public function kanaName($gender = null)
    {
        if ($gender === static::GENDER_MALE) {
            $format = static::randomElement(static::$maleKanaNameFormats);
        } elseif ($gender === static::GENDER_FEMALE) {
            $format = static::randomElement(static::$femaleKanaNameFormats);
        } else {
            $format = static::randomElement(array_merge(static::$maleKanaNameFormats, static::$femaleKanaNameFormats));
        }

        return $this->generator->parse($format);
    }

    /**
     * @param string|null $gender 'male', 'female' or null for any
     * @return string
     * @example 'アキラ'
     */
    public function firstKanaName($gender = null)
    {
        if ($gender === static::GENDER_MALE) {
            return static::firstKanaNameMale();
        } elseif ($gender === static::GENDER_FEMALE) {
            return static::firstKanaNameFemale();
        }

        return $this->generator->parse(static::randomElement(static::$firstKanaNameFormat));
    }

    /**
     * @example 'アキラ'
     */
    public static function firstKanaNameMale()
    {
        return static::randomElement(static::$firstKanaNameMale);
    }

    /**
     * @example 'アケミ'
     */
    public static function firstKanaNameFemale()
    {
        return static::randomElement(static::$firstKanaNameFemale);
    }

    /**
     * @example 'アオタ'
     */
    public static function lastKanaName()
    {
        return static::randomElement(static::$lastKanaName);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?xml version="1.0" encoding="UTF-8"?>
<project name="Tokenizer" default="setup">
    <target name="setup" depends="clean,install-tools,generate-autoloader