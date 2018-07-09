<?php

declare(strict_types = 1);

/*
 * Copyright (c) DateTime-Contributors
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

class Time
{
    private $datetime;

    public function __construct(string $time)
    {
        $tempdate = new DateTimeImmutable($time);
        $this->datetime = new DateTimeImmutable(
            '1970-01-01 ' . $tempdate->format('H:i:s.u'),
            new DateTimeZone('UTC')
        );
    }

    public function add(TimeInterval $interval) : Time
    {
        $self = clone($this);
        $self->datetime = $this->datetime->add($interval->getDateTimeInterval());

        return $self;
    }

    public function sub(TimeInterval $interval) : Time
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
        return new self($datetime->format('H:i:s.u'));
    }

    private function sanitizeFormatString(string $format) : string
    {
        return preg_replace('/(?<!\\\\)([rceIOPTZUdDjlNSwzWFmMntLoYy])/', '\\\\$1', $format);
    }
}
