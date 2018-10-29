<?php

if(! function_exists('dump') ){

    function dump($vars, $limit = 100){
        $varDumper = new \Collective\Dumper\VarDumper();

        if( is_array($vars) ){
            foreach ($vars as $someVar) {
                $varDumper->dump($someVar, $limit);
            }
        }else{
            $varDumper->dump($vars, $limit);
        }

    }

}

if(! function_exists('dd') ){

    function dd($vars, $limit = 100){
        $varDumper = new \Collective\Dumper\VarDumper();

        if( is_array($vars) ){
            foreach ($vars as $someVar) {
                $varDumper->dump($someVar, $limit);
            }
        }else{
            $varDumper->dump($vars, $limit);
        }

        die(1);

    }

}
