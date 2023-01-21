<?php

namespace App\Controller;

class Transit_wheel
{
  public static function getImage($rx1, $p1, $hc1, $hpos, $l1, $ubt1, $personId = null)
  {
    include ("constants_trans.php");

$line1 = safeEscapeString($l1);

$ubt1 = intval(safeEscapeString($ubt1));

$retrograde = safeEscapeString($rx1);

$longitude = unserialize($p1);
$hc = unserialize($hc1);
$house_pos = unserialize($hpos);

$longitude[LAST_TPLANET + 1] = $hc[1];
$longitude[LAST_TPLANET + 2] = $hc[10];

$Ascendant1 = $hc[1];
$hc[13] = $hc[1];

    $copyright1 = "This chart wheel is not copyrighted";
    $copyright2 = "but generated by AlexKD";

    ob_clean();
ob_start();
// set the content-type
    if (!realpath('../src/Services/arial.ttf'))
      $services_path = './src/Services';
    else 
      $services_path = '../src/Services';

    // create the blank image
$overall_size = 840;
$y_top_margin = 50;
$im = @imagecreatetruecolor($overall_size, $overall_size + $y_top_margin) or die("Cannot initialize new GD image stream");

// specify the colors
$white = imagecolorallocate($im, 255, 255, 255);
    $almost_white = imagecolorallocate($im, 254, 254, 254);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$magenta = imagecolorallocate($im, 255, 0, 255);
$yellow = imagecolorallocate($im, 255, 255, 204);
$cyan = imagecolorallocate($im, 0, 255, 255);
$green = imagecolorallocate($im, 0, 224, 0);
$light_green = imagecolorallocate($im, 153, 255, 153);
$another_green = imagecolorallocate($im, 0, 128, 0);
$grey = imagecolorallocate($im, 153, 153, 153);
$black = imagecolorallocate($im, 0, 0, 0);
$tcolor = imagecolorallocate($im, 153, 51, 255);
$lavender = imagecolorallocate($im, 160, 0, 255);
$orange = imagecolorallocate($im, 255, 128, 64);
$light_blue = imagecolorallocate($im, 239, 239, 239);
$another_blue = imagecolorallocate($im, 212, 232, 242);
$violet = imagecolorallocate($im, 197, 139, 255);

// specific colors
$planat_color = $black;   //was $cyan;
$platrans_color = $tcolor;
$deg_min_color = $black;    //$white;
$sign_color = $magenta;

$size_of_rect = $overall_size;    // size of rectangle in which to draw the wheel
$diameter = $overall_size * 13 / 16;            // diameter of circle drawn
$outer_outer_diameter = $overall_size * 15 / 16;      // diameter of circle drawn
$outer_diameter_distance = ($outer_outer_diameter - $diameter) / 2; // distance between outer-outer diameter and diameter
$inner_diameter_offset = $overall_size * 25 / 128;     // diameter of inner circle drawn
$inner_diameter_offset_2 = $overall_size * 21 / 128;   // diameter of nextmost inner circle drawn
$dist_from_diameter1 = $overall_size / 20;      // distance inner planet glyph is from circumference of wheel
$dist_from_diameter1a = 12;     // distance inner planet glyph is from circumference of wheel - for line
$dist_from_diameter2 = 58;      // distance outer planet glyph is from circumference of wheel
$dist_from_diameter2a = 28;     // distance outer planet glyph is from circumference of wheel - for line
$radius = $diameter / 2;        // radius of circle drawn
$middle_radius = $overall_size * 277 / 640;   //the radius for the middle of the two outer circles

$center_pt_x = $size_of_rect / 2;       // center of circle
$center_pt_y = $y_top_margin + ($size_of_rect / 2);   // center of circle

if ($ubt1 == 0) {
  $last_planet_num = LAST_TPLANET;
} else {
  $last_planet_num = LAST_TPLANET - 2;
}

$num_planets = $last_planet_num + 1;

$spacing = 4;     // spacing between planet glyphs around wheel - this number is really one more than shown here

// create colored rectangle on blank image
imagefilledrectangle($im, 0, 0, $size_of_rect, $size_of_rect + $y_top_margin, $almost_white);
    imagecolortransparent($im, $almost_white);

// MUST BE HERE - I DO NOT KNOW WHY - MAYBE TO PRIME THE PUMP


imagettftext($im, 10, 0, 0, 0, $black, $services_path . '/arial.ttf', " ");

// draw the outer-outer border of the chartwheel
imagefilledellipse($im, $center_pt_x, $center_pt_y, $overall_size , $overall_size, $another_blue);

// draw the outer-outer circle of the chartwheel
imagefilledellipse($im, $center_pt_x, $center_pt_y, $outer_outer_diameter, $outer_outer_diameter, $yellow);
imageellipse($im, $center_pt_x, $center_pt_y, $outer_outer_diameter, $outer_outer_diameter, $black);

// draw the outer circle of the chartwheel
imagefilledellipse($im, $center_pt_x, $center_pt_y, $diameter, $diameter, $white);
imageellipse($im, $center_pt_x, $center_pt_y, $diameter, $diameter, $black);


//shade the areas of complete signs, alternating colors - do not move this code from here
    $flag = False;
for ($i = 0; $i <= 330; $i = $i + 30) {
  $angle = $i + sprintf("%.0f", $Ascendant1);

  if ($flag == True) {
    imagefilledarc($im, $center_pt_x, $center_pt_y, $diameter - 1, $diameter - 1, $angle, $angle + 30, $light_blue, IMG_ARC_PIE);
  } else {
    imagefilledarc($im, $center_pt_x, $center_pt_y, $diameter - 1, $diameter - 1, $angle, $angle + 30, $white, IMG_ARC_PIE);
  }

  $flag = !$flag;
}


// draw the inner circle of the chartwheel
imagefilledellipse($im, $center_pt_x, $center_pt_y, $diameter - ($inner_diameter_offset_2 * 2), $diameter - ($inner_diameter_offset_2 * 2), $light_green);
imagefilledellipse($im, $center_pt_x, $center_pt_y, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $white);

imageellipse($im, $center_pt_x, $center_pt_y, $diameter - ($inner_diameter_offset_2 * 2), $diameter - ($inner_diameter_offset_2 * 2), $black);
imageellipse($im, $center_pt_x, $center_pt_y, $diameter - ($inner_diameter_offset * 2), $diameter - ($inner_diameter_offset * 2), $black);

//data for chart
imagettftext($im, 8, 0, 100, 38, $black, $services_path . '/arial.ttf', $line1);

//imagettftext($im, 8, 0, $overall_size * 90 / 128, $overall_size * 135 / 128, $black, $services_path . '/arial.ttf', $copyright1);
//imagettftext($im, 8, 0, $overall_size * 90 / 128, $overall_size * 43 / 40, $black, $services_path . '/arial.ttf', $copyright2);

// ------------------------------------------


//draw the horizontal line for the Ascendant
$x1 = -($radius - $inner_diameter_offset) * cos(deg2rad(0));
$y1 = -($radius - $inner_diameter_offset) * sin(deg2rad(0));

$x2 = -$radius * cos(deg2rad(0));
$y2 = -$radius * sin(deg2rad(0));

imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);

//draw the arrow for the Ascendant
$x1 = -$radius;
$y1 = 30 * sin(deg2rad(0));

$x2 = -($radius - 12);
$y2 = 12 * sin(deg2rad(-15));
imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);

