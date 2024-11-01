<?php

add_shortcode("theworld", "theworld_shortcode");

function theworld_shortcode() {
    $the_world = new TheWorld();
    $num = $the_world->getCountryNum();
    $img = $the_world->chartImg();
    return $img . "<br>" . "I've been to " . $num . " countries!!";
}