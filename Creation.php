<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creation</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php

if (isset($_GET['nom'])) {
    echo '<p>'.$_GET['error'].'</p>';
    echo '<form action="Form.php" methode="post" enctype="multipart/form-data">';
    echo '<input type="hidden" name="hide" value="0" />';
    echo '<label class="label">Username :</label><input type="text" name="nom" class="box" value="'.$_GET['nom'].'">';
    echo "<p></p>";
    echo '<label class="label">Mot de passe :</label><input type="password" name="mdp" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Email :</label><input type="email" name="email" class="box" value="">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
}
else 
{
    echo '<form action="Form.php" methode="post" enctype="multipart/form-data">';
    echo '<input type="hidden" name="hide" value="0" />';
    echo '<label class="label">Username :</label><input type="text" name="nom" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Mot de passe :</label><input type="password" name="mdp" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Email :</label><input type="email" name="email" class="box" value="">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
}

?>

</body>

<footer>
JonathanBaechelen&copy2019
</footer>