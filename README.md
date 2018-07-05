# DateTime

A libary to handle dates and times separately from one another.

## Background

So far all the libraries around that help handling Dates and Times all extend
one of PHPs DateTime-Objects.

This library tries to address that by providing two separate Objects that
handle Dates and Times respectively. Internaly they do use PHPs
DateTimeImmutable-Object but that's not exposed to the outside.

So now you can use a Date-Object without having to worry about the
time-component and vice-versa.

## Installation

This library is best installed using composer.

```bash
composer require datetime/datetime
```

## Usage

### Date

There is a `Date`-Object as well as a `DateInterval`-Object

Easiest usage is like this:

```php
$date = new \DateTime\Date('2018-07-05');
echo $date->format('d. m. Y');
// 05. 07. 2018
echo $date->format('jS \o\f F Y H:i:s');
// 5th of July 2018 H:i:s
```

Another possibility would be to use it like this:

```php
$date = new \DateTime\Date('last wednesday of june 2018');
echo $date->format('d. m. Y');
// 27. 06. 2018
```

Or to use the `DateInterval`-Object:

```php
$date1 = new \DateTime\Date('2018-07-05');
$date2 = new \DateTime\Date('2020-07-05');
$interval = $date1->diff($date2);

echo $interval->format('%d %m %y');
// 731 0 0
```

### Time

There is also a `Time`-Object as well as a `TimeInterval`-Object

Those can be used as follows:

```php
$time = new \DateTime\Time('12:23:34');
echo $time->format('H:i:s');
// 12:23:34
echo $time->format('jS \o\f F Y H:i:s');
// jS of F Y 12:23:34
```

