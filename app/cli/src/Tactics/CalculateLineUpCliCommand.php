<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Tactics;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Tactic\Application\CalculateLineUpQuery;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CalculateLineUpCliCommand extends CliCommand
{
    private $bus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->bus = $queryBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('tactic')
            ->addOption('tactic', null, InputOption::VALUE_REQUIRED)
            ->setAliases(['get:tactic', 'tactic:get'])
        ;
    }

    protected function useCase(): void
    {
        $tactic = $this->input->getOption('tactic');
        $response = $this->bus->dispatch(new CalculateLineUpQuery($tactic))->last(HandledStamp::class)->getResult();
        $this->output->writeln($response);
    }
}