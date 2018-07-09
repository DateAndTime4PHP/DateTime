<?php

declare(strict_types = 1);

/*
 * Copyright (c) DateTime-Contributors
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use DateTime\Exception\NotYetImplemented;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

class Date
{
    private $datetime;

    /**
     * Date constructor.
     *
     * @param string $date A date-string in an ISO-format.
     *
     * @throws \Exception
     */
    public function __construct(string $date)
    {
        $tempDate = new DateTimeImmutable($date);
        $this->datetime = new DateTimeImmutable(
            $tempDate->format('Y-m-d') . 'T12:00:00.0',
            new DateTimeZone('UTC')
        );
        $this->datetime = $this->datetime->setTime(
            12,
            00,
            00,
            0
        );
    }

    public function format(string $format) : string
    {
        $format = $this->sanitizeFormatString($format);

        return $this->datetime->format($format);
    }

    public function add(DateInterval $interval) : Date
    {
        $self = clone($this);
        $self->datetime = $this->datetime->add($interval->getDateTimeInterval());

        return $self;
    }

    public function sub(DateInterval $interval) : Date
    {
        $self = clone($this);
        $self->datetime = $this->datetime->sub($interval->getDateTimeInterval());

        return $self;
    }

    public function modify(string $modification) : Date
    {
        throw new NotYetImplemented('"modify" is not yet implemented');
        // TODO Remove all time-information from modification-string
        $self = clone($this);
        $self->datetime = $this->datetime->modify($modification);

        return $self;
    }

    public function diff(Date $date) : DateInterval
    {
        return DateInterval::fromDateTimeInterval(
            $this->datetime->diff($date->datetime)
        );
    }

    public static function fromDateTimeInterface(DateTimeInterface $datetime)
    {
        return new self($datetime->format('Y-m-d'));
    }

    public function getYear() : int
    {
        return (int) $this->datetime->format('Y');
    }

    public function getMonth() : int
    {
        return (int) $this->datetime->format('n');
    }

    public function getDay() : int
    {
        return (int) $this->datetime->format('j');
    }

    private function sanitizeFormatString(string $format) : string
    {
        return preg_replace('/(?<!\\\\)([aABgGhHisuveIOPTZcrU])/', '\\\\$1', $format);
    }
}
