<?php
    session_start();
    ob_start();
    require 'config.php';

$query = [];
$user_id = $_SESSION['id'];

$sql = $pdo->query( "SELECT e.data, e.hora, e.status, c.nome, c.contato, v.tipo, v.placa, v.modelo, u.nome as operador 
FROM tbl_estacionamento as e 
INNER JOIN tbl_usuario as u ON e.operador_id = u.id 
INNER JOIN tbl_cliente as c ON e.cliente_id = c.id 
INNER JOIN tbl_veiculo as v ON v.cliente_id = c.id;" );

$nome = filter_input(INPUT_POST, 'nome');
$contato = filter_input(INPUT_POST,'contato');
$tipo = filter_input(INPUT_POST,'tipo');
$placa = filter_input(INPUT_POST,'placa');
$marca = filter_input(INPUT_POST,'marca');
$modelo = filter_input(INPUT_POST,'modelo');
$data = filter_input(INPUT_POST,'data');
$hora = filter_input(INPUT_POST,'hora');

if($nome && $contato && $tipo && $placa && $marca && $modelo && $data && $hora) {

    $cliente = $pdo->prepare("INSERT INTO tbl_cliente (nome, contato) VALUES (:nome, :contato)");
    $cliente->bindValue(':nome', $nome);
    $cliente->bindValue(':contato', $contato);
    $cliente->execute();
    
    $result = $pdo->query("SELECT id FROM tbl_cliente WHERE nome = '$nome' and contato = '$contato'");
    print_r($result);
    if($result->rowCount() > 0) {
        $cliente_id = $result->fetch(PDO::FETCH_ASSOC);
        
        $veiculo = $pdo->prepare("INSERT INTO tbl_veiculo (tipo, placa, marca, modelo, cliente_id) VALUES (:tipo, :placa, :marca, :modelo, :cliente_id);");
        $veiculo->bindValue(':tipo', $tipo);
        $veiculo->bindValue(':placa', $placa);
        $veiculo->bindValue(':marca', $marca);
        $veiculo->bindValue(':modelo', $modelo);
        $veiculo->bindValue(':cliente_id', $cliente_id['id']);
        $veiculo->execute();
        
        $estacionamento = $pdo->prepare("INSERT INTO tbl_estacionamento (data, hora, cliente_id, operador_id) VALUES (:data, :hora, :cliente_id, :operador_id)");    

        $estacionamento->bindValue(':data', $data);
        $estacionamento->bindValue(':hora', $hora);
        $estacionamento->bindValue(':cliente_id', $cliente_id['id']);
        $estacionamento->bindValue(':operador_id', $user_id);
        $estacionamento->execute();
        
        header("Location: home.php");
        exit;
    }
}

?>