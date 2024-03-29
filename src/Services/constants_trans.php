<?php

//date_default_timezone_set('UTC');    //e.g. 'America/Denver'

// set assignments of important variables
if (!defined("SE_NSUN")) {
    define("SE_NSUN", 0);
    define("SE_NMOON", 1);
    define("SE_NMERCURY", 2);
    define("SE_NVENUS", 3);
    define("SE_NMARS", 4);
    define("SE_NJUPITER", 5);
    define("SE_NSATURN", 6);
    define("SE_NURANUS", 7);
    define("SE_NNEPTUNE", 8);
    define("SE_NPLUTO", 9);
    define("SE_TSUN", 10);
    define("SE_TMOON", 11);
    define("SE_TMERCURY", 12);
    define("SE_TVENUS", 13);
    define("SE_TMARS", 14);
    define("SE_TJUPITER", 15);
    define("SE_TSATURN", 16);
    define("SE_TURANUS", 17);
    define("SE_TNEPTUNE", 18);
    define("SE_TPLUTO", 19);
    define("LAST_TPLANET", 19);

    define("EMAIL_enabled", False);
    define("EMAIL", "all_brovchenko@mail.ru");

    define("CLR_BLACK", "#000000");
    define("CLR_TRANS", "#9933ff");
    define("CLR_WHITE", "#ffffff");

    define("CLR_RED", "#ff0000");
    define("CLR_ANOTHER_RED", "#ff3c3c");

    define("CLR_GREEN", "#2dac00");
    define("CLR_LIME", "#9cce04");

    define("CLR_BLUE", "#0000ff");
    define("CLR_LIGHT_BLUE", "#c0c0ff");
    define("CLR_ANOTHER_BLUE", "#2020ff");

    define("CLR_PURPLE", "#ff00ff");
    define("CLR_CYAN", "#00ffff");

    define("CLR_YELLOW", "#ffff00");

    define("CLR_GRAY", "#c0c0c0");
    define("CLR_ANOTHER_GRAY", "#e0e0e0");

    define("CLR_ORANGE", "#db9b40");
    define("CLR_LAVENDER", "#a000ff");

    define("CLR_10TH_H", "#0000ff");
    define("CLR_11TH_H", "#ff0000");
    define("CLR_12TH_H", "#2dac00");
    define("CLR_1ST_H", "#840da9");
    define("CLR_2ND_H", "#c0004d");
    define("CLR_3RD_H", "#808080");
}
$pl_tame[0] = "Sunn";
$pl_tame[1] = "Moonn";
$pl_tame[2] = "Mercuryn";
$pl_tame[3] = "Venusn";
$pl_tame[4] = "Marsn";
$pl_tame[5] = "Jupitern";
$pl_tame[6] = "Saturnn";
$pl_tame[7] = "Uranusn";
$pl_tame[8] = "Neptunen";
$pl_tame[9] = "Pluton";
$pl_tame[10] = "Sunt";
$pl_tame[11] = "Moont";
$pl_tame[12] = "Mercuryt";
$pl_tame[13] = "Venust";
$pl_tame[14] = "Marst";
$pl_tame[15] = "Jupitert";
$pl_tame[16] = "Saturnt";
$pl_tame[17] = "Uranust";
$pl_tame[18] = "Neptunet";
$pl_tame[19] = "Plutot";
$pl_tame[LAST_TPLANET + 1] = "Ascendant";
$pl_tame[LAST_TPLANET + 2] = "Midheaven";

$pl_tame[LAST_TPLANET + 1] = "Ascendant";
$pl_tame[LAST_TPLANET + 2] = "House 2";
$pl_tame[LAST_TPLANET + 3] = "House 3";
$pl_tame[LAST_TPLANET + 4] = "House 4";
$pl_tame[LAST_TPLANET + 5] = "House 5";
$pl_tame[LAST_TPLANET + 6] = "House 6";
$pl_tame[LAST_TPLANET + 7] = "House 7";
$pl_tame[LAST_TPLANET + 8] = "House 8";
$pl_tame[LAST_TPLANET + 9] = "House 9";
$pl_tame[LAST_TPLANET + 10] = "MC (Midheaven)";
$pl_tame[LAST_TPLANET + 11] = "House 11";
$pl_tame[LAST_TPLANET + 12] = "House 12";

$pl_ephem_number[0] = "0";
$pl_ephem_number[1] = "1";
$pl_ephem_number[2] = "2";
$pl_ephem_number[3] = "3";
$pl_ephem_number[4] = "4";
$pl_ephem_number[5] = "5";
$pl_ephem_number[6] = "6";
$pl_ephem_number[7] = "7";
$pl_ephem_number[8] = "8";
$pl_ephem_number[9] = "9";
$pl_ephem_number[10] = "D";
$pl_ephem_number[11] = "A";
$pl_ephem_number[12] = "t";

