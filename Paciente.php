<?php

class Paciente {
    //put your code here
    public $pacienteID;
    public $nomePaciente;
    public $dtNascPaciente;
    public $ultTemperatura;
    public $alergias = [];
    public $atendimentos = [];
    
    function __construct($array) {
        // Carrega informações do Paciente
        $this->pacienteID = $array['PacienteID'];
        $this->nomePaciente = $array['Nome'];
        $this->dtNascPaciente = $array['DataNasc'];
        $this->ultTemperatura = $array['UltTemperatura'];
    }
    
    function getAlergias($id) {
        // Pega todas as alergias do Paciente
        
    }
    
    function getAtendimentos($id) {
        // Pega todas os atendimentos do Paciente
        
    }
}
