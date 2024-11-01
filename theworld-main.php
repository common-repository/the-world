<?php
class TheWorld {
  var $validCodeList = '';
  var $hasBeenColour = '';
  var $notBeenColour = '';
  var $BGColour = '';

  function __construct() {
    $this->loadData();
  }

  function loadData(){
    if ( get_option('theworld_Colour_has_been') == "" )
      update_option('theworld_Colour_has_been', 'FF0000');
    if ( get_option('theworld_Colour_not_been') == "" )
      update_option('theworld_Colour_not_been', '999999');
    if ( get_option('theworld_Colour_BG') == "" )
      update_option('theworld_Colour_BG', 'FFFFFF');

    $this->setValidCodeList(get_option('theworld_select'));
    $this->setHasBeenColour(get_option('theworld_Colour_has_been'));
    $this->setNotBeenColour(get_option('theworld_Colour_not_been'));
    $this->setBGColour(get_option('theworld_Colour_BG'));
  }

  function setValidCodeList($data){
    $this->validCodeList = $data;
  }

  function setHasBeenColour($data){
    $this->hasBeenColour = $data;
  }

  function setNotBeenColour($data){
    $this->notBeenColour = $data;
  }

  function setBGColour($data){
    $this->BGColour = $data;
  }

  function getHasBeenColour(){
    return $this->hasBeenColour;
  }

  function getNotBeenColour(){
    return $this->notBeenColour;
  }

  function getBGColour(){
    return $this->BGColour;
  }

  function getCountryNum(){
    return count(explode("|", $this->validCodeList));
  }

  function chartImg(){
    $params = self::$chartDafault;
    $params["chld"] = $this->validCodeList;
    $params["chco"] = "$this->notBeenColour|$this->hasBeenColour";
    $params["chf"] = "bg,s,$this->BGColour";
    $url = $this->chartURL($params);
    return "<img src='$url' style='width:100%; height:auto;'>";
  }

  function chartURL($data) {
    $baseURL = "http://chart.apis.google.com/chart?";
    $params = array();
    while(list ($key, $val) = each($data)) {
      array_push ($params, htmlspecialchars($key)."=".htmlspecialchars($val));
    }
    return $baseURL . implode("&", $params);
  }

  function country_inputs($codes){
    $inputs = array();
    foreach( $codes as $code ){
      $inputs[] = $this->echo_country_input($code);
    }
    return (implode(" | ", $inputs));
  }

  function echo_country_input($cd) {
    $pos = strpos( $this->validCodeList, $cd );
    $countryName = self::$codeList[$cd];
    $checked = $pos === false ? "" : "checked='checked'";
    return "<input type='checkbox' name='country[]' value='$cd' id='checkbox_$cd' $checked> <label for='checkbox_$cd'>$countryName</label>";
  }

  function codeMap() {
    return self::$codeMap;
  }

  private static $chartDafault = array(
    'cht' => 'map:fixed=-60,-180,80,180',
    'chs' => '750x400',
    'chco' => '999999|FF0000',
    'chf' => 'FFFFFF',
    'chld' => ''
  );

