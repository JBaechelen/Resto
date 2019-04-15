<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Utilisateur</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php
require 'Process.php';
$base = new Mytable('guide_duchemin', 'liste_users', 'root', '');
if (isset($_GET['id'])) {
    $donnees = array();
    $donnees = $base->GetInfo($_GET['id']);
    echo '<label class="label">Nom :</label><input readonly type="text" name="nom" class="box" value="'.$donnees[1].'">';
    echo "<p></p>";
    echo '<label class="label">Adresse :</label><input readonly type="text" name="adresse" class="box" value="'.$donnees[2].'">';
    echo "<p></p>";
    echo '<label class="label">Email :</label><input readonly type="email" name="email" class="box" value="'.$donnees[4].'">';
    echo "<p></p>";
    echo '<label class="label">Username :</label><input readonly type="text" name="user" class="box" value="'.$donnees[5].'">';
    echo "<p></p>";
    echo '<label class="label">Mot de passe :</label><input readonly type="password" name="mdp" class="box" value="'.$donnees[6].'">';
    echo "<p></p>";
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
}
?>

</body>