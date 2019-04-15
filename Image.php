<!--Partie centrale-->
<?php include("header.php");  
include("guide.php");
?>
<div id="page-wrapper" class="container">
 
     <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <?php
					 
					 	$extension=array(0=>'jpeg',1=>'png',2=>'gif',3=>'jpg',4=>'JPG');
						$pass='../photos/photo';
						$test_nom ="/[\w]+/";
						define ('SITE_ROOT', realpath(dirname(__FILE__)));
					
						$table=new mytable('','','','','IMAGES');
						$table->Info_table($nom);
						
						if(isset($_POST['Ajouter'])!=null && preg_match($test_nom,$_POST['TITRE_IMG'])==1)
						{
							if(isset($_FILES['image'])!=null)
							{
								$type = $_FILES['image']['type'];
								$substr = explode('/',$type);
			
								if(in_array($substr[1],$extension))
								{
									$photoNouveau = $_FILES['image']['name'];
									$extent = strrchr($photoNouveau,'.');
									$resultat=$table->Recup_Max_ID();
									$tab=$resultat->fetch(PDO::FETCH_ASSOC);
									if($tab['MAX('.$nom.')']==null)
									{
										$tab['MAX('.$nom.')']=0; 
										
									}
									$num = $tab['MAX('.$nom.')'] + 1 ;
									$photoName = $pass.strtolower($num).$extent;
									$vignette = '../vignettes/photo_small'.$num.$extent;
									$photoLast = $_FILES['image']['tmp_name'];
									$largeur_vignette=300;
									
									if(move_uploaded_file($photoLast,$photoName))
									{
					
										echo '<img src="'.$photoName.'" alt="" width="200"></img>';
										$tableaudim = getimagesize($photoName);
										$src_w = $tableaudim[0];
										$src_h = $tableaudim[1];
										$dest_img = $vignette;
										$hauteur=$largeur_vignette*($src_h/$src_w);
										$dst_img = imagecreatetruecolor($largeur_vignette,$hauteur);
					
										switch($substr[1])
										{
											case "jpeg":
												$flux_img = imagecreatefromjpeg($photoName);
											break;
											case "gif":
												$flux_img = imagecreatefromgif($photoName);
											break;
											case "png":
												$flux_img = imagecreatefrompng($photoName);
											break;
											default:
											echo "Type de fichier image non autorisée";
											break;
										}
										if($src_w > $largeur_vignette)
										{
																	
											imagecopyresampled($dst_img, $flux_img, 0, 0, 0, 0, $largeur_vignette, $hauteur, $src_w, $src_h);
										}
										else
										{
											imagecopyresized($dst_img, $flux_img, 0, 0, 0, 0, $largeur_vignette, $hauteur, $src_w, $src_h);
										}											
										if(imagejpeg($dst_img,$dest_img))
										{
						
											echo '<br/><p>La vignette a bien été créée</p>';
											echo '<br/><img src="'.$vignette.'"/><br/>';
										}
										
										$chemin=substr($photoName,3);
										//echo $chemin;
										$chemin_vign=substr($vignette,3);
										
										$req='INSERT INTO IMAGES VALUES (ID_IMG,"'.$_POST['TITRE_IMG'].'","'.$_POST['ALT_IMG'].'","'.$chemin.'","'.$chemin_vign.'")';
										$table->Insertion($req);
									}
								}
							}
						}
						else
						{
							echo '<h2>Importer des images �  associer aux fiches pedagogiques</h2>';
							
							echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post" name="form1" enctype="multipart/form-data">';
							
							echo '<label for="titre_img">Titre Image</label></br>';
							echo '<input type="text" value="" name="TITRE_IMG" required="required"></input></br>';
							
							echo '<label for="alt_img" style="alignment-baseline:top">ALT_IMG</label></br>';
							echo '<input  type="text" name="ALT_IMG" value="" required="required"></input></br></br>';
							
							echo '<input type="file" name="image" id="image" required="required" ></input></br>';
							
							echo '<button type="submit" name="Ajouter" id="Ajouter">Ajouter</button>';
							echo '</form>';
						}
					?>
                    
            	</div>        
			</div>
		</div>
	</div>
</div>

<?php include("footer.php");  ?>