  private static $codeMap = array(
    "North America" => array( "CA", "GL", "US", "MX" ),
    "Central America and The Caribbean" => array( "AI", "AG", "AW", "BB", "BS", "BZ", "BM", "VG", "KY", "CR", "CU", "DM", "DO", "SV", "GP", "GT", "GD", "HT", "HN", "JM", "MQ", "MS", "AN", "NI", "PA", "PR", "KN", "LC", "VC", "TC", "TT", "VI" ),
    "South America" => array( "AR", "BO", "BR", "CL", "CO", "EC", "FK", "GF", "GY", "PY", "PE", "SR", "UY", "VE"),
    "Africa" => array( "DZ", "AO", "BJ", "BW", "BF", "BI", "CM", "CV", "CF", "TD", "KM", "CG", "CD", "DJ", "EG", "GQ", "ER", "ET", "GA", "GM", "GH", "GW", "GN", "CI", "KE", "LS", "LR", "LY", "MG", "MW", "ML",  "MR", "MU", "MA", "MZ", "NA", "NE", "NG", "RE", "RW", "ST", "SN", "SC", "SL", "SO", "ZA", "SD", "SZ", "TZ", "TG", "TN", "UG", "EH", "ZM", "ZW" ),
    "Europe" => array( "AL", "AD", "AM", "AT", "AZ", "BY", "BE", "BA", "BG", "HR", "CZ", "DK", "EE", "FO", "FI", "FR", "GE", "DE", "GI", "GR", "HU", "IS", "IE", "IT", "YK", "LV", "LI", "LT", "LU", "MK", "MT", "MD", "MC", "ME", "NL", "NO", "PL", "PT", "RO", "RU", "SM", "RS", "SK", "SI", "ES", "SE", "CH", "UA", "GB", "VA" ),
    "Middle East" => array( "BH", "CY", "IR", "IQ", "IL", "JO", "KW", "LB", "OM", "PS", "QA", "SA", "SY", "TR", "AE", "YE"),
    "Asia" => array( "AF", "BD", "BT", "BN", "KH", "CN", "TP", "HK", "IN", "ID", "JP", "KZ", "KG","LA", "MO", "MY", "MV", "MN", "MM", "NP", "KP", "PK", "PH", "SG", "LK", "KR", "TW", "TJ", "TH", "TM", "UZ", "VN"),
    "Australia and Pacific" => array( "AS", "AU", "CK", "FJ", "PF", "GU", "KI", "MH", "FM", "NR", "NC", "NZ", "NU", "NF", "MP", "PW", "PG", "PN", "WS", "SB", "TO", "TV", "VU" )
  );

