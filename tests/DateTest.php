<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\Date;
use DateTime\DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @expectedException \DateTime\Exception\NotYetImplemented
     * @covers \DateTime\Date::modify
     */
    public function testModify()
    {
        $date = new Date('2018-07-09');
        $date->modify('');
    }

    /** @covers \DateTime\Date::sub */
    public function testSub()
    {
        $date = new Date('2018-07-09');

        $date1 = $date->sub(new DateInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new Date('2017-06-08'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('2017-06-08 12:00:00.0', new DateTimeZone('UTC')),
            'datetime',
            $date1
        );

    }

    /** @covers \DateTime\Date::diff */
    public function testDiff()
    {
        $date1 = new Date('2018-07-09');
        $date2 = new Date('2019-08-10');

        $diff1 = $date1->diff($date2);
        $diff2 = $date2->diff($date1);

        self::assertEquals($diff1, $diff2);

        self::assertEquals(0, $diff1->getDateTimeInterval()->y);
        self::assertEquals(0, $diff1->getDateTimeInterval()->m);
        self::assertEquals(397, $diff1->getDateTimeInterval()->d);
        self::assertEquals(0, $diff1->getDateTimeInterval()->h);
        self::assertEquals(0, $diff1->getDateTimeInterval()->i);
        self::assertEquals(0, $diff1->getDateTimeInterval()->s);
    }

    /** @covers \DateTime\Date::getYear */
    public function testGetYear()
    {
        $date = new Date('2018-07-09');

        self::assertSame(2018, $date->getYear());
    }

    /** @covers \DateTime\Date::__construct */
    public function testInstantiation()
    {
        $date = new Date('2018-07-09');

        $datetime = new DateTimeImmutable('2018-07-09 12:00:00.0', new DateTimeZone('UTC'));

        self::assertAttributeInstanceOf(DateTimeImmutable::class, 'datetime', $date);
        self::assertAttributeEquals($datetime, 'datetime', $date);
    }

    /** @covers \DateTime\Date::format */
    public function testFormat()
    {
        $date = new Date('2018-07-09');

        self::assertEquals(
            'abc09efghi9kMonday0772018pqrs31uv1x18189ABCMonEJulyGHIJK0Jul1OPQRthTUV28X2018Z',
            $date->format('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
        );
    }

    /** @covers \DateTime\Date::getMonth */
    public function testGetMonth()
    {
        $datetime = new Date('2018-07-09');

        self::assertSame(7, $datetime->getMonth());
    }

    /** @covers \DateTime\Date::add */
    public function testAdd()
    {
        $date = new Date('2018-07-09');

        $date1 = $date->add(new DateInterval('P1Y1M1DT1H1M1S'));

        self::assertEquals(new Date('2019-08-10'), $date1);
        self::assertAttributeEquals(
            new DateTimeImmutable('2019-08-10 12:00:00.0', new DateTimeZone('UTC')),
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

    /** @covers \DateTime\Date::getDay */
    public function testGetDay()
    {
        $datetime = new Date('2018-07-09');

        self::assertSame(9, $datetime->getDay());
    }
}
