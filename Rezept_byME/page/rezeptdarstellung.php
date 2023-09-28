<?php
global $con;
?>
<!DOCTYPE html>
<html lang="en">
<body>
	<main>
		<h1>Rezeptübersicht</h1>
		<?php
		$sql = "
			SELECT
				r.IDRezept,
				r.Titel as rTitel,
				r.Beschreibung as rBeschreibung,
				r.DauerVorbereitung,
				r.DauerZubereitung,
				r.DauerRuhen,
				r.AnzahlPersonen,
				CONCAT(u.Vorname, ' ', u.Nachname) as username,
				s.Titel as SchTitel,
				s.Beschreibung as SchBeschreibung
			FROM tbl_rezepte as r
			INNER JOIN tbl_user as u ON r.FIDUser = u.IDUser
			INNER JOIN tbl_schwierigkeitsgrade as s ON r.FIDSchwierigkeitsgrad = s.IDSchwierigkeitsgrad
			ORDER BY rTitel ASC
		";
		$rezeptQuery = makeStatement($sql);
		$rezeptResult = $rezeptQuery->fetchAll();

		foreach ($rezeptResult as $rezept) {
			$sql = "
				SELECT
					rz.Anzahl,
					z.Bezeichnung as zutatname,
					e.Bezeichnung as einheitname
				FROM tbl_rezepte_zutaten as rz
				INNER JOIN tbl_zutaten as z ON rz.FIDZutat = z.IDZutat
				LEFT JOIN tbl_einheiten as e ON rz.FIDEinheit = e.IDEinheit
				WHERE rz.FIDRezept = {$rezept["IDRezept"]}
			";
			$ingredientsQuery = makeStatement($sql);
			$ingredientsResult = $ingredientsQuery->fetchAll();

			$sql = "
				SELECT
					Titel,
					Beschreibung
				FROM tbl_zubereitungsschritte
				WHERE FIDRezept = {$rezept["IDRezept"]}
				ORDER BY Reihenfolge ASC
			";
			$stepsQuery = makeStatement($sql);
			$stepsResult = $stepsQuery->fetchAll();

			echo ("
				<article>
					<section>
						<h3>{$rezept["rTitel"]}</h3>
						<p>(von {$rezept["username"]})</p>
						<p>Zeiten:</p>
						<ul>
							<li>Vorbereitungszeit: {$rezept["DauerVorbereitung"]} Min.</li>
							<li>Zubereitungszeit: {$rezept["DauerZubereitung"]} Min.</li>
							<li>Nachbereitungs- oder Ruhezeit: {$rezept["DauerRuhen"]} Min.</li>
						</ul>
						<p>Für {$rezept["AnzahlPersonen"]} Personen</p>
						<p>Schwierigkeitsgrad: {$rezept["SchTitel"]} - {$rezept["SchBeschreibung"]}</p>
					</section>
					<section>
						<h4>Zutaten:</h4>
						<ul>
			");
			foreach ($ingredientsResult as $ingredient) {
				echo ("
							<li>{$ingredient["Anzahl"]} {$ingredient["einheitname"]} {$ingredient["zutatname"]}</li>
			");
			}
			echo ("
						</ul>
					</section>
					<section>
						<h4>Zubereitungsschritte:</h4>
						<ol>
			");
			foreach ($stepsResult as $step) {
				$title = "";
				if (!empty($step["Titel"])) {
					$title = "<p>{$step["Titel"]}:</p>";
				}
				echo ("
							<li>
								{$title}
								<p>{$step["Beschreibung"]}</p>
							</li>
			");
			}
			echo ("
						</ol>
					</section>
				</article>
			");
		}
		?>
	</main>
</body>

</html>