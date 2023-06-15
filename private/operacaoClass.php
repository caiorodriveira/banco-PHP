<?php 
    class Operacao {
        public $conta;
        public $operacao;
        public $valor;

        public function __construct($conta, $operacao, $valor){
            $this->conta = $conta;
            $this->operacao = $operacao;
            $this->valor = $valor;
        }

        
    }
?>