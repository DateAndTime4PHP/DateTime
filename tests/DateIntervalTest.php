<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\DateInterval;
use DateInterval as DateTimeInterval;
use PHPUnit\Framework\TestCase;

class DateIntervalTest extends TestCase
{

    /** @covers \DateTime\DateInterval::getDateTimeInterval */
    public function testGetDateTimeInterval()
    {
        $interval = new DateInterval('P1Y1M1DT1H1M1S');
        self::assertEquals(
            new DateTimeInterval('P1Y1M1D'),
            $interval->getDateTimeInterval()
        );
    }

    /** @covers \DateTime\DateInterval::format */
    public function testFormat()
    {
        $interval = new DateInterval('P1Y1M1D');
        self::assertEquals(
            '%011011011(unknown)%H%h%I%i%S%s%F%f+',
            $interval->format('%%%Y%y%M%m%D%d%a%H%h%I%i%S%s%F%f%R%r')
        );
    }

    /** @covers \DateTime\DateInterval::fromDateTimeInterval */
    public function testFromDateTimeInterval()
    {
        $datetimeinterval = new DateTimeInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateTimeInterval('P1Y1M1D'),
            'interval',
            DateInterval::fromDateTimeInterval($datetimeinterval)
        );
    }

    /** @covers \DateTime\DateInterval::__construct */
    public function testInstantiation()
    {
        $interval = new DateInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateTimeInterval('P1Y1M1D'),
            'interval',
            $interval
        );
    }
}
