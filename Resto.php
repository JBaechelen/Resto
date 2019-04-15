<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resto</title>
</head>

<body>
<?php
try
{
	$dsn = 'mysql:host:localhost;dbname=guide_duchemin';
	$bdd = new PDO($dsn, 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$reponse = $bdd->query('SELECT * FROM guide_duchemin.liste_restos');
}
catch(Exception $e)
{
	echo "Échec : " . $e->getMessage();
}
?>

<table>
	<tr>
    	<th>Id</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Prix</th>
        <th>Commentaire</th>
        <th>Note</th>
        <th>Date</th>
    </tr>
    <?php
	while($donnees = $reponse->fetch())
	{
		?>
        <tr>
        	<td><?php echo $donnees['id'];?></td>
            <td><?php echo $donnees['nom'];?></td>
            <td><?php echo $donnees['adresse'];?></td>
            <td><?php echo $donnees['prix'];?></td>
            <td><?php echo $donnees['commentaire'];?></td>
            <td><?php echo $donnees['note'];?></td>
            <td><?php echo $donnees['visite'];?></td>
        </tr>
        <?php
	}
	?>
    
</table>

</body>

</html>