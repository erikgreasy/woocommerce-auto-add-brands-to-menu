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





add_filter( 'wp_nav_menu_objects', 'auto_add_tax_to_menu' );


function auto_add_tax_to_menu( $items ) {

    $tax_name = 'pwb-brand';

    $results = get_terms( array(
        'taxonomies' => $tax_name
    ) );

    // ITERATE THROUGH MENU ITEMS
    foreach ( $items as $item ) {
        $title = $item->title;
        $ID = $item->ID;
        if($title=='Domov'){
            $parentId = $ID;
        }
    }


    // ITERATE THROUGH SELECTED TERM
    foreach ( $results as $result ) {
    $name = $result->name;
    $id = $result->id;
    $url = get_term_link( $result );
    $link = array (
            'title'            => $name,
            'menu_item_parent' => $parentId,
            'ID'               => $id,
            'db_id'            => $id,
            'url'              => $url,
            'xfn'              => 'child',
            'target'           => '',
            'current'          => ''
        );

    $items[] = (object) $link;
    }

    return $items;   
}