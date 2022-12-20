<?php

namespace TungNguyen\TemporaryCommand\App\Console\Commands\Traits;

use Exception;
use Illuminate\Support\Str;
use TungNguyen\TemporaryCommand\App\Console\Commands\BaseCommand;

/**
 * Trait LoggingTrait
 * @package TungNguyen\TemporaryCommand\App\Console\Commands\Traits
 * @mixin BaseCommand
 *
 */
trait LoggingTrait
{
    /**
     * @param string $message
     * @param string $type
     * @return void
     * @throws Exception
     */
    public function writeLog(string $message, string $type = 'csv')
    {
        $method = 'writeLogTo' . Str::of($type)->camel();

        if (!method_exists(self::class, $method)) {
            throw new Exception('Not found method');
        }

        $path = $this->getPath($type);

        $this->{$method}($path, $message);
    }

    /**
     * @param string $type
     * @return string
     */
    private function getPath(string $type): string
    {
        $logName = $this->getLogName() . '-' . $this->getExecutedTime();

        return storage_path("logs/$logName.$type");
    }

    /**
     * @param string $path
     * @param string $message
     * @return void
     */
    private function writeLogToCsv(string $path, string $message): void
    {
        $message = explode(',', $message);

        $fp = fopen($path, 'a');
        fputcsv($fp, $message);
        fclose($fp);
    }
    
    /**
     * @param string $path
     * @param string $type
     * @return array
     * @throws Exception
     */
    public function getDataFromFile(string $path, string $type = 'csv'): array
    {
        $method = 'getDataFrom' . Str::of($type)->camel();

        if (!method_exists(self::class, $method)) {
            throw new Exception('Not found method');
        }

        return $this->{$method}($path, $type);
    }

    /**
     * @param string $path
     * @return array
     */
    private function getDataFromCsv(string $path): array
    {
        $data = [];

        $fp = fopen($path, 'r');
        while (($row = fgetcsv($fp)) !== false) {
            $data[] = $row;
        }
        fclose($fp);

        return $data;
    }
}