$y2 = 12 * sin(deg2rad(15));
imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);

// ------------------------------------------

// draw in the actual house cusp numbers and sign
for ($i = 1; $i <= 12; $i = $i + 1) {
  $angle = -($Ascendant1 - $hc[$i]);

  $sign_pos = floor($hc[$i] / 30) + 1;
  if ($sign_pos == 1 Or $sign_pos == 5 Or $sign_pos == 9) {
    $clr_to_use = $red;
  } elseif ($sign_pos == 2 Or $sign_pos == 6 Or $sign_pos == 10) {
    $clr_to_use = $another_green;
  } elseif ($sign_pos == 3 Or $sign_pos == 7 Or $sign_pos == 11) {
    $clr_to_use = $orange;
  } elseif ($sign_pos == 4 Or $sign_pos == 8 Or $sign_pos == 12) {
    $clr_to_use = $blue;
  }

  // sign glyph
  self::display_house_cusp($i, $angle, $middle_radius, $xy);
  imagettftext($im, 14, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $clr_to_use, $services_path . '/HamburgSymbols.ttf', chr($sign_glyph[$sign_pos]));

  // house cusp degree
  if ($i >= 1 And $i <= 6) {
    self::display_house_cusp($i, $angle - 4, $middle_radius, $xy);
  } else {
    self::display_house_cusp($i, $angle + 5, $middle_radius, $xy);
  }

  $reduced_pos = Composite::Reduce_below_30($hc[$i]);
  $int_reduced_pos = floor($reduced_pos);
  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }

  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $black, $services_path . '/arial.ttf', $t . chr(176));

  // house cusp minute
  if ($i >= 1 And $i <= 4) {
    self::display_house_cusp($i, $angle + 4, $middle_radius, $xy);
  } elseif ($i == 5 Or $i == 6) {
    self::display_house_cusp($i, $angle + 5, $middle_radius, $xy);
  } elseif ($i == 7) {
    self::display_house_cusp($i, $angle - 4, $middle_radius, $xy);
  } else {
    self::display_house_cusp($i, $angle - 5, $middle_radius, $xy);
  }

  $reduced_pos = Composite::Reduce_below_30($hc[$i]);
  $int_reduced_pos = floor(60 * ($reduced_pos - floor($reduced_pos)));
  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }
  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $black, $services_path . '/arial.ttf', $t . chr(39));
}

