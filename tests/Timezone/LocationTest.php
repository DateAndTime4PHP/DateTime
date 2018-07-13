<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest\Timezone;

use DateTime\Timezone\Name;
use DateTime\Timezone\Timezone;
use DateTime\Timezone\Location;
use PHPUnit\Framework\TestCase;
use Exception;

class LocationTest extends TestCase
{

    /** @covers \DateTime\Timezone\Location::getLongitude */
    public function testGetLongitude()
    {
        $timezone = Timezone::fromString('Europe/Berlin');
        $location = Location::fromTimezone($timezone);
        if (! $location instanceof Location) {
            self::fail('Wrong instance returned');
        }

        self::assertEquals(13.366659999999996, $location->getLongitude());
    }

    /** @covers \DateTime\Timezone\Location::getCountryCode */
    public function testGetCountryCode()
    {
        $timezone = Timezone::fromString('Europe/Berlin');
        $location = Location::fromTimezone($timezone);
        if (! $location instanceof Location) {
            self::fail('Wrong instance returned');
        }

        self::assertEquals('DE', $location->getCountryCode());
    }

    /** @covers \DateTime\Timezone\Location::getLatitude */
    public function testGetLatitude()
    {
        $timezone = Timezone::fromString('Europe/Berlin');
        $location = Location::fromTimezone($timezone);
        if (! $location instanceof Location) {
            self::fail('Wrong instance returned');
        }

        self::assertEquals(52.5, $location->getLatitude());
    }

    /** @covers \DateTime\Timezone\Location::fromTimezone */
    public function testGettingLocation()
    {
        $timezone =  Timezone::fromString('Europe/Berlin');
        if (! $timezone instanceof Name) {
            throw new Exception('Timezone is not of type Name');
        }

        self::assertInstanceOf(Location::class, Location::fromTimezone($timezone));
    }

    /** @covers \DateTime\Timezone\Location::getComments */
    public function testGetComments()
    {
        $timezone = Timezone::fromString('Europe/Berlin');
        $location = Location::fromTimezone($timezone);
        if (! $location instanceof Location) {
            self::fail('Wrong instance returned');
        }

        self::assertEquals('Germany (most areas)', $location->getComments());
    }

    /**
     * @covers \DateTime\Timezone\Location::__construct
     * @covers \DateTime\Timezone\Location::fromTimezone
     */
    public function testGettingAValidLocation()
    {
        $timezone = Timezone::fromString('Europe/Berlin');
        $location = Location::fromTimezone($timezone);

        self::assertInstanceOf(Location::class, $location);
    }
}
