<?php

namespace Alejgarciarodriguez\PccBasketApp\Cli\Player;

use Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Symfony\Command\CliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Get\GetPlayersQuery;
use Alejgarciarodriguez\PccBasketApp\Player\PlayerOrder;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class GetPlayersCliCommand extends CliCommand
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
            ->setName('player:list')
            ->addOption('order', null, InputOption::VALUE_OPTIONAL)
            ->addOption('dir', null, InputOption::VALUE_OPTIONAL, 'asc|desc', 'asc')
            ->setDescription('Outputs all players in JSON format')
        ;
    }

    protected function useCase(): void
    {
        $response = $this->bus->dispatch(new GetPlayersQuery(
            new PlayerOrder($this->input->getOption('order'),$this->input->getOption('dir'))
        ))->last(HandledStamp::class)->getResult();

        $this->output->writeln($response);
    }
}