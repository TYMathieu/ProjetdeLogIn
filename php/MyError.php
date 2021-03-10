<?php
class MyError
{
  private $_code;
  private $_message;
  private $_time;

  function __construct($code = 0, $message = "")
  {
    $this->_code = $code;
    $this->_message = $message;
    $this->_time = new DateTime("NOW", new DateTimeZone("Europe/Paris"));
  }

  function __toString()
  {
    // Condition ternaire
    return ($this->_code != 0) ? $this->_message : "";
  }

  function setError($code = 0, $message = "")
  {
    $this->_code = $code;
    $this->_message = $message;
    $this->_time = new DateTime("NOW", new DateTimeZone("Europe/Paris"));
  }
}
