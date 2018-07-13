<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime\Timezone;

use Closure;

class Location
{
    private $countryCode;

    private $latitude;

    private $longitude;

    private $comment;

    private function __construct(string $countryCode, float $latitude, float $longitude, string $comment)
    {
        $this->countryCode = $countryCode;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->comment = $comment;
    }

    public static function fromTimezone(Name $timezone) : self
    {
        $timezoneThief = function (Name $timezone) {
            return $timezone->timezone;
        };
        $timezoneThief = Closure::bind($timezoneThief, null, $timezone);
        $location = $timezoneThief($timezone)->getLocation();
        return new self(
            $location['country_code'],
            $location['latitude'],
            $location['longitude'],
            $location['comments']
        );

    }

    public function getCountryCode() : string
    {
        return $this->countryCode;
    }

    public function getLatitude() : float
    {
        return $this->latitude;
    }

    public function getLongitude() : float
    {
        return $this->longitude;
    }

    public function getComments() : string
    {
        return $this->comment;
    }
}
