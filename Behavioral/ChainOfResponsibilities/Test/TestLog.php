<?php

namespace DesignPatterns\Behavioral\ChainOfResponsibilities\Test;

use DesignPatterns\Behavioral\ChainOfResponsibilities\Responsible\ConsoleLogger;
use DesignPatterns\Behavioral\ChainOfResponsibilities\Responsible\EmailLogger;
use DesignPatterns\Behavioral\ChainOfResponsibilities\Responsible\DBLogger;
use DesignPatterns\Behavioral\ChainOfResponsibilities\Responsible\FileLogger;
use DesignPatterns\Behavioral\ChainOfResponsibilities\LogLevel;

require_once '../../../autoload.php';

class TestLog
{
    private $logChain;

    public function __construct()
    {
        $logger = new ConsoleLogger([LogLevel::ALL]);
        $emailLogger = $logger->setNext(
                new EmailLogger([LogLevel::ERROR, LogLevel::FUNCTIONAL_MESSAGE, LogLevel::FUNCTIONAL_ERROR])
        );
        $dbLogger = $emailLogger->setNext(
                new DBLogger([LogLevel::DEBUG, LogLevel::WARNING])
        );
        $dbLogger->setNext(
                new FileLogger([LogLevel::INFO, LogLevel::NONE])
        );

        $this->logChain = $logger;
    }

    public function log(int $level, string $message)
    {
        $this->logChain->log($level, $message);
    }

}
echo 'ERROR, FUNCTIONAL_MESSAGE, FUNCTIONAL_ERROR -> EmailLogger' . PHP_EOL;
echo 'WARNING, DEBUG -> DBLogger' . PHP_EOL;
echo 'INFO, NONE -> FileLogger' . PHP_EOL;


$app = new TestLog();
$app->log(LogLevel::NONE, "This is None.");
$app->log(LogLevel::INFO, "This is Info.");
$app->log(LogLevel::DEBUG, "This is Debug.");
$app->log(LogLevel::WARNING, "This is WARNING.");
$app->log(LogLevel::ERROR, "This is ERROR.");
$app->log(LogLevel::FUNCTIONAL_MESSAGE, "This is FUNCTIONAL_MESSAGE.");
$app->log(LogLevel::FUNCTIONAL_ERROR, "This is FUNCTIONAL_ERROR.");
$app->log(LogLevel::ALL, "This is ALL.");
$app->log(LogLevel::undefined, "This is undefined.");
