<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTime\Timezone;

use Closure;
use DateTime\Timezone\Localizable;
use DateTime\Timezone\Location;
use DateTimeZone;

final class Name extends Timezone
{
    public function getLocation() : Location
    {
        return Location::fromTimezone($this);
    }
}
