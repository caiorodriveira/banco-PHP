<?php 
    class Pessoa {
        public $nome;
        public $email;
        public $cpf;

        public function __construct($nome,$email, $cpf){
            $this->nome = $nome;
            $this->email = $email;
            $this->cpf = $cpf;            
        }
    }
?>