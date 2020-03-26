<?php

namespace PrintCount;


/**
 * Installer class
 */
class Installer 
{
    
    /**
     * Run the installer
     * @return void
     */
    public function run() {

        $this->create_table();
    }


    /**
     * Creating mysql table
     * @return void
     */
    public function create_table() {
        
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}pc` (
         `pc_ID` int(11) NOT NULL AUTO_INCREMENT,
         `pc_type` varchar(30) NOT NULL,
         `pc_title` varchar(100) NOT NULL,
         `pc_total` int(4) NOT NULL,
         `pc_note` varchar(255) DEFAULT NULL,
          `created_by` bigint(20) NOT NULL,
          `created_at` datetime NOT NULL,
         PRIMARY KEY (`pc_ID`)
        ) $charset_collate";


        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}