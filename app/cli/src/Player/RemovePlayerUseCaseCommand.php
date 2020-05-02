<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Remove\RemovePlayerCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;

class RemovePlayerUseCaseCommand extends CliCommand
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
            ->setName('player:delete')
            ->addOption('number', null, InputOption::VALUE_REQUIRED)
            ->setAliases(['player:remove', 'delete:player', 'remove:player'])
            ->setDescription('Remove player by number')
        ;
    }

    protected function useCase(): void
    {
        $this->bus->dispatch(new RemovePlayerCommand(
            $this->input->getOption('number')
        ));
    }
}