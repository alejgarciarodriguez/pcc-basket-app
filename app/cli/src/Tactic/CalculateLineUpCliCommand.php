<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Tactic;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Symfony\Command\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Tactic\Application\CalculateLineUpQuery;
use Symfony\Component\Console\Input\InputArgument;
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
            ->addArgument('tactic', InputArgument::REQUIRED)
            ->setAliases(['get:tactic', 'tactic:get'])
            ->setDescription('Returns the best team line up based on available players')
        ;
    }

    protected function useCase(): void
    {
        $tactic = $this->input->getArgument('tactic');
        $response = $this->bus->dispatch(new CalculateLineUpQuery($tactic))->last(HandledStamp::class)->getResult();
        $this->output->writeln($response);
    }
}