// ------------------------------------------

// draw the lines for the house cusps
$angle_sum = 0;
for ($i = 1; $i <= 12; $i = $i + 1) {
  $angle = $Ascendant1 - $hc[$i];
  $x1 = -$radius * cos(deg2rad($angle));
  $y1 = -$radius * sin(deg2rad($angle));

  $x2 = -($radius - $inner_diameter_offset) * cos(deg2rad($angle));
  $y2 = -($radius - $inner_diameter_offset) * sin(deg2rad($angle));

  if ($i != 1 And $i != 10) {
    imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $grey);
  }

  // display the house numbers themselves - 26 March 2010
  $angle_diff = $hc[$i + 1] - $hc[$i];
  if ($angle_diff < -180) {
    $angle_diff = $angle_diff + 360;
  }

  $angle_to_use = $angle_sum + ($angle_diff / 2);

  self::display_house_number_new($i, $angle_to_use, $radius - $inner_diameter_offset, $xy);   //26 March 2010


  // display the house numbers themselves
  //display_house_number($i, -$angle, $radius - $inner_diameter_offset, $xy);
  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $black, $services_path . '/arial.ttf', $i);

  $angle_sum = $angle_sum + $angle_diff;    //26 March 2010
}

// ------------------------------------------

// draw the little degree marks around of the wheel
$spoke_length = 9;
$minor_spoke_length = 4;

for ($i = 0; $i <= 359; $i = $i + 1) {
  $angle = $i + $Ascendant1;

  $x1 = -$radius * cos(deg2rad($angle));
  $y1 = -$radius * sin(deg2rad($angle));

  if ($i % 5 == 0) {
    $x2 = -($radius - $spoke_length) * cos(deg2rad($angle));
    $y2 = -($radius - $spoke_length) * sin(deg2rad($angle));
    imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $red);
  } else {
    $x2 = -($radius - $minor_spoke_length) * cos(deg2rad($angle));
    $y2 = -($radius - $minor_spoke_length) * sin(deg2rad($angle));
    imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);
  }
}


// ------------------------------------------


// draw the near-vertical line for the MC
$angle = $Ascendant1 - $hc[10];
$dist_mc_asc = $angle;

if ($dist_mc_asc < 0) {
  $dist_mc_asc = $dist_mc_asc + 360;
}

$value = 90 - $dist_mc_asc;
$angle1 = 65 - $value;
$angle2 = 65 + $value;

$x1 = -($radius - $inner_diameter_offset) * cos(deg2rad($angle));
$y1 = -($radius - $inner_diameter_offset) * sin(deg2rad($angle));

$x2 = -$radius * cos(deg2rad($angle));
$y2 = -$radius * sin(deg2rad($angle));

imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);

