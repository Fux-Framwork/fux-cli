<?php

namespace FuxCli\Commands\Database;

use FuxCli\Utils\PathUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Iam extends Command
{
    /**
     * The name of the command
     *
     * @var string
     */
    protected static $defaultName = 'db:iam';

    /**
     * The command description
     *
     * @var string
     */
    protected static $defaultDescription = 'Define settings for database vcs';

    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, "The vcs file name");
    }


    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userName = $input->getArgument('name');

        if (!preg_match('/^[a-z\-]+$/', $userName) || !$userName){
            $io->error("You can use only lowercase letters and dash '-' char");
            return Command::FAILURE;
        }

        $rootDir = PathUtils::getProjectRoot();

        $dbDir = "$rootDir/db";
        if (!file_exists($dbDir) && !mkdir($dbDir, 0777, true)) {
            $io->error("Unable to create settings cache folder at $dbDir");
            return Command::FAILURE;
        }


        if (!file_put_contents("$dbDir/.iam", $userName)) {
            $io->error("Unable to create settings file at $dbDir/.iam");
            return Command::FAILURE;
        }

        $io->success("VCS settings saved correctly");
        return Command::SUCCESS;
    }
}