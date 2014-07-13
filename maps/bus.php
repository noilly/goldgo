<?php
echo '[';
$row = 1;
if (($handle = fopen("dataset_bus_stops.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
         {
		if(!empty($data[8]))
{	
            echo ('{"name":"'.$data[1]." ".$data[2]." ".$data[3].'","lng":"'. $data[7].'","lat":"'.$data[8].'"},') ;
			}
        }
    }
    fclose($handle);
}
echo ']';
?>