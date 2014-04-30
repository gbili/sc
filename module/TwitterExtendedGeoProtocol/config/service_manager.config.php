<?php
namespace TwitterExtendedGeoProtocol;

return array(
    'aliases' => array(
        'tegpConverter' => 'TwitterExtendedGeoProtocol\Service\Converter',
    ),

    'factories' => array(
        'TwitterExtendedGeoProtocol\Service\Converter' => function ($sm) {
            $scorePattern       = '/' . $sm->get('tegpScorePatternCompiledPart') . '/';
            $geoProtocolPattern = '/^'. $sm->get('tegpAggregatedPatternCompiled') . '$/';
            $service = new Service\Converter($geoProtocolPattern, $scorePattern);
            return $service;
        },

        'tegpAggregatedPatternCompiled' => function ($sm) {
            $config = $sm->get('Config');
            $tegpConfig = $config['tweet_geo_protocol_status']['patterns'];
            $userPart  = $sm->get('tegpUserPatternCompiledPart');
            $geoPart   = $sm->get('tegpGeoPatternCompiledPart');
            $scorePart = $sm->get('tegpScorePatternCompiledPart');
            return "{$userPart}{$geoPart}(?<scores>(?:$scorePart){1,3})";
        },

        'tegpUserPatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tegpNamedPatterns');
            return $patterns['user'];
        },

        'tegpGeoPatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tegpNamedPatterns');
            return "\\({$patterns['zoom']}\\)";
        },

        'tegpScorePatternCompiledPart' => function ($sm) {
            $patterns = $sm->get('tegpNamedPatterns');
            return "{$patterns['score_tag']}:{$patterns['score_value']};";
        },

        'tegpNamedPatterns' => function ($sm) {
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

