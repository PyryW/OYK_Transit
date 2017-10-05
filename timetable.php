<?php
$url = "https://api.digitransit.fi/routing/v1/routers/hsl/index/graphql";    
$request = file_get_contents('./stops.txt');

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/graphql"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}


curl_close($curl);

$response = json_decode($json_response, true);

$stopDetails = array(
	'divId' => array( 
		'south',
		'west',
		'north',
		'east' 
		),
	'divDir' => array(
		'&#8595;E',
		'&#8592;L',
		'&#8593;P',
		'I&#8594;'
		)
);

for ($i = 0; $i <= 3; $i++) {
	echo '
	<table id="' . $stopDetails[divId][$i] . '">
		<tr>
			<th colspan="3"><div class="cardinal">' . $stopDetails[divDir][$i] . '</div>' . $response[data][stops][$i][name] . ' <div class="stopid">(3122)</div></th>
		</tr>';
	for ($j = 0; $j <= 4; $j++) {
    	echo 
			'<tr class="lines">
				<td class="line">' . $response[data][stops][$i][stoptimesWithoutPatterns][$j][trip][pattern][route][shortName] . '</td>
				<td class="dest">' . $response[data][stops][$i][stoptimesWithoutPatterns][$j][trip][pattern][headsign] . '</td>
				<td class="time">'; 
				if (empty($response[data][stops][$i][stoptimesWithoutPatterns][$j][realtime])) {echo '~'; }; echo gmdate("H:i", $response[data][stops][$i][stoptimesWithoutPatterns][$j][realtimeArrival]) . '</td>
			</tr>';
		};
	echo '</table>';
}
?>

