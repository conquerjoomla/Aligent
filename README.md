This sofware was built/tested with:
php: 7.3.1 (on windows)
phpuint: 8.0.5

Usage:
------
php.exe aligent.php Format DateTimeFormat StartDateTime EndDateTime StartTimezone EndTimezone

Format:
1 - Seconds
2 - Minutes
3 - Hours
4 - Days
5 - Years

DateTimeFormat: Uses php date format (eg: "Y-n-j H:i:s")

eg:
php.exe aligent.php 4 "Y-n-j H:i:s" "2019-3-1 12:00:00" "2019-3-18 12:00:00" "Australia/Adelaide" "Australia/Adelaide"

Testing:
--------
phpuint test/test.php



