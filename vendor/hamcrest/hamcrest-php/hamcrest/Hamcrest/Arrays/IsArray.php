<?php

namespace Faker\Provider\de_DE;

class Address extends \Faker\Provider\Address
{
    protected static $buildingNumber = array('###', '##', '#', '#/#', '##[abc]', '#[abc]');

    protected static $streetSuffixLong = array(
        'Gasse', 'Platz', 'Ring', 'Straße', 'Weg', 'Allee'
    );
    protected static $streetSuffixShort = array(
        'gasse', 'platz', 'ring', 'straße', 'str.', 'weg', 'allee'
    );

    protected static $postcode = array('#####');

    /**
     * @var array
     * @see https://de.wikipedia.org/wiki/Liste_der_Gro%C3%9F-_und_Mittelst%C3%A4dte_in_Deutschland
     */
    protected static $cityNames = array(
        'Aachen', 'Aalen', 'Achern', 'Achim', 'Ahaus', 'Ahlen', 'Ahrensburg', 'Aichach', 'Albstadt', 'Alfter', 'Alsdorf', 'Altenburg', 'Amberg', 'Andernach', 'Annaberg-Buchholz', 'Ansbach', 'Apolda', 'Arnsberg', 'Arnstadt', 'Aschaffenburg', 'Aschersleben', 'Attendorn', 'Augsburg', 'Aurich',
        'Backnang', 'Bad Harzburg', 'Bad Hersfeld', 'Bad Homburg vor der Höhe', 'Bad Honnef', 'Bad Kissingen', 'Bad Kreuznach', 'Bad Mergentheim', 'Bad Nauheim', 'Bad Neuenahr-Ahrweiler', 'Bad Oeynhausen', 'Bad Oldesloe', 'Bad Rappenau', 'Bad Salzuflen', 'Bad Soden am Taunus', 'Bad Vilbel', 'Bad Waldsee', 'Bad Zwischenahn', 'Baden-Baden', 'Baesweiler', 'Balingen', 'Bamberg', 'Barsinghausen', 'Baunatal', 'Bautzen', 'Bayreuth', 'Beckum', 'Bedburg', 'Bensheim', 'Bergheim', 'Bergisch Gladbach', 'Bergkamen', 'Berlin', 'Bernau bei Berlin', 'Bernburg (Saale)', 'Biberach an der Riß', 'Bielefeld', 'Bietigheim-Bissingen', 'Bingen am Rhein', 'Bitterfeld-Wolfen', 'Blankenburg (Harz)', 'Blankenfelde-Mahlow', 'Blieskastel', 'Böblingen', 'Bocholt', 'Bochum', 'Bonn', 'Borken', 'Bornheim', 'Bottrop', 'Bramsche', 'Brandenburg an der Havel', 'Braunschweig', 'Bremen', 'Bremerhaven', 'Bretten', 'Brilon', 'Bruchköbel', 'Bruchsal', 'Brühl', 'Buchholz in der Nordheide', 'Büdingen', 'Bühl', 'Bünde', 'Büren', 'Burg', 'Burgdorf', 'Burgwedel', 'Butzbach', 'Buxtehude',
        'Calw', 'Castrop-Rauxel', 'Celle',
        'Chemnitz', 'Cloppenburg', 'Coburg', 'Coesfeld', 'Coswig', 'Cottbus', 'Crailsheim', 'Cuxhaven',
        'Dachau', 'Darmstadt', 'Datteln', 'Deggendorf', 'Delbrück', 'Delitzsch', 'Delmenhorst', 'Dessau-Roßlau', 'Detmold', 'Dietzenbach', 'Dillenburg', 'Dillingen/Saar', 'Dinslaken', 'Ditzingen', 'Döbeln', 'Donaueschingen', 'Dormagen', 'Dorsten', 'Dortmund', 'Dreieich', 'Dresden', 'Duderstadt', 'Duisburg', 'Dülmen', 'Düren', 'Düsseldorf',
        'Eberswalde', 'Eckernförde', 'Edewecht', 'Ehingen', 'Einbeck', 'Eisenach', 'Eisenhüttenstadt', 'Eisleben, Lutherstadt', 'Eislingen/Fils', 'Ellwangen (Jagst)', 'Elmshorn', 'Elsdorf', 'Emden', 'Emmendingen', 'Emmerich am Rhein', 'Emsdetten', 'Enger', 'Ennepetal', 'Ennigerloh', 'Eppingen', 'Erding', 'Erftstadt', 'Erfurt', 'Erkelenz', 'Erkrath', 'Erlangen', 'Eschborn', 'Eschweiler', 'Espelkamp', 'Essen', 'Esslingen am Neckar', 'Ettlingen', 'Euskirchen',
        'Falkensee', 'Fellbach', 'Filderstadt', 'Flensburg', 'Flörsheim am Main', 'Forchheim', 'Frankenthal (Pfalz)', 'Frankfurt (Oder)', 'Frankfurt am Main', 'Frechen', 'Freiberg', 'Freiburg im Breisgau', 'Freising', 'Freital', 'Freudenstadt', 'Friedberg', 'Friedberg (Hessen)', 'Friedrichsdorf', 'Friedrichshafen', 'Frieso