<?php

namespace Btn\Domain\Utils;

class DateTimeUtils
{
    const TIME_HELPER_YEAR = 31536000;
    const TIME_HELPER_MONTH = 2592000;
    const TIME_HELPER_WEEK = 604800;
    const TIME_HELPER_DAY = 86400;
    const TIME_HELPER_HOUR = 3600;
    const TIME_HELPER_MINUTE = 60;
    const TIME_HELPER_SECOND = 1;

    public static function humanTiming(\DateTime $time, $separator = ' ')
    {
        $tokens = array(
            self::TIME_HELPER_YEAR   => 'year',
            self::TIME_HELPER_MONTH  => 'month',
            self::TIME_HELPER_WEEK   => 'week',
            self::TIME_HELPER_DAY    => 'day',
            self::TIME_HELPER_HOUR   => 'hour',
            self::TIME_HELPER_MINUTE => 'minute',
            self::TIME_HELPER_SECOND => 'second',
        );

        list($numberOfUnits, $text, $unit) = self::_humanTiming($time, $tokens);
        if (is_null($numberOfUnits)) {
            return '';
        }

        return $numberOfUnits . $separator . $text . (($numberOfUnits > 1) ? 's' : '');
    }

    public static function shortHumanTiming(\DateTime $time, $separator = '')
    {
        $tokens = array(
            self::TIME_HELPER_YEAR   => 'Y',
            self::TIME_HELPER_MONTH  => 'M',
            self::TIME_HELPER_WEEK   => 'W',
            self::TIME_HELPER_DAY    => 'D',
            self::TIME_HELPER_HOUR   => 'h',
            self::TIME_HELPER_MINUTE => 'm',
            self::TIME_HELPER_SECOND => 's',
        );

        list($numberOfUnits, $text, $unit) = self::_humanTiming($time, $tokens);

        return $numberOfUnits . $separator . $text;
    }

    private static function _humanTiming(\DateTime $time, $tokens)
    {
        $time = (time() - $time->getTimestamp()) * -1; // to get the time since that moment

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);

            return [$numberOfUnits, $text, $unit];
        }

        return [null, null, null];
    }
}