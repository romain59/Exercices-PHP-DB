<?php
/**
 * Created by PhpStorm.
 * User: sstienface
 * Date: 04/12/2018
 * Time: 11:25
 */

// Premiere ligne

$servername = "localhost";
$username = "id7331152_romainbon";
$password = "Denise230134";
$dbname = "id7331152_test";

$conn = new mysqli($servername, $username, $password);

if ($conn -> connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        $conn->select_db($dbname);
    }

?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>index</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>

    <div class="container   ">

        <h1>Fiche de Renseignement Eleves : </h1><br>

        <form action="index.php" method="post">

            <p>Ajouter un Eleves : </p>

            <label for="prenom">Prénom : </label><input name="prenom" type="text">
            <label for="nom">Nom : </label><input name="nom" type="text">
            <label for="age">Age : </label><input name="age" type="text">
            <input name="valider" type="submit">
        </form>

        <br><br><br><hr><br><br>

        <form action="index.php" method="get">

            <p>Supprimer un Eleves : </p>

            <label for="IdEleves">ID Eleves : </label><input name="id" type="number">
            <input name="Valider" type="submit">
        </form>

        <br><br><hr><br><br>

        <form action="index.php" method="get">
            <input type="submit" name="afficher" value="Afficher la liste !">
        </form>

        <br><br><hr><br><br>

        <form action="index.php" method="post">

            <p>Modifier un Eleves : </p>

            <label for="Id">Id : </label><input name="Id" type="text">
            <label for="prenom">Prénom : </label><input name="Prenom" type="text">
            <label for="nom">Nom : </label><input name="Nom" type="text">
            <label for="age">Age : </label><input name="Age" type="text">
            <input name="VALIDER" type="submit">
        </form>

        <br><br><br><hr><br><br>

        <form action="index.php" method="post">

            <p>Ajouter un Mugs : </p>

            <label for="Description">Description Du Mugs : </label><input name="Description" type="text">
            <input name="submit" type="submit">
        </form>

        <br><br><hr><br><br>

        <form action="index.php" method="post">

            <p>Modifier un Mugs : </p>

            <label for="Ident">Id : </label><input name="Ident" type="text">
            <label for="Descript">Description : </label><input name="Descript" type="text">
            <input name="ok" type="submit">
        </form>

        <br><br><br><hr><br><br>

        <form action="index.php" method="post">

            <p>Associer un Eleves et un Mugs : </p>

            <label for="IDeleves">Identifiants Eleves : </label><input name="IDeleves" type="text">
            <label for="IDmugs">Identifiants Mugs : </label><input name="IDmugs" type="text">
            <input name="SUBMIT" type="SUBMIT">
        </form>

        <br><br><hr><br><br>

        <form action="index.php" method="get">
            <label for="iidd">Identifiants Eleves : </label><input name="iidd" type="text">
            <input type="submit" name="OK">
        </form>

        <br><br><hr><br><br>

    </div>


    </body>
    </html>



<?php

function formulaireeleves () {

    global $conn;

    if (isset($_POST['prenom']) != '' && $_POST['nom'] != '' && $_POST['age'] !='' && isset($_POST["valider"]) ) {


            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $age = $_POST['age'];

            $sql = "INSERT INTO eleves VALUES (NULL, '$prenom', '$nom', '$age')";

            $conn->query($sql);

    }

}

formulaireeleves();


function afficherEleves () {
    global $conn;

    $reponse = "SELECT id,prenom,nom,age from eleves";
    $result = $conn -> query($reponse);

    while ( $donnees = $result -> fetch_assoc()) {

        echo "id : ".$donnees['id']." prenom : ".$donnees['prenom']." nom : ".$donnees['nom']." age : ".$donnees['age']."<br>";

    }
}

if (!empty($_GET['afficher'])){
    afficherEleves();
}


function deleteEleves (){

    global $conn;

    if (isset($_POST['id']) != '' && isset($_POST["valider"])) {

            $IdEleves = $_POST['id'];

            $sql = "DELETE from eleves WHERE id =$IdEleves";

            $conn -> query($sql);

    }

}

deleteEleves();

function MisaJourEleves() {

    global $conn;

    if (isset($_POST['Id']) != '' && $_POST['Prenom'] != '' && $_POST['Nom'] !='' && $_POST['Age'] !='' && isset($_POST["VALIDER"]) ) {

        $id = $_POST['Id'];
        $prenom = $_POST['Prenom'];
        $nom = $_POST['Nom'];
        $age = $_POST['Age'];

        $sql = "UPDATE eleves SET id= '$id', prenom = '$prenom',nom = '$nom',age = '$age' WHERE id='$id' ";

        $conn -> query($sql);

    }

}

MisaJourEleves();

function DescriptionMugs () {

    global $conn;

    if (isset($_POST['Description']) != ''  && isset($_POST["submit"]) ) {


        $Description= $_POST['Description'];


        $sql = "INSERT INTO mugs VALUES ('','$Description')";

        $conn->query($sql);

    }

}

DescriptionMugs();

function association (){

    global $conn;

    if (isset($_POST['IDeleves']) != '' && $_POST['IDmugs'] !='' && isset($_POST["SUBMIT"]) ) {


        $IdEleves= $_POST['IDeleves'];
        $IdMugs= $_POST['IDmugs'];



        $sql = "INSERT INTO eleves_mugs VALUES ('','$IdEleves','$IdMugs')";

        $conn->query($sql);

    }

}

association();

function MisaJourMugs() {

    global $conn;

    if (isset($_POST['Ident']) != '' && $_POST['Descript'] != '' && isset($_POST["ok"]) ) {

        $id = $_POST['Ident'];
        $description = $_POST['Descript'];


        $sql = "UPDATE mugs SET id= '$id', description = '$description' WHERE id='$id' ";

        $conn -> query($sql);

    }

}

MisaJourMugs();

function afficherElevesetMugs ($IDELEVES) {

    global $conn;

    if (isset($IDELEVES)){

        $reponse = "SELECT mugs.description FROM eleves_mugs,mugs WHERE eleves_mugs.id_eleves = 76 AND eleves_mugs.id_mugs = mugs.id";
        $result = $conn -> query($reponse);


        $Reponse = "SELECT * from eleves WHERE id =$IDELEVES";
        $Result = $conn -> query($Reponse);

        while ( $Donnees = $Result -> fetch_assoc()) {

            echo " Je m'apelle  ".$Donnees['prenom'].' '.$Donnees['nom']." j'ai ".$Donnees['age'].' est jai un mugs  ';

        }

        while ( $donnee = $result -> fetch_assoc()) {

            echo $donnee['description']."<br>";

        }

    }



}

afficherElevesetMugs($_GET['iidd']);

//if (!empty($_POST['Afficher'])){
    //afficherElevesetMugs();
//}