$sign_name[1] = "ARIES";
$sign_name[2] = "TAURUS";
$sign_name[3] = "GEMINI";
$sign_name[4] = "CANCER";
$sign_name[5] = "LEO";
$sign_name[6] = "VIRGO";
$sign_name[7] = "LIBRA";
$sign_name[8] = "SCORPIO";
$sign_name[9] = "SAGITTARIUS";
$sign_name[10] = "CAPRICORN";
$sign_name[11] = "AQUARIUS";
$sign_name[12] = "PISCES";
$sign_name[13] = "ARIES";

$name_of_sign[1] = "Aries";
$name_of_sign[2] = "Taurus";
$name_of_sign[3] = "Gemini";
$name_of_sign[4] = "Cancer";
$name_of_sign[5] = "Leo";
$name_of_sign[6] = "Virgo";
$name_of_sign[7] = "Libra";
$name_of_sign[8] = "Scorpio";
$name_of_sign[9] = "Sagittarius";
$name_of_sign[10] = "Capricorn";
$name_of_sign[11] = "Aquarius";
$name_of_sign[12] = "Pisces";
$name_of_sign[13] = "Aries";

$aspects_defined[1] = "000";
$aspects_defined[2] = "045";
$aspects_defined[3] = "060";
$aspects_defined[4] = "090";
$aspects_defined[5] = "120";
$aspects_defined[6] = "135";
$aspects_defined[7] = "180";
$aspects_defined[8] = "030";
$aspects_defined[9] = "150";
$aspects_defined[10] = "072";
$aspects_defined[11] = "144";

$pl_tglyph[0] = 81;
$pl_tglyph[1] = 87;
$pl_tglyph[2] = 69;
$pl_tglyph[3] = 82;
$pl_tglyph[4] = 84;
$pl_tglyph[5] = 89;
$pl_tglyph[6] = 85;
$pl_tglyph[7] = 73;
$pl_tglyph[8] = 79;
$pl_tglyph[9] = 80;
$pl_tglyph[10] = 81;
$pl_tglyph[11] = 87;
$pl_tglyph[12] = 69;
$pl_tglyph[13] = 82;
$pl_tglyph[14] = 84;
$pl_tglyph[15] = 89;
$pl_tglyph[16] = 85;
$pl_tglyph[17] = 73;
$pl_tglyph[18] = 79;
$pl_tglyph[19] = 80;
$pl_tglyph[LAST_TPLANET + 1] = 90;    //Ascendant
$pl_tglyph[LAST_TPLANET + 2] = 88;    //Midheaven

$asp_color[1] = CLR_BLUE;
$asp_color[2] = CLR_RED;
$asp_color[3] = CLR_GREEN;
$asp_color[4] = CLR_RED;     
$asp_color[5] = CLR_BLUE;      
$asp_color[6] = CLR_GREEN;
$asp_color[7] = CLR_LIGHT_BLUE; //30
$asp_color[8] = CLR_CYAN; //45
$asp_color[9] = CLR_LAVENDER; //72
$asp_color[10] = CLR_LAVENDER; //144

$asp_name[1] = "Conjunction";
$asp_name[2] = "Opposition";
$asp_name[3] = "Trine";
$asp_name[4] = "Square";
$asp_name[5] = "Quincunx";
$asp_name[6] = "Sextile";
$asp_name[7] = "Semi-sextile";
$asp_name[8] = "Semi-square";
$asp_name[9] = "Quintile";
$asp_name[10] = "Biquintile";

$asp_glyph[1] = 113;    //  0 deg
$asp_glyph[2] = 119;    //180 deg
$asp_glyph[3] = 101;    //120 deg
$asp_glyph[4] = 114;    // 90 deg
$asp_glyph[5] = 111;    //150 deg
$asp_glyph[6] = 116;    // 60 deg
$asp_glyph[7] = 105;    // 30 deg
$asp_glyph[8] = 121;    // 45 deg
$asp_glyph[9] = 117;    // 72 deg
$asp_glyph[10] = 110;    // 144 deg

$sign_glyph[1] = 97;
$sign_glyph[2] = 115;
$sign_glyph[3] = 100;
$sign_glyph[4] = 102;
$sign_glyph[5] = 103;
$sign_glyph[6] = 104;
$sign_glyph[7] = 106;
$sign_glyph[8] = 107;
$sign_glyph[9] = 108;
$sign_glyph[10] = 122;
$sign_glyph[11] = 120;
$sign_glyph[12] = 99;

?>