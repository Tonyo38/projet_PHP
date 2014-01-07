		<?php
				$url = $data->img->getURL();
				$id = $data->imgID;
				$size = $data->size;
				$commentaire=$data->commentaire;
				$cathegorie =$data->cathegorie;
		?>
		<div id="corps">
			<form action="index.php">
				<select name="cathegorie" id="cathegorie">
					<option value="All">Toutes</option>
					<?php
						#On récupère la liste des cathégorie et on les met dans la listbox
						for($i=0;$i<count($data->listCathegorie);$i++){
							if($data->listCathegorie[$i]==$cathegorie) print "<option value=\"".$data->listCathegorie[$i]."\" selected>".$data->listCathegorie[$i]."</option>\n";
							print "<option value=\"".$data->listCathegorie[$i]."\">".$data->listCathegorie[$i]."</option>\n";
						}
					?>
				</select> 
				<input type="submit" name="filtrer" value="Filtrer"/>
				<input type="submit" name="edit" value="Editer"/>
				<input type="hidden" name="action" value="solo">
				<input type="hidden" name="controller" value="Photo">
				<input type="hidden" name="imgID" value=<?php echo $id?>>
				<input type="hidden" name="size" value=<?php echo $size?>>
			</form>
			<?php 
				# Mise en place des deux boutons
				print "<p>\n";
				print "<a href=\"index.php?controller=Photo&action=prev&imgID=$id&size=$size\">Prev</a> ";
				print "<a href=\"index.php?controller=Photo&action=next&imgID=$id&size=$size\">Next</a>\n";
				print "<p>Cathégorie : $cathegorie</p>";
				print "<p>\n";
				// Réalise l'affichage de l'image
				print "<a href=\"index.php?controller=Photo&action=zoomPlus&imgID=$id&size=$size\">\n";
				print "<img src=\"$url\" width=\"$size%\" height=\"$size%\">\n";
				print "</a>\n";
				print "</p>\n";
				print "<p>Commentaire : $commentaire</p>";
				?>		
			</div>