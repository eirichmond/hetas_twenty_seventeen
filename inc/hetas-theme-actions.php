<?php

add_action('hetas_before_main_content', 'hetas_before_main_content_wrapper');

function hetas_before_main_content_wrapper() {
    global $blog_id;
    if($blog_id == 1) {
        echo '<div class="col-md-9">';
    } else {
        if(is_page()) {
            echo '<div class="col-md-12">';
        } elseif (is_single()) {
            echo '<main id="main" class="site-main col-md-12" role="main">';
        }
    }
    
}

add_action('hetas_after_main_content', 'hetas_after_main_content_wrapper_end');
function hetas_after_main_content_wrapper_end() {
    global $blog_id;
    if($blog_id == 1) {
        echo '</div>';
    } else {
        if(is_page()) {
            echo '</div>';
        } elseif (is_single()) {
            echo '</main>';
        }
    }
}

add_action('hetas_sidebar_content', 'hetas_sidebar_content_callback');
function hetas_sidebar_content_callback() {
    global $blog_id;
    if($blog_id == 1) {
        echo '<div class="col-md-3">';
        get_sidebar('page');
        echo '</div>';
    }
}
