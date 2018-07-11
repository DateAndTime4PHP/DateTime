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

class DateInterval
{
    private $interval;

    public function __construct(string $interval)
    {
        $this->interval = new DateTimeInterval($interval);
        $this->interval->h = 0;
        $this->interval->i = 0;
        $this->interval->s = 0;
        $this->interval->f = 0;
    }

    public function format(string $format) : string
    {
        $format = preg_replace('/(?<!%)(%H|%h|%I|%i|%S|%s|%F|%f)/', '%$1', $format);

        return $this->interval->format($format);
    }

    public function getDateTimeInterval() : DateTimeInterval
    {
        return $this->interval;
    }

    public static function fromDateTimeInterval(DateTimeInterval $interval) : DateInterval
    {
        $string = 'P';

        if ($interval->days) {
            $string .= $interval->days . 'D';
        } else {
            if ($interval->y) {
                $string .= $interval->y . 'Y';
            }
            if ($interval->m) {
                $string .= $interval->m . 'M';
            }
            if ($interval->d) {
                $string .= $interval->d . 'D';
            }
        }

        return new self($string);
    }
}
