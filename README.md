<h1 align="center">Fux CLI</h1>

<p align="center">PHP command-line tool for a better development process</p>

<p align="center">
    <img alt="Preview" src="/art/preview.png">
    <p align="center">
        <a href="https://github.com/Fux-Framwork/fux-cli/actions"><img alt="Build Status" src="https://github.com/Fux-Framwork/fux-cli/workflows/CI/badge.svg"></a>
        <a href="//packagist.org/packages/fux/fux-cli"><img alt="Latest Stable Version" src="https://poser.pugx.org/fux/fux-cli/v"></a>
        <a href="//packagist.org/packages/fux/fux-cli"><img alt="License" src="https://poser.pugx.org/fux/fux-cli/license"></a>
    </p>
</p>

## Usage as executable

You can use this CLI tool just by build downloading the ./dist/fux-cli.phar file or building it from scratch executing
the
following command

`php phar-composer-1.4.0.phar build . dist`

If you don't know that phar-composer is, just check the official repository at https://github.com/clue/phar-composer.

Then to make the CLI tool globally accessible you can just move it in your `bin` folder with the following command

`cp dist/fux-cli.phar /usr/local/bin/fux`

It is not recommended to use it as composer dependency in your project, instead copy the fux.phar file inside your
project root.

## Commands

All you need to do is call the one of the following commands

### Database commands

`fux db:iam {name}`

Allow you to set your name/nickname for the current project. This name will be used for all vcs files that you create
using `fux db:vcs` command.

`fux db:vcs [filename]`

This command create an SQL file in the database vcs directory of the project with the following format
`./db/vcs/{Y-m-d}/{H_i_s}_{filename}.sql` where the {filename} placeholder can be the filename argument or the {name}
argument passed to `fux db:iam` command. It's recommended to execute `db:iam` command the first time, so that you can
execute `fux db:vcs` without additional arguments.
