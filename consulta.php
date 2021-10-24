<?php
if(!isset($_POST['id-paciente'])){
    header("Location: vacinas.php");
    exit;
}
    $entrada = trim($_POST['id-paciente']);
    $banco = new PDO ('mysql:host=127.0.0.1;dbname=mydb','root', 'caules');
    $sth = $banco->prepare('SELECT * FROM `paciente` WHERE `id_paciente` LIKE :entrada');
    $sth->bindParam(':entrada',$entrada,PDO::PARAM_STR);
    $sth->execute();

    $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <title>Detalhes da consulta</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">logo</a>
            <ul class="navbar-nav mr-auto"></ul>
        </nav>
    </header>

    <div class="container" id="principal">
        <h1 class="text-center pt-3">Detalhes da consulta</h3>
        <ul class="list-group">
            <li class="list-group-item">Paciente:               <?php echo $resultados[0]['nome']; ?> </li>
            <li class="list-group-item">Sexo:                   <?php echo $resultados[0]['sexo']; ?> </li>
            <li class="list-group-item">Nascimento:             <?php echo $resultados[0]['nascimento']; ?> </li>
            <li class="list-group-item">Telefone:               <?php echo $resultados[0]['telefone']; ?> </li>
        </ul>
        
        <div class="form-group pb-3 justify-content">
            <form action="adiciona2.php" method="POST">
                <li class="list-group-item pb-3 pt-3" for="vacinas-aplicadas">Adicionar arquivos:
                    <input type="file">
                </li>
                <div>
                <li class="list-group-item pb-2 pt-3">Sintomas:
                    <input class="form-control pl-3" name="sintomas">
                </li>

                <li class="list-group-item pb-2 pt-3" >Prescrições:
                    <input class="form-control pl-3" name="remedios">
                    <input type="hidden" name="paciente-id" value="<?php echo $resultados[0]['id_paciente']; ?>">
                </li>
                
                </div>
                    <div class="row pt-3">
                    <div class="col text-end">
                        <button class="btn btn-primary">Gerar atestado</button>
                        <button class="btn btn-warning">Gerar exame</button>
                        <button type="submit" class="btn btn-success">Finalizar consulta</button>
                    </div>
                </div>
            </form>
            <div>
                <form action="cancela.php" method="POST">
                    <div>
                        <button class="btn btn-danger">Cancelar consulta</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    
</body>
