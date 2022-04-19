<?php

class potentielClient
{
    public static function ajoutClient($_postP, $pdoP)
    {
        // J'envoie mes données dans ma base grâce à mes différentes requêtes.

        $stmt = $pdoP->prepare("INSERT INTO client(nom_client, prenom_client, date_test_client, appareil_client, perte_auditive_client, deni_client, souhait_client, remarque_client, opticien_test_client) VALUES(UPPER(?), ?, ?, ?, ?, ?, ?, ?, ?)");

        $nomClient = htmlspecialchars($_POST['nomClient']);
        $prenomClient = htmlspecialchars($_POST['prenomClient']);
        $date = $_POST['date-test'];
        $appareil = $_POST['appareil'];
        $perte = $_POST['perte-auditive'];
        $deni = $_POST['deni'];
        $souhait = $_POST['souhait'];
        $remarque = htmlspecialchars($_POST['remarque']);
        $opticien = $_POST['opticien'];


        $stmt->execute([$nomClient, $prenomClient, $date, $appareil, $perte, $deni, $souhait, $remarque, $opticien]);
    }

    public static function tableauClient($pdoP)
    {
        // Je sélectionne les données de ma bd pour les afficher sous forme de tableau.

        $stmt = $pdoP->prepare("SELECT id_client, nom_client, prenom_client, appareil_client, perte_auditive_client, deni_client, souhait_client, remarque_client, opticien_test_client, DATE_FORMAT(date_test_client, '%d/%m/%Y') FROM client ORDER BY DATE_FORMAT(date_test_client, '%d/%m/%Y') DESC");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<div class=\"container mt-3\"><table class=\"table\" style='box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius: 10px;'>
        <thead class=\"thead-light\">
            <tr>
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Nom client</th>
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Prénom client</th>
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Date Test Auditif</th> 
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Appareillé</th>  
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Perte Auditive</th>  
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Déni</th>  
                <th style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Souhaite un appareillage</th>  
                <th style='border: 1px solid #E2E2E2;'>Remarque</th>  
                <th style='border-left: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>Opticien en charge</th>  
                <th></th>
            </tr>
        </thead>
        <tbody>";
        echo '<form action = "index.php?page=optical-table#titre-2" method = "post">
        <input type = "search" name = "motCle" class="barreRecherche" placeholder="Recherche..."  style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <input type = "submit" name = "rechercheRapide" value="Rechercher" class="btnRecherche">
        <button type = "cancel" name = "annuler"  style="background:none; margin-left: 10px; border: none; cursor:pointer;" class="btnAnnule"><img src="./Public/Medias/Deleteicon.png" style="width:25px; height:auto;"></button>
        </form>';
        if (isset($_POST["rechercheRapide"])) {
            $terme = htmlspecialchars($_POST["motCle"]); //pour sécuriser le formulaire contre les failles html
            $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
            if ($terme != '') {
                $terme = strtolower($terme);
                $stmt = $pdoP->prepare("SELECT id_client, nom_client, prenom_client, appareil_client, perte_auditive_client, deni_client, souhait_client, remarque_client, opticien_test_client, DATE_FORMAT(date_test_client, '%d/%m/%Y') FROM client WHERE nom_client LIKE ? OR opticien_test_client LIKE ? ORDER BY opticien_test_client ");
                $stmt->execute(array("%" . $terme . "%", "%" . $terme . "%"));
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $message = "Vous devez entrer un mot clé dans la barre de recherche";
            }
        }
        foreach ($data as $datavalue) {
            echo "<tr>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['nom_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['prenom_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['DATE_FORMAT(date_test_client, \'%d/%m/%Y\')'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['appareil_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['perte_auditive_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['deni_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['souhait_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2;'>" . $datavalue['remarque_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>" . $datavalue['opticien_test_client'] . "</td>";
            echo "<td style='border: 1px solid #E2E2E2; text-align: center; vertical-align: middle;'>
            <form method='POST' action='index.php?page=optical-table#titre-2'>
            <button type='submit' name='delete' style='background:none; border:none; cursor:pointer;' value='" . $datavalue['id_client'] . "'>
            <img src='./public/Medias/supprimer.png' style='width:30px; height:30px;'>
            </button>
            </form>                 
            </td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    }
    public static function deleteClient($pdoP, $values)
    {
        // Cette fonction me sert à supprimer les données de mon tableau

        try {
            $req = $pdoP->prepare('DELETE FROM client WHERE id_client=?');
            $req->execute([$values['delete']]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}