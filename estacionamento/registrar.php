<?php 

require 'config.php';

session_start();
ob_start();

$id = $_SESSION['id'];
$sql = $pdo->query("SELECT * FROM tbl_usuario WHERE id = $id");
$banco = $sql->fetch(PDO::FETCH_ASSOC); 


$query = [];
$user_id = $_SESSION['id'];

$sql = $pdo->query( "SELECT e.data, e.hora, e.status, c.nome, c.contato, v.tipo, v.placa, v.modelo, u.nome as operador 
FROM tbl_estacionamento as e 
INNER JOIN tbl_usuario as u ON e.operador_id = u.id 
INNER JOIN tbl_cliente as c ON e.cliente_id = c.id 
INNER JOIN tbl_veiculo as v ON v.cliente_id = c.id;" );

// $nome = filter_input(INPUT_GET, 'nome');
// $contato = filter_input(INPUT_GET,'contato');
// $tipo = filter_input(INPUT_GET,'tipo');
// $placa = filter_input(INPUT_GET,'placa');
// $marca = filter_input(INPUT_GET,'marca');
// $modelo = filter_input(INPUT_GET,'modelo');
// $data = filter_input(INPUT_GET,'data');
// $hora = filter_input(INPUT_GET,'hora');

// if($nome && $contato && $tipo && $placa && $marca && $modelo && $data && $hora) {

//     $cliente = $pdo->prepare("INSERT INTO tbl_cliente (nome, contato) VALUES (:nome, :contato)");
//     $cliente->bindValue(':nome', $nome);
//     $cliente->bindValue(':contato', $contato);
//     $cliente->execute();
    
//     $result = $pdo->query("SELECT id FROM tbl_cliente WHERE nome = '$nome' and contato = '$contato'");
//     print_r($result);
//     if($result->rowCount() > 0) {
//         $cliente_id = $result->fetch(PDO::FETCH_ASSOC);
        
//         $veiculo = $pdo->prepare("INSERT INTO tbl_veiculo (tipo, placa, marca, modelo, cliente_id) VALUES (:tipo, :placa, :marca, :modelo, :cliente_id);");
//         $veiculo->bindValue(':tipo', $tipo);
//         $veiculo->bindValue(':placa', $placa);
//         $veiculo->bindValue(':marca', $marca);
//         $veiculo->bindValue(':modelo', $modelo);
//         $veiculo->bindValue(':cliente_id', $cliente_id['id']);
//         $veiculo->execute();
        
//         $estacionamento = $pdo->prepare("INSERT INTO tbl_estacionamento (data, hora, cliente_id, operador_id) VALUES (:data, :hora, :cliente_id, :operador_id)");    

//         $estacionamento->bindValue(':data', $data);
//         $estacionamento->bindValue(':hora', $hora);
//         $estacionamento->bindValue(':cliente_id', $cliente_id['id']);
//         $estacionamento->bindValue(':operador_id', $user_id);
//         $estacionamento->execute();
        
//         header("Location: home.php");
//         exit;
//     }
// } 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> Cadastrar veiculo </title>
</head>
<body>

    <div id="grid-container">
        
        <div id="menu-container">            

            <div class="item-menu" id="left-menu"> <a href="home.php"> Sistema de estacionamento </a> </div>
            
            <div>

                <div class="item-menu"> <img id="img-menu" src="arquivo/<?=$banco['avatar']; ?>" alt="foto-de-perfil"> </div>
                <div class="item-menu"> <span>  <?= $_SESSION['nome']?>  </span> </div>
                <div class="item-menu"> <a href=""> Sair </a> </div>
                
            </div>

        </div>
            
        <div id="main-container">

            <div id="h1-container"> <h1>Cadastro de Veículo</h1> </div>

            <div id="form-container">

                <form action="registra_action.php" method="post">

                    <input type="hidden"> <br>

                    <input class="input-form" type="text" name="nome" placeholder="nome do cliente"> <br>

                    <input class="input-form" type="text" name="contato" placeholder="contato do cliente"> <br>

                    <input class="input-form" type="number" name="tipo" placeholder="tipo do veiculo"> <br>

                    <input class="input-form" type="text" name="placa" placeholder="nome da placa"> <br>

                    <input class="input-form" type="text" name="marca" placeholder="nome do marca"> <br>

                    <input class="input-form" type="text" name="modelo" placeholder="nome do modelo"> <br>

                    <input class="input-form" type="text" name="data" placeholder="data"> <br>

                    <input class="input-form" type="text" name="hora" placeholder="hora"> <br>

                    <input id="button-form" type="submit" name="cadastrar" value="cadastrar">
            
                </form>

                <div> <a href="home.php"> Voltar </a>  </div>
                
            </div>    
                               
        </div>

    </div>

</body>
</html>