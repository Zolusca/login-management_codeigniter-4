<?php

namespace App\Libraries;

use DateTime;
use DateTimeZone;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerConfiguration
{
    /**
     * @return Logger logger object
     * @param string $class name of class where used
     * this method for creating logger monolog object where the output on console
     * @example logger    = LoggerCreations::LoggerCreations(User::class);
     */
    public static function LoggerCreations(): Logger
    {
        $logger = new Logger("login_management");

        // this configuration for message format
        // you can read more at https://betterstack-com. or monolog doc
        $output = "%level_name% | %datetime% > %message% | %context% %extra%\n";
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $currentTime = $dateTime->format('Y-m-d ~ H:i');

        // this setting for format log output, we can used line text or json formatter
        // line format
        $formatter      = new LineFormatter($output,$currentTime,true,true);
        // json format
        //  $formatter      = new JsonFormatter(); format json

        // console
        // this setting for logging appear, this setting for console output
        $streamHandler  = new StreamHandler("php://stderr");
        $streamHandler->setFormatter($formatter);

        // file
        // this for file output, where it will write file at `WRITEPATH.'/logs/app.log`
        // and will deleting automatic file when file >10
//        $rotatingFileHandler = new RotatingFileHandler(WRITEPATH.'/logs/app.log',10);
//        $rotatingFileHandler->setFormatter($formatter);

        $logger->pushHandler($streamHandler);
        return $logger;
    }
}