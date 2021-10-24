<?php
$erro=false;
try{
    $conn = mysqli_connect('localhost','root','caules','mydb');
    $sintomas = $_POST['sintomas'];
    $remedios = $_POST['remedios'];
    $id_paciente = $_POST['paciente-id'];
    $data_agora = date('Y-m-d');

    $q1 = "INSERT INTO consulta (paciente_id_paciente,data_consulta,sintomas,prescricoes) VALUES ('{$id_paciente}','{$data_agora}','{$sintomas}','{$remedios}')";
    $exec1 = mysqli_query($conn,$q1);
}
catch(Exception $e){
    echo "Erro na conclusão da consulta";
    $erro=true;
}

?>

<?php
if (!$erro){ ?>
    <h1>Consulta registrada com sucesso!</h1>

    <script>
    function goBack() {
      window.history.back();
    }
    </script>
    
    <button onclick="goBack()">Voltar</button>
<?php
}
?>
