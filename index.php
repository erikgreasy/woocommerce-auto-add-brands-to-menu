<?php

/*
 *  Plugin name: Woocommerce Auto Menu Brands
 *  Plugin URI: https://greasydesign.sk
 *  Description: WooCommerce plugin to automatically add woo brands to nav menu 
 *  Version: 1.0
 *  Author: Erik Masný
 *  Author URI: https://greasydesign.sk
 * 
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );





add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );

function your_custom_menu_item ( $items, $args ) {
    $cat_name = 'product_cat';
    $menu_name = 'top menu';


    if ( $args->menu->name == $menu_name ) {
        
        


    $taxonomy     = $cat_name;
    $orderby      = 'name';  
    $show_count   = 0;      // 1 for yes, 0 for no
    $pad_counts   = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title        = '';  
    $empty        = 0;



    $args = array(
        'taxonomy'     => $taxonomy,
        'orderby'      => $orderby,
        'show_count'   => $show_count,
        'pad_counts'   => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li'     => $title,
        'hide_empty'   => $empty
    );
    $all_categories = get_categories( $args );

    foreach( $all_categories as $category ) {
        $name = $category->name;
        $link = get_term_link( $category->slug, $cat_name );
        if( $name != __('uncategorized') ) {

            $items .= '<ul>
                            <li><a href="'. $link .'">'. $name .'</a></li>
                       </ul>';
        }
    }

}

    return $items;
}
