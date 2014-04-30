<?php ob_start() ?>
<p>Playa punta elena is a great sunbathing spot. Close to Corralejo.</p>
<?php
return array(
    // Marker
    'lat' => '28.740970',
    'lng' => '-13.936373',

    //General
    'type' => 'sunbathing',
    'title' => 'Playa Punta Elena',
    'description' => ob_get_clean(), 
);
