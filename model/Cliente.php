<?php

class Cliente{

    protected $cod;
    protected $nome;
    protected $cpf;
    protected $email;
    protected $senha;

    public function __construct($cod, $nome,$Cpf,  $email, $senha)
    {
        $this->cod = $cod;
        $this->nome = $nome;
        $this->cpf = $Cpf;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function get_cod(){
        return ($this->cod);
    }
    public function set_cod($cod){
        $this->cod = $cod;
    }
    public function get_nome(){
        return($this->nome);
    }

    public function set_nome($nome){
        $this->nome = $nome;
    }



    public function get_cpf(){
        return($this->cpf);
    }
    
    
    public function set_cpf($Cpf){
        $this->cpf = $Cpf;
    }



    public function get_email(){
        return($this->email);
    }
   
    public function set_email($email){
        $this->email = $email;
    }
    
    public function get_senha(){
        return($this->senha);
    }
    public function set_senha($senha){
        $this->senha = $senha;
    }
}

?>