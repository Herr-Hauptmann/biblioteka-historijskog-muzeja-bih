<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => "Morate potvrditi :attribute kako bi nastavili.",
    'accepted_if'          => 'Morate potvrditi :attribute ukoliko je :other jednak :value kako bi nastavili.',
    "active_url"           => "Uneseni :attribute nije pravilan URL.",
	"after"                => "Uneseni :attribute mora biti datum nakon :date.",
    'after_or_equal'       => ":Attribute mora biti datum nakon ili jednak :date.",
    "alpha"                => ":Attribute se može sastojati samo od slova.",
	"alpha_dash"           => ":Attribute se može sastojati samo od slova, brojeva i crtica.",
	"alpha_num"            => ":Attribute se može sastojati samo od slova i brojeva.",
	"array"                => ":Attribute mora biti niz.",
	"before"               => ":Attribute mora sadržavati datum prije :date.",
	"between"              => array(
		"numeric"          => "Broj :attribute mora biti između :min i :max.",
		"file"             => "Datoteka :attribute mora imati između :min i :max kilobajta u veličini.",
		"string"           => ":Attribute mora sadržavati između :min i :max znakova.",
		"array"            => "Polje :attribute mora sadržavati između :min i :max objekata.",
	),
	"boolean"              => ":Attribute mora biti logička istina ili neistina.",
	"confirmed"            => "Potvrda unosa :attribute nije tačna.",
    'current_password'     => 'Unesena lozinka nije tačna.',
    "date"                 => "Uneseni :attribute nije pravilan datum.",
    'date_equals'          => 'Uneseni :attribute mora biti :date.',
    "date_format"          => "Uneseni :attribute ne odgovara pravilnom formatu :format.",
    'declined'             => ':Attribute mora biti odbijen.',
    'declined_if'          => ':Attribute mora biti odbijen kada je :other jednak :value.',
    "different"            => ":Attribute i :other moraju se razlikovati.",
	"digits"               => ":Attribute mora sadržavati :digits cifara.",
	"digits_between"       => ":Attribute mora sadržavati između :min i :max cifara.",
    'dimensions'           => ':Attribute nema važeće dimenzije slike.',
    'distinct'             => ':Attribute posjeduje duplikat s istom vrijednosti.',
    'doesnt_end_with'      => ':Attribute ne može završavati s jednom od sljedećih vrijednosti: :values.',
    'doesnt_start_with'    => ':Attribute ne može početi s jednom od sljedećih vrijednosti: :values.',
    "email"                => ":Attribute mora biti pravilna e-mail adresa.",
    'ends_with'            => ':Attribute mora završavati s jednom od sljedećih vrijednosti: :values.',
    'enum'                 => 'Odabrani :attribute nije pravilan.',
    "exists"               => "Odabrani :attribute nije pravilan.",
    'file'                 => ':Attribute mora biti fajl.',
    'filled'               => 'Polje :attribute mora imati vrijednost.',
    'gt'                   => [
        'array'            => ':Attribute mora imati više od :value stavki.',
        'file'             => ':Attribute mora biti veći od :value kilobajti.',
        'numeric'          => ':Attribute mora biti veči od :value.',
        'string'           => ':Attribute mora imati više od :value karaktera.',
    ],
    'gte' => [
        'array'            => ':Attribute mora imati :value ili više stavki.',
        'file'             => ':Attribute mora imati :value ili više kilobajti.',
        'numeric'          => ':Attribute mora biti veći ili jednak od :value.',
        'string'           => ':Attribute mora imati :value ili više karaktera.',
    ],
    "image"                => ":Attribute mora biti slika.",
	"in"                   => "Odabrani :attribute nije dozvoljen.",
    'in_array'             => 'Polje :attribute ne postoji u dozvoljenim vrijednostima: :other.',
    "integer"              => ":Attribute mora biti cijelobrojni broj.",
	"ip"                   => ":Attribute mora biti pravilna IP adresa.",
    'ipv4'                 => ':Attribute mora biti pravilna IPv4 adresa.',
    'ipv6'                 => ':Attribute mora biti pravilna IPv6 adresa.',
    'json'                 => ':Attribute mora biti pravilan JSON string.',
    'lowercase'            => ':Attribute mora sadržavati samo mala slova.',
    'lt' => [
        'array'            => ':Attribute mora imati manje od :value stavki.',
        'file'             => ':Attribute mora biti manji od :value kilobajti.',
        'numeric'          => ':Attribute mora biti manji od :value.',
        'string'           => ':Attribute mora imati manje od :value karaktera.',
    ],
    'lte' => [
        'array'            => ':Attribute ne smije imati više od :value stavki.',
        'file'             => ':Attribute može imati najviše :value kilobajti.',
        'numeric'          => ':Attribute mora biti :value ili manji.',
        'string'           => ':Attribute mora imati :value ili manje karaktera.',
    ],
    'mac_address'          => ':Attribute mora biti ispravna MAC adresa.',
    "max"                  => array(
		"numeric"          => ":Attribute nesmije biti veće od :max.",
		"file"             => "Datoteka :attribute nesmije biti veća od :max kilobajta.",
		"string"           => ":attribute nesmije sadržavati više od :max slova.",
		"array"            => "Polje :attribute nesmije sadržavati više od :max objekata.",
	),
    'max_digits'           => ':Attribute ne smije imati više od :max cifara.',
    "mimes"                => ":Attribute mora biti tipa: :values.",
    'mimetypes'            => ':Attribute mora biti jednog od sljedećih tipova: :values.',
    "min"                  => array(
		"numeric"          => ":Attribute mora biti veći od :min.",
		"file"             => "Datoteka :attribute mora biti veća od :min kilobajta.",
		"string"           => ":Attribute mora sadržavati barem :min slova.",
		"array"            => "Polje :attribute mora sadržavati barem :min objekata.",
	),
    'min_digits'           => ':Attribute mora imati najmanje :min cifara.',
    'multiple_of'          => ':Attribute mora biti faktor broja :value.',
    "not_in"               => "Odabrani :attribute nije dozvoljen.",
    'not_regex'            => 'Uneseni format polja :attribute nije dozvoljen.',
    "numeric"              => ":Attribute mora sadržavati broj.",
    'password' => [
        'letters'          => ':Attribute mora sadržavati najmanje jedno slovo.',
        'mixed'            => ':Attribute mora sadržavati najmanje jedno veliko ijedno malo slovo.',
        'numbers'          => ':Attribute mora sadržavati najmanje jedan broj.',
        'symbols'          => ':Attribute mora sadržavati najmanje jedan simbol.',
        'uncompromised'    => 'Unesena :attribute se pojavila u curenju podataka. Molimo unesite neku drugu vrijednost za polje :attribute.',
    ],
    'present'              => 'Polje :attribute ne smije biti prisutno.',
    'prohibited'           => 'Polje :attribute je zabranjeno.',
    'prohibited_if'        => 'Polje :attribute je zabranjeno kada je :other jednak :value.',
    'prohibited_unless'    => 'Polje :attribute je zabranjeno osim kada je :other jedno od sljedećih: :values.',
    'prohibits'            => 'Polje :attribute zabranjuje :other.',
    "regex"                => "Format :attribute nije tačan.",
    "required"             => "Polje :attribute je obavezno.",
    'required_array_keys'  => 'Polje :attribute mora imati unose za: :values.',
    "required_if"          => "Polje :attribute je obavezno kada je :other :value.",
    'required_if_accepted' => 'Polje :attribute je obavezno kada je :other prihvaćeno.',
    'required_unless'      => 'Polje :attribute je obavezno osim kada :other ima jednu od sljedećih vrijednosti: :values.',
    "required_with"        => "Polje :attribute je obavezno kada su :values prisutni.",
    "required_with_all"    => "Polje :attribute je obavezno kada su :values prisutni.",
	"required_without"     => "Polje :attribute je obavezno kada :values nisu prisutni.",
	"required_without_all" => "Polje :attribute je obavezno kad nijedan od :values nisu prisutni.",
    "same"                 => "Sadržaji polja :attribute i :other moraju biti isti.",
    "size"                 => array(
		"numeric"          => ":Attribute mora sadržavati :size cifara.",
		"file"             => "Datoteka :attribute mora imati :size kilobajta u veličini.",
		"string"           => ":Attribute mora sadržavati :size slova.",
		"array"            => "Polje :attribute mora sadržavati :size objekata.",
	),
    'starts_with'          => ':Attribute mora početi s jednom od sljedećih vrijednosti: :values.',
    'string'               => ':Attribute mora biti string.',
    "timezone"             => ":Attribute nije pravilna vremenska zona.",
    "unique"               => "Uneseno :attribute je već zauzeto.",
    'uploaded'             => ':Attribute nije uspješno prenesen.',
    'uppercase'            => ':Attribute mora sadržavati samo velika slova.',
    "url"                  => "Uneseni :attribute nije pravilnog formata.",
    'uuid'                 => ':Attribute mora biti pravilan UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
