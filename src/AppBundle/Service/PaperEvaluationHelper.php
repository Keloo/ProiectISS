<?php

namespace AppBundle\Service;

use Symfony\Component\Config\Definition\Exception\Exception;

class PaperEvaluationHelper
{
    private $rateMap = [
        1 => 'Strong Accept',
        2 => 'Accept',
        3 => 'Weak Accept',
        4 => 'Borderline',
        5 => 'Weak Reject',
        6 => 'Reject',
        7 => 'Strong Reject'
    ];

    /**
     * @return array
     */
    public function getRateMap()
    {
        return $this->rateMap;
    }

    /**
     * @param array $rateMap
     */
    public function setRateMap($rateMap)
    {
        $this->rateMap = $rateMap;
    }

    /**
     * @param $rate
     * @return mixed
     */
    public function rateToText($rate)
    {
        if ($rate < 1 or $rate > 7) {
            throw new Exception("Rate out of range");
        }

        return $this->rateMap[$rate];
    }
}
