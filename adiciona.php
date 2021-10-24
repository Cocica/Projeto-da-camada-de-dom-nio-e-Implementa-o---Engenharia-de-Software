<?php
try{
    $conn = mysqli_connect('localhost','root','caules','mydb');
    $vacina = $_POST['vacina-nome'];
    $data = $_POST['vacina-data'];
    $dose = $_POST['vacina-dose'];
    $id = $_POST['usuario-id'];

    //id da vacina
    $passo1 = "SELECT id_vacinas FROM vacinas WHERE nome = '{$vacina}'";
    $exec = mysqli_query($conn,$passo1);
    $resultado = mysqli_fetch_all($exec,MYSQLI_ASSOC);

    $idVacina = $resultado[0]['id_vacinas'];

    //id do cartão

    $passo2 = "SELECT paciente.id_cartao FROM cartao,paciente WHERE paciente.id_cartao = cartao.id_cartao AND paciente.id_paciente = '{$id}'";
    $exec2 = mysqli_query($conn,$passo2);
    $resultado2 = mysqli_fetch_all($exec2,MYSQLI_ASSOC);

    $idCartao = $resultado2[0]['id_cartao'];

    $q = "INSERT INTO cartao_inclui_vacinas (cartao_id_cartao,vacinas_id_vacinas,dose,data_vacinacao) VALUES ('{$idCartao}','{$idVacina}','{$dose}','{$data}')";
    $exec3 = mysqli_query($conn,$q);

}
catch(Exception $e){
    echo "Erro na inclusão da vacina";
}

?>