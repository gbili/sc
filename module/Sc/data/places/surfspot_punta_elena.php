<?php ob_start() ?>
<p>Punta Elena is a great surfspot in Corralejo. You can do some shopping and easily</p>
<?php
return array(
    // Marker
    'lat' => '28.740970',
    'lng' => '-13.936373',

    //General
    'type' => 'surfspot',
    'title' => 'Punta Elena',
    'description' => ob_get_clean(), 
);
