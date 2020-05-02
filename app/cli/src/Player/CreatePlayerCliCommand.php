<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Symfony\Command\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Create\CreatePlayerCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\CreatePlayerResponse;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;

class CreatePlayerCliCommand extends CliCommand
{
    private $bus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->bus = $commandBus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('player:create')
            ->addOption('number', null, InputOption::VALUE_REQUIRED)
            ->addOption('name', null, InputOption::VALUE_REQUIRED)
            ->addOption('role', null, InputOption::VALUE_REQUIRED)
            ->addOption('valuation', null, InputOption::VALUE_REQUIRED, 'Integer between 0 and 100 inclusive')
            ->setDescription('Creates a new player')
        ;
    }

    protected function useCase(): void
    {
        $this->bus->dispatch(new CreatePlayerCommand(
            $this->input->getOption('number'),
            $this->input->getOption('name'),
            $this->input->getOption('role'),
            $this->input->getOption('valuation'),
        ));

        $this->output->writeln(new CreatePlayerResponse());
    }
}