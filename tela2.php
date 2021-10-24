<?php
$conn = mysqli_connect('localhost','root','caules','mydb');
$sql = 'SELECT * from `paciente`';
$result = mysqli_query($conn,$sql);
$cocica = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <title>Vacina-buscar</title>
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
        <h1 class="text-center pt-4">Pacientes conectados com você</h1>
        <div class="container text-center pt-4">
        <?php
        if (count($cocica)){
            foreach($cocica as $Resultado){
                ?>
                <div class="listItems col-12">
                <ul>
                    <form action="consulta.php" method="POST">
                            <li><?php echo $Resultado['nome'];?>
                                <input type="hidden" name="id-paciente" value="<?php echo $Resultado['id_paciente'];?>">
                                <button class="btn btn-success" id="button-visual" name="button-consulta">Iniciar consulta</button>
                            </li>
                    </form>
                </ul>
                </div>
            <?php
            }
        }
        else {
            ?>
            <h3 class="pb-3">Falha</h1>
        <?php
        }
        ?> 
    </div>
    </div>
</body>
</html>