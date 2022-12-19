<?php

namespace TungNguyen\TemporaryCommand\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use TungNguyen\TemporaryCommand\App\Console\Commands\Traits\LoggingTrait;
use TungNguyen\TemporaryCommand\App\Console\Commands\Traits\ProgressBarTrait;

class BaseCommand extends Command
{
    use LoggingTrait, ProgressBarTrait;

    /**
     * @var string
     */
    protected $executedTime;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var string
     */
    protected $logName;

    /**
     * BaseCommand Constructor
     */
    public function __construct()
    {
        $this->setExecutedTime();
        $this->setSignature();
        $this->setLogName();

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getExecutedTime(): string
    {
        return $this->executedTime;
    }

    /**
     * @return void
     */
    public function setExecutedTime()
    {
        $this->executedTime = Carbon::now()->format('Ymd-His');
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return void
     */
    public function setSignature()
    {
        $this->signature = 'command:' . $this->getClassNameWithoutNamespace();
    }

    /**
     * @return string
     */
    public function getLogName(): string
    {
        return $this->logName;
    }

    /**
     * @return void
     */
    public function setLogName()
    {
        $this->logName = $this->getClassNameWithoutNamespace();
    }

    /**
     * @return Stringable
     */
    private function getClassNameWithoutNamespace(): Stringable
    {
        $classNameArr = explode('\\', static::class);

        return Str::of($classNameArr[array_key_last($classNameArr)])
            ->replace('Command', '')
            ->kebab();
    }
}
