		<?php
				$url = $data->img->getURL();
				$id = $data->imgID;
				$size = $data->size;
				$commentaire=$data->commentaire;
				$cathegorie =$data->cathegorie;
		?>
		<div id="corps">
			<form action="index.php">

				<input type="hidden" name="action" value="modif">
				<input type="hidden" name="controller" value="Photo">
				<input type="hidden" name="size" value=<?php echo $size?>>
				<input type="hidden" name="imgID" value=<?php echo $id?>>
				<label from="category">Cathégorie : 
					<select name="cathegorie" id="cathegorie">
						<?php
							#On récupère la liste des cathégorie et on les met dans la listbox
							for($i=0;$i<count($data->listCathegorie);$i++){
								if($data->listCathegorie[$i]==$cathegorie) print "<option value=\"".$data->listCathegorie[$i]."\" selected>".$data->listCathegorie[$i]."</option>\n";
								print "<option value=\"".$data->listCathegorie[$i]."\">".$data->listCathegorie[$i]."</option>\n";
							}
						?>
					</select> 
				</label>
				<label from="newcathegorie">
					Nouvelle cathégorie :
					<input type="text" name="newcathegorie">
				</label>

			
			<?php 
				# Mise en place des deux boutons
				print "<p>\n";
				print "<a href=\"index.php?controller=Photo&action=prev&imgID=$id&size=$size&edit=edit\">Prev</a> ";
				print "<a href=\"index.php?controller=Photo&action=next&imgID=$id&size=$size&edit=edit\">Next</a>\n";
				print "<p>\n";
				// Réalise l'affichage de l'image
				print "<a href=\"index.php?controller=Photo&action=zoomPlus&imgID=$id&size=$size&edit=edit\">\n";
				print "<img src=\"$url\" width=\"$size%\" height=\"$size%\">\n";
				print "</a>\n";
				print "</p>\n";
				?>	

				<label from="category">Commentaire : 
					<input type="text" name="commentaire" value=<?php echo $commentaire?>>
				</label>
				<input type="submit" name="valider" value="valider"/>
				<input type="submit" name="retour" value="retour"/>

				</form>	
			</div>