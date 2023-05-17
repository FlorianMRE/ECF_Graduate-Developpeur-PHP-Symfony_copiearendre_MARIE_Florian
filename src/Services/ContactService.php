<?php

namespace App\Services;

use App\Repository\OpeningHoursRepository;

class ContactService
{
    public function openingHours(
        $openingHours
    ): array
    {
        $openingHoursArray = [];

        foreach ($openingHours as $key => $hours) {
            if (!is_null($hours->getWeekDay()) && !empty($hours->getWeekDay())) {
                $openingHoursArray[$key]['day'] = $hours->getWeekDay();
            } else {
                $openingHoursArray[$key]['day'] = '';
            }
            if (!is_null($hours->getAmOpen()) && !empty($hours->getAmOpen())) {
                $openingHoursArray[$key]['amopen'] = substr($hours->getAmOpen(), 0, 2) . ':' . substr($hours->getAmOpen(), 2, 2);
            } else {
                $openingHoursArray[$key]['amopen'] = '';
            }
            if (!is_null($hours->getAmClose()) && !empty($hours->getAmClose())) {
                $openingHoursArray[$key]['amclose'] = substr($hours->getAmClose(), 0, 2) . ':' . substr($hours->getAmClose(), 2, 2);
            } else {
                $openingHoursArray[$key]['amclose'] = '';
            }
            if (!is_null($hours->getPmOpen()) && !empty($hours->getPmOpen())) {
                $openingHoursArray[$key]['pmopen'] = substr($hours->getPmOpen(), 0, 2) . ':' . substr($hours->getPmOpen(), 2, 2);
            } else {
                $openingHoursArray[$key]['pmopen'] = '';
            }
            if (!is_null($hours->getPmClose()) && !empty($hours->getPmClose())) {
                $openingHoursArray[$key]['pmclose'] = substr($hours->getPmClose(), 0, 2) . ':' . substr($hours->getPmClose(), 2, 2);
            } else {
                $openingHoursArray[$key]['pmclose'] = '';
            }
            $openingHoursArray[$key]['dayclose'] = $hours->isCloseDay();
        }

        return $openingHoursArray;
    }
}