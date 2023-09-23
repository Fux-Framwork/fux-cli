<h1 align="center">Fux CLI</h1>

<p align="center">PHP command-line tool for a better development process</p>

<p align="center">
    <img alt="Preview" src="/art/preview.png">
    <p align="center">
        <a href="https://github.com/Fux-Framwork/fux-cli/actions"><img alt="Build Status" src="https://github.com/Fux-Framwork/fux-cli/workflows/CI/badge.svg"></a>
        <a href="//packagist.org/packages/Fux-Framwork/fux-cli"><img alt="Latest Stable Version" src="https://poser.pugx.org/Fux-Framwork/fux-cli/v"></a>
        <a href="//packagist.org/packages/Fux-Framwork/fux-cli"><img alt="License" src="https://poser.pugx.org/Fux-Framwork/fux-cli/license"></a>
    </p>
</p>

## Instal

This CLI application is a small game written in PHP and is installed using [Composer](https://getcomposer.org):

```
composer global require fux/fux-cli
```

Make sure the `~/.composer/vendor/bin` directory is in your system's `PATH`.

<details>
<summary>Show me how</summary>

If it's not already there, add the following line to your Bash configuration file (usually `~/.bash_profile`, `~/.bashrc`, `~/.zshrc`, etc.):

```
export PATH=~/.composer/vendor/bin:$PATH
```

If the file doesn't exist, create it.

Run the following command on the file you've just updated for the change to take effect:

```
source ~/.bash_profile
```
</details>

## Use

All you need to do is call the one of the following commands

```
fux db:iam your-name
fux db:vcs
```

## Update

```
composer global update fux/fux-cli
```

## Delete

```
composer global remove fux/fux-cli
```