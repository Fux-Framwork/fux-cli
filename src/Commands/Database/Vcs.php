<?php

namespace FuxCli\Commands\Database;

use FuxCli\Utils\PathUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Vcs extends Command
{
    /**
     * The name of the command
     *
     * @var string
     */
    protected static $defaultName = 'db:vcs';

    /**
     * The command description
     *
     * @var string
     */
    protected static $defaultDescription = 'Create your database version control file';

    protected function configure()
    {
        $this->addArgument('filename', InputArgument::OPTIONAL, "The file name");
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

        $filename = $input->getArgument('filename');
        $rootDir = getcwd();
        if (!$filename){
            if (file_exists("$rootDir/db/.iam")) $filename = file_get_contents("$rootDir/db/.iam");
        }

        if (!$filename){
            $io->warning("No filename argument given and no 'iam' command executed before. Please execute db:iam or use the filename argument.");
            return Command::INVALID;
        }

        $filename = date('H_i_s')."_$filename";

        $today = date('Y-m-d');
        $projectRelativeDir = "db/vcs/$today";
        $absDir = "$rootDir/$projectRelativeDir";
        $fileFullDir = "$absDir/$filename.sql";

        if (file_exists($fileFullDir)){
            $io->warning("A file with the same name and same date already exists. No new file have been created.");
            return Command::INVALID;
        }

        if (!file_exists($absDir)){
            if (!mkdir($absDir,0777,true)){
                $io->error("Unable to create folder $absDir");
                return Command::FAILURE;
            }
        }

        if (!file_put_contents($fileFullDir, "-- Database VCS file created at $today")){
            $io->error("Unable to create file $absDir/$filename.sql");
            return Command::FAILURE;
        }

        $io->success("VCS .sql file created at ./$projectRelativeDir/$filename.sql");
        return Command::SUCCESS;
    }
}