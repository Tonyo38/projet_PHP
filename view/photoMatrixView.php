<div id="corps">
	<?php # mise en place de la vue partielle : le contenu central de la page  
		$ID = $data->imgID;
		$SIZE = $data->size;
		$NB=$data->nb;
		# Mise en place des deux boutons
		print "<p>\n";
		print "<a href=\"index.php?controller=PhotoMatrix&action=prev&imgID=$ID&size=$SIZE&nb=$NB\">Prev</a> ";
		print "<a href=\"index.php?controller=PhotoMatrix&action=next&imgID=$ID&size=$SIZE&nb=$NB\">Next</a>\n";
		print "<p>\n";

		// Réalise l'affichage des images
		foreach ($data->imgMatrixURL as $i) {
			print "<a href=\"".$i[1]."\"><img src=\"".$i[0]."\" width=\"".$size."\" height=\"".$size."\"></a>\n";
		};
		print "</a>\n";
	?>		
</div>