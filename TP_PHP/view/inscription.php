<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script/formscript.js"></script>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
    </head>
    <body>
        <br>
        <form method="post">
            <div>
                <h2>Inscription</h2>
                <div class="formulaire">
                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                </div>
                <div class="formulaire">
                    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="formulaire">
                    <input type="email" id="mail" name="mail" placeholder="Courriel" required>
                </div>
                <div class="formulaire">
                    <input type="text" id="mdp" name="mdp" placeholder="Mot de passe" required>
                </div>

                <select class="list" id="list" name="list">
                    <?php
                        require_once('model/dbconnect.php');

                        $query = "SELECT id_club, nom_club FROM club";
                        $result = $pdo->query($query);
                        
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . $row['id_club'] . "\">" . $row['nom_club'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <h2>Sexe</h2>
            <div class="bouton-radio">            
                <input type="radio" id="sexe" name="sexe" value="Homme" />
                <label for="homme">Homme</label>
            
                <input type="radio" id="sexe" name="sexe" value="Femme" />
                <label for="femme">Femme</label>
            
                <input type="radio" id="sexe" name="sexe" value="Autre" />
                <label for="autre">Autre</label>
            </div>
            
            <h2>Photo de profil</h2>
            <div class="img_select">
                <input type="file" accept="image/*" name="image" id="image" onchange="displayImage(event)">
                <br><br>
                <img id="preview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 300px;">
                <br><br>
            </div>

            <script>
                function displayImage(event) {
                    var image = document.getElementById('preview');
                    image.src = URL.createObjectURL(event.target.files[0]);
                }
            </script>

            <div class="bouton">
                <input type="submit" name="submit" value="S'inscrire" onclick="verifierBoutonRadio()"/>
            </div>
        </form>
    </body>
</html>