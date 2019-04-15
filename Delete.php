<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete</title>
<link rel="stylesheet" href="style.css">
</head>

<?php

require 'Process.php';
$base = new Mytable('guide_duchemin', 'liste_restos', 'root', '');
$base->Delete($_GET['id']);
echo "Supression effectué.";
sleep(3);
header("Location: http://localhost/Resto/Bases.php");
exit();

?>