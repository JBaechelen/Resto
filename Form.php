<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Verification</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

<?php

require 'Process.php';
$base = new Mytable('guide_duchemin', 'liste_users', 'root', '');

if (isset($_GET['hide'])) {
    $return = $base->Create_User($_GET['nom'], $_GET['email'], password_hash($_GET['mdp'], PASSWORD_DEFAULT));
    if ($return == "Ce nom d'utilisateur existe déjà.") {
        header("Location: http://localhost/Resto/Creation.php?nom=".$_GET['nom']."&error=".utf8_encode($return));
        exit();
    }
    elseif ($return == "Cet email est déjà utilisé.")
    {
        header("Location: http://localhost/Resto/Creation.php?nom=".$_GET['nom']."&error=".utf8_encode($return));
        exit();
    }
    else
    {
        header("Location: http://localhost/Resto/Utilisateur.php?id=".$return);
        exit();
    }
}
elseif (isset($_GET['mdp']))
{
    $retour = $base->VerifyUser($_GET['user'], $_GET['mdp']);
    if ($retour) {
        header("Location: http://localhost/Resto/Identification.php?verif=".$return."&user=".$_GET['user']);
        exit();
    }
    else
    {
        header("Location: http://localhost/Resto/Identification.php?user=".$_GET['user']."&error=".$retour);
        exit();
    }
}
else 
{
    header("Location: http://localhost/Resto/Bases.php");
    exit();
}

?>
</body>

<footer>
moi&copy2019
</footer>