  private static $codeList = array(
    "AD" => "Andorra",
    "AE" => "United Arab Emirates",
    "AF" => "Afghanistan",
    "AG" => "Antigua and Barbuda",
    "AI" => "Anguilla",
    "AL" => "Albania",
    "AM" => "Armenia",
    "AO" => "Angola",
    "AQ" => "Antarctica",
    "AR" => "Argentina",
    "AS" => "American Samoa",
    "AT" => "Austria",
    "AU" => "Australia",
    "AW" => "Aruba",
    "AX" => "Åland Islands",
    "AZ" => "Azerbaijan",
    "BA" => "Bosnia and Herzegovina",
    "BB" => "Barbados",
    "BD" => "Bangladesh",
    "BE" => "Belgium",
    "BF" => "Burkina Faso",
    "BG" => "Bulgaria",
    "BH" => "Bahrain",
    "BI" => "Burundi",
    "BJ" => "Benin",
    "BL" => "Saint Barthélemy",
    "BM" => "Bermuda",
    "BN" => "Brunei Darussalam",
    "BO" => "Bolivia",
    "BQ" => "Bonaire, Sint Eustatius and Saba",
    "BR" => "Brazil",
    "BS" => "Bahamas",
    "BT" => "Bhutan",
    "BV" => "Bouvet Island",
    "BW" => "Botswana",
    "BY" => "Belarus",
    "BZ" => "Belize",
    "CA" => "Canada",
    "CC" => "Cocos (Keeling) Islands",
    "CD" => "Congo Kinshasa",
    "CF" => "Central African Republic",
    "CG" => "Congo Brazzaville",
    "CH" => "Switzerland",
    "CI" => "Ivory Coast",
    "CK" => "Cook Islands",
    "CL" => "Chile",
    "CM" => "Cameroon",
    "CN" => "China",
    "CO" => "Colombia",
    "CR" => "Costa Rica",
    "CU" => "Cuba",
    "CV" => "Cape Verde",
    "CW" => "Curaçao",
    "CX" => "Christmas Island",
    "CY" => "Cyprus",
    "CZ" => "Czech Republic",
    "DE" => "Germany",
    "DJ" => "Djibouti",
    "DK" => "Denmark",
    "DM" => "Dominica",
    "DO" => "Dominican Republic",
    "DZ" => "Algeria",
    "EC" => "Ecuador",
    "EE" => "Estonia",
    "EG" => "Egypt",
    "EH" => "Western Sahara",
    "ER" => "Eritrea",
    "ES" => "Spain",
    "ET" => "Ethiopia",
    "FI" => "Finland",
    "FJ" => "Fiji",
    "FK" => "Falkland Islands (Malvinas)",
    "FM" => "Micronesia",
    "FO" => "Faroe Islands",
    "FR" => "France",
    "GA" => "Gabon",
    "GB" => "United Kingdom",
    "GD" => "Grenada",
    "GE" => "Georgia",
    "GF" => "French Guiana",
    "GG" => "Guernsey",
    "GH" => "Ghana",
    "GI" => "Gibraltar",
    "GL" => "Greenland",
    "GM" => "Gambia",
    "GN" => "Guinea",
    "GP" => "Guadeloupe",
    "GQ" => "Equatorial Guinea",
    "GR" => "Greece",
    "GS" => "South Georgia and the South Sandwich Islands",
    "GT" => "Guatemala",
    "GU" => "Guam",
    "GW" => "Guinea-Bissau",
    "GY" => "Guyana",
    "HK" => "Hong Kong",
    "HM" => "Heard Island and McDonald Islands",
    "HN" => "Honduras",
    "HR" => "Croatia",
    "HT" => "Haiti",
    "HU" => "Hungary",
    "ID" => "Indonesia",
    "IE" => "Ireland",
    "IL" => "Israel",
    "IM" => "Isle of Man",
    "IN" => "India",
    "IO" => "British Indian Ocean Territory",
    "IQ" => "Iraq",
    "IR" => "Iran",
    "IS" => "Iceland",
    "IT" => "Italy",
    "JE" => "Jersey",
    "JM" => "Jamaica",
    "JO" => "Jordan",
    "JP" => "Japan",
    "KE" => "Kenya",
    "KG" => "Kyrgyzstan",
    "KH" => "Cambodia",
    "KI" => "Kiribati",
    "KM" => "Comoros",
    "KN" => "Saint Kitts and Nevis",
    "KP" => "North Korea",
    "KR" => "South Korea",
    "KW" => "Kuwait",
    "KY" => "Cayman Islands",
    "KZ" => "Kazakhstan",
    "LA" => "Laos",
    "LB" => "Lebanon",
    "LC" => "Saint Lucia",
    "LI" => "Liechtenstein",
    "LK" => "Sri Lanka",
    "LR" => "Liberia",
    "LS" => "Lesotho",
    "LT" => "Lithuania",
    "LU" => "Luxembourg",
    "LV" => "Latvia",
    "LY" => "Libya",
    "MA" => "Morocco",
    "MC" => "Monaco",
    "MD" => "Moldova",
    "ME" => "Montenegro",
    "MF" => "Saint Martin (French part)",
    "MG" => "Madagascar",
    "MH" => "Marshall Islands",
    "MK" => "Macedonia",
    "ML" => "Mali",
    "MM" => "Myanmar",
    "MN" => "Mongolia",
    "MO" => "Macau",
    "MP" => "Northern Mariana Islands",
    "MQ" => "Martinique",
    "MR" => "Mauritania",
    "MS" => "Montserrat",
    "MT" => "Malta",
    "MU" => "Mauritius",
    "MV" => "Maldives",
    "MW" => "Malawi",
    "MX" => "Mexico",
    "MY" => "Malaysia",
    "MZ" => "Mozambique",
    "NA" => "Namibia",
    "NC" => "New Caledonia",
    "NE" => "Niger",
    "NF" => "Norfolk Island",
    "NG" => "Nigeria",
    "NI" => "Nicaragua",
    "NL" => "Netherlands",
    "NO" => "Norway",
    "NP" => "Nepal",
    "NR" => "Nauru",
    "NU" => "Niue",
    "NZ" => "New Zealand",
    "OM" => "Oman",
    "PA" => "Panama",
    "PE" => "Peru",
    "PF" => "French Polynesia",
    "PG" => "Papua New Guinea",
    "PH" => "Philippines",
    "PK" => "Pakistan",
    "PL" => "Poland",
    "PM" => "Saint Pierre and Miquelon",
    "PN" => "Pitcairn",
    "PR" => "Puerto Rico",
    "PS" => "Palestine",
    "PT" => "Portugal",
    "PW" => "Palau",
    "PY" => "Paraguay",
    "QA" => "Qatar",
    "RE" => "Réunion",
    "RO" => "Romania",
    "RS" => "Serbia",
    "RU" => "Russia",
    "RW" => "Rwanda",
    "SA" => "Saudi Arabia",
    "SB" => "Solomon Islands",
    "SC" => "Seychelles",
    "SD" => "Sudan",
    "SE" => "Sweden",
    "SG" => "Singapore",
    "SH" => "Saint Helena",
    "SI" => "Slovenia",
    "SJ" => "Svalbard and Jan Mayen",
    "SK" => "Slovakia",
    "SL" => "Sierra Leone",
    "SM" => "San Marino",
    "SN" => "Senegal",
    "SO" => "Somalia",
    "SR" => "Suriname",
    "SS" => "South Sudan",
    "ST" => "Sao Tome and Principe",
    "SV" => "El Salvador",
    "SX" => "Sint Maarten (Dutch part)",
    "SY" => "Syria",
    "SZ" => "Swaziland",
    "TC" => "Turks and Caicos Islands",
    "TD" => "Chad",
    "TF" => "French Southern Territories",
    "TG" => "Togo",
    "TH" => "Thailand",
    "TJ" => "Tajikistan",
    "TK" => "Tokelau",
    "TL" => "Timor-Leste",
    "TM" => "Turkmenistan",
    "TN" => "Tunisia",
    "TO" => "Tonga",
    "TR" => "Turkey",
    "TT" => "Trinidad and Tobago",
    "TV" => "Tuvalu",
    "TW" => "Taiwan",
    "TZ" => "Tanzania",
    "UA" => "Ukraine",
    "UG" => "Uganda",
    "UM" => "United States Minor Outlying Islands",
    "US" => "United States",
    "UY" => "Uruguay",
    "UZ" => "Uzbekistan",
    "VA" => "Vatican",
    "VC" => "Saint Vincent and the Grenadines",
    "VE" => "Venezuela",
    "VG" => "British Virgin Islands",
    "VI" => "Virgin Islands",
    "VN" => "Vietnam",
    "VU" => "Vanuatu",
    "WF" => "Wallis and Futuna",
    "WS" => "Samoa",
    "YE" => "Yemen",
    "YT" => "Mayotte",
    "YK" => "Kosovo",
    "ZA" => "South Africa",
    "ZM" => "Zambia",
    "ZW" => "Zimbabwe",
    "AC" => "Ascension Island",
    "CP" => "Clipperton Island",
    "DG" => "Diego Garcia",
    "EA" => "Ceuta, Melilla",
    "EU" => "European Union",
    "FX" => "France, Metropolitan",
    "IC" => "Canary Islands",
    "TA" => "Tristan da Cunha",
    "GG" => "Guernsey",
    "IM" => "Isle of Man",
    "JE" => "Jersey",
    "AN" => "Netherlands Antilles",
    "BU" => "Burma",
    "TP" => "East Timor",
    "ZR" => "Zaire",
    "DY" => "Benin",
    "EW" => "Estonia",
    "JA" => "Jamaica",
    "LF" => "Libya Fezzan",
    "RA" => "Argentina",
    "RH" => "Haiti",
    "RL" => "Lebanon",
    "RM" => "Madagascar",
    "RN" => "Niger",
    "WG" => "Grenada",
    "WL" => "Saint Lucia",
    "WV" => "Saint Vincent",
    "YV" => "Venezuela",
    "BQ" => "British Antarctic Territory",
    "CT" => "Canton and Enderbury Islands",
    "DY" => "Dahomey",
    "FQ" => "French Southern and Antarctic Territories",
    "HV" => "Upper Volta",
    "JT" => "Johnston Island",
    "MI" => "Midway Islands",
    "NH" => "New Hebrides",
    "NQ" => "Dronning Maud Land",
    "PC" => "Pacific Islands, Trust Territory of the",
    "PU" => "U.S. Miscellaneous Pacific Islands",
    "PZ" => "Panama Canal Zone",
    "RH" => "Southern Rhodesia",
    "WK" => "Wake Island",
  );
}

