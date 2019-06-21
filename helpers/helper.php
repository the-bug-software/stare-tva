<?php

// ------------------------------------------------------------------------
use TheBugSoftware\Helpers\Debug as TheDebug;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

if (! function_exists('debug')) {
    function debug($data = null)
    {
        $clone = new VarCloner();

        $dumper = 'cli' === PHP_SAPI ? new CliDumper() : new TheDebug();
        $dumper->dump($clone->cloneVar($data));

        die(1);
    }
}
// ------------------------------------------------------------------------
