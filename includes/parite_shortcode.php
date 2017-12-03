<?php

/* Parity Create Pages Function */
function parite_posttype() {

    register_post_type( 'Parite',
        array(
            'labels' => array(
                'name' => __( 'Parite' ),
                'menu_icon' => 'dashicons-schedule',
                'singular_name' => __( 'Parite' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'parite'),
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
        )
    );
}

add_action( 'init', 'parite_posttype' );


/** Parity Create Shortcode Function */


function parite_shortcode($atts) {
    extract(shortcode_atts(array(
        'name' => 'name'
    ), $atts));

    add_action( 'wp_footer', function() use ( $name ) {
        echo '<script>';
        echo 'parityShortcode("' . $name . '")';
        echo '</script>';
    });


    $content = '';
    $content .= '<div class="parityContainer">';
    $content .= '<div class="parityHeader">';
    $content .= '<span class="parityPrice" id="parityPrice" ></span>';
    $content .= '<span id="parityIcon"></span>';
    $content .= '<span id="parityChangeRate"></span>';
    $content .= '</div>';
    $content .= '<div class="parityContent">';
    $content .= '<div class="parityColumn">';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Sembol</h5>';
    $content .= '<span id="paritySymbol"></span>';
    $content .= '</div>';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Satış</h5>';
    $content .= '<span id="paritySelling"></span>';
    $content .= '</div>';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Günlük En Yüksek</h5>';
    $content .= '<span id="parityDailyHight"></span>';
    $content .= '</div>';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Kapanış Fiyatı</h5>';
    $content .= '<span id="parityClosePrice"></span>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="parityColumn">';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Son İşlem Fiyatı</h5>';
    $content .= '<span id="parityLast"></span>';
    $content .= '</div>';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Günlük En Düşük</h5>';
    $content .= '<span id="parityDailyLow"></span>';
    $content .= '</div>';
    $content .= '<div class="parityItem">';
    $content .= '<h5 class="title">Açılış Fiyatı</h5>';
    $content .= '<span id="parityOpenPrice"></span>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    return $content;

}

add_shortcode('parite', 'parite_shortcode');