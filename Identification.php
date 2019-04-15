<?php 
session_start();
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Utilisateur</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<p>Veuillez vous identifier :</p>

<?php

if (isset($_GET['verif'])) {    
    
    $_SESSION['user'] = $_GET['user'];
    require 'Process.php';
    $base = new Mytable('guide_duchemin', 'liste_users', 'root', '');
    $_SESSION['id'] = $base->GetUserId($_SESSION['user']);
    
    header("Location: http://localhost/Resto/Bases.php");
    exit();
}
elseif (isset($_SESSION['user']))
{
    session_destroy();
    header("Location: http://localhost/Resto/Bases.php");
    exit();
}
elseif (isset($_GET['user']))
{
    echo '<form action="Form.php" methode="post" enctype="multipart/form-data">';
    echo '<label class="label">Username :</label><input type="text" name="user" class="box" value="'.$_GET['user'].'">';
    echo "<p></p>";
    echo '<label class="label">Mot de passe :</label><input type="password" name="mdp" class="box" value="">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<p>Pas encore membre?</p>';
    echo '<a href="Creation.php"><button>Creer un compte</button></a><br />';
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
}
else
{
    echo '<form action="Form.php" methode="post" enctype="multipart/form-data">';
    echo '<label class="label">Username :</label><input type="text" name="user" class="box" value="">';
    echo "<p></p>";
    echo '<label class="label">Mot de passe :</label><input type="password" name="mdp" class="box" value="">';
    echo "<p></p>";
    echo '<input type="submit" value="Envoyer" />';
    echo "</form>";
    echo '<p>Pas encore membre?</p>';
    echo '<a href="Creation.php"><button>Creer un compte</button></a><br />';
    echo '<a href="Bases.php"><button class="boutton">Retour</button></a>';
}

?>

</body>

<footer>
JonathanBaechelen&copy2019
</footer>