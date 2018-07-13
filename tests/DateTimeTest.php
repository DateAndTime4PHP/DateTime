<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\DateTime;
use DateTime\Date;
use DateTime\DateInterval;
use DateTime\DateTimeInterval;
use DateTime\Time;
use DateTime\Timezone\Name;
use DateTime\Timezone\Timezone;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    /** @covers \DateTime\DateTime::sub */
    public function testSub()
    {
        $date = new DateTime('2018-07-09 12:23:34.567');

        $date1 = $date->sub(new DateTimeInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new DateTime('2017-06-08 11:22:33.567'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('2017-06-08 11:22:33.567', new DateTimeZone('UTC')),
            'datetime',
            $date1
        );
    }

    /** @covers \DateTime\DateTime::diff */
    public function testDiff()
    {
        $date1 = new DateTime('2018-07-09 12:23:34.567');
        $date2 = new DateTime('2019-08-10 13:24:35.567');

        $diff1 = $date1->diff($date2);
        $diff2 = $date2->diff($date1);

        self::assertEquals(1, $diff1->getDateTimeInterval()->y);
        self::assertEquals(1, $diff1->getDateTimeInterval()->m);
        self::assertEquals(1, $diff1->getDateTimeInterval()->d);
        self::assertEquals(1, $diff1->getDateTimeInterval()->h);
        self::assertEquals(1, $diff1->getDateTimeInterval()->i);
        self::assertEquals(1, $diff1->getDateTimeInterval()->s);
        self::assertEquals(0, $diff1->getDateTimeInterval()->f);
    }

    /** @covers \DateTime\DateTime::__construct */
    public function testInstantiation()
    {
        $date = new DateTime('2018-07-09 12:23:34.567');

        $datetime = new DateTimeImmutable('2018-07-09 12:23:34.567', new DateTimeZone('UTC'));

        self::assertAttributeInstanceOf(DateTimeImmutable::class, 'datetime', $date);
        self::assertAttributeEquals($datetime, 'datetime', $date);
    }

    /** @covers \DateTime\DateTime::format */
    public function testFormat()
    {
        $date = new DateTime('2018-07-09 12:23:34.567');

        self::assertEquals(
            'pmb2018-07-09T12:23:34+00:0009UTCf1212239kMonday0772018pqMon, 09 Jul 2018 12:23:34 +000034315670005671x18189PM558CMonEJuly12120JK0Jul1+0000+00:00QRthUTC1531139014V28X20180',
            $date->format('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        );
    }

    /** @covers \DateTime\DateTime::add */
    public function testAdd()
    {
        $date = new DateTime('2018-07-09 12:23:34.567');

        $date1 = $date->add(new DateTimeInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new DateTime('2019-08-10 13:24:35.567'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('2019-08-10 13:24:35.567', new DateTimeZone('UTC')),
            'datetime',
            $date1
        );
    }

    /** @covers \DateTime\Date::fromDateTimeInterface */
    public function testFromDateTimeInterface()
    {
        $datetime = new DateTimeImmutable('2018-07-00 12:00:00.0', new DateTimeZone('UTC'));

        $date = Date::fromDateTimeInterface($datetime);

        self::assertAttributeInstanceOf(DateTimeImmutable::class, 'datetime', $date);
        self::assertAttributeEquals($datetime, 'datetime', $date);
    }

    /** @covers \DateTime\DateTime::modify */
    public function testModify()
    {
        $date = new DateTime('2018-07-13 12:23:34.567');

        $date2 = $date->modify('+ 2 years');

        self::assertNotSame($date, $date2);

        self::assertEquals(
            new DateTime('2020-07-13 12:23:34.567'),
            $date2
        );
    }

    /** @covers \DateTime\DateTime::getTimestamp */
    public function testGettingTimestamp()
    {
        $date = new DateTime('2018-07-13 12:23:34.567');

        self::assertEquals(
            '1531484614',
            $date->getTimestamp()
        );
    }

    /** @covers \DateTime\DateTime::getTimezone */
    public function testGettingTimezone()
    {
        $date = new DateTime('2018-07-13 12:23:34.567');

        $timezone = $date->getTimezone();

        self::assertInstanceOf(Timezone::class, $timezone);
        self::assertInstanceOf(Name::class, $timezone);
        self::assertEquals('UTC', $timezone->getName());
    }


    public function testCreatingFromFormat()
    {
        $self = DateTime::createFromFormat('Y-m-d H:i:s','2018-07-13 12:23:34');

        self::assertEquals(
            new DateTime('2018-07-13 12:23:34'),
            $self
        );
    }
}
