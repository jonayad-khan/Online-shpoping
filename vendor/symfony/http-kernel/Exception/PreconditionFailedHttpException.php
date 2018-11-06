= Caster::PREFIX_VIRTUAL;

        foreach ($map as $key => $accessor) {
            try {
                $a[$prefix.$key] = $c->$accessor();
            } catch (\Exception $e) {
            }
        }

        if (isset($a[$prefix.'flags'])) {
            $flagsArray = array();
            foreach (self::$splFileObjectFlags as $value => $name) {
                if ($a[$prefix.'flags'] & $value) {
                    $flagsArray[] = $name;
                }
            }
            $a[$prefix.'flags'] = new ConstStub(implode('|', $flagsArray), $a[$prefix.'flags']);
        }

        if (isset($a[$prefix.'fstat'])) {
            $a[$prefix.'fstat'] = new CutArrayStub($a[$prefix.'fstat'], array('dev', 'ino', 'nlink', 'rdev', 'blksize', 'blocks'));
        }

      