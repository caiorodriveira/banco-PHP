<?php 
    class Conta {
        public $pessoa;
        public $saldo;
        public $numero;

        public function __construct($pessoa, $saldo, $numero){
            $this->pessoa = $pessoa;
            $this->saldo = $saldo;
            $this->numero = $numero;
        }
    }
?>