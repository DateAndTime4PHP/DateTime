<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\Time;
use DateTime\TimeInterval;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    /** @covers \DateTime\Time::sub */
    public function testSub()
    {
        $date = new Time('12:23:34.567');

        $date1 = $date->sub(new TimeInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new Time('11:22:33.567'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('1970-01-01 11:22:33.567', new DateTimeZone('UTC')),
            'datetime',
            $date1
        );
    }

    /** @covers \DateTime\Time::add */
    public function testAdd()
    {
        $date = new Time('12:23:34.567');

        $date1 = $date->add(new TimeInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new Time('13:24:35.567'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('1970-01-01 13:24:35.567', new DateTimeZone('UTC')),
            'datetime',
            $date1
        );
    }

    /** @covers \DateTime\Time::diff */
    public function testDiff()
    {
        $date1 = new Time('12:23:34.567');
        $date2 = new Time('13:24:35.678');

        $diff1 = $date1->diff($date2);
        $diff2 = $date2->diff($date1);

        self::assertEquals($diff1, $diff2);

        self::assertEquals(0, $diff1->getDateTimeInterval()->y);
        self::assertEquals(0, $diff1->getDateTimeInterval()->m);
        self::assertEquals(0, $diff1->getDateTimeInterval()->d);
        self::assertEquals(1, $diff1->getDateTimeInterval()->h);
        self::assertEquals(1, $diff1->getDateTimeInterval()->i);
        self::assertEquals(1, $diff1->getDateTimeInterval()->s);
        self::assertEquals(0.0, $diff1->getDateTimeInterval()->f);

    }

    /** @covers \DateTime\Time::format */
    public function testFormat()
    {
        $date = new Time('12:23:34.567');

        self::assertEquals(
            'pmbcdef121223jklmnopqr34t567000567wxyzPM558CDEF1212IJKLMNOPQRSTUVWXYZ',
            $date->format('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        );

    }

    /** @covers \DateTime\Time::__construct */
    public function testInstantiation()
    {
        $date = new Time('12:23:34.567');

        $datetime = new DateTimeImmutable('1970-01-01 12:23:34.567', new DateTimeZone('UTC'));

        self::assertAttributeInstanceOf(DateTimeImmutable::class, 'datetime', $date);
        self::assertAttributeEquals($datetime, 'datetime', $date);
    }

    /** @covers \DateTime\Time::fromDateTimeInterface */
    public function testFromDateTimeInterface()
    {
        $datetime1 = new DateTimeImmutable('2018-07-09 12:23:34.567', new DateTimeZone('UTC'));
        $datetime2 = new DateTimeImmutable('1970-01-01 12:23:34.567', new DateTimeZone('UTC'));

        $date = Time::fromDateTimeInterface($datetime1);

        self::assertAttributeInstanceOf(DateTimeImmutable::class, 'datetime', $date);
        self::assertAttributeEquals($datetime2, 'datetime', $date);
    }
}
