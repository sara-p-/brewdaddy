<?php

    class WP_Boilerplate_Facet {
        // =========================================================================
        // ADDING SUPPORT FOR FACETWP
        // =========================================================================
        static function main_query() {
            add_filter( 'facetwp_is_main_query', function( $bool, $query ) {
                return ( true === $query->get( 'facetwp' ) ) ? true : $bool;
            }, 10, 2 );
        }

        // =========================================================================
        // ADDING Labels
        // =========================================================================
        static function fwp_add_facet_labels() {
        ?>
        <script>
        (function($) {
            $(document).on('facetwp-loaded', function() {
                $('.facetwp-facet').each(function() {
                    console.log('facet loaded');
                    var $facet = $(this);
                    var facet_name = $facet.attr('data-name');
                    var facet_label = FWP.settings.labels[facet_name];

                    if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
                        $facet.wrap('<div class="facet-wrap"></div>');
                        $facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
                    }
                });
            });
        })(jQuery);
        </script>
        <?php
        }

        // =========================================================================
        // CHANGING THE MARKUP FOR SLIDERS
        // =========================================================================
        function range_markup($html, $params) {
            if ( 'slider' == $params['facet']['type'] ) {
                $label = $params['facet']['label'];
                $output = str_replace( '<span class="facetwp-slider-label">', '<span class="facetwp-slider-label">' .  $label . ' - ', $output );
            }
            return $output;
        }
    }