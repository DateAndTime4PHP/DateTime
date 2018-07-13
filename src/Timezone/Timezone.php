<?php

/*
 * Copyright (c) DateTime-Contributors
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime\Timezone;

use Closure;
use DateTime\DateTime;
use DateTimeZone;

abstract class Timezone
{
    const AFRICA = 1 ;
    const AMERICA = 2 ;
    const ANTARCTICA = 4 ;
    const ARCTIC = 8 ;
    const ASIA = 16 ;
    const ATLANTIC = 32 ;
    const AUSTRALIA = 64 ;
    const EUROPE = 128 ;
    const INDIAN = 256 ;
    const PACIFIC = 512 ;
    const UTC = 1024 ;
    const ALL = 2047 ;
    const ALL_WITH_BC = 4095 ;
    const PER_COUNTRY = 4096 ;

    const TYPE_TIMEZONE = 3;
    const TYPE_ABBREVIATION = 2;
    const TYPE_OFFSET = 1;

    protected $timezone;

    private function __construct(DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
    }

    public function getType() : int
    {
        if (false !== $this->timezone->getLocation()) {
            return self::TYPE_TIMEZONE;
        }
        if (false !== strpos($this->getName(), ':')) {
            return self::TYPE_OFFSET;
        }

        return self::TYPE_ABBREVIATION;
    }

    public function getName() : string
    {
        return $this->timezone->getName();
    }

    public function getOffset(DateTime $datetime) : int
    {
        $datetimeThief = function (DateTime $datetime) {
            return $datetime->datetime;
        };
        $datetimeThief = Closure::bind($datetimeThief, null, $datetime);
        $datetime       = $datetimeThief($datetime);

        return $this->timezone->getOffset($datetime);
    }

    public function getTransitions(int $timestamp_begin = null, int $timestamp_end = null) : array
    {
        return $this->timezone->getTransitions($timestamp_begin, $timestamp_end);
    }

    public static function listAbbreviations() : array
    {
        return DateTimeZone::listAbbreviations();
    }

    public static function listIdentifiers(int $what = self::ALL, string $country = null) : array
    {
        return DateTimeZone::listIdentifiers($what, $country);
    }

    public static function fromString(string $timezone) : self
    {
        $timezone = new DateTimeZone($timezone);

        if (false !== $timezone->getLocation()) {
            return new Name($timezone);
        }
        if (false !== strpos($timezone->getName(), ':')) {
            return new Offset($timezone);
        }

        return new Abbreviation($timezone);
    }
}
