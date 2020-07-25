<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function in_array;

use const FILE_IGNORE_NEW_LINES;

/**
 * Italy.
 */
final class Italy extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'IT';

    /**
     * @var string
     */
    public const IT_ID_LIST_PATH = __DIR__ . '/../../resources/IT_ID_list';

    /**
     * @var int
     */
    public const LENGTH = 16;

    // phpcs:disable

    /**
     * @var string
     */
    public const PATTERN = '[a-zA-Z]{6}[LMNPQRSTUVlmnpqrstuv0-9]{2}[ABCDEHLMPRSTabcdehlmprst]([0Ll][1-9]|[1Mm2Nn4Qq5Rr6Ss][0-9]|[3Pp7Tt][0-1])[a-zA-Z][LMNPQRSTUVlmnpqrstuv0-9]{3}[a-zA-Z]';

    // phpcs:enable

    /**
     * @var array<int, string>
     */
    private $listSet = [];

    protected function hasValidDate(string $tin): bool
    {
        $day = (int) ($this->convertCharToNumber(mb_substr($tin, 9, 2)));
        $c9 = $tin[8];
        $month = $this->getMonthNumber($c9);
        $year = (int) ($this->convertCharToNumber(mb_substr($tin, 6, 2)));

        if (1 <= $day && 31 >= $day) {
            $d1 = checkdate($month, $day, 1900 + $year);
            $d2 = checkdate($month, $day, 2000 + $year);

            return $d1 || $d2;
        }

        $d1 = checkdate($month, $day - 40, 1900 + $year);
        $d2 = checkdate($month, $day - 40, 2000 + $year);

        return 41 <= $day && 71 >= $day && ($d1 || $d2);
    }

    protected function hasValidPattern(string $tin): bool
    {
        if (false !== $listSet = file(self::IT_ID_LIST_PATH, FILE_IGNORE_NEW_LINES)) {
            $this->listSet = $listSet;
        }

        $code = mb_substr($tin, 11, 1) . $this->convertCharToNumber(mb_substr($tin, 12, 3));

        $containsUpper = in_array($code, $this->listSet, true);
        $containsLower = in_array(mb_strtolower($code), $this->listSet, true);

        return ($containsUpper || $containsLower) && parent::hasValidPattern($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        $sum = 0;

        for ($i = 0; 15 > $i; ++$i) {
            $sum += 0 === $i % 2 ?
                $this->convertOddCharacter($tin[$i]) :
                $this->convertEvenCharacter($tin[$i]);
        }
        $remainderBy26 = $sum % 26;
        $c16 = $tin[15];
        $check = $this->getAlphabeticalPosition($c16) - 1;

        return $remainderBy26 === $check;
    }

    private function convertCharToNumber(string $oldStr): string
    {
        $newStr = '';

        for ($i = 0; mb_strlen($oldStr) > $i; ++$i) {
            $newStr .= $this->getNumberFromChar($oldStr[$i]);
        }

        return $newStr;
    }

    private function convertEvenCharacter(string $c): int
    {
        if (is_numeric($c)) {
            return (int) $c;
        }

        return $this->getAlphabeticalPosition($c) - 1;
    }

    private function convertOddCharacter(string $c): int
    {
        $normalizedChar = $c;

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

    private function getMonthNumber(string $m): int
    {
        switch ($m) {
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

    private function getNumberFromChar(string $m): int
    {
        if (is_numeric($m)) {
            return (int) $m;
        }

        switch ($m) {
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
