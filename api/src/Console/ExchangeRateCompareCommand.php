<?php

declare(strict_types=1);

namespace App\Console;

use App\Services\CurrencyComparator;
use App\Services\CurrencyRate\MonoBankRateService;
use App\Services\CurrencyRate\PrivatBankRateService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(name: 'app:exchange:compare')]
class ExchangeRateCompareCommand extends Command
{
    public function __construct(
        private readonly MonoBankRateService $monoBankRateService,
        private readonly PrivatBankRateService $privatBankRateService,
        private readonly CurrencyComparator $comparator,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Fetches currency rates from different banks and compare it.')
            ->addArgument('threshold', InputArgument::OPTIONAL, 'Threshold for rate change', 0.001);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>I`m fetching data from API, wait, please....</comment>');

        try {
            $this->comparator->compare(
                $this->monoBankRateService->getCurrencyRates(),
                $this->privatBankRateService->getCurrencyRates(),
                $input->getArgument('threshold')
            );
        } catch (\RuntimeException $throwable) {
            $output->writeln(sprintf('<error>%s</error>', $throwable->getMessage()));
            return Command::FAILURE;
        } catch (Throwable $throwable) {
            $output->writeln(sprintf('<error>%s</error>', 'Something wrong, please, try later...'));
            return Command::FAILURE;
        }

        $output->writeln('<info>Check your email.</info>');

        return Command::SUCCESS;
    }
}
