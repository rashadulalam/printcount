<?php

namespace PrintCount\Frontend;

/**
 * Frontend
 */
class Frontend
{
    
    function __construct()
    {
        add_shortcode( 'print-count', [ $this, 'print_count_enquery' ] );
    }

    public function print_count_enquery($atts, $content = '' ) {
        
    }
}