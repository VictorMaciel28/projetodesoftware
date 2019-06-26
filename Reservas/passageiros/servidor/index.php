<?php
session_start();

require 'classes/banco.php';

header("Access-Control-Allow-Origin: *");

$banco = new mysqli('localhost','root','','mydb');
if ($banco->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Deu algum erro na conexão com o banco.";
} 


switch ($_SERVER['PATH_INFO']) {
    
    case '/login':  
    $nome = $_POST["nome"];
    $codigo = $_POST["codigo"];
    $_SESSION['id']=$codigo;
    $sql= "SELECT * FROM itr_psgr WHERE `NM_PSGR` = '$nome' AND `CD_PSGR` = '$codigo';";
    
    $result = $banco->query($sql);
    if ($result->num_rows > 0) {
        echo '<script type="text/javascript">window.location.href="../../../../Reservas/passageiros/view/home.html"</script>';
    }else{
        echo "Login não encontrado, tente novamente!";
    }
    break;

    case '/id':
    echo $_SESSION['id'];
    break;

    case '/voos':  
    $sql= "SELECT * FROM itr_voo;";
    $result = $banco->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $return_arr[] = array(
            "NR_VOO" => $row['NR_VOO'],
            "DT_SAIDA_VOO" => $row['DT_SAIDA_VOO'],
            //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
            "NR_ROTA_VOO" => $row['NR_ROTA_VOO'],
            "CD_ARNV" => $row['CD_ARNV']
            );};
        echo json_encode($return_arr);
    }else {
        echo "0 results";
    };
    break;

    case '/reservas':
    $codigo=$_SESSION['id'];
    $sql= "SELECT * FROM itr_resv WHERE `CD_PSGR` = $codigo;";
    $result = $banco->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $return_arr[] = array(
            "CD_PSGR" => $row['CD_PSGR'],
            "NR_VOO" => $row['NR_VOO'],
            "DT_SAIDA_VOO" => $row['DT_SAIDA_VOO'],
            //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
            "PC_DESC_PASG" => $row['PC_DESC_PASG'],
            );};
    echo json_encode($return_arr);
        }
    break;

    case '/buscavoo':
        $campo = $_POST["campo"];
        $sql= "SELECT * FROM itr_voo WHERE `DT_SAIDA_VOO` = '$campo';";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "NR_VOO" => $row['NR_VOO'],
                "DT_SAIDA_VOO" => $row['DT_SAIDA_VOO'],
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                "NR_ROTA_VOO" => $row['NR_ROTA_VOO'],
                "CD_ARNV" => $row['CD_ARNV']
                );};
            echo json_encode($return_arr);
            }
    break;

    case '/reservar':
        $col1 = $_POST["col1"];
        $col2 = $_POST["col2"];
        $col3 = $_POST["col3"];
        $id = $_SESSION['id'];

    $sql= "INSERT INTO `itr_resv` (`CD_PSGR`, `NR_VOO`, `DT_SAIDA_VOO`, `PC_DESC_PASG`) VALUES ('$id', '$col1', '$col2', '3');";
    $result = $banco->query($sql);
    //INSERT INTO * FROM itr_psgr WHERE `NM_PSGR` = '$nome' AND `CD_PSGR` = '$codigo';";
    if ($result=='1'){
        echo 'Incluído com sucesso!';
    }else{
        echo 'Erro na inclusão';
    }
    break;

    case '/reserva/cancelar':
        $col1 = $_POST["col1"];
        $col2 = $_POST["col2"];
        $col3 = $_POST["col3"];
        $id = $_SESSION['id'];
        $sql= "DELETE FROM `itr_resv` WHERE `CD_PSGR`= $id AND `NR_VOO`=$col1 AND`DT_SAIDA_VOO`= '$col2';";
        $result = $banco->query($sql);
        if ($result=='1'){
            echo 'Excluído com sucesso!';
        }else{
            echo 'Erro na exclusão';
        }
    break;
  

    case '/servicos':
        echo "Responddido";
    break;

    default:
        echo "Página não encontrada.";
        //echo '<script type="text/javascript">window.location.href="../../pages/404page.html"</script>';
    break; 
}

?>




