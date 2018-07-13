<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest\Timezone;

use DateTime\DateTime;
use DateTime\Timezone\Abbreviation;
use DateTime\Timezone\Location;
use DateTime\Timezone\Name;
use DateTime\Timezone\Offset;
use DateTime\Timezone\Timezone;
use DateTimeZone;
use Exception;
use PHPUnit\Framework\TestCase;

class TimezoneTest extends TestCase
{
    /**
     * @dataProvider timezoneTypeProvider
     * @covers \DateTime\Timezone\Timezone::getType
     */
    public function testTimezoneType(string $timezone, int $type, string $instance)
    {
        $timezone = Timezone::fromString($timezone);

        self::assertEquals($type, $timezone->getType());
        self::assertInstanceOf($instance, $timezone);
    }

    public function timezoneTypeProvider() : array
    {
        return [
            ['Europe/Berlin', 3, Name::class],
            ['CEST', 2, Abbreviation::class],
            ['+02:00', 1, Offset::class],
            ['A', 2, Abbreviation::class],
            ['+0200', 1, Offset::class],
        ];
    }

    /** @covers \DateTime\Timezone\Timezone::getName */
    public function testGEttingName()
    {
        $timezone = Timezone::fromString('Europe/Berlin');

        self::assertEquals('Europe/Berlin', $timezone->getName());
    }

    /**
     * @covers \DateTime\Timezone\Timezone::getType
     * @dataProvider gettingTypeProvider
     */
    public function testGettingType(string $timezone, int $type)
    {
        $timezone = Timezone::fromString($timezone);

        self::assertEquals($type, $timezone->getType());
    }

    public function gettIngTypeProvider() : array
    {
        return [
            ['Europe/Berlin', Timezone::TYPE_TIMEZONE],
            ['CEST', Timezone::TYPE_ABBREVIATION],
            ['+02:00', Timezone::TYPE_OFFSET],
            ['A', Timezone::TYPE_ABBREVIATION],
            ['+0200', Timezone::TYPE_OFFSET],
        ];
    }

    /** @covers \DateTime\Timezone\Timezone::getOffset */
    public function testGettingOffset()
    {
        $timezone = Timezone::fromString('Europe/Berlin');

        $offset = $timezone->getOffset(new DateTime('2018-07-15 12:23:34.567'));

        self::assertEquals(7200, $offset);
    }

    /** @covers \DateTime\Timezone\Timezone::listIdentifiers */
    public function testListingIdentifiers()
    {
        self::assertEquals(
            DateTimeZone::listIdentifiers(),
            Timezone::listIdentifiers()
        );
    }

    /** @covers \DateTime\Timezone\Timezone::listAbbreviations */
    public function testListingbbreviations()
    {
        self::assertEquals(
            DateTimeZone::listAbbreviations(),
            Timezone::listAbbreviations()
        );
    }

    public function testGettingTransitions()
    {
        $dtzone = new DateTimeZone('Europe/Berlin');
        $timezone = Timezone::fromString('Europe/Berlin');
        self::assertEquals(
            $dtzone->getTransitions(null, null),
            $timezone->getTransitions()
        );

    }

    /**
     * @covers \DateTime\Timezone\Timezone::fromString
     * @covers \DateTime\Timezone\Timezone::__construct
     * @dataProvider timezoneTypeProvider
     */
    public function testInstantiation(string $timezone, int $type, string $instance)
    {
        $timezone = Timezone::fromString($timezone);

        self::assertInstanceOf($instance, $timezone);
    }
}
