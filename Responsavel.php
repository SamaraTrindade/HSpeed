<?php

class responsavel {
    //put your code here
    public $responsavelID;
    public $cpf;
    public $nome;
    public $localizacao;
    
    function __construct($cpf) {
        // Busca os dados da clínica no banco e cria o objeto.
        include "Connection.php";
        
        $stmt = $pdo->prepare("SELECT * FROM 'responsavel' WHERE 'cpf' = ?");
        $stmt->execute([$cpf]); 
        $user = $stmt->fetch();
        
        $this->responsavelID = $user[''];
    }
}
