<?php
namespace Lang;
return array(
    'translation_file_patterns' => array(
        array(
            'type'     => 'phparray',
            'base_dir' => __DIR__ . '/../language',
            'pattern'  => '%s.php',
            'text_domain' => strtolower(__NAMESPACE__),
        ),
    ),
);
