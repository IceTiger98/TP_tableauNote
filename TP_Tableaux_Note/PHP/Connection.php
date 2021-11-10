
<!-- Connexion de la bdd "tp_note"-->
<?php
			
            define('USER',"root");
            define('PASSWD',"");
            define('SERVER',"localhost");
            define('BASE',"tp_note");


            function connect_bd_PDO()
            {
                $dsn="mysql:dbname=".BASE.";host=".SERVER;
                try{
                    $connexionPDO=new PDO($dsn,USER,PASSWD);
                    $connexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e){
                    echo ("Echec de la connexion PDO : %s\n", $e->getMessage());
                    exit();
                }
                return $connexionPDO;
            }            
?>