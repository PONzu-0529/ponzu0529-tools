<?php

require_once __DIR__ . '/../common/LogOptions.php';
require_once __DIR__ . '/../model/db/LoggingDB.php';


class LoggingService
{
  private LoggingDB $logging_db;


  public function __construct()
  {
    $this->logging_db = new LoggingDB();
  }


  public function record_log(LogStyle $log_style): void
  {
    $this->logging_db->record_log($log_style);
  }
}
