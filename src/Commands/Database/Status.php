<?php

namespace FuxCli\Commands\Database;

use FuxCli\Utils\LocalDB;
use FuxCli\Utils\PathUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Status extends Command
{
    /**
     * The name of the command
     *
     * @var string
     */
    protected static $defaultName = 'db:status';

    /**
     * The command description
     *
     * @var string
     */
    protected static $defaultDescription = 'Show the list of not executed vcs files';

    protected function configure()
    {
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

        $table = new Table($output);
        $table->setHeaders(["File", "Author", "Created at"]);

        $vcsFiles = PathUtils::rglob(getcwd() . "/db/vcs/*/*.sql");

        foreach ($vcsFiles as $f) {
            if (LocalDB::isFileMarked($f)) continue;
            $filename = basename($f, ".sql");
            $parts = explode("@", $filename);
            $time = str_replace("_", ":", $parts[0]);
            $segments = explode("/", $f);
            $date = $segments[count($segments) - 2];
            $author = $parts[1];
            $collapsedFileDir = str_replace(getcwd(), ".", $f);
            $table->addRow([$collapsedFileDir, $author, "$date $time"]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}