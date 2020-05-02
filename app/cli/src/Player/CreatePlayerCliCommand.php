<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\CliCommand;
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
            ->setAliases(['create:player', 'add:player', 'player:add', 'players:create'])
            ->addOption('number', null, InputOption::VALUE_REQUIRED)
            ->addOption('name', null, InputOption::VALUE_REQUIRED)
            ->addOption('role', null, InputOption::VALUE_REQUIRED)
            ->addOption('valuation', null, InputOption::VALUE_REQUIRED, 'Integer between 0 and 100 inclusive')
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