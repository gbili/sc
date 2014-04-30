<?php
namespace TwitterExtendedGeoProtocol\Service;

class Converter 
{
    protected $patterns;

    public function __construct($fullPattern, $scorePattern)
    {
        $this->patterns = array(
            'full' => $fullPattern,
            'score' => $scorePattern,
        );
    }

    public function toStatusText(array $data)
    {
        $text = "{$data['user']}({$data['zoom']})";
        return $text . array_reduce($data['scores'], function ($ret, $elem) {
            return "$ret{$elem['score_tag']}:{$elem['score_value']};";
        }, '');
    }

    public function extractStatusesTextData(array $statuses)
    {
        // Extract each status data
        foreach ($statuses as $status) {
            $status->tgp_data = $this->statusTextToArray($status->text);
        }
        return $statuses;
    }

    /**
     * Pattern 
     * '<user>(<geo-tag>:<lat>,<long>,<zoom>)<score-tag>:<score>;<score-tag>:<score>;'
     *                                                   min-max | max cumulated
     *  <user>      : [A-Za-z0-9_]{1,15}                 -> 1-15 | 15 : gbili_
     *  <geo_tag>   : [A-Za-z0-9 ]{0,28}                 -> 0-28 | 41 : Some_____________place, some_13__________place
     *  <lat>       : \d{1,2}\.\d{6}                     -> 6-8  | 51 : 13.444789, 1.343344
     *  <long>      : -?\d{1,2}\.\d{6}                   -> 7-9  | 60 : -13.343344
     *  <zoom>      : (?:[1-9][0-9]?)                    -> 1-2  | 62 : 1, 99 
     *  <score_tag> : ([A-Za-z ]{0,19}[a-z])?            -> 0-20 | 82 : Some     Tag
     *  <score_count>     : ((?:0)|(?:[1-9][0-9]?)|100)  -> 1-3  | 85 : 0, 94, 100
     *
     *  Total                                            -> 15-85
     *
     *  Delimiters  : (:,,):;:;:;                        -> 7-9-11
     *  Total with separators                            -> min:(15+7)-max:(85+7)-(85+22+9)-(85+22+22+11)
     *  Total with separators                            -> min:22-max:92-116-140
     *  Max ;<score-tag>:<score> = 3
     */
    public function statusTextToArray($text)
    {
        $matches      = array();
        $scoreMatches = array();
        if (0 === preg_match($this->patterns['full'], $text, $matches)) {
            return array();
        } else if (0 === preg_match_all($this->patterns['score'], $matches['scores'], $scoreMatches)) {
            throw new \Exception('Bad score pattern');
        }
        return $this->constructDataArray($matches, $scoreMatches);
    }

    protected function constructDataArray($matches, $scoreMatches)
    {
        $data = $this->cleanupMatches($matches);
        $data['scores'] = $this->refactorScoreMatchesArray($scoreMatches);
        return $data;
    }

    protected function cleanupMatches($matches)
    {
        unset($matches['score_tag'], $matches[4], $matches['score_value'], $matches[5]);
        return $matches;
    }

    protected function refactorScoreMatchesArray($scoreMatches)
    {
        $refactored = array();
        $scoresCount = count($scoreMatches['score_tag']);
        for ($i=0;$i<$scoresCount;$i++) {
            $refactored[$i] = array(
                'score_tag' => $scoreMatches['score_tag'][$i], 
                'score_value' => $scoreMatches['score_value'][$i], 
            );
        }
        return $refactored;
    }

    public function tests()
    {
        $status = new \StdClass();
        $status->text = 'gbili_com(17)wave height:1;asdf d:23;';

        $expectedStatus = clone $status;
        $expectedStatus->tgp_data = array (
            0 => 'gbili_com(17)wave height:1;asdf d:23;',
            'user' => 'gbili_com',
            1 => 'gbili_com',
            'zoom' => '17',
            2 => '17',
            'scores' => array( 
                0 => array(
                    'score_tag' => 'wave height',
                    'score_value' => '1',
                ),
                1 => array(
                    'score_tag' => 'asdf d',
                    'score_value' => '23',
                ),
            ),
            3 => 'wave height:1;asdf d:23;',
        );

        $status = current($this->extractStatusesTextData(array($status)));

        if (!property_exists($status, 'tgp_data')) {
            throw new \Exception('Missing tgp_data property');
        } else {
            echo '.';
        }

        if ($status->tgp_data !== $expectedStatus->tgp_data) {
            throw new \Exception('Conversion went wrong');
        } else {
            echo '.';
        }

        if ($expectedStatus->text !== $this->toStatusText($status->tgp_data)) {;
            throw new \Exception('Data does not convert to the same status text');
        } else {
            echo '.';
        }
    }
}
