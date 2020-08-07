<?php

    session_start();
    include '../classes/Connection.php';
    include '../classes/Paciente.php';
    
    $id = filter_input(INPUT_POST, 'idResponsavel', FILTER_SANITIZE_NUMBER_INT);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
        
    // Validação da sessão (Segurança)
    if($_SESSION['ID'] != $id || $_SESSION['CPF'] != $cpf) {
        echo "-1"; exit;
    }
    
    // Opção LISTA
    if($_POST['op'] == "listar") {
        $idResp = $_SESSION['ID'];
        $stmt = $conn->prepare("SELECT * FROM paciente WHERE PacienteID IN (SELECT IDPaciente FROM relpacresp WHERE IDResponsavel = :id) ORDER BY DataNasc DESC");
        $stmt->bindParam(':id', $idResp);
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            // ENCONTROU RESULTADOS
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dep_array[] = new Paciente($row);
            }
            echo json_encode($dep_array);
        } else {
            // NÃO ENCONTROU NADA
            echo "-1";
        }
    }
    
    
    

    
