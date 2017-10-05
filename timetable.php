<?php
$SOAP = new SoapClient("http://omatlahdot.hkl.fi/interfaces/kamo?wsdl");

$Stop0 = $SOAP->getNextDeparturesRT("1284122"); //Etelään
$Stop1 = $SOAP->getNextDeparturesRT("1284157"); //Pohjoiseen
$Stop2 = $SOAP->getNextDeparturesRT("1284123"); //Länteen
$Stop3 = $SOAP->getNextDeparturesRT("1284172"); //Itään

echo '
	<table id="west">
		<tr>
			<th colspan="3"><div class="cardinal">&#8592;L</div>' . $Stop0[0]->stopname . ' <div class="stopid">(3153)</div></th>
		</tr>';
	for ($i = 0; $i <= 4; $i++) {
    	echo 
			'<tr class="lines">
				<td class="line">' . $Stop0[$i]->line . '</td>
				<td class="dest">' . $Stop0[$i]->dest . '</td>
				<td class="time">'; if (empty($Stop0[$i]->rtime)) {echo '~' . substr($Stop0[$i]->time, 0, -3); ;} else {echo substr($Stop0[$i]->rtime, 0, -3); ;}; echo '</td>
			</tr>';
		};
echo '</table>';

echo '
	<table id="north">
		<tr>
			<th colspan="3"><div class="cardinal">&#8593;P</div>' . $Stop1[0]->stopname . ' <div class="stopid">(3123)</div></th>
		</tr>';
	for ($i = 0; $i <= 4; $i++) {
    	echo 
			'<tr class="lines">
				<td class="line">' . $Stop1[$i]->line . '</td>
				<td class="dest">' . $Stop1[$i]->dest . '</td>
				<td class="time">'; if (empty($Stop1[$i]->rtime)) {echo '~' . substr($Stop1[$i]->time, 0, -3); ;} else {echo substr($Stop1[$i]->rtime, 0, -3); ;}; echo '</td>

			</tr>';
		};
echo '</table>';

echo '
	<table id="south">
		<tr>
			<th colspan="3"><div class="cardinal">&#8595;E</div>' . $Stop2[0]->stopname . ' <div class="stopid">(3122)</div></th>
		</tr>';
	for ($i = 0; $i <= 4; $i++) {
    	echo 
			'<tr class="lines">
				<td class="line">' . $Stop2[$i]->line . '</td>
				<td class="dest">' . $Stop2[$i]->dest . '</td>
				<td class="time">'; if (empty($Stop2[$i]->rtime)) {echo '~' . substr($Stop2[$i]->time, 0, -3); ;} else {echo substr($Stop2[$i]->rtime, 0, -3); ;}; echo '</td>

			</tr>';
		};
echo '</table>';

echo '<table id="east">
		<tr>
			<th colspan="3"><div class="cardinal">I&#8594;</div>' . $Stop3[0]->stopname . ' <div class="stopid">(3154)</div></th>
		</tr>';
	for ($i = 0; $i <= 4; $i++) {
    	echo 
			'<tr class="lines">
				<td class="line">' . $Stop3[$i]->line . '</td>
				<td class="dest">' . $Stop3[$i]->dest . '</td>
				<td class="time">'; if (empty($Stop3[$i]->rtime)) {echo '~' . substr($Stop3[$i]->time, 0, -3); ;} else {echo substr($Stop3[$i]->rtime, 0, -3); ;}; echo '</td>

			</tr>';
		};
echo '</table>';
?>