// draw the arrow for the 10th house cusp (MC)
$x1 = $x2 + (15 * cos(deg2rad($angle1)));
$y1 = $y2 + (15 * sin(deg2rad($angle1)));
imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);

$x1 = $x2 - (15 * cos(deg2rad($angle2)));
$y1 = $y2 + (15 * sin(deg2rad($angle2)));
imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);


// ------------------------------------------


// draw the dividing lines between the signs
for ($i = 0; $i <= 330; $i = $i + 30) {
  //$angle = $Ascendant1 - $hc1[$i];
  $angle = $i + sprintf("%.0f", $Ascendant1);

  $x1 = -($overall_size / 2) * cos(deg2rad($angle));
  $y1 = -($overall_size / 2) * sin(deg2rad($angle));

  $x2 = -($radius + $outer_diameter_distance) * cos(deg2rad($angle));
  $y2 = -($radius + $outer_diameter_distance) * sin(deg2rad($angle));

  imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $black);
}


// put signs around chartwheel
$cw_sign_glyph = 14;
$ch_sign_glyph = 12;
$gap_sign_glyph = - $overall_size * 11 / 160;

for ($i = 1; $i <= 12; $i++) {
  $angle_to_use = deg2rad((($i - 1) * 30) + 15 - $Ascendant1);

  $center_pos_x = -$cw_sign_glyph / 2;
  $center_pos_y = $ch_sign_glyph / 2;

  $offset_pos_x = $center_pos_x * cos($angle_to_use);
  $offset_pos_y = $center_pos_y * sin($angle_to_use);

  $x1 = $center_pos_x + $offset_pos_x + ((-$radius + $gap_sign_glyph) * cos($angle_to_use));
  $y1 = $center_pos_y + $offset_pos_y + (($radius - $gap_sign_glyph) * sin($angle_to_use));

  if ($i == 1 Or $i == 5 Or $i == 9) {
    $clr_to_use = $red;
  } elseif ($i == 2 Or $i == 6 Or $i == 10) {
    $clr_to_use = $another_green;
  } elseif ($i == 3 Or $i == 7 Or $i == 11) {
    $clr_to_use = $orange;
  } elseif ($i == 4 Or $i == 8 Or $i == 12) {
    $clr_to_use = $blue;
  }

  self::drawboldtext($im, 14, 0, $x1 + $center_pt_x, $y1 + $center_pt_y, $clr_to_use, $services_path . '/HamburgSymbols.ttf', chr($sign_glyph[$i]), 0); //used to be boldness of 1 - last number
}

// ------------------------------------------


// put planets in chartwheel
// sort longitudes in descending order from 360 down to 0
    for ($i = 0; $i <= $num_planets - 1; $i++)
    {
      $sort[$i] = $longitude[$i];
      $sort_pos[$i] = $i;
    }

// do the actual sort
    for ($i = 0; $i <= $num_planets - 2; $i++)
    {
      for ($j = $i + 1; $j <= $num_planets - 1; $j++)
      {
        if ($sort[$j] > $sort[$i])
        {
          $temp = $sort[$i];
          $temp1 = $sort_pos[$i];

          $sort[$i] = $sort[$j];
          $sort_pos[$i] = $sort_pos[$j];

          $sort[$j] = $temp;
          $sort_pos[$j] = $temp1;
        }
      }
    }

// count how many planets are in each house
self::Count_planets_in_each_house5($num_planets, $house_pos, $sort_pos, $sort, $nopih);

//find the best planet to start displaying the wheel and reorder the $sort[] array starting with that planet
self::Find_best_planet_to_start_with($num_planets, $house_pos, $sort_pos, $sort, $nopih);


for ($i = 0; $i <= 359; $i++) {
  $spot_filled[$i] = 0;
}

$house_num = 0;

