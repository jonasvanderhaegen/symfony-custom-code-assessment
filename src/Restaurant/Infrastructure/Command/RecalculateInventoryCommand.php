<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:recalculate-inventory',
    description: 'Recalculates inventory levels across all restaurants',
)]
class RecalculateInventoryCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command recalculates inventory levels based on orders and waste tracking.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Implementation here
        return Command::SUCCESS;
    }
} 