<?php

require_once "../ConOracle.php";
// acesso somente para que tiver atuorização
// if (!isset($_SESSION['usuarioId']) and !isset($_SESSION['usuarioEmail'])) {
//     $_SESSION['error']['notAuthorized'] = "faça o login ou crie uma conta";
// 		header("Location: ../index.php");
//         die;
// }


if (isset($_POST['token'])) {
    require_once "../ConOracle.php";

  //  Error_reporting(0);

    $emailUser = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL): "";
    $usuario = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_STRING): "";
    

    $con = new ConOracle();
	 $link = $con->conectar();
	

    if ($emailUser != "") {

        $sql = "SELECT EMAIL FROM G4M_USER where EMAIL= '$emailUser' ";
        $stid = oci_parse($link, $sql); 
      
        oci_execute($stid,OCI_COMMIT_ON_SUCCESS);
        
        
        

            if ($email =  oci_fetch_assoc($stid)) {
                echo "<div class='alert alert-danger my-2' role='alert'>";
                echo " e-mail já cadastrado";
                echo "</div>";
            }else{
                echo "<div class='alert alert-success my-2' role='alert'>";
                echo  " e-mail disponível";
                echo "</div>";
            }
        
    }

    if ($usuario != "") {

        $sql = "SELECT LOGIN FROM G4M_USER where LOGIN= '$usuario' ";
        $stid = oci_parse($link, $sql); 
      
        oci_execute($stid,OCI_COMMIT_ON_SUCCESS);

        if ($email =  oci_fetch_assoc($stid)) {
            echo "<div class='alert alert-danger my-2' role='alert'>";
            echo " Username já cadastrado";
            echo "</div>";
        } else {
            echo "<div class='alert alert-success my-2' role='alert'>";
            echo " Username disponível";
            echo "</div>";
        }
    }
   
     oci_close($link); 

} else {

    header('location: index.php');
}


    
   
	    	
    
    


