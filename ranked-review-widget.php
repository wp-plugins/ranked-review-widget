<?php

/*
  Plugin Name: Ranked Review Widget
  Plugin URI: http://amplifierinternational.com
  Description: RankedByReview Reviews widget
  Version: 1.0.0
  Author: Craig G Smith
  Author Email: vxdhost@gmail.com
  License:

  Copyright 2011 Craig G Smith (vxdhost@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */

DEFINE("RBR_BUSINESSID", "0");
DEFINE("RBR_HEADING", "");

add_shortcode("ranked-review-widget", "ranked_review_widget_handler");

function ranked_review_widget_handler($incomingfrompost) {
    //process incoming attributes assigning defaults if required
    $incomingfrompost = shortcode_atts(array(
        "businessid" => RBR_BUSINESSID,
        "heading" => RBR_HEADING
            ), $incomingfrompost);


    //run function that actually does the work of the plugin
    $demolph_output = ranked_review_widget_function($incomingfrompost);
    //send back text to replace shortcode in post
    return $demolph_output;
}

function ranked_review_widget_function($incomingfromhandler) {

    $demolp_output = '';
    if ((int) $incomingfromhandler["businessid"]) {
        
        //$demolp_output .= (int) $incomingfromhandler["businessid"];
        $demolp_output .= '<div id="rbr_review_div_' . $incomingfromhandler["businessid"] . '" class="rbr_widget" data-id="' . $incomingfromhandler["businessid"] . '">';
       if($incomingfromhandler["heading"]){
        $demolp_output .= '<h3>' . wp_specialchars_decode($incomingfromhandler["heading"]) . '</h3>';
       }
        $demolp_output .= '<div class="inner">';
        $demolp_output .= '</div></div>';
        wp_enqueue_script(
                'rbr-script-scroller', plugins_url('jquery.liquid-slider.min.js', __FILE__), array('jquery')
        );
        wp_enqueue_script(
                'rbr-script', plugins_url('rbr.js', __FILE__), array('jquery')
        );
        wp_enqueue_style(
                'rbr-style', plugins_url('rbr.css', __FILE__)
        );
    }
    return $demolp_output;
}
