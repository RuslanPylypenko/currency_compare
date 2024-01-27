<?php

declare(strict_types=1);

namespace App\Console;

use App\Services\CurrencyComparator;
use App\Services\CurrencyRate\MonoBankApiClient;
use App\Services\CurrencyRate\PrivatBankApiClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:exchange:compare')]
class ExchangeRateCompareCommand extends Command
{
    public function __construct(
        private readonly MonoBankApiClient $monoBankApiClient,
        private readonly PrivatBankApiClient $privatBankApiClient,
        private readonly CurrencyComparator $comparator,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Fetches currency rates from different banks and compare it.')
            ->addArgument('threshold', InputArgument::OPTIONAL, 'Threshold for rate change', 0.05);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('I`m do some magic, wait, please....');

        $output->writeln((string)$input->getArgument('threshold'));

        $this->comparator->compare(
            $this->monoBankApiClient->getRates(),
            $this->privatBankApiClient->getRates(),
            $input->getArgument('threshold')
        );

        $output->writeln('Check your email.');

        return Command::SUCCESS;
    }
}
