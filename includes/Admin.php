<?php

namespace PrintCount;


/**
 * Admin
 */
class Admin {
    

    /**
     * Initialize the class
     */
    function __construct() {
        $printings = new Admin\Printings();

        new Admin\Menu( $printings );

        $this->despatch_actions( $printings );
    }


    /**
     * Dispatch and bind actions
     * 
     * @return void
     */
    public function despatch_actions( $printings ) {
        add_action( 'admin_init', [ $printings, 'form_handler' ] );

        add_action( 'admin_post_printing-delete', [ $printings, 'delete_printing'] );
    }
}