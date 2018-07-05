<?php

/*
 * Copyright (c) wdv Gesellschaft für Medien & Kommunikation mbH & Co. OHG
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use DateTimeImmutable;
use DateTimeZone;

class Time
{
    private $datetime;

    public function __construct(string $time)
    {
        $tempdate = new DateTimeImmutable($time);
        $this->datetime = new DateTimeImmutable(
            '1970-01-01 ' . $tempdate->format('H:i:s'),
            new DateTimeZone('UTC')
        );
    }

    public function add(TimeInterval $interval) : Time
    {
        $self = clone($this);
        $self->datetime = $this->datetime->add($interval->getDateTimeInterval());

        return $self;
    }

    public function sub(DateInterval $interval) : Time
    {
        $self = clone($this);
        $self->datetime = $this->datetime->sub($interval->getDateTimeInterval());

        return $self;
    }

    public function format(string $format) : string
    {
        $format = $this->sanitizeFormatString($format);

        return $this->datetime->format($format);
    }

    public function diff(Time $time) : TimeInterval
    {
        return TimeInterval::fromDateTimeInterval(
            $this->datetime->diff($time->datetime)
        );
    }

    public static function fromDateTimeInterface(DateTimeInterface $datetime)
    {
        return new self($datetime->format('H:i:s.f'));
    }

    private function sanitizeFormatString(string $format) : string
    {
        return preg_replace('/(?<!\\\\)([dDjlNSwzWFmMntLoYy])/', '\\\\$1', $format);
    }
}
