<?php

/**
 * Insert printing data
 * 
 * @param  $args[] array
 * 
 * @return int
 */
function insert_new_print( $args = [] ) {
    global $wpdb;

    if( empty( $args['pc_title'] ) ) {
        return new \WP_Error( 'no-title', __( 'You must provide a print title', 'print-count') );
    }

    $defaults = [
        'pc_type'    => '',
        'pc_title'   => '',
        'pc_total'   => '',
        'pc_note'    => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),

    ];

    $data = wp_parse_args( $args, $defaults );

    $inserted = $wpdb->insert(
        $wpdb->prefix . 'pc',
        $data,
        [
            '%s',
            '%s',
            '%d',
            '%s',
            '%d',
            '%s'

        ]
    );

    if( ! $inserted ) {
        return new \WP_Error( 'faild-to-insert', __( 'Faild to insert data', 'print-count' ) );
    }

    return $wpdb->insert_id;
}


/**
 * Fetch the printing from database
 *   
 * @return array
 */
function get_printings( $args = [] ) {
    global $wpdb;

    $defaults = [
        'number'  => 10,
        'offset'  => 0,
        'orderby' => 'pc_ID',
        'order'   => 'ASC',
    ];

    $data = wp_parse_args( $args, $defaults );

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}pc
        ORDER BY {$data['orderby']} {$data['order']}
        LIMIT %d, %d",

        $data['offset'], $data['number']
    );

    $items = $wpdb->get_results( $sql );

    return $items;


}

/**
 * Get the count of total printing
 * 
 * @return int
 */
function printing_count()
{
   global $wpdb;

   $count = (int) $wpdb->get_var( "SELECT count(*) FROM {$wpdb->prefix}pc");

   return $count;
}