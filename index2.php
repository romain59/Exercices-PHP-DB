<?php
/**
 * Created by PhpStorm.
 * User: romainbon
 * Date: 2019-01-07
 * Time: 15:33
 */

function ajouter ($prenom,$nom,$age){

    global $conn;

    $sql = "INSERT INTO eleves VALUES (\"\", \" $prenom \", \"$nom \", \"$age \")";

    $conn->query($sql);


}

//ajouter("bryan","bultot","25");


function toutleseleves(){

    global $conn;

    $reponse = "SELECT id,prenom,nom,age from eleves";
    $result = $conn -> query($reponse);

    while ( $donnees = $result -> fetch_assoc()) {

        echo "id=".$donnees['id']." prenom=".$donnees['prenom']." nom=".$donnees['nom']." age=".$donnees['age']."<br>";

    }
}


toutleseleves();

function misajour ($id,$prenom,$nom,$age){


    global $conn;
    $sql = "UPDATE eleves SET id= '$id', prenom = '$prenom',nom = '$nom',age = '$age' WHERE id= 16 ";


    $conn -> query($sql);


}

//misajour(1,'Brian','Flament','36');

function delete ($id) {

    global $conn;

    $sql = "DELETE from eleves WHERE id =$id";

    $conn -> query($sql);

}

//delete(19);

