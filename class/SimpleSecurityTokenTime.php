<?php

class SimpleSecurityTokenTime
{
  public $maxSecondsExpiration;
  private $alphabet;
  private $numChars;
  private $key_private;

  public function __construct(
    $key_private = '%3da-Yui0=?4z5', // Change by your own key
    $maxSecondsExpiration = 180,
    $numChars = 6
  ) {
    $this->maxSecondsExpiration = $maxSecondsExpiration; // Must be greatest minute and less than 1 hour
    $this->key_private = $key_private;
    $this->alphabet = range('A', 'Z');
    $this->numChars = $numChars;
  }

  public function getToken(DateTime $time = null)
  {
    if (is_null($time))
      $time = new DateTime();

    list($timeToCalc, $secondsToExpiration) = $this->getTimeToCalc($time);

    $timeUnix = $timeToCalc->getTimestamp();
    $tokenMD5 = md5("{$this->key_private}$timeUnix");

    $tokenNumber = $this->getTokenNumberFromHash($tokenMD5);

    return [$tokenNumber, $secondsToExpiration];
  }

  public function evalToken($tokenToValidate)
  {
    $currentToken = $this->getToken()[0];
    $isToken = $tokenToValidate === $currentToken;

    return $isToken;
  }

  private function getTimeToCalc($time)
  {
    $timeMinutesToSecond = $time->format('i') * 60;
    $timeSecondsElapse = $timeMinutesToSecond + $time->format('s');

    $periodExpiration = $timeMinutesToSecond / $this->maxSecondsExpiration;
    $periodExpirationIni = (int) $periodExpiration;
    $secondsForPeriodoIni = $timeSecondsElapse - $periodExpirationIni * $this->maxSecondsExpiration;

    $periodExpirationMinIni = ($periodExpirationIni * $this->maxSecondsExpiration) / 60;
    $secondsToExpiration = $this->maxSecondsExpiration - $secondsForPeriodoIni;


    $timePeriod = new DateTime($time->format("Y-m-d H:$periodExpirationMinIni:00"));

    return [$timePeriod, $secondsToExpiration];
  }

  private function getTokenNumberFromHash($tokenMD5)
  {
    $tokenNumber = '';
    $charsTokenMD5 = str_split(substr($tokenMD5, 0, $this->numChars));

    foreach ($charsTokenMD5 as $char) {
      $tokenNumber .= is_numeric($char)
        ? $char
        : $this->alphaToNumber($char);
    }

    $tokenNumber = substr($tokenNumber, 0, $this->numChars);

    return $tokenNumber;
  }

  private function alphaToNumber($letter)
  {
    $letter = strtoupper($letter);
    return array_search($letter, $this->alphabet);
  }
}
