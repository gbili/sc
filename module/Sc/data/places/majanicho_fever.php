<?php ob_start() ?>
<p>Majanicho fever is a chiringuito almost on the water. Its main tower has a chillout top, where you can go and have the greatest view on your surfing husband.</p>
<p>During the summer, Majanicho Fever Bar organizes some cool events that you should definetely check out</p>
<?php
return array(
    // Marker
    'lat' => '28.740970',
    'lng' => '-13.936373',

    //General
    'type' => 'chiringuito',
    'title' => 'Majanicho Fever',
    'description' => ob_get_clean(), 
);
