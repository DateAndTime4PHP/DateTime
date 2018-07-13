<?php

declare(strict_types = 1);

/*
 * Copyright (c) DateTime-Contributors
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use DateInterval;

class DateTimeInterval
{
    private $interval;

    public function __construct(string $interval)
    {
        $this->interval = new DateInterval($interval);
    }

    public function format(string $format) : string
    {
        return $this->interval->format($format);
    }

    public function getDateTimeInterval() : DateInterval
    {
        return $this->interval;
    }

    public static function fromDateTimeInterval(DateInterval $interval) : self
    {
        $self = new self('P1Y');
        $self->interval = $interval;

        return $self;
    }
}
