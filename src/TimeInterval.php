<?php

declare(strict_types = 1);

/*
 * Copyright (c) DateTime-Contributors
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime;

use DateInterval as DateTimeInterval;

class TimeInterval
{
    private $interval;

    public function __construct(string $interval)
    {
        $this->interval = new DateTimeInterval($interval);
        $this->interval->d = 0;
        $this->interval->m = 0;
        $this->interval->y = 0;
        $this->interval->days = 0;
    }

    public function getDateTimeInterval() : DateTimeInterval
    {
        return $this->interval;
    }

    public static function fromDateTimeInterval(DateTimeInterval $interval) : TimeInterval
    {
        $string = 'PT';

        if ($interval->h) {
            $string .= $interval->h . 'H';
        }
        if ($interval->i) {
            $string .= $interval->i . 'M';
        }
        if ($interval->s) {
            $string .= $interval->s . 'S';
        }

        return new self($string);
    }

    public function format(string $format) : string
    {
        $format = preg_replace('/(?<!%)(%Y|%y|%M|%m|%D|%d|%a)/', '%$1', $format);

        return $this->interval->format($format);
    }
}