// add planet glyphs around circle
for ($i = $num_planets - 1; $i >= 0; $i--) {
  // $sort() holds longitudes in descending order from 360 down to 0
  // $sort_pos() holds the planet number corresponding to that longitude
  $temp = $house_num;
  $house_num = $house_pos[$sort_pos[$i]];              // get the house this planet is in

  if ($temp != $house_num) {
    $planets_done = 1;
  }      // this planet is in a different house than the last one - this planet is the first one in this house, in other words

  // get index for this planet as to where it should be in the possible xx different positions around the wheel
  $from_cusp = Composite::Crunch($sort[$i] - $hc[$house_num]);
  $to_next_cusp = Composite::Crunch($hc[$house_num + 1] - $sort[$i]);
  $next_cusp = $hc[$house_num + 1];

  $angle = $sort[$i];
  $how_many_more_can_fit_in_this_house = floor($to_next_cusp / ($spacing + 1));

  //if ($nopih[$house_num] - $planets_done > $how_many_more_can_fit_in_this_house)
  //if ($nopih[$house_num] != $planets_done And $nopih[$house_num] - $planets_done > $how_many_more_can_fit_in_this_house)
  //if ($nopih[$house_num] - $planets_done > $how_many_more_can_fit_in_this_house)
  if ($nopih[$house_num] - $planets_done >= $how_many_more_can_fit_in_this_house) {
    $angle = Composite::Crunch($next_cusp - (($nopih[$house_num] - $planets_done + 1) * ($spacing + 1)));
  }

  while (self::Check_for_overlap($angle, $spot_filled, $spacing) == True) {
    $angle = Composite::Crunch($angle + 1);
  }

  // mark this position as being filled
  $spot_filled[round($angle)] = 1;
  $spot_filled[Composite::Crunch(round($angle) - 1)] = 1;  // allows for a little better separation between Mars and Sun on 3/13/1966 test example

  // take the above index and convert it into an angle
  $planet_angle[$sort_pos[$i]] = $angle;              // needed for aspect lines
  $our_angle = Composite::Crunch($angle - $Ascendant1);      // needed for placing info on chartwheel

  $angle_to_use = deg2rad($our_angle);

  //denote that we have done at least one planet in this house (actually count the planets in this house that we have done)
  $planets_done++;

  self::display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1, $xy, 0);
  imagettftext($im, 16, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $sort_pos[$i] > 9 ? $platrans_color : $planat_color, $services_path . '/HamburgSymbols.ttf', chr($pl_tglyph[$sort_pos[$i]]));

  // display degrees of longitude for each planet
  $reduced_pos = Composite::Reduce_below_30($sort[$i]);
  $int_reduced_pos = floor($reduced_pos);
  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }

  $space_between_signs = $overall_size / 32;
  self::display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - $space_between_signs, $xy, 1);
  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $planat_color, $services_path . '/arial.ttf', $t . chr(176));

  // display planet sign
  $sign_pos = floor($sort[$i] / 30) + 1;
  self::display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - $space_between_signs * 2, $xy, 2);
  if ($sign_pos == 1 Or $sign_pos == 5 Or $sign_pos == 9) {
    $clr_to_use = $red;
  } elseif ($sign_pos == 2 Or $sign_pos == 6 Or $sign_pos == 10) {
    $clr_to_use = $another_green;
  } elseif ($sign_pos == 3 Or $sign_pos == 7 Or $sign_pos == 11) {
    $clr_to_use = $orange;
  } elseif ($sign_pos == 4 Or $sign_pos == 8 Or $sign_pos == 12) {
    $clr_to_use = $blue;
  }
  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $clr_to_use, $services_path . '/HamburgSymbols.ttf', chr($sign_glyph[$sign_pos]));

  // display minutes of longitude for each planet
  $int_reduced_pos = floor(60 * ($reduced_pos - floor($reduced_pos)));
  if ($int_reduced_pos < 10) {
    $t = "0" . $int_reduced_pos;
  } else {
    $t = $int_reduced_pos;
  }
  self::display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - $space_between_signs * 3, $xy, 1);
  imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $planat_color, $services_path . '/arial.ttf', $t . chr(39));

  // display Rx symbol
  if (strtoupper(Composite::mid($retrograde, $sort_pos[$i] + 1, 1)) == "R") {
    self::display_planet_glyph($our_angle, $angle_to_use, $radius - $dist_from_diameter1 - $space_between_signs * 3.8, $xy, 3);
    imagettftext($im, 10, 0, $xy[0] + $center_pt_x, $xy[1] + $center_pt_y, $red, $services_path . '/HamburgSymbols.ttf', chr(62));
  }
}

