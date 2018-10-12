<?php

if(! function_exists('dump') ){

    function dump($vars){
        $varDumper = new \Collective\Dumper\VarDumper();

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
        $varDumper = new \Collective\Dumper\VarDumper();

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
