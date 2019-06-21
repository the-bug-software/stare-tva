<?php
/**
 * Example.
 */
require_once '../vendor/autoload.php';

//
use TheBugSoftware\StareTva\StareTva;

try {
    $response = (new StareTva)
        ->for(30214391)
        ->for(31423108)
        ->for(6093130)
        ->get();

    debug(json_decode($response), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