// ------------------------------------------

$aspects = Composite::GetAspectsArray();
$longitude[$last_planet_num + 1] = $hc[1];
$planet_angle[$last_planet_num + 1] = $Ascendant1;
$sort_pos[$last_planet_num + 1] = $last_planet_num + 1;
// draw in the aspect lines
for ($i = 0; $i <= $last_planet_num; $i++) {
  if ($sort_pos[$i] > 20) continue;
  for ($j = $i + 1; $j <= $last_planet_num + 1; $j++) {
    if ($sort_pos[$j] > 20) continue;
    $da = Abs($longitude[$sort_pos[$i]] - $longitude[$sort_pos[$j]]);
    if ($da > 180) {
      $da = 360 - $da;
    }
    for($q = 1; $q <= count($aspects); $q++)
    {
      $orb = $aspects[$q]->orb;
      if ($sort_pos[$i] == SE_NSUN or $sort_pos[$j] == SE_NSUN)
        $orb = $aspects[$q]->orb_for_sun;
      elseif ($sort_pos[$i] == SE_NMOON or $sort_pos[$j] == SE_NMOON)
        $orb = $aspects[$q]->orb_for_moon;
      if ($da <= $aspects[$q]->degrees + $orb And $da >= $aspects[$q]->degrees - $orb)
      {
        $drawDashed = ($orb < 3);

        if ($q != 1) {
          //non-conjunctions
          $x1 = (-$radius + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant1));
          $y1 = ($radius - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$i]] - $Ascendant1));
          $x2 = (-$radius + $inner_diameter_offset) * cos(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant1));
          $y2 = ($radius - $inner_diameter_offset) * sin(deg2rad($planet_angle[$sort_pos[$j]] - $Ascendant1));

          $aspect_color = ${$aspects[$q]->color};
          if ($drawDashed)
          {
            $style = array($aspect_color, $aspect_color, $aspect_color, $aspect_color, $white, $white, $white, $white);
            imagesetstyle($im, $style);
            imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, IMG_COLOR_STYLED);
          }
          else
            imageline($im, $x1 + $center_pt_x, $y1 + $center_pt_y, $x2 + $center_pt_x, $y2 + $center_pt_y, $aspect_color);
        }
        break;
      }
    }
  }
}


// draw the image in png format - using imagepng() results in clearer text compared with imagejpeg()

imagepng($im);

imagedestroy($im);
    $result = ob_get_contents();
    ob_end_clean();
    $file_path = 'natal_wheel' . (empty($personId) ? '' : $personId) . '.png';
    file_put_contents($file_path, $result);
     return $file_path;
}

