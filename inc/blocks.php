<?php

use Carbon_Fields\Container;
use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_register_custom_blocks');
function crb_register_custom_blocks()
{

    // BLOK 1: LEAFLET MAPA (TURNEJA)
    Block::make(__('Brkovi Mapa'))
        ->add_fields(array(
            Field::make('text', 'lat', __('Latitude'))->set_default_value('44.8125')->set_width(50),
            Field::make('text', 'lng', __('Longitude'))->set_default_value('20.4612')->set_width(50),
            Field::make('text', 'popup', __('Naziv Lokacije (Klub/Grad)'))->set_default_value('Koncert Brkova!'),
        ))
        ->set_icon('location-alt')
        ->set_category('widgets')
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            if (! is_admin()) {
                wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
                wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
            }
            $map_id = 'map-' . uniqid();
            if (is_admin()) {
                echo '<div class="p-4 bg-light text-center border">📍 Mapa će biti vidljiva na sajtu (Lat: ' . $fields['lat'] . ')</div>';
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
        });

    Block::make(__('Podaci o Koncertu'))
        ->add_fields(array(
            Field::make('date', 'event_date', __('Datum Koncerta'))->set_width(50),
            Field::make('text', 'event_city', __('Grad'))->set_width(50),
            Field::make('text', 'event_venue', __('Klub/Prostor'))->set_width(50),
            Field::make('text', 'event_tickets', __('Link za karte'))->set_width(50),
            Field::make('text', 'event_lat', __('Latitude'))->set_width(50),
            Field::make('text', 'event_lng', __('Longitude'))->set_width(50),
        ))
        ->set_description(__('Glavni podaci o koncertu koji se prikazuju na vrhu.'))
        ->set_icon('calendar-alt')
        ->set_category('layout')
        ->set_render_callback(function ($fields, $attributes, $inner_blocks) {
            if (is_admin()) {
                echo '<div class="p-3 bg-dark text-warning border border-warning rounded">';
                echo '<strong>📅 Modul za podatke:</strong> ' . esc_html($fields['event_city']) . ' (' . esc_html($fields['event_date']) . ')';
                echo '</div>';
                return;
            }
    ?>
        <!-- FRONTEND PRIKAZ UNUTAR SINGLE-KONCERTI STRANE -->
        <div class="event-hero bg-dark text-white p-5 rounded-4 shadow-lg mb-5 border-start border-warning border-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge bg-warning text-dark mb-2"><?php echo esc_html($fields['event_date']); ?></span>
                    <h1 class="display-4 fw-bold"><?php echo esc_html($fields['event_city']); ?></h1>
                    <p class="lead mb-0"><i class="bi bi-geo-alt"></i> <?php echo esc_html($fields['event_venue']); ?></p>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <?php if ($fields['event_tickets']) : ?>
                        <a href="<?php echo esc_url($fields['event_tickets']); ?>" class="btn btn-warning btn-lg px-5 fw-bold rounded-pill">Kupi Karte</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
        });
}
