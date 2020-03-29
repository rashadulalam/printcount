<?php

namespace PrintCount\Frontend;

/**
 * Frontend
 */
class Enquery
{
    
    function __construct()
    {
        add_shortcode( 'print-count', [ $this, 'print_count_enquery' ] );
    }

    public function print_count_enquery($atts, $content = '' ) {
        

        ob_start();
            include __DIR__ .'/views/enquery.php';
        return ob_get_clean();
    }
}