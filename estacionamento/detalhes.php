<?php 
session_start();
ob_start();
?>

<?php 
require 'config.php';

$info = [];

$id = filter_input(INPUT_GET, 'id');
if($id) {    
    $lista = $pdo->query("SELECT e.id, e.data, e.hora, c.nome , c.contato , v.tipo , v.modelo, v.placa , e.status, u.nome as operador
    FROM tbl_usuario as u INNER JOIN tbl_estacionamento as e on u.id = e.operador_id 
    INNER JOIN tbl_cliente as c on e.cliente_id = c.id INNER JOIN tbl_veiculo as v on v.cliente_id = c.id Where e.id = $id");
  
    if($lista->rowCount() > 0 ){
        $info = $lista->fetch(PDO::FETCH_ASSOC);
       
    }
    

    print_r($info);

}else{
    header("Location: index.php");
    exit;
}

?>

<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>detalhes</title>
    </head>
    <body>
        
    
    <tr>
        <td> <?php echo $info['data']; ?> </td>
        <td> <?= $info['hora']; ?> </td>
        <td> <?= $info['nome']; ?> </td>
        <td> <?= $info['contato']; ?> </td>
        <td> <?= $info['tipo']; ?> </td>
        <td> <?= $info['placa']; ?> </td>
        <td> <?= $info['modelo']; ?> </td>
        <td> <?= $info['status']; ?> </td>
    </tr>   
   
    
    <table>
        <tr>
            <th><a href="">Finalizar</a></th>
            <th><a href="">Editar</a></th>
            <th><a href="home.php">Voltar</a></th>
        </tr>
    </table>
</body>
</html>