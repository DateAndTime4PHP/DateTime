<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use Closure;
use DateTime\Timezone\Name;
use DateTime\Timezone\Timezone;
use DateTimeImmutable;
use DateTimeInterface;

class DateTime
{
    private $datetime;

    public function __construct(string $datetimeString = 'now', Timezone $timezone = null)
    {
        if (null === $timezone) {
            $timezone = Timezone::fromString('UTC');
        }
        $timezoneThief = function (Timezone $timezone) {
            return $timezone->timezone;
        };
        $timezoneThief = Closure::bind($timezoneThief, null, $timezone);

        $timezone = $timezoneThief($timezone);
        $this->datetime = new DateTimeImmutable($datetimeString, $timezone);
        $this->datetime->setTimezone($timezone);
    }

    public function add(DateTimeInterval $interval) : self
    {
        $self = clone($this);
        $self->datetime = $self->datetime->add($interval->getDateTimeInterval());

        return $self;
    }

    public function modify(string $modification) : self
    {
        $self = clone($this);
        $self->datetime = $this->datetime->modify($modification);

        return $self;
    }

    public function sub(DateTimeInterval $interval) : self
    {
        $self = clone($this);
        $self->datetime = $this->datetime->sub($interval->getDateTimeInterval());

        return $self;
    }

    public function diff(DateTime $date) : DateTimeInterval
    {
        return DateTimeInterval::fromDateTimeInterval(
            $this->datetime->diff($date->datetime)
        );
    }

    public function format(string $format) : string
    {
        return $this->datetime->format($format);
    }

    public function getTimestamp() : int
    {
        return $this->datetime->getTimestamp();
    }

    public function getTimezone() : Timezone
    {
        return Timezone::fromString($this->datetime->getTimezone()->getName());
    }

    public static function createFromFormat(
        string $format,
        string $time,
        TimeZone $timezone = null
    ) : self
    {
        if (null === $timezone) {
            $timezone = Timezone::fromString('UTC');
        }

        $timezoneThief = function (Timezone $timezone) {
            return $timezone->timezone;
        };
        $timezoneThief = Closure::bind($timezoneThief, null, $timezone);
        $timezone      = $timezoneThief($timezone);

        $datetime = DateTimeImmutable::createFromFormat($format, $time, $timezone);

        return self::createFromPhpDateTime($datetime);
    }

    public static function createFromPhpDateTime(DateTimeInterface $datetime) : self
    {
        return new self(
            $datetime->format('c'),
            Timezone::fromString($datetime->getTimezone()->getName())
        );
    }
}
