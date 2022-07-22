<?php
include("../config.php");
include("../ajax/PDO.php");




$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$complement = $_POST['complement'];
$return = array();
$return['salvo'] = 'false';

$id = $_SESSION['dados']['id'];

if(isset($_POST['salvar-end'])){

$local = array("cep"=>$cep,"endereco"=>$endereco,"numero"=>$numero,"bairro"=>$bairro,"cidade"=>$cidade,"estado"=>$estado,"comp"=>$complement,"salvar"=>"checked");

$_SESSION['local'] = $local;

// print_r($_SESSION['local']);


$query = "SELECT * FROM `enderecos` WHERE `id` = ?";
$valores = [$id];
$res = normalDbQuery($query,$valores);

if(count($res) > 0){
    $query ="UPDATE `enderecos` SET `cep`=?,`logradouro`=?,`bairro`=?,`cidade`=?,`estado`=?,`numero`=?,`complemento`=? WHERE `id` = ?";
    $valores = [$cep,$endereco,$bairro,$cidade,$estado,$numero,$complement,$id];


    $return['salvo'] = 'true';

    
}else{
    $query = "INSERT INTO `dblojinha`.`enderecos` (`id`,`cep`, `logradouro`, `bairro`, `cidade`, `estado`, `numero`, `complemento`) VALUES ('?','?','?','?','?','?','?','?')";
    $valores = [$id,$cep,$endereco,$bairro,$cidade,$estado,$numero,$complement];

    // echo $query;
    if(count(normalDbQuery($query,$valores)) > 0){
        die(json_encode(['sucesso'=>"true"]));
    }
    
}
}

die(json_encode($return))



?>