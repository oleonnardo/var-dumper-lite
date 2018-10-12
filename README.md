VarDumper Component
================================

O componente VarDumper fornece mecanismos para caminhar através de qualquer
variável PHP. Construído em cima, ele fornece as funções `dump()` e `dd()` que você
pode usar em vez de `var_dump` e `die`.

Instalação
------------

    composer require "leonardo/var-dumper":"dev-master"

Como usar
-----------

Simplesmente chame as funções `dump()` ou `dd()` passando como parâmetro uma variável ou um array de variáveis. 


Exemplos
-----------

Código:
`<?php 
$productos = array(
    'producto1' => array(
        'preco'=> 25,
        'quantidade' => 5
    ),
    'producto2' => array(
        'quantidade' => 100,
        'producto2.1' => array(
            'preco'=> 25,
            'quantidade' => 5
        ),

    ),
);

dump($productos);
?>`

Saída:
`array:2 [
    "producto1" => array:2 [
        "preco" => 25
        "quantidade" => 5
    ]
    "producto2" => array:2 [
        "quantidade" => 100
        "producto2.1" => array:2 [
            "preco" => 25
            "quantidade" => 5
        ]
    ]
 ]`

