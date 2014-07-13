<?php

$row = 1;
if (($handle = fopen("dataset_park_facilties_part_1.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
         {
		if(strpos(strtoupper($data[6]),'TOILET') !== false)
{	
            echo ('{"name":"'.$data[6].',"lng":"'. $data[12].',"lat":"'.$data[13].'"},') ;
			}
        }
    }
    fclose($handle);
}

$row = 1;
if (($handle = fopen("dataset_park_facilties_part_2.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
         {
		// echo $data[6];
		if(strpos(strtoupper($data[6]),'TOILET') !== false)
{		
                        echo ('{"name":"'.$data[6].',"lng":"'. $data[12].',"lat":"'.$data[13].'"},') ;
			}
        }
    }
    fclose($handle);
}
?>