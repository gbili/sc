<?php
namespace TwitterGeoProtocol;

return array(
    'aliases' => array(
        'tgpConverter' => 'TwitterGeoProtocol\Service\Converter',
    ),

    'factories' => array(
        'TwitterGeoProtocol\Service\Converter' => function ($sm) {
            $scorePattern       = '/' . $sm->get('tgpScorePatternCompiledPart') . '/';
            $geoProtocolPattern = '/^'. $sm->get('tgpAggregatedPatternCompiled') . '$/';
            $service = new Service\Converter($geoProtocolPattern, $scorePattern);
            return $service;
        },

        'tgpAggregatedPatternCompiled' => function ($sm) {
            $config = $sm->get('Config');
            $tgpConfig = $config['tweet_geo_protocol_status']['patterns'];
            $userPart  = $sm->get('tgpUserPatternCompiledPart');
            $geoPart   = $sm->get('tgpGeoPatternCompiledPart');
            $scorePart = $sm->get('tgpScorePatternCompiledPart');
            return "{$userPart}{$geoPart}(?<scores>(?:$scorePart){1,3})";
        },

        'tgpUserPatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tgpNamedPatterns');
            return $patterns['user'];
        },

        'tgpGeoPatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tgpNamedPatterns');
            return "\\({$patterns['geo_tag']}:{$patterns['lat']},{$patterns['long']},{$patterns['zoom']}\\)";
        },

        'tgpScorePatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tgpNamedPatterns');
            return "{$patterns['score_tag']}:{$patterns['score_value']};";
        },

        'tgpNamedPatterns' => function ($sm) {
            $config = $sm->get('Config');
            $patternSections = $config['tweet_geo_protocol_status']['patterns'];
            $patterns = array();
            foreach ($patternSections as $patternSection) {
                foreach ($patternSection as $identifier => $subPattern) {
                    $patterns[$identifier] = "(?<$identifier>$subPattern)";
                }
            }
            return $patterns;
        },

        'twitter' => function ($sm) {
            $service = new \ZendService\Twitter\Twitter\Twitter();
        },
    ),
);

