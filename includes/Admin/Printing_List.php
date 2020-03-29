<?php

namespace PrintCount\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}


/**
 * Printing List
 */
class Printing_List extends \WP_List_Table
{
    
    function __construct()
    {
        parent::__construct( [
            'singular' => __( 'Printing', 'print-count' ),
            'plural'   => __( 'Printings', 'print-count' ),
            'ajax'     => false,
        ] );
    }

    public function no_items() {
        _e( 'No printing found', 'print-count' );
    }

    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'pc_title'   => __( 'Print title', 'print-cou'), 
            'pc_type'    => __( 'Print type', 'print-cou'), 
            'pc_total'   => __( 'Print total', 'print-cou'),
            'pc_note'    => __( 'Note', 'print-cou'), 
            'created_by' => __( 'Recorded by', 'print-cou'), 
            'created_at' => __( 'Print time', 'print-cou'), 

        ];
    }

    public function get_bulk_actions() {
        $actions =  array(
            'trash' => __( 'Move to Trash', 'print-count' )
        );

        return $actions;
    }

    protected function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            
            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

                
            
            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    public function column_pc_title( $item ) {

        $actions = [];

        $actions['edit'] = sprintf(

            '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=print-count&action=edit&id=' . $item->pc_ID ), __( 'Edit', 'print-count' ),__( 'Edit', 'print-count' )

        );

        $actions['delete'] = sprintf(

            '<a href="#" class="submitdelete" data-id="%s">%s</a>', $item->pc_ID, __( 'Delete', 'print-count' )

        );

        return sprintf(

            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=print-count&action=view&id=' . $item->pc_ID ), $item->pc_title, $this->row_actions( $actions )

        );
    }

    public function get_sortable_columns()
    {
        $sortable_columns = [
            'pc_title' => [ 'pc_title', true ],
            'created_at' => [ 'created_at', true],
        ];

        return $sortable_columns;
    }

    protected function column_cb( $item )
    {
        return sprintf(
            '<input type="checkbox" name="printing_id[]" value="%d" />', $item->pc_ID
        );
    }

    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [ $column, $hidden, $sortable ];

        $per_page     = 10;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;


        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if( isset( $_REQUEST['orderby']) && isset( $_REQUEST['order']) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'];


        }

        $this->items = get_printings( $args );


        $this->set_pagination_args( [
            'total_items' => printing_count(),
            'per_page'    => $per_page,
        ] );

    }
}