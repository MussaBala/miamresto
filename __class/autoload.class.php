<?php

/**
 * @copyright  : Link To Business
 */

/**
 * Charge les classes de manière automatique
 *
 * @updated 20160405
 */
spl_autoload_register(
    function ( $class ) {

        include_once( $class . '.class.php' );
        //include_once( __DIR__ . '/functions.php' );

    }
);