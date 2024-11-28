<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>
<body>

<?php

include('../config/conecta.php');

$stmt = $conn -> prepare("SELECT * FROM tb_vendedor");
$stmt -> execute();
$result=$stmt->fetchAll();

?>

<form action="" method="post">
    <input type="text" name="busca" id="" placeholder="Insira o nome ou a comissão do vendedor">
    <input type="submit" value="Buscar">
</form>

<?php
if (!empty($_POST['busca'])) {
$sql=$conn->prepare("SELECT * FROM tb_vendedor WHERE nm_vendedor LIKE :buscar OR perc_comissao LIKE :buscar ORDER BY nm_vendedor");
$buscar="%".$_POST['busca'] . "%";
$sql->bindParam(":buscar",$buscar);
$sql->execute();
$result=$sql->fetchAll();
}
?>

<a href="adicionar.php"><img src="../img/adicionar.png" height="50" width="50"></a>
<table class="table table-bordered">
        <thead>
            <tr>
            <th>ID</th>
            <th>Vendedor</th>
            <th>Comissão</th>
            <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($result as $linha) {
                echo "<tr>";  
                echo "<td>".$linha['id_vendedor'] ." </td>";
                echo "<td>".$linha['nm_vendedor'] ." </td>"; 
                echo "<td>".$linha['perc_comissao'] ." </td>"; 
        ?>
                <td> <a href="editar.php?id=<?php echo $linha['id_vendedor']?>"><img src="../img/editar.png" height="25" width="25"></a> </td>
                <td> <a href="excluir.php?id=<?php echo $linha['id_vendedor']?>"><img src="../img/excluir.png" height="25" width="25" onclick='return confirm("Deseja Realmente Excluir?")'></a></td>
                
                <?php
                echo "</tr>";
            }
                ?>
        </tbody>
            
        
    </table>
</body>
</html>