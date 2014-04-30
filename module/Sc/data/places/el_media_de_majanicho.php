<?php ob_start() ?>
<p>El medio de majanicho is a great spot. Its pros are:</p>
<ul>
    <li>The closest spot to Lajares</li>
</ul>
<p>Not everything is green though, cons:</p>
<ul>
    <li>It's rocky access makes it a real pain to get in. However, you can go round and access from the "the right of majanicho".</li>
    <li>There is a single wave which covers the whole whidth, so you either stay on the sides, or the comeback may be difficult.</li>
</ul>
<?php
return array(
    // Marker
    'lat' => '28.742400',
    'lng' => '-13.935600',
    'icon' => 'icon_majanicho_fever',

    //General
    'title' => 'El Medio de Majanicho',
    'type' => 'surfspot',
    'description' => ob_get_clean(),
);
