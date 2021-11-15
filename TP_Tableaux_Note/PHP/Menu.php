<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Intranet (Notes)</title>
		<meta charset="utf-8"/>
		<!--<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>-->
        <!--<script type="text/javascript" src="../JS/function.js"></script>-->
        <link rel="stylesheet" href="../CSS/Menu.css" />
	</head>
	<body>     

        <?php
			
            session_start();
            include("Connection.php");
            $conn = connect_bdd_PDO();

            tableauNote($conn);
            tableauMoyenne($conn);




            function editer($conn){
            
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
            
                        if(isset($_GET['text'])){
            
                            edit($conn);
                        }
            
                    
            function tableauNote($conn){
            
                    $reqNote = "SELECT * from table_note, table_etudiant 
                                WHERE table_note.login_etudiant = table_etudiant.login_etudiant";
                    
            
                    echo ("<h3> Tableau de notes</h3>") ;
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
                        foreach ($conn->query($reqNote) as $row) {
                                                            echo("<tr>");
                                                                echo("<td>".$row['matiere']."</td>");
                                                                echo("<td>".$row['nom_etudiant']." ".$row['prenom_etudiant']."</td>");
                                                                //mise en place de l'input textdésactivé de base
                                                                echo("<td>".$row['note']."<input type='text'class='note' id='txt".$i."'name='text[]'disabled></td>");
                                                                //mise en place de la checkbox qui permet d'editer la note
                                                                echo("<td><input type='checkbox'name='idNote[]'id='".$i."'value='".$row['id_note']."'onchange='activeTxt(this.id)'></td>");
                                                            echo("</tr>");
                        $i++;
                        }
                                                echo("</tbody>");
                                            echo("</table>");
                    
                                    echo("<input type='submit' value='Valider'>");
                                echo("</form>");
            }
                    
            
            function tableauMoyenne($conn){
            
                    $reqMoyenne =  "SELECT *, AVG(note) AS moyenne from table_note, table_etudiant 
                                            WHERE table_note.login_etudiant = table_etudiant.login_etudiant 
                                            GROUP BY id_etudiant";        
            
                        //affichage du tableau des moyennes 
                        echo("<h3> Moyenne des étudiants</h3>");
            
                                        echo("<script>");
                                                echo("function CreeMoyenne{");
            
                                                    echo("let table =document.createElement('table');\n");
                                                    echo("document.body.appendChild(table);\n");
            
                                                        echo("let head = document.createElement('thead');\n");
                                                        echo("table.appendChild(head);\n");
            
                                                            echo("let trh = document.createElement('tr');\n");
                                                            echo("head.appendChild(trh);\n");
            
                                                                //[Matières | Etudiants | Moyennes]
                                                                echo("let thMatiere = document.createElement('th');\n");
                                                                echo("thMat.innerHTML = 'Matières';\n");
                                                                echo("trh.appendChild(thMatiere);\n");
            
                                                                echo("let thEtudiant = document.createElement('th');\n");
                                                                echo("thEtud.innerHTML = 'Etudiants';\n"            );
                                                                echo("trh.appendChild(thEtudiant);\n");
                                                        
                                                                echo("let thMoyenne = document.createElement('th');\n");
                                                                echo("thMoy.innerHTML = 'Moyennes';\n");
                                                                echo("trh.appendChild(thMoyenne);\n");
            
                                                        echo("let body = document.createElement('tbody');\n");
                                                        echo("table.appendChild(body);\n");
            
            
            
                        $i=0;
                        foreach ($conn->query($reqMoyenne) as $row) {
            
                                    echo("let tr".$i." = document.createElement('tr');\n");
                                    echo("body.appendChild(tr".$i.");\n");
            
                                        if ($row['moyenne'] > 14){
                                            echo("tr".$i.".classList.add('vert');\n");
                                        }
            
                                        else if ($row['moyenne'] <= 14 && $row['moyenne'] >= 10)
                                        {
                                            echo("tr".$i.".classList.add('orange');\n");
                                        }
            
                                        else
                                        {
                                            echo("tr".$i.".classList.add('rouge');\n");
                                        }
            
                        echo("let tdMatiere".$i." = document.createElement('td');\n");
                        echo("tdMatiere".$i.".innerHTML = '".$row['matiere']."';\n");
                        echo("tr".$i.".appendChild(tdMatiere".$i.");\n");
            
                        echo("let tdEtudiant".$i." = document.createElement('td');\n");
                        echo("tdEtudiant".$i.".innerHTML = '".$row['nom_etudiant']." ".$row['prenom_etudiant']."';\n");
                        echo("tr".$i.".appendChild(tdEtudiant".$i.");\n");
            
                        echo("let tdMoyenne".$i." = document.createElement('td');\n");
                        echo("tdMoyenne".$i.".innerHTML = '".$row['moyenne']."';\n");
                        echo("tr".$i.".appendChild(tdMoyenne".$i.");\n");
            
                        $i++;
                    } 
                    echo("}");

                    echo("</script>");
            
            
            }  
        ?>


            <script>
                //fonction javascript qui active la zone de texte en fonction de la check box
                function checkBox(val)
                {
                    console.log(val);
                    let text =document.getElementById("txt"+val);
                    if(text.disabled == true)
                    {
                        text.disabled = false;
                    }
                    else 
                    {
                        text.disabled = true;
                    }
                }

                CreeMoyenne();
            </script>

</body>

</html>
