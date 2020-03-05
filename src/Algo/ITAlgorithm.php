<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Exception\TINException;
use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Italy
 */
class ITAlgorithm extends TINAlgorithm
{
    const LENGTH = 16;
    const PATTERN = "[a-zA-Z]{6}[LMNPQRSTUVlmnpqrstuv0-9]{2}[ABCDEHLMPRSTabcdehlmprst]([0Ll][1-9]|[1Mm2Nn4Qq5Rr6Ss][0-9]|[3Pp7Tt][0-1])[a-zA-Z][LMNPQRSTUVlmnpqrstuv0-9]{3}[a-zA-Z]";
    const IT_ID_LIST_PATH = "/resources/IT_ID_list";
    private static $listSet = [];

    public function __construct()
    {
        $filename = dirname(dirname(__DIR__)) . self::IT_ID_LIST_PATH;
        if (!is_file($filename) || !is_readable($filename)) {
            throw new TINException("Could not read resource file");
        }
        $arr = file($filename, FILE_IGNORE_NEW_LINES);
        self::$listSet = $arr;
    }

    public static function setResultDateValidation($set)
    {
        self::$listSet = $set;
    }

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin) || !$this->isValidDate($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        $code = StringUtil::substring($tin, 11, 12) . $this->convertCharToNumber(StringUtil::substring($tin, 12, 15));

        $containsUpper = in_array(strtoupper($code), self::$listSet);
        $containsLower = in_array(strtolower($code), self::$listSet);
        $matchPattern = StringUtil::isFollowPattern($tin, self::PATTERN);

        return ($containsUpper || $containsLower) && $matchPattern;
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowRuleItalia($tin);
    }

    public function isFollowRuleItalia(string $tin)
    {
        $sum = 0;
        for ($i = 0; $i < 15; $i++) {
            if ($i % 2 == 0) {
                $sum += $this->convertOddCharacter($tin[$i]);
            } else {
                $sum += $this->convertEvenCharacter($tin[$i]);
            }
        }
        $remainderBy26 = $sum % 26;
        $c16 = $tin[15];
        $check = StringUtil::getAlphabeticalPosition($c16) - 1;

        return $remainderBy26 == $check;
    }

    protected function convertEvenCharacter(string $c)
    {
        if (is_numeric($c)) {
            return intval($c);
        }
        return StringUtil::getAlphabeticalPosition($c) - 1;
    }

    protected function convertOddCharacter(string $c)
    {
        $normalizedChar = $c;
        if (!is_numeric($normalizedChar)) {
            $normalizedChar = strtoupper($normalizedChar);
        }
        switch ($normalizedChar) {
            case '0':
            case 'A':
                return 1;
            case '1':
            case 'B':
                return 0;
            case '2':
            case 'C':
                return 5;
            case '3':
            case 'D':
                return 7;
            case '4':
            case 'E':
                return 9;
            case '5':
            case 'F':
                return 13;
            case '6':
            case 'G':
                return 15;
            case '7':
            case 'H':
                return 17;
            case '8':
            case 'I':
                return 19;
            case '9':
            case 'J':
                return 21;
            case 'K':
                return 2;
            case 'L':
                return 4;
            case 'M':
                return 18;
            case 'N':
                return 20;
            case 'O':
                return 11;
            case 'P':
                return 3;
            case 'Q':
                return 6;
            case 'R':
                return 8;
            case 'S':
                return 12;
            case 'T':
                return 14;
            case 'U':
                return 16;
            case 'V':
                return 10;
            case 'W':
                return 22;
            case 'X':
                return 25;
            case 'Y':
                return 24;
            case 'Z':
                return 23;
            default:
                return -1;
        }
    }

    protected function getMonthNumber(string $m)
    {
        switch (strtoupper($m)) {
            case 'A':
                return 1;
            case 'B':
                return 2;
            case 'C':
                return 3;
            case 'D':
                return 4;
            case 'E':
                return 5;
            case 'H':
                return 6;
            case 'L':
                return 7;
            case 'M':
                return 8;
            case 'P':
                return 9;
            case 'R':
                return 10;
            case 'S':
                return 11;
            case 'T':
                return 12;
            default:
                return -1;
        }
    }

    private function isValidDate(string $tin)
    {
        $day = intval($this->convertCharToNumber(StringUtil::substring($tin, 9, 11)));
        $c9 = $tin[8];
        $month = $this->getMonthNumber($c9);
        $year = intval($this->convertCharToNumber(StringUtil::substring($tin, 6, 8)));
        if ($day >= 1 && $day <= 31) {
            return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
        }
        return $day >= 41 && $day <= 71 && (DateUtil::validate(1900 + $year, $month, $day - 40) || DateUtil::validate(2000 + $year, $month, $day - 40));
    }

    private function convertCharToNumber($oldStr)
    {
        $newStr = '';
        for ($i = 0; $i < strlen($oldStr); $i++) {
            if (!is_numeric($oldStr[$i])) {
                $newStr .= $this->getNumberFromChar($oldStr[$i]);
            } else {
                $newStr .= $oldStr[$i];
            }
        }
        return $newStr;
    }

    protected function getNumberFromChar($m)
    {
        switch (strtoupper($m)) {
            case 'L':
                return 0;
            case 'M':
                return 1;
            case 'N':
                return 2;
            case 'P':
                return 3;
            case 'Q':
                return 4;
            case 'R':
                return 5;
            case 'S':
                return 6;
            case 'T':
                return 7;
            case 'U':
                return 8;
            case 'V':
                return 9;
            default:
                return -1;
        }
    }
}
