<?php

/*
 * Copyright (c) DateTime-Contributors
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace DateTimeTest;

use DateTime\Date;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    public function testThatUsageExample1WorksAsAdvertised()
    {
        $date = new Date('2018-07-05');

        $this->assertEquals(
            '05. 07. 2018',
            $date->format('d. m. Y')
        );
        $this->assertEquals(
            '5th of July 2018 H:i:s',
            $date->format('jS \o\f F Y H:i:s')
        );
    }
}
