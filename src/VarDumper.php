<?php

namespace Collective\Dumper;

use \ReflectionClass as ReflectionClass;

class VarDumper {

    private $content = '';

    private $css = '
        <style type="text/css"> 
            pre.sf-dump { display: block; white-space: pre; padding: 5px; line-height: 16px; } 
            pre.sf-dump:after { content: ""; visibility: hidden; display: block; height: 0; clear: both; }
            pre.sf-dump span { display: inline; } 
            pre.sf-dump .sf-dump-wrapper { margin-left: 15px; } 
            pre.sf-dump, pre.sf-dump .sf-dump-default{background-color:#18171B; color:#FF8400; line-height:1.2em; font:12px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: break-all}
            pre.sf-dump .sf-dump-num{font-weight:bold; color:#FFB300}
            pre.sf-dump .sf-dump-const{font-weight:bold}
            pre.sf-dump .sf-dump-str{font-weight:bold; color:#56DB3A}
            pre.sf-dump .sf-dump-note{color:#1299DA}
            pre.sf-dump .sf-dump-ref{color:#A0A0A0}
            pre.sf-dump .sf-dump-public{color:#FFFFFF}
            pre.sf-dump .sf-dump-protected{color:#FFFFFF}
            pre.sf-dump .sf-dump-private{color:#FFFFFF}
            pre.sf-dump .sf-dump-meta{color:#B729D9}
            pre.sf-dump .sf-dump-key{color:#56DB3A}
            pre.sf-dump .sf-dump-index{color:#1299DA}
            pre.sf-dump .sf-dump-ellipsis{color:#FF8400}
            pre.sf-dump .sf-dump-icone {font-size: 15px; color: #dedede; text-decoration: none; line-height: 20px; margin: 0 -2px;}
         </style>';

    private $dump = '<pre class="sf-dump">%sfDump%</pre>';

    private $reflection = [
        'Name' => 'getName',
        'NamespaceName' => 'getNamespaceName',
        'Constants' => 'getConstants',
        'DefaultProperties' => 'getProperties',
        'FileName' => 'getFileName'
    ];

    public function dump($var){
        $this->content = '';

        if( $this->getType($var) == 'object' ){
            $var = $this->objectToArray($var);
        }

        $this->content .= $this->setType($var);
        $this->content .= $this->getContent($var);
        $this->run();
    }

    private function setType($var){
        $type = $this->getType($var);
        $complement = $this->isArray($type, $var);
        return '<span class="sf-dump-note" style="cursor: pointer;">' . $complement . '</span>';
    }

    private function isArray($type, $var){
        $element = '';

        if( is_array($var) ){
            $element .= ' ' . $type . ':'.count($var) . ' ';
        }

        return $element;
    }

    private function getType($var){
        return gettype($var);
    }

    private function getContent($var){

        if( $this->getType($var) !== 'array' ){
            return $this->setItem($var);
        }

        return $this->setArray($var);
    }

    private function setItem($varItem){
        
        if( $this->getType($varItem) === 'boolean' ){
            $content = ' <span class="sf-dump-const">';
            $content .= ($varItem) ? 'true' : 'false';
            return $content . "</span>";
        }

        if( in_array($this->getType($varItem), ['null', 'NULL']) ){
            return ' <span class="sf-dump-note">null</span>';
        }

        return ($this->getType($varItem) === 'string') ?
                ' "<span class="sf-dump-key">' . $varItem . '</span>"' :
                ' <span class="sf-dump-num">' . $varItem . '</span>';
        
    }

    private function setArray($varArray){

        $html = ' [<br>';
        $html .= '<div class="sf-dump-wrapper">';

        foreach ($varArray as $key => $value) {
            $html .= $this->setItem($key) . ' =>' . $this->setType($value);
            $html .= $this->getContent($value);
            $html .= '<br>';
        }

        $html .= '</div>';
        $html .= ' ]';

        return $html;
    }

    private function objectToArray($object){
        $properties = array();
        $reflectionClass = new ReflectionClass($object);
        $nameClass = 'ObjectClass: ' . $reflectionClass->getShortName();

        foreach ($this->reflection as $key => $method) {
            $properties[$nameClass][$key] = $reflectionClass->$method();
        }

        return $properties;
    }

    private function run(){
        echo $this->css . ' ' . str_replace('%sfDump%', $this->content, $this->dump);
    }

}
