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

    case '/rotas':
        $sql= "SELECT * FROM itr_rota_voo";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "NR_ROTA_VOO" => $row['NR_ROTA_VOO'],
                "ITR_ARPT_CD_ORIG" => $row['ITR_ARPT_CD_ORIG'],
                "ITR_ARPT_CD_DEST" => $row['ITR_ARPT_CD_DEST'],
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                "VR_PASG" => $row['VR_PASG'],
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/aeronaves':
        $sql= "SELECT * FROM itr_arnv";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "CD_ARNV" => $row['CD_ARNV'],
                "CD_EQPT" => $row['CD_EQPT'],
                "CD_CMPN_AEREA" => $row['CD_CMPN_AEREA']
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/paises':
        $sql= "SELECT * FROM itr_pais";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "CD_PAIS" => $row['CD_PAIS'],
                "NM_PAIS" => $row['NM_PAIS'],
                "QT_PPL_PAIS" => $row['QT_PPL_PAIS']
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/aeroportos':
        $sql= "SELECT * FROM itr_arpt";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "CD_ARPT" => $row['CD_ARPT'],
                "CD_PAIS" => $row['CD_PAIS'],
                "SG_UF" => $row['SG_UF'],
                "NM_CIDD" => $row['NM_CIDD']
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/companhiasaereas':
        $sql= "SELECT * FROM itr_cmpn_aerea";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "CD_CMPN_AEREA" => $row['CD_CMPN_AEREA'],
                "NM_CMPN_AEREA" => $row['NM_CMPN_AEREA'],
                "CD_PAIS" => $row['CD_PAIS']
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/unidadesfederativas':
        $sql= "SELECT * FROM itr_uf";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "SG_UF" => $row['SG_UF'],
                "NM_UF" => $row['NM_UF'],
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    case '/equipamentos':
        $sql= "SELECT * FROM itr_eqpt";
        $result = $banco->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $return_arr[] = array(
                "CD_EQPT" => $row['CD_EQPT'],
                "NM_EQPT" => $row['NM_EQPT'],
                "DC_TIPO_EQPT" => $row['DC_TIPO_EQPT'],
                "QT_MOTOR" => $row['QT_MOTOR'],
                "IC_TIPO_PRPS" => $row['IC_TIPO_PRPS'],
                "QT_PSGR" => $row['QT_PSGR']
                //"ITR_ARPT_CD_ORIG" => utf8_encode($row['ITR_ARPT_CD_ORIG']),
                );};
        echo json_encode($return_arr);
            }
    break;

    default:
        echo "Página não encontrada.";
        //echo '<script type="text/javascript">window.location.href="../../pages/404page.html"</script>';
    break; 
}

?>




