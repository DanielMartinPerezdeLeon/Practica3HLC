<?php

    session_start(); //Abre una nueva sesion   

    if(!isset($_SESSION["number"])){    //Si la variable de sesión no está definida
        $_SESSION["number"]=rand(1,100);    //Le da un numero aleatorio     
        $_SESSION["intentos"]=0;        //Reinicia los intentos
        $_SESSION["limite_superior"]=100;   //limites
        $_SESSION["limite_inferior"]=1;

    }

    $numero=$_SESSION["number"]; //Para facilitar codigo
    echo "<script>console.log($numero);</script>";  //Manda el numero a la consola de javaScript
    
    if(isset($_POST["intento"])){   //Si se ha mandado un numero por el formulario
        $intento=($_POST["intento"]);   //Facilita codigo   
        $nintentos=$_SESSION["intentos"];   //IDEM  

        

        if($numero==$intento){ //SI acierta 
            echo "Acertado, has hecho $nintentos intentos"; //Avisa
            unset($_SESSION["numero"]);//Desdefine la variable de sesion
            session_destroy(); //Cuidado, podria dar problemas
        }elseif($intento<$numero){  //Intento menor que el numero   
            echo "El numero es mayor que $intento";//AVisa  
            $_SESSION["intentos"]++;    //Aumenta +1 intentos

            if($_SESSION["limite_inferior"]<$intento){  //si el limite inferior es mayor que el intento
                $_SESSION["limite_inferior"]=$intento;  //ESE es el nuevo limite inferior  
            }

        }else{  //IDEM PERO mayor
            echo "El numero es menor que $intento";
            $_SESSION["intentos"]++;

            if($_SESSION["limite_superior"]>$intento){
                $_SESSION["limite_superior"]=$intento;
            }
            
        }
    }

?>






<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Juego</title>
	</head>
	<body>
		<main>
			<!-- HAY QUE HACER ESTO BONITO-->

               <spam>adivina el numero entre <?php echo $_SESSION["limite_inferior"]; ?> 
                        y  <?php echo $_SESSION["limite_superior"]; ?> </spam>  <!-- muestra los valores del php-->	
            <!-- hacer_Intento(($_GET['subject'),$num)  -->
            <form action="" method="post">
                Intento:<input type="number" name="intento" required>
                <input type="submit">
            </form>



                
		</main>
		
	</body>
</html> 
