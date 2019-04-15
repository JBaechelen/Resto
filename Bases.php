<?php 
session_start();
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css">
<title>Resto</title>
</head>

<body>

<?php 

include 'Process.php';

echo '<header class="header">';
//echo '<a href="Form.php?mdp=aaa"><button class="boutton">Test</button></a>';
echo '<a class="bout" href="ImageAjout.php"><button>Ajouter une image</button></a>';
echo '<a href="Ajout.php"><button>Ajouter</button></a><br />';
if (isset($_SESSION['user'])) {
    echo '<a href="Identification.php"><button>Deconnection</button></a>';
    $baseUser = new Mytable('guide_duchemin', 'liste_users', 'root', '');
    $userId = $baseUser->GetUserId($_SESSION['user']);
    echo '<a class="bout" href="Utilisateur.php?id='.$userId.'"><button>Votre compte</button></a>';
}
else 
{
    echo '<a class="bout" href="Creation.php"><button>Creer un compte</button></a>';
    echo '<a href="Identification.php"><button>Identification</button></a>';
}
echo '</header>';

$base = new Mytable('guide_duchemin', 'liste_restos', 'root', '');

if (isset($_GET['hide'])) {
    if ($_GET['hide'] != 0) {
        $id = htmlentities($_GET['hide'], ENT_QUOTES, "UTF-8");
        $nom = htmlentities($_GET['nom'], ENT_QUOTES, "UTF-8");
        $adr = htmlentities($_GET['adresse'], ENT_QUOTES, "UTF-8");
        $prix = htmlentities($_GET['prix'], ENT_QUOTES, "UTF-8");
        $com = htmlentities($_GET['commentaire'], ENT_QUOTES, "UTF-8");
        $note = htmlentities($_GET['note'], ENT_QUOTES, "UTF-8");
        $date = htmlentities($_GET['date'], ENT_QUOTES, "UTF-8");
        echo ($base->Modification($id, $nom, $adr, $prix, $com, $note, $date));
        header("Location: http://localhost/Resto/Bases.php");
        exit();
    }
    else
    {
        $nom = $_GET['nom'];
        $adr = $_GET['adresse'];
        $prix = $_GET['prix'];
        $com = $_GET['commentaire'];
        $note = $_GET['note'];
        $date = $_GET['date'];
        echo ($base->Ajout($nom, $adr, $prix, $com, $note, $date));
        header("Location: http://localhost/Resto/Bases.php");
        exit();
    }
}
else {    
    $base->Rendre_HTML();
}

?>

</body>

<footer>
JonathanBaechelen&copy2019
</footer>