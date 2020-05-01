<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\CommandBus;
use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Remove\RemovePlayerCommand;
use Symfony\Component\Console\Input\InputOption;

class RemovePlayerUseCaseCommand extends CliCommand
{
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('player:delete')
            ->addOption('number', null, InputOption::VALUE_REQUIRED)
            ->setAliases(['player:remove', 'delete:player', 'remove:player'])
        ;
    }

    protected function useCase(): void
    {
        $this->bus->handle(new RemovePlayerCommand(
            $this->input->getOption('number')
        ));
    }
}