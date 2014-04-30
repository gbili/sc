<?php ob_start() ?>
<p>El faro de Cotillo, is a great spot in the north shore. It's red and white stripes make it unmissable.</p>
<?php
return array(
    // Marker
    'lat' => '28.715555',
    'lng' => '-14.013692',

    //General
    'type' => 'tourism',
    'title' => 'Faro Cotillo',
    'description' => ob_get_clean(), 
);
