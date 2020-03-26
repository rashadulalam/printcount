<?php

namespace PrintCount\Admin;



/**
 * Printings
 */
class Printings
{
    
    /**
     * Creating plugin page
     * @return void
     */
    public function printing_page() {
    
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';

        switch ( $action ) {
            case 'new':
                $template = __DIR__ . '/views/new-print.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/edit-print.php';
                break;
            
            default:
                $template = __DIR__ . '/views/list-print.php';
                break;
        }

        if( file_exists( $template ) ) {
            include $template;
        }
    }


    public function form_handler() {
       
        if( ! isset( $_POST['submit_print'] ) ) {
            return;
        }

        if( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-print' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }

        $pring_type  = isset( $_POST['print-type']) ? $_POST['print-type'] : '';
        
        $print_title = isset( $_POST['print-title']) ? $_POST['print-title'] : '';
        
        $total_print = isset( $_POST['total-print']) ? $_POST['total-print'] : '';
        
        $print_note  = isset( $_POST['print-note']) ? $_POST['print-note'] : '';

        $args = [
            'pc_type'  => $pring_type,
            'pc_title' => $print_title,
            'pc_total' => $total_print,
            'pc_note'  => $print_note,
        ];

        $insert_id = insert_new_print( $args );

    }
}