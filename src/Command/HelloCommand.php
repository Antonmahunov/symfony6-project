<?php

namespace App\Command;

use App\Service\Greeting;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{

    private Greeting $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;

        parent::__construct();
    }

    public function configure(): void
    {
        $this->setName('app:say-hello')
            ->setDescription('Say hello to the user')
            ->addArgument('name', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln([
            'Hello from the app',
            '==========>',
            '',
        ]);

        $output->writeln($this->greeting->greet($name));

        return 0;
    }
}