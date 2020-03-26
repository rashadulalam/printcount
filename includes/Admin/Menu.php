<?php

namespace PrintCount\Admin;

/**
 * Menu
 */
class Menu
{
    public $printings;
    
    public function __construct( $printings )
    {
        $this->printings = $printings;

        add_action( 'admin_menu', [ $this, 'admin_menu'] );
    }


    public function admin_menu()
    {
        $parent_slug = "print-count";

        add_menu_page( __( "Print Count", "print-count"), __( "Print", "print-count" ), "manage_options", $parent_slug, [ $this->printings, "printing_page"], "dashicons-welcome-learn-more" );
        add_submenu_page( $parent_slug, __( "Print Count", "print-count"), __( "Print count", "print-count" ), "manage_options", $parent_slug, [ $this->printings, "printing_page"] );
        add_submenu_page( $parent_slug, __( "Print Count settings", "print-count"), __( "Print count Settings", "print-count" ), "manage_options", $parent_slug . '-settings', [ $this, "printing_settings"] );
    }

    public function printing_settings()
    {
        # code...
    }

}