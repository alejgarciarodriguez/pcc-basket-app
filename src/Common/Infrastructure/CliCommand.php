<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Infrastructure;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

abstract class CliCommand extends SymfonyCommand
{
    protected $input;
    protected $output;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;
        try {
            $this->useCase();
        } catch (HandlerFailedException $e){
            $exceptions = $e->getNestedExceptions();
            $first = reset($exceptions);
            $this->output->writeln(json_encode($first));
            return 1;
        }

        return 0;
    }

    abstract protected function useCase();
}