<?php

namespace App\Commande;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;


class TestCommande extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('captusite:imports:users')

            // the short description shown while running "php bin/console list"
            ->setDescription('Import la liste des users')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This commande get all les users')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $outputConsole = new ConsoleOutput();
        $output->writeln([
            'User Import',
            '===========',
            '',
        ]);

        $userService = $container->get(UserService::class);

        $userService->importUsers();

        $output->writeln('....');

    }
}