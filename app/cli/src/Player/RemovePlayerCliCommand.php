<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Symfony\Command\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Remove\RemovePlayerCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\RemovePlayerResponse;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;

class RemovePlayerCliCommand extends CliCommand
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
            ->setName('player:remove')
            ->addOption('number', null, InputOption::VALUE_REQUIRED)
            ->setDescription('Remove player by number')
        ;
    }

    protected function useCase(): void
    {
        $number = $this->input->getOption('number');
        $this->bus->dispatch(new RemovePlayerCommand(
            $this->input->getOption('number')
        ));
        $this->output->writeln(new RemovePlayerResponse($number));
    }
}