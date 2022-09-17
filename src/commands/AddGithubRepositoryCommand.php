<?php

namespace George\ConsoleApp\Commands;

use George\ConsoleApp\Controllers\AddGithubRepositoryController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddGithubRepositoryCommand extends Command
{
    /**
     * The name of the command (the part after "bin/demo").
     *
     * @var string
     */
    protected static $defaultName = 'repository:add';

    /**
     * The command description shown when running "php bin/demo list".
     *
     * @var string
     */
    protected static $defaultDescription = 'Add a Github Repository!';

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

        $name="Default";
        $data=[];

        $data['name'] = $io->ask(sprintf('What name would you give your repo? %s', $name));
        $data['token'] = $io->ask(sprintf('Please type in your Token?'));

        //Instantiate Controller
        $addGithubController=new AddGithubRepositoryController;
        if ($addGithubController->addRepository($data)) {
            $io->success('Well done Repository Created Succesffully!');
        }else{
            $io->error($addGithubController::$response);
        }

        return Command::SUCCESS;
    }
}