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

Easiest usage is like this:

```php
$date = new DateTime\Date('2018-07-05');
echo $date->format('d. m. Y');
// 05. 07. 2018
echo $date->format('jS \o\f F Y H:i:s');
// 5th of July 2018 H:i:s
```

Another possibility would be to use it like this:

```php
$date = new Date('last wednesday of june 2018');
echo $date->format('d. m. Y');
// 27. 06. 2018

