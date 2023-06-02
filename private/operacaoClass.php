<?php 
    class Operacao {
        public $pessoa;
        public $conta;
        public $operacao;
        public $valor;

        public function __construct($pessoa, $conta, $operacao, $valor){
            $this->pessoa = $pessoa;
            $this->conta = $conta;
            $this->operacao = $operacao;
            $this->valor = $valor;
        }

        
    }
?>