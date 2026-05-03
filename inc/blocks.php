<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_register_custom_blocks' );
function crb_register_custom_blocks() {

    // BLOK 1: LEAFLET MAPA (TURNEJA)
    Block::make( __( 'Brkovi Mapa' ) )
        ->add_fields( array(
            Field::make( 'text', 'lat', __( 'Latitude' ) )->set_default_value('44.8125')->set_width(50),
            Field::make( 'text', 'lng', __( 'Longitude' ) )->set_default_value('20.4612')->set_width(50),
            Field::make( 'text', 'popup', __( 'Naziv Lokacije (Klub/Grad)' ) )->set_default_value('Koncert Brkova!'),
        ) )
        ->set_icon( 'location-alt' )
        ->set_category( 'widgets' )
        ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            if ( ! is_admin() ) {
                wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
                wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
            }
            $map_id = 'map-' . uniqid();
            if ( is_admin() ) {
                echo '<div class="p-4 bg-light text-center border">📍 Mapa će biti vidljiva na sajtu (Lat: '.$fields['lat'].')</div>';
                return;
            }
            ?>
            <div id="<?php echo $map_id; ?>" style="height: 400px; width: 100%;" class="my-4 shadow"></div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var map = L.map('<?php echo $map_id; ?>').setView([<?php echo $fields['lat']; ?>, <?php echo $fields['lng']; ?>], 14);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                    L.marker([<?php echo $fields['lat']; ?>, <?php echo $fields['lng']; ?>]).addTo(map)
                        .bindPopup('<?php echo esc_js($fields['popup']); ?>').openPopup();
                });
            </script>
            <?php
        } );
}
