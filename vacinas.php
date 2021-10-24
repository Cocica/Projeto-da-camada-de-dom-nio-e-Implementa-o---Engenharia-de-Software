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
    <title>Cartão de vacina</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">logo</a>
            <ul class="navbar-nav mr-auto"></ul>
        </nav>
    </header>

    <div class="container" id="principal">
        <h1 class="text-center pt-3">Cartão de vacina</h3>
        <ul class="list-group">
            <li class="list-group-item">Paciente:               <?php echo $resultados[0]['nome']; ?> </li>
            <li class="list-group-item">Sexo:                   <?php echo $resultados[0]['sexo']; ?> </li>
            <li class="list-group-item">Nascimento:             <?php echo $resultados[0]['nascimento']; ?> </li>
            <li class="list-group-item">Telefone:               <?php echo $resultados[0]['telefone']; ?> </li>
        </ul>


        <?php
                $conn = mysqli_connect('localhost','root','caules','mydb');
                $sqll = "SELECT vacinas.nome FROM cartao, paciente, cartao_inclui_vacinas, vacinas WHERE cartao.id_cartao=paciente.id_cartao AND vacinas.id_vacinas=cartao_inclui_vacinas.vacinas_id_vacinas AND
                cartao.id_cartao=cartao_inclui_vacinas.cartao_id_cartao AND paciente.id_paciente = '{$resultados[0]['id_paciente']}'";
                $resultt = mysqli_query($conn,$sqll);
                $cocicaa = mysqli_fetch_all($resultt, MYSQLI_ASSOC); 
        ?>
        <div class="form-group pb-3">
            <li class="list-group-item pb-2" for="vacinas-aplicadas">Vacinas aplicadas:
                <select multiple class="form-control" id="vacinas-aplicadas">
                <?php
                    foreach($cocicaa as $Resultado){
                ?>
                    <option><?php echo $Resultado['nome']; ?></option>

                <?php } ?>

                </select>
                <div class="text-center pt-3 pb-3">
                    <button class="btn btn-success pt">Imprimir cartão</button>
                </div>
            </li>
        </div>

        <?php
            $sql = 'SELECT `nome` from `vacinas`';
            $result = mysqli_query($conn,$sql);
            $cocica = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>

        <div class="form-group pb-3">
            <form action="adiciona.php" method="POST">
                <li class="list-group-item pb-2" for="vacinas-aplicadas">Aplicar vacina:
                        <input type="text" name="vacina-nome" list="vacinas-disponiveis">
                        <datalist id="vacinas-disponiveis" >
                        <?php
                        foreach($cocica as $Resultado){
                        ?>
                        <option><?php echo($Resultado['nome']) ;?></option>
                        <?php }?>
                        </datalist>
                    <input type="hidden" name="usuario-id" value="<?php echo $resultados[0]['id_paciente']; ?>">
                    <input  type="date" name="vacina-data" placeholder="Data"> 
                    <input type="number" name="vacina-dose" min="1" max="5" placeholder="Dose">
                    <button type="submit" name="submit" class="btn btn-success">Inserir</button>
                </li>
            </form>        
        </div>
    </div>
    
</body>
