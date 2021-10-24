<?php
if(!isset($_GET['nome_paciente'])){
    header("Location: tela.php");
    exit;
}
    $nome = "%".trim($_GET['nome_paciente'])."%";
    $banco = new PDO ('mysql:host=127.0.0.1;dbname=mydb','root', 'caules');
    $sth = $banco->prepare('SELECT * FROM `paciente` WHERE `nome` LIKE :nome');
    $sth->bindParam(':nome',$nome,PDO::PARAM_STR);
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
    <title>Pacientes conectados</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">logo</a>
              <ul class="navbar-nav mr-auto">
              </ul>
          </nav>
    </header>
    <div class="container" id="principal">
    <h1 class="text-center pt-4">Busca por cartão de vacina</h1>
        <div class="row height d-flex justify-content-center align-items-center">
            <div class="col-md-8">
                <form action="busca.php" method="GET">
                    <div class="search"> <i class="fa fa-search"></i> <input type="text" class="form-control" placeholder="Busque pacientes por nome" name="nome_paciente"> <button class="btn btn-primary">Buscar</button> </div>
                </form>
            </div>
        </div>
        <div class="container text-center">
        <?php
        if (count($resultados)){
            foreach($resultados as $Resultado){
                ?>
                <div class="listItems col-12">
                <ul>
                    <form action="vacinas.php" method="POST">
                            <li><?php echo $Resultado['nome'];?>
                                <input type="hidden" name="id-paciente" value="<?php echo $Resultado['id_paciente'];?>">
                                <button class="btn btn-success" id="button-visual" name="button-vac">Visualizar</button>
                            </li>
                    </form>
                </ul>
                </div>
            <?php
            }
        }
        else {
            ?>
            <h3 class="pb-3">Não foram encontrados resultados com esse nome</h1>
        <?php
        }
        ?> 
    </div>

</body>