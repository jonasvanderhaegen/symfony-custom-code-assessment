<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-daily-reports',
    description: 'Generates daily reports for all restaurants',
)]
class GenerateDailyReportsCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command generates daily reports for all restaurants including sales, inventory, and staff metrics.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Implementation here
        return Command::SUCCESS;
    }
} 