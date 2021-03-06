<?php

namespace Checkout\Tests;

use Checkout\CheckoutApiException;
use Checkout\CheckoutUtils;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertNotNull;

class CheckoutUtilsTest extends TestCase
{

    /**
     * @test
     * @throws CheckoutApiException
     */
    public static function shouldGetVersion(): void
    {
        $version = CheckoutUtils::getVersion();
        assertNotEmpty($version);
        assertNotNull($version);
    }

    /**
     * @test
     */
    public static function shouldFormatDateToIso8601(): void
    {
        $date = new DateTime();
        $formatted = CheckoutUtils::formatDate($date);
        self::assertEquals($date->format(DateTimeInterface::ISO8601), $formatted);
    }
}
