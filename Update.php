<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php

    $id = $_GET['id'];
    include 'Process.php';
    $base = new Mytable('guide_duchemin', 'liste_restos', 'root', '');
    echo "<p>Saisissez les nouvelles valeurs :</p>";
    echo '<form action="Bases.php" methode="post" enctype="multipart/form-data">';
    $donnees = array();
    $donnees = $base->GetInfo($id);
    echo '<input type="hidden" name="hide" value="'.$id.'" />';
    echo '<label class="label">Nom :</label><input type="text" name="nom" class="box" value="'.$donnees[1].'">';
    echo "<p></p>";
    echo '<label class="label">Adresse :</label><input type="text" name="adresse" class="box" value="'.$donnees[2].'">';
    echo "<p></p>";
    echo '<label class="label">Prix en euro :</label><input type="text" name="prix" class="box" value="'.$donnees[3].'">';
    echo "<p></p>";
    echo '<label class="label">Commentaire :</label><textarea class="area" name="commentaire">'.$donnees[4].'</textarea>';
    echo "<p></p>";
    echo '<label class="label">Note :</label><input type="number" name="note" class="box" value="'.$donnees[5].'">';
    echo "<p></p>";
    echo '<label class="label">Visite :</label><input type="date" name="date" class="box" value="'.$donnees[6].'">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
?>

</body>