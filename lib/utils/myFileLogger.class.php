<?php

/*
 * Modified copy of /lib/symfony/log/sfLogger/sfFileLogger.class.php
 * to write log files without the header "Mar 07 10:25:53 symfony [Info]"
 */

class myFileLogger
{
  protected
    $fp = null;

  /**
   * Initializes the file logger.
   *
   * @param array Options for the logger
   */
  public function initialize($options = array())
  {
    if (!isset($options['file']))
    {
      throw new sfConfigurationException('File option is mandatory for a file logger');
    }

    $dir = dirname($options['file']);

    if (!is_dir($dir))
    {
      mkdir($dir, 0777, 1);
    }

    $fileExists = file_exists($options['file']);
    if (!is_writable($dir) || ($fileExists && !is_writable($options['file'])))
    {
      throw new sfFileException(sprintf('Unable to open the log file "%s" for writing', $options['file']));
    }

    $this->fp = fopen($options['file'], 'a');
    if (!$fileExists)
    {
      chmod($options['file'], 0666);
    }
  }

  /**
   * Logs a message.
   *
   * @param string Message
   * @param string Message priority
   * @param string Message priority name
   */
  public function log($message, $priority, $priorityName)
  {
    $line = sprintf("%s%s", $message, DIRECTORY_SEPARATOR == '\\' ? "\r\n" : "\n");

    flock($this->fp, LOCK_EX);
    fwrite($this->fp, $line);
    flock($this->fp, LOCK_UN);
  }

  /**
   * Executes the shutdown method.
   */
  public function shutdown()
  {
    if ($this->fp)
    {
      fclose($this->fp);
    }
  }
}