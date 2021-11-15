<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Intranet (Notes)</title>
		<meta charset="utf-8"/>
		<!--<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>-->
        <script type="text/javascript" src="../JS/function.js"></script>
        <link rel="stylesheet" href="../CSS/Menu.css" />
	</head>
	<body>     

        <?php
			
            session_start();
            //appel du script et de la fonction de connexion à la BDD
            include("Connection.php");
            include ("Fonction.php");

            $conn = connect_bdd_PDO();
        
            echo ("<h3> Tableau de notes</h3>") ;

                if(isset($_GET['text']))
            {
                $getNote = $_GET['text'];
                $getIdNote = $_GET['id_note'];
        
                for($i = 0; $i < sizeof($getNote); $i++)
                {
                    $reqEdit = "UPDATE note SET note = :newNote 
                                WHERE note.id_note = :newIdNote";
                    $modele = $conn -> prepare($reqEdit);
                    $modele -> bindValue('newNote', $getNote[$i]);
                    $modele -> bindValue('newIdNote', $getIdNote[$i]);
                    $modele -> execute();
        
                }
            }

        

        $note = getNote($conn);
        
        //affichage du tableau de note[Matières | Etudiants | Notes | Editer]
                        echo("<form action='' method='get'>");
        
                             echo("<table>");
                                        echo("<thead>");
                                                echo("<tr>");
                                                    echo("<th>Matières</th>");
                                                    echo("<th>Etudiants</th>");
                                                    echo("<th>Notes</th>");
                                                    echo("<th>Editer</th>");
                                                echo("</tr>");
                                        echo("</thead>");
                                    echo("<tbody>");
            
$i =0;
            foreach ($conn->query($reqBNote) as $row) {
                                                echo("<tr>");
                                                    echo("<td>".$row['matiere']."</td>");
                                                    echo("<td>".$row['nom_etudiant']." ".$row['prenom_etudiant']."</td>");
                                                    //mise en place de l'input text désactivé de base
                                                    echo("<td>".$row['note']."<input type='text'class='note' id='txt".$i."' name='text[]' disabled></td>");
                                                    //mise en place de la checkbox qui permet d'editer la note
                                                    echo("<td><input type='checkbox' name='idNote[]'   id='".$i."' value='".$row['id_note']."' onchange='activeTxt(this.id)'></td>");
                                                echo("</tr>");
            $i++;
            }
                                    echo("</tbody>");
                                echo("</table>");
        
                        echo("<input type='submit' value='Valider'>");
                    echo("</form>");
        


            echo("<h3> Moyenne des étudiants</h3>");






        $note = getMoyenne($conn);

        //affichage du tableau des moyennes [Matières | Etudiants | Moyennes]
                            echo("<table>");
                                    echo("<thead>");
                                        echo("<tr>");
                                            echo("<th>Matières</th>");
                                            echo("<th>Etudiants</th>");
                                            echo("<th>Moyennes</th>");
            
                                        echo("</tr>");
                                    echo("</thead>");
                                echo("<tbody>");

        foreach ($conn->query($reqMoyenne) as $row) {
                                        echo("<tr>");
                                            echo("<td>".$row['matiere']."</td>");
                                            echo("<td>".$row['nom_etudiant']." ".$row['prenom_etudiant']."</td>");
                                            echo("<td>".$row['moyenne']."</td>");
                                        echo("</tr>");
        }

                                echo("</tbody>");
                            echo("</table>");     
        
        ?>


        

</body>

</html>
