<?php

namespace George\ConsoleApp\Commands;

use George\ConsoleApp\Controllers\GetGithubRepositoryController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetGithubRepositoryCommand extends Command
{
    /**
     * The name of the command (the part after "bin/demo").
     *
     * @var string
     */
    protected static $defaultName = 'repository:get';

    /**
     * The command description shown when running "php bin/demo list".
     *
     * @var string
     */
    protected static $defaultDescription = 'Get Github RepositorIES!';

    /**
     * Execute the command
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       
        $io = new SymfonyStyle($input, $output);

        $data=[];
        $data['token'] = $io->ask(sprintf('Please type in your Token?'));

        // Instantiate Controller
        $addGithubController=new GetGithubRepositoryController;
        if ($addGithubController->getRepository($data)) {
            $io->success('Well done Repository Retreived Succesffully!: '. $addGithubController::$response);
        }else{
            $io->error($addGithubController::$response);
        }

        return Command::SUCCESS;
    }
}