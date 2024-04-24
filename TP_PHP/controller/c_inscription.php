<?php
require_once('model/dbconnect.php');

// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {

    // Récupère les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $mail = isset($_POST['mail']) ? $_POST['mail'] : null;
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : null;
    $list = isset($_POST['list']) ? $_POST['list'] : null;
    $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : null;
    $image = isset($_POST['image']) ? $_POST['image'] : null;

    // Vérifie que les clés nécessaires sont définies
    if ($nom && $prenom && $mail && $mdp && $list && $sexe && $image) {
        $sql = "INSERT INTO utilisateur (id_club, nom_uti, prenom_uti, mail_uti, password_uti, sexe_uti, image_uti) VALUES (:idclub, :nom, :prenom, :mail, :mdp, :sexe, :image)";
        $requete = $pdo->prepare($sql);

        $image64 = base64_encode($image);

        // Lie les valeurs aux paramètres de la requête.
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':mail', $mail, PDO::PARAM_STR);
        $requete->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $requete->bindParam(':idclub', $list, PDO::PARAM_STR);
        $requete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $requete->bindParam(':image', $image64, PDO::PARAM_STR);

        try {
            $requete->execute();
            echo "Inscrit.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23505) {
                echo "Erreur lors de l'inscription, l'adresse mail spécifiée est déjà associée à un autre compte.";
            }
        }

        $pdo = null;
    } else {
        include('view/inscription.php');
        echo "<p class='alert'>Veuillez remplir tous les champs du formulaire.</p>";
    }
} else {
    include('view/inscription.php');
}