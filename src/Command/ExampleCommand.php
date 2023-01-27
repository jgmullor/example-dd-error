<?php

declare(strict_types=1);

namespace Jgmullor\ExampleApp\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'example',
    description: 'example',
    hidden: false,
)]
final class ExampleCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'example';

    protected function configure(): void
    {
        $this->setDescription('Example');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return self::SUCCESS;
    }
}
