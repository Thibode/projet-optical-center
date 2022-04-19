<?php

include('./models/function-page.php');
include("./utils/db.php");

if (isset($_POST['ajout-client'])) {
    if (potentielClient::ajoutClient($_POST, $pdo)) {
    }
}
if (isset($_POST['delete'])) {
    if (potentielClient::deleteClient($pdo, $_POST)) {
    }
}


?>
<div class="bg-main">
    <h2 id="titre-1">Ajout de client audio</h2>

    <div class="formulaire">
        <form action="index.php?page=optical-table" method="POST">
            <div class="info-client">
                <h3>Informations Client :</h3>
                <label for="name"></label>
                <input class="info" type="text" id="nomClient" name="nomClient" placeholder="Nom" />
                <label for="firstname"></label>
                <input class="info" type="text" id="prenomClient" name="prenomClient" placeholder="Prénom" />

            </div>
            <div class="info-audio">
                <h3>Informations Audio :</h3>
                <div class="group-1">
                    <label for="test" style="text-decoration:underline;">Test auditif fait le :</label>
                    <input class="info" type="date" id="date-test" name="date-test" />
                    <select name="opticien" id="opticien">
                        <option value="">--Réalisé par--</option>
                        <option value="Anne-Sophie TOURNE">Anne-Sophie TOURNE</option>
                        <option value="Chloé COUTANT">Chloé COUTANT</option>
                        <option value="Fabiola ESTRADA">Fabiola ESTRADA</option>
                        <option value="Guillaume DUTHILLY">Guillaume DUTHILLY</option>
                        <option value="Jean-Françis GUÉRIN">Jean-Françis GUÉRIN</option>
                        <option value="Marion CHARRIER">Marion CHARRIER</option>
                        <option value="Mathieu BODIN">Mathieu BODIN</option>
                        <option value="Océane GOSSET">Océane GOSSET</option>
                        <option value="Sixtine LANÇON">Sixtine LANÇON</option>
                    </select>
                </div>
                <br>
                <div class="group-2">
                    <select name="appareil" id="appareil">
                        <option value="">--Appareillé--</option>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </select>
                    <select name="perte-auditive" id="perte-auditive">
                        <option value="">--Perte auditive--</option>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                        <option value="PRESBYACOUSIE">PRESBYACOUSIE</option>
                    </select>
                    <select name="deni" id="deni">
                        <option value="">--Déni--</option>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </select>
                </div>
                <div class="group-3">
                    <label for="souhait" style="text-decoration:underline;">Souhaite se faire appareillé :</label>
                    <select name="souhait" id="souhait">
                        <option value=""></option>
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </select><br>
                    <label for="remarque" style="text-decoration:underline;">Remarque :</label>
                    <textarea name="remarque" id="remarque" cols="60" rows="4"></textarea>
                </div>
                <input class="bouton" type="submit" name="ajout-client" value="Ajout client" />
            </div>
        </form>
    </div>

    <h2 id="titre-2">Tableau récapitulatif</h2>

    <div class="tableau">
        <?php
        if (potentielClient::tableauClient($pdo)) {
        }

        ?>

        <a href="index.php?page=optical-table" id="btn-retour">
            <img src="./Public/Medias/flechehaut.png" alt="fleche retour" id="fleche">
        </a>

    </div>
</div>