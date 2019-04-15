<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php

    echo "<p>Remplissez le formulaire :</p>";
    echo '<form action="Bases.php" methode="post" enctype="multipart/form-data">';
    echo '<input type="hidden" name="hide" value="0" />';
    echo '<label class="label">Nom :</label><input type="text" name="nom" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Adresse :</label><input type="text" name="adresse" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Prix en euro :</label><input type="text" name="prix" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Commentaire :</label><textarea class="area" name="commentaire"></textarea>';
    echo "<p></p>";
    echo '<label class="label">Note :</label><input type="number" name="note" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Visite :</label><input type="date" name="date" class="box" value="">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
    
?>

</body>
<footer>
jonathanBaechelen&copy2019
</footer>