public static function Count_planets_in_each_house($num_planets, $house_pos, &$sort_pos, &$sort, &$nopih)
{

  for ($i = 1; $i <= 12; $i++) {
    $nopih[$i] = 0;
  }      // reset and count the number of planets in each house

  for ($i = 0; $i <= $num_planets - 1; $i++)            // run through all the planets and see how many planets are in each house
  {
    $temp = $house_pos[$sort_pos[$i]];
    $nopih[$temp]++;                                    // get house planet is in
  }
}

  public static function display_house_cusp($num, $angle, $radii, &$xy)
  {
    $char_width = $radii * 18 / 277;
    $half_char_width = $char_width / 2;
    $char_height = $radii * 12 / 277;
    $half_char_height = $char_height / 2;

//puts center of character right on circumference of circle
    $xpos0 = -$half_char_width;
    $ypos0 = $half_char_height;

    $x_adj = -cos(deg2rad($angle));
    $y_adj = sin(deg2rad($angle));

    $xy[0] = $xpos0 + $x_adj - ($radii * cos(deg2rad($angle)));
    $xy[1] = $ypos0 + $y_adj + ($radii * sin(deg2rad($angle)));

    return ($xy);
  }

  public static function display_house_number_new($num, $angle, $radii, &$xy)
  {
    if ($num < 10)
    {
      $char_width = 10;
    }
    else
    {
      $char_width = 18;
    }
    $half_char_width = $char_width / 2;
    $char_height = 12;
    $half_char_height = $char_height / 2;
    $quarter_char_height = $char_height / 4;

//puts center of character right on circumference of imaginary circle
    $xpos0 = -$half_char_width;
    $ypos0 = $char_height;

    if ($num == 1)
    {
      $radii = $radii + 1;

      $x_adj = -cos(deg2rad($angle)) * $half_char_width;
      $ypos0 = $half_char_height - ($half_char_height / 2);
      $y_adj = sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 2)
    {
      $radii = $radii + 3;

      $x_adj = -cos(deg2rad($angle));
      $ypos0 = $half_char_height - ($half_char_height / 2);
      $y_adj = sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 3)
    {
      $xpos0 = -$half_char_width;
      $x_adj = -cos(deg2rad($angle)) * $half_char_width;
      $ypos0 = $char_height - 4;
      $y_adj = sin(deg2rad($angle)) * $half_char_height;
    }
    elseif ($num == 4)
    {
      $xpos0 = -$half_char_width;
      $x_adj = -cos(deg2rad($angle)) * $half_char_width;
      $ypos0 = $char_height - 2;
      $y_adj = sin(deg2rad($angle)) * $half_char_height;
    }
    elseif ($num == 5)
    {
      $xpos0 = 3;
      $x_adj = -cos(deg2rad($angle)) * $half_char_width;
      $ypos0 = $half_char_height;
      $y_adj = sin(deg2rad($angle)) * $half_char_height;
    }
    elseif ($num == 6)
    {
      $radii = $radii + 5;

      $xpos0 = $half_char_width / 2;
      $x_adj = -cos(deg2rad($angle));
      $ypos0 = $half_char_height;
      $y_adj = sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 7)
    {
      $radii = $radii + 3;

      $x_adj = -cos(deg2rad($angle)) * $char_width;
      $ypos0 = 0;
      $y_adj = -sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 8)
    {
      $radii = $radii - 2;

      $xpos0 = $half_char_width;
      $x_adj = -cos(deg2rad($angle));
      $ypos0 = $half_char_height;
      $y_adj = sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 9)
    {
      $xpos0 = 0;
      $x_adj = -cos(deg2rad($angle)) * $char_width;
      $ypos0 = 2;
      $y_adj = sin(deg2rad($angle)) * $half_char_height;
    }
    elseif ($num == 10)
    {
      $xpos0 = 0;
      $x_adj = -cos(deg2rad($angle)) * $char_width;
      $ypos0 = 2;
      $y_adj = sin(deg2rad($angle)) * $half_char_height;
    }
    elseif ($num == 11)
    {
      $radii = $radii + 6;

      $xpos0 = 0;
      $x_adj = -cos(deg2rad($angle)) * $half_char_width;
      $y_adj = sin(deg2rad($angle)) * $char_height;
    }
    elseif ($num == 12)
    {
      $radii = $radii + 2;

      $xpos0 = -$half_char_width;
      $x_adj = -cos(deg2rad($angle)) * $half_char_width / 2;
      $ypos0 = $half_char_height;
      $y_adj = sin(deg2rad($angle));
    }

    $xy[0] = $xpos0 + $x_adj - ($radii * cos(deg2rad($angle)));
    $xy[1] = $ypos0 + $y_adj + ($radii * sin(deg2rad($angle)));;

    return ($xy);
  }

  public static function Find_best_planet_to_start_with($num_planets, $house_pos, &$sort_pos, &$sort, $nopih)
  {

    //step 1 - find planets which have at least 20 deg clearance between themselves and the next lower planet in the array
    for ($i = $num_planets - 2; $i >= 0; $i--)
    {
      if ($sort[$i] - $sort[$i + 1] >= 20)
      {
        //step 2 - is this planet the first (and only) planet in the house?
        $pl_num = $sort_pos[$i];
        $house_of_pl = $house_pos[$pl_num];
        if ($nopih[$house_of_pl] == 1)
        {
          $start_planet = $pl_num;
          $start_planet_idx = $i;
          break;
        }
      }
    }

    if ($i < 0) { return; }       //we did not find a planet that meets our needs so do not change the $sort[] array

    //here we reorder the $sort[] and $sort_pos[] arrays so that we start with the indicated planet, which is $start_planet
    $sp = array();
    $s = array();

    $cnt = $num_planets - 1;
    for ($i = $start_planet_idx; $i >= 0; $i--)
    {
      $sp[$cnt] = $sort_pos[$i];
      $s[$cnt] = $sort[$i];
      $cnt--;
    }

    for ($i = $num_planets - 1; $i > $start_planet_idx; $i--)
    {
      $sp[$cnt] = $sort_pos[$i];
      $s[$cnt] = $sort[$i];
      $cnt--;
    }

    $sort_pos = $sp;
    $sort = $s;
  }

  public static function display_planet_glyph($our_angle, $angle_to_use, $radii, &$xy, $code)
  {
// $code = 0 for planet glyph, 1 for text, 2 for sign glyph, 3 for Rx symbol
// $our_angle in degree, $angle_to_use in radians
    $this_angle = Composite::Crunch($our_angle);

    if ($this_angle >= 1 And $this_angle <= 181)
    {
      if ($code == 0)
      {
        $cw_pl_glyph = 17;
        $ch_pl_glyph = 17;
      }
      elseif ($code == 1)
      {
        $cw_pl_glyph = 14;
        $ch_pl_glyph = 12;
      }
      elseif ($code == 2)
      {
        $cw_pl_glyph = 14;
        $ch_pl_glyph = 12;
      }
      else
      {
        $cw_pl_glyph = 8;
        $ch_pl_glyph = 10;
      }
    }
    else
    {
      if ($code == 0)
      {
        $cw_pl_glyph = 13;
        $ch_pl_glyph = 17;
      }
      elseif ($code == 1)
      {
        $cw_pl_glyph = 8;
        $ch_pl_glyph = 8;
      }
      elseif ($code == 2)
      {
        $cw_pl_glyph = 8;
        $ch_pl_glyph = 8;
      }
      else
      {
        $cw_pl_glyph = 6;
        $ch_pl_glyph = 10;
      }
    }

    $gap_pl_glyph = -10;

// take into account the width and height of the glyph, defined below
// get distance we need to shift the glyph so that the absolute middle of the glyph is the start point
    $center_pos_x = -$cw_pl_glyph / 2;
    $center_pos_y = $ch_pl_glyph / 2;

// get the offset we have to move the center point to in order to be properly placed
    $offset_pos_x = $center_pos_x * cos($angle_to_use);
    $offset_pos_y = $center_pos_y * sin($angle_to_use);

// now get the final X, Y coordinates
    $xy[0] = $center_pos_x + $offset_pos_x + ((-$radii + $gap_pl_glyph) * cos($angle_to_use));
    $xy[1] = $center_pos_y + $offset_pos_y + (($radii - $gap_pl_glyph) * sin($angle_to_use));

    return ($xy);
  }

  public static function drawboldtext($image, $size, $angle, $x_cord, $y_cord, $clr_to_use, $fontfile, $text, $boldness)
  {
    $_x = array(1, 0, 1, 0, -1, -1, 1, 0, -1);
    $_y = array(0, -1, -1, 0, 0, -1, 1, 1, 1);

    for($n = 0; $n <= $boldness; $n++)
    {
      ImageTTFText($image, $size, $angle, $x_cord+$_x[$n], $y_cord+$_y[$n], $clr_to_use, $fontfile, $text);
    }
  }

  public static function Count_planets_in_each_house5($num_planets, $house_pos, &$sort_pos, &$sort, &$nopih)
  {

    for ($i = 1; $i <= 12; $i++) { $nopih[$i] = 0; }      // reset and count the number of planets in each house

    for ($i = 0; $i <= $num_planets - 1; $i++)            // run through all the planets and see how many planets are in each house
    {
      $temp = $house_pos[$sort_pos[$i]];
      $nopih[$temp]++;                                    // get house planet is in
    }
  }

  public static function Check_for_overlap($angle, $spot_filled, $spacing)
  {
// spacing is really 1 more than we enter with, but we use assign $spacing = 1 less for easier math below
    $result = False;

    for ($i = $angle - $spacing; $i <= $angle + $spacing; $i++)
    {
      if ($spot_filled[Composite::Crunch(round($i))] == 1)
      {
        $result = True;
        break;
      }
    }

    return $result;
  }
}
?>