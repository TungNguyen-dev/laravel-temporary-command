<?php

namespace TungNguyen\TemporaryCommand\App\Console\Commands\Traits;

use Symfony\Component\Console\Helper\ProgressBar;
use TungNguyen\TemporaryCommand\App\Console\Commands\BaseCommand;

/**
 * Trait ProgressBarTrait
 * @package TungNguyen\TemporaryCommand\App\Console\Commands\Traits;
 * @mixin BaseCommand
 */
trait ProgressBarTrait
{
    /**
     * @param int $max
     * @return ProgressBar
     */
    public function createProgressBar(int $max = 0): ProgressBar
    {
        $progressBar = $this->output->createProgressBar($max);
        $progressBar->setFormat("<fg=green;bg=blue> %message:-50s%</> \n %current%/%max% [%bar%] %percent:3s%% \n %elapsed:-25s% %estimated:24s% \n --- \n %progress_status:-100s% \n");
        $progressBar->setBarCharacter('<fg=green>=</>');
        $progressBar->setEmptyBarCharacter("-");

        return $progressBar;
    }

    /**
     * @param ProgressBar $progressBar
     * @return void
     */
    public function startProgress(ProgressBar $progressBar): void
    {
        $progressBar->setMessage('Start');
        $progressBar->setMessage('', 'progress_status');
        $progressBar->start();
    }

    /**
     * @param ProgressBar $progressBar
     * @return void
     */
    public function finishProgress(ProgressBar $progressBar): void
    {
        $progressBar->setMessage('Task is finished!');
        $progressBar->finish();
    }
}
