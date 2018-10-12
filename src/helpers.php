<?php

use Collective\Dumper\VarDumper;

if(! function_exists('dump') ){

    function dump($vars){
        $varDumper = new VarDumper();

        if( is_array($vars) ){
            foreach ($vars as $someVar) {
                $varDumper->dump($someVar);
            }
        } else {
            $varDumper->dump($vars);
        }

    }

}

if(! function_exists('dd') ){

    function dd($vars){
        $varDumper = new VarDumper();

        if( is_array($vars) ){
            foreach ($vars as $someVar) {
                $varDumper->dump($someVar);
            }
        } else {
            $varDumper->dump($vars);
        }

        die(1);

    }

}
