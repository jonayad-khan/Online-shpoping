\Caster\SplCaster', 'castObjectStorage'),
        'SplPriorityQueue' => array('Symfony\Component\VarDumper\Caster\SplCaster', 'castHeap'),
        'OuterIterator' => array('Symfony\Component\VarDumper\Caster\SplCaster', 'castOuterIterator'),

        'Redis' => array('Symfony\Component\VarDumper\Caster\RedisCaster', 'castRedis'),
        'RedisArray' => array('Symfony\Component\VarDumper\Caster\RedisCaster', 'castRedisArray'),

        'DateTimeInterface' => array('Symfony\Component\VarDumper\Caster\DateCaster', 'castDateTime'),
        'DateInterval' => array('Symfony\Component\VarDumper\Caster\DateCaster', 'castInterval'),
        'DateTimeZone' => array('Symfony\Component\VarDumper\Caster\DateCaster', 'castTimeZone'),
        'DatePeriod' => array('Symfony\Component\VarDumper\Caster\DateCaster', 'castPeriod'),

        'GMP' => array('Symfony\Component\VarDumper\Caster\GmpCaster', 'castGmp'),

        ':curl' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castCurl'),
        ':dba' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castDba'),
        ':dba persistent' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castDba'),
        ':gd' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castGd'),
        ':mysql link' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castMysqlLink'),
        ':pgsql large object' => array('Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLargeObject'),
        ':pgsql link' => array('Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLink'),
        ':pgsql link persistent' => array('Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLink'),
        ':pgsql result' => array('Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castResult'),
        ':process' => array('Symfony\Component\VarDumper\Caster\ResourceCaster', 'castProcess'),