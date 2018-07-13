<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest\Timezone;

use DateTime\Timezone\Location;
use DateTime\Timezone\Name;
use DateTime\Timezone\Timezone;
use Exception;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /** @covers \DateTime\Timezone\Name::getLocation() */
    public function testGettingLocation()
    {
        $timezone =  Timezone::fromString('Europe/Berlin');
        if (! $timezone instanceof Name) {
            throw new Exception('Timezone is not of type Name');
        }

        self::assertInstanceOf(Location::class, $timezone->getLocation());
    }
}
