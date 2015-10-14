<?php

namespace Bootstrap\Console\Server;

use Bootstrap\Console\SlayerCommand;
use Bootstrap\Console\CLI;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class OptimizeCommand extends SlayerCommand
{
    protected $name = 'optimize';

    protected $description = "Combine all classes defined in the compile php file";

    public function slash()
    {
        $this->info('Removing compiled file...');
        @unlink(BASE_PATH . '/storage/slayer/compiled.php');

        $output = CLI::bash([
            'php vendor/classpreloader/console/classpreloader.php compile ' .
            '--config="bootstrap/compiler.php" ' .
            '--output="storage/slayer/compiled.php" ' .
            '--strip_comments=1',
        ]);

        $this->comment( $output );
    }

}