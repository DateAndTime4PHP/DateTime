<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\TimeInterval;
use DateInterval as DateTimeInterval;
use PHPUnit\Framework\TestCase;

class TimeIntervalTest extends TestCase
{

    /** @covers \DateTime\TimeInterval::getDateTimeInterval */
    public function testGetDateTimeInterval()
    {
        $interval = new TimeInterval('P1Y1M1DT1H1M1S');
        self::assertEquals(
            new DateTimeInterval('PT1H1M1S'),
            $interval->getDateTimeInterval()
        );
    }

    /** @covers \DateTime\TimeInterval::format */
    public function testFormat()
    {
        $interval = new TimeInterval('PT1H1M1S');
        self::assertEquals(
            '% %Y%y%M%m%D%d%a0110110110000000+',
            $interval->format('%% %Y%y%M%m%D%d%a%H%h%I%i%S%s%F%f%R%r')
        );
    }

    /** @covers \DateTime\TimeInterval::fromDateTimeInterval */
    public function testFromDateTimeInterval()
    {
        $datetimeinterval = new DateTimeInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateTimeInterval('PT1H1M1S'),
            'interval',
            TimeInterval::fromDateTimeInterval($datetimeinterval)
        );
    }

    /** @covers \DateTime\TimeInterval::__construct */
    public function testInstantiation()
    {
        $interval = new TimeInterval('P1Y1M1DT1H1M1S');

        self::assertAttributeEquals(
            new DateTimeInterval('PT1H1M1S'),
            'interval',
            $interval
        );
    }
}
