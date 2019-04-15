<?php
session_start();
require("includes/header.php");
include("includes/logo.php");
include("includes/menu.php");
include("includes/pitch.php");
include("includes/connect.php");
//include("models/guide.php");
?>

<div id="main">
				
		<h2 class="wrap" style="font-family:Geneva, sans-serif;color:#3D1F1F;text-shadow: 1px 2px 3px rgba(0,0,0, 0.5);">Gérer les Locations</h2>	
        <?php
		echo'<div><div class="conteneur2">';
		$message="";
if(isset($_FILES['image']) && $_POST['creer'])
{
	$img = new MYTABLE('IMMO_IMAGES');
	$conn = $img->getConnection();
	$rq= "SELECT MAX(ID_IMG) FROM IMMO_IMAGES";
	$res = $conn->query($rq);
	$tab = $res->fetch();
	$nbmax = $tab[0]+1;
	$destination_img = "";
	
	$name = $_FILES['image']['name'];
	$type = $_FILES['image']['type'];
	$img_path = "photos/img";
	$tabsplitimg = explode('/',$type);
	$type_ext = $tabsplitimg[1];
	$tab_ref = array('gif','jpeg', 'jpg', 'JPG', 'png');
	if(in_array($type_ext, $tab_ref))
	{
		$name_ext = strrchr($name,'.');
		$destination_img.=$img_path.$nbmax.$name_ext;
		$origin = $_FILES['image']['tmp_name'];
		if(move_uploaded_file($origin, $destination_img))
		{
			/*$message.= '<img src="'.$destination_img.'" alt="verif_img" width="300">';*/
			 $vignette = 'vignette/img_small'.$nbmax.$name_ext;
			 $tabDim = getimagesize($destination_img);
			 $src_w = $tabDim[0];
			 $src_h = $tabDim[1];
			 /*$message.=$src_w.$src_h;*/
			 $dest_w = 400;
			 $dest_h = $dest_w*($src_h/$src_w);
			 $image = imagecreatetruecolor($dest_w, $dest_h);
			 switch($name_ext)
			 {
				 case '.jpg':
				 		$flux = imagecreatefromjpeg($destination_img);
						break;
				 case '.jpeg':
				 		$flux = imagecreatefromjpeg($destination_img);
						break;
				 case '.JPEG':
				 		$flux = imagecreatefromjpeg($destination_img);
						break;
				 case '.JPG':
				 		$flux = imagecreatefromjpeg($destination_img);
						break;
				 case '.png':
				 		$flux = imagecreatefrompng($destination_img);
						break;
				 case '.gif':
				 		$flux = imagecreatefromgif($destination_img);
						break;
			 }
			 if($src_w > $dest_w)
			 {
				 $vign = imagecopyresampled($image ,$flux , 0 , 0 , 0 , 0 , $dest_w ,$dest_h ,$src_w ,$src_h );
				 switch($name_ext)
				 {
					 case '.jpg':
				 		$res = imagejpeg($image,$vignette);
						break;
				   	 case '.jpeg':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.JPEG':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.JPG':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.png':
				 		$res = imagepng($image,$vignette);
						break;
				 	 case '.gif':
				 		$res = imagegif($image,$vignette);
						break;
				 }
				 if($res)
				 {
					 $message .= '<img src="'.$vignette.'" alt="verif_img">';
				 }
				 else
				 {
					 $message.= 'Echec de creation de vignette';
				 }
			 }
			 else
			 {				 
				$vign2 = imagecopyresized($image ,$flux , 0 , 0 , 0 , 0 , $dest_w , $dest_h , $src_w , $src_h );
				switch($name_ext)
				 {
					 case '.jpg':
				 		$res = imagejpeg($image,$vignette);
						break;
				   	 case '.jpeg':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.JPEG':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.JPG':
				 		$res = imagejpeg($image,$vignette);
						break;
				 	 case '.png':
				 		$res = imagepng($image,$vignette);
						break;
				 	 case '.gif':
				 		$res = imagegif($image,$vignette);
						break;
				 }
				 if($res)
				 {
					 $message .= '<img src="'.$vignette.'" alt="verif_img">';
				 }
				 else
				 {
					 $message.= 'Echec de creation de vignette';
				 }
			 }
			 $rq = "INSERT INTO  IMMO_IMAGES(TITRE_IMG,ALT_IMG,SRC_IMG,EXTENSION,SRC_VIGN) 
			 VALUES('".$name."','".$name."','".$destination_img."','".$name_ext."','".$vignette."')";
			 $res = $conn->query($rq);
			 if($res == FALSE)
			 {
				 $message.= 'Echec de la requete';
			 }
			 else
			 {
				 $message.= 'Ajout de l\' image réussi';
			 }
			 					
		}
		else
		{
			$message.= 'Echec du chargement';
		}
	}
	else
	{
		$message.='extension non autorisé';
	}
}
else
{
	$message = "formulaire non fonctionnel";
}
/*if(isset($_POST['creer']) && !empty($_POST['creer']))
{
	if(isset($_SESSION['ID']) && isset($_POST['proprietaire']) && isset($_POST['type_bien']) && isset($_POST['titre']) && isset($_POST['nb_pieces']) && isset($_POST['prix_loc']))
 	{			 
			 echo'<div style="height:100px;">coucouCnous</div>';
			 /*&& isset($_POST['description'])
		     && isset($_POST['ges'])
			 && isset($_POST['classeEco'])
			 && isset($_POST['meuble'])
			 && isset($_POST['localisation'])
			 && isset($_POST['cpville'])
			 && isset($_POST['departement'])
			 && isset($_POST['charge'])
			 && isset($_POST['montantcharges'])
			if(!empty($_POST['proprietaire'])
			&& !empty($_POST['type_bien'])
			&& !empty($_POST['titre'])
			&& !empty($_POST['nb_pieces'])
			&& !empty($_POST['prix_loc']))
			{
				
				$logement = new MYTABLE('IMMO_LOGEMENTS');
				if($logement->VerifCritere('TITRE', $_POST['titre'])==FALSE)
				{
					echo'je suis dans le true de verifcritere';
					if($logement->AJOUTER_LOGEMENT(
					0,
					$_SESSION['ID'], 
					$_POST['type_bien'], 
					$_POST['titre'], 
					$_POST['nb_pieces'], 
					$_POST['prix_loc'], 
					$_POST['description'], 
					$_POST['ges'], 
					$_POST['classeEco'], 
					$_POST['meuble'],
					$_POST['localisation'], 
					$_POST['cpville'], 
					$_POST['departement'], 
					$_POST['charge'], 
					$_POST['montantcharges']))
					{
						echo'Ajout effectué';
					}
					else{
						echo'<div style="height:60px;">Echec de l\'opération d\'ajout 		                              du logement !!!!</div>';}
					
				}
				else
				{
					echo'<div style="height:60px;">il y a déja un bien du même nom !                          </div>';
				}
			}
			else
			{
				echo'Remplir les champs recquis';
			}
		}
	}*/
             echo'<form action="ajouter.php" method="post"    enctype="multipart/form-data" name="formulaire" >
      <div class="row">
      <div class="col-25">
      <label for="proprietaire">Proprietaire :</label>
      </div>
      <div class="col-75">
      <input type="text" id="nom" name="proprietaire" required readonly value="'.$_SESSION['identifiant'].'">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="type_bien">Type de bien :</label>
      </div>
	        <div class="col-75" ><select required name="typeBien" id="typeBien" class="liste"  style="display:block" >';
			$logement = new MYTABLE('IMMO_LOGEMENTS');
			$Connect= $logement->getConnection();
			echo '<option value="indefini">Indéfini</option>';
			$rq = "SELECT id_cat, nom_cat FROM IMMO_CAT_BIENS";
			$State = $Connect->query($rq);
			while($ligne=$State->FETCH(PDO::FETCH_NUM))
			{
				if(isset( $_POST['typeBien']) && $_POST['typeBien']==$ligne[0])
				{
					echo'<option selected="selected" value="'.$ligne[0].'"/>'.$ligne[1].'</option>';
				}
				else	
				{
					echo'<option value="'.$ligne[0].'"/>'.$ligne[1].'</option>';
				}
			}
			echo'</select>';
			
			echo'</div></div>
	  
	  <!--<div class="row">
      <div class="col-25">
      <label for="titre">Titre :</label>
      </div>
      <div class="col-75">
      <input type="text" id="nom" required name="titre" placeholder="Titre...">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="nb_pieces">Nombre de pièces :</label>
      </div>
      <div class="col-75">
      <input type="number" required id="nb_pieces" name="nb_pieces" placeholder="">
      </div>
      </div>
      <div class="row">
      <div class="col-25">
      <label for="surface">Surface :</label>
      </div>
      <div class="col-75">
      <input type="number" required id="surface" name="surface" placeholder="en m²">
      </div>
      </div>
      <div class="row">
      <div class="col-25">
      <label for="prix_loc">Prix de la location :</label>
      </div>
      <div class="col-75">
      <input type="text" required id="prix_loc" name="prix_loc" placeholder="€">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="description">Description :</label>
      </div>
      <div class="col-75">
      <input type="text" id="description" name="description" placeholder="">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="ges">GES :</label>
      </div>
      <div class="col-75" ><select name="GES" id="GES" class="liste"  	          
	  style="display:block" >
	  <option Value="0"/>Définir GES</option>
	  <option value="A"/>A</option>
	  <option value="B"/>B</option>
	  <option value="C"/>C</option>
	  <option value="D"/>D</option>
	  <option value="E"/>E</option>
	  <option value="F"/>F</option>
	  </select>
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="classeEco">Classe ECO :</label>
      </div>
      <div class="col-75" ><select name="classeEco" id="classeEco" class="liste"  	          
	  style="display:block" >
	  <option Value="0"/>Définir classe eco</option>
	  <option value="A"/>A</option>
	  <option value="B"/>B</option>
	  <option value="C"/>C</option>
	  <option value="D"/>D</option>
	  <option value="E"/>E</option>
	  <option value="F"/>F</option>
	  </select>
      </div>
      </div>
	  
	  <div class="row">
      <div class="col-25">
      <label for="meuble">Meublé :</label>
      </div>
      <div class="col-75" ><select name="meuble" id="meuble" class="liste" 
	  style="display:block" >
	  <option Value="0"/>Non-Meublé</option>
	  <option Value="1"/>Meublé</option>
	  </select>
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="localisation">Localisation :</label>
      </div>
      <div class="col-75">
      <input type="text" id="localisation" name="localisation" placeholder="">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="cpville">CP Ville :</label>
      </div>
      <div class="col-75">
      <input type="number" id="cpville" name="cpville" placeholder="Code Postale">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="departement">Departement :</label>
      </div>
      <div class="col-75">
      <input type="text" id="departement" name="departement" placeholder="">
      </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="charge">Charges incluses :</label>
      </div>
       <div class="col-75" ><select name="charge" id="charge" class="liste" 
	  style="display:block" >
	  <option Value="0"/>Charges non-incluses</option>
	  <option Value="1"/>Charges incluses</option>
	  </select>
	  </div>
      </div>
	  <div class="row">
      <div class="col-25">
      <label for="montantcharges">Montant charges :</label>
      </div>
      <div class="col-75">
      <input type="text" id="montantcharges" name="montantcharges" placeholder="€">
      </div>
      </div>-->
	  <div class="row">
      <div class="col-25">
      <label for="image">Uploader une ou des images :</label>
      </div>
      <div class="col-75">
      <input type="file" class="form-control" id="image" name="image">
      </div>
      </div>
	  <!--<div class="row">
      <div class="col-25">
      <label for="docs">Uploader une documentation :</label>
      </div>
      <div class="col-75">
      <input type="file" id="docs" name="docs" multiple placeholder="">
      </div>
      </div>-->
	  <input type="submit" value="Valider" name="creer">
	  </form>
	  ';
		
			echo '<h1>test</h1>'.$message;
			echo'</div>';
		?>
			</div>
            </div>
            </div>
         
<?php
include("includes/actu.php");
require("includes/footer.php");

?>
		