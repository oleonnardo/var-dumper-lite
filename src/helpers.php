<?php

if(! function_exists('dump') ){

    function dump($var, $someVars = array()){
        $varDumper = new \Collective\Dumper\VarDumper();

        $varDumper->dump($var);

        foreach ($someVars as $someVar) {
            $varDumper->dump($someVar);
        }

    }

}

if(! function_exists('dd') ){

    function dd($var, $someVars = array()){
        $varDumper = new \Collective\Dumper\VarDumper();

        $varDumper->dump($var);

        foreach ($someVars as $someVar) {
            $varDumper->dump($someVar);
        }

        die(1);

    }

}
