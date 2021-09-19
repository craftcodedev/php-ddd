<?php


namespace App\Shared\UI\Command\Event;


use App\Shared\Infrastructure\Bus\Event\Consumer\DatabaseEventConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsumeDatabaseEventCommand extends Command
{
    public function __construct(private DatabaseEventConsumer $consumer)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('event:mysql:consume')
            ->setDescription('Consume domain events from Database')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to consume');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $quantity = (int) $input->getArgument('quantity');

        $this->consumer->consume();

        return 0;
    }
}