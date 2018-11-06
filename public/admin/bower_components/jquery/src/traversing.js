eychely', 'Sierra Leone', 'Singapur',
        'Slovensko', 'Slovinsko', 'Somálsko', 'Spojené arabské emiráty', 'Spojené království', 'Spojené státy americké',
        'Srbsko', 'Středoafrická republika', 'Surinam', 'Súdán', 'Svatá Lucie', 'Svatý Kryštof a Nevis',
        'Svatý Tomáš a Princův ostrov', 'Svatý Vincenc a Grenadiny', 'Svazijsko', 'Sýrie', 'Šalamounovy ostrovy',
        'Španělsko', 'Šrí Lanka', 'Švédsko', 'Švýcarsko', 'Tádžikistán', 'Tanzanie', 'Thajsko', 'Togo', 'Tonga',
        'Trinidad a Tobago', 'Tunisko', 'Turecko', 'Turkmenistán', 'Tuvalu', 'Uganda', 'Ukrajina', 'Uruguay',
        'Uzbekistán', 'Vanuatu', 'Vatikán', 'Venezuela', 'Vietnam', 'Východní Timor', 'Zambie', 'Zimbabwe',
    );

    /**
     * Source: https://cs.wikipedia.org/wiki/Kraje_v_%C4%8Cesku#Ekonomika
     */
    private static $regions = array(
        'Hlavní město Praha', 'Jihomoravský kraj', 'Jihočeský kraj', 'Karlovarský kraj', 'Královéhradecký kraj',
        'Liberecký kraj', 'Moravskoslezský kraj', 'Olomoucký kraj', 'Pardubický kraj', 'Plzeňský kraj',
        'Středočeský kraj', 'Vysočina', 'Zlínský kraj', 'Ústecký kraj',
    );

    /**
     * Source: http://aplikace.mvcr.cz/adresy/
     */
    protected static $street = array(
        'Alžírská', 'Angelovova', 'Antonínská', 'Arménská', 'Čelkovická', 'Červenkova', 'Československého exilu',
        'Chlumínská', 'Chládkova', 'Diskařská', 'Do Kopečka', 'Do Vozovny', 'Do Vršku', 'Doubravická', 'Doudova',
        'Drahotínská', 'Dělnická', 'Generála Šišky', 'Gončarenkova', 'Gutova', 'Havlínova', 'Havraní', 'Helmova',
        'Hečkova', 'Holubinková', 'Holínská', 'Horní Hrdlořezská', 'Horní Stromky', 'Hostivařské nám.', 'Houbařská',
        'Hořanská', 'Hrachovská', 'Hrad III. nádvoří', 'Hrdlořezská', 'Jenská', 'Jerevanská', 'Ježovická', 'K Březince',
        'K Dobré Vodě', 'K Hořavce', 'K Hrušovu', 'K Háji', 'K Návsi', 'K Padesátníku', 'K Pyramidce', 'K Samotě',
        'K Vinici', 'K Vystrkovu', 'Karlovarská', 'Karlínské nám.', 'Kaňkova', 'Ke Kyjovu', 'Ke Stadionu', 'Kejnická',
        'Klatovská', 'Kohoutových', 'Kopanská', 'Kralupská', 'Kukelská', 'Kukučínova', 'Kunešova', 'Kvestorská',
        'Křišťanova', 'Lanžhotská', 'Leštínská', 'Lindavská', 'Litevská', 'Lojovická', 'Lukešova', 'Maltézské náměstí',
        'Melodická', 'Mečíková', 'Milady Horákové', 'Mšenská', 'N. A. Někrasova', 'Na Dědince', 'Na Habrové',
        'Na Jezerce', 'Na Jílech', 'Na Petynce', 'Na Rozcestí', 'Na Sedlišti', 'Na Vrchu', 'Na Výšině', 'Na Úbočí',
        'Na Štamberku', 'Nad Hliníkem', 'Nad Hřištěm', 'Nad Klikovkou', 'Nad libeňským nádražím', 'Nad Nuslemi',
        'Nad Slávií', 'Nad Trnkovem', 'Nad Šauerovými sady', 'Netřebská', 'Nivnická', 'Nádražní', 'nám. Pod Lípou',
        'nám. Před bateriemi', 'nám. Svatopluka Čecha', 'Odlehlá', 'Okrasná', 'Omská', 'Otavova', 'Oválová',
        'Palackého nám.', 'Pavlišovská', 'Paškova', 'Petřínské sady', 'Pilovská', 'Pod Bruskou', 'Pod novou školou',
        'Pod soutratím', 'Pod Svahem', 'Pod Útesy', 'Pohledná', 'Pošepného nám.', 'Prokopových', 'Pávovské náměstí',
        'Pětipeského', 'Příbramská', 'Radbuzská', 'Radnické schody', 'Raichlova', 'Roentgenova', 'Rozkošného',
        'Rozrazilová', 'Ruzyňská', 'Římovská', 'Říční', 'Satalická', 'Schoellerova', 'Smrková', 'Souvratní', 'Sovova',
        'Sportovní', 'Stadionová', 'Statková', 'Stavební', 'Široká', 'Školní', 'Tatranská', 'Tomsova', 'Toruňská',
        'Točenská', 'Trnkovo náměstí', 'Truhlářova', 'Tvrdonická', 'Týmlova', 'U Beránky', 'U Chmelnice',
        'U Chodovského hřbitova', 'U Drážky', 'U Fořta', 'U Kamýku', 'U Klubovny', 'U Lesa', 'U Pekáren',
        'U Prašné brány', 'U Prádelny', 'U Silnice', 'U Sladovny', 'U Slovanky', 'U Soutoku', 'U Trojice', 'U Vinice',
        'U vinných sklepů', 'U Vodárny', 'U Vorlíků', 'U zeleného ptáka', 'U Čekárny', 'U Županských', 'Ukrajinská',
        'Újezdská', 'V Jámě', 'V Předním Hloubětíně', 'V Rohu', 'V Uličce', 'Valčíkova', 'Ve Lhotce', 'Ve Vrších',
        'Velenická', 'Violková', 'Vlašská', 'Voděradská', 'Vyderská', 'Vysokoškolská', 'Výpadová', 'Vřesovická',
        'Za Pekárnou', 'Zámecká',
    );

    /**
     * Randomly returns a czech city.
     *
     * @example '