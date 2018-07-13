<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateInterval;
use DateTime\DateTimeInterval;
use PHPUnit\Framework\TestCase;

class DateTimeIntervalTest extends TestCase
{

    /** @covers \DateTime\DateTimeInterval::getDateTimeInterval */
    public function testGetDateTimeInterval()
    {
        $interval = new DateTimeInterval('P1Y1M1DT1H1M1S');
        self::assertEquals(
            new DateInterval('P1Y1M1DT1H1M1S'),
            $interval->getDateTimeInterval()
        );
    }

    /** @covers \DateTime\DateTimeInterval::format */
    public function testFormat()
    {
        $interval = new DateTimeInterval('P1Y1M1DT1H1M1S');
        self::assertEquals(
            '%011011011(unknown)0110110110000000+',
            $interval->format('%%%Y%y%M%m%D%d%a%H%h%I%i%S%s%F%f%R%r')
        );
    }

    /** @covers \DateTime\DateTimeInterval::fromDateTimeInterval */
    public function testFromDateTimeInterval()
    {
        $datetimeinterval = new DateInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateInterval('P1Y1M1DT1H1M1S'),
            'interval',
            DateTimeInterval::fromDateTimeInterval($datetimeinterval)
        );
    }

    /** @covers \DateTime\DateTimeInterval::__construct */
    public function testInstantiation()
    {
        $interval = new DateTimeInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateInterval('P1Y1M1DT1H1M1S'),
            'interval',
            $interval
        );
    }
}
