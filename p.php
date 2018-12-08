<?php

$diskVolumes = array();

$vol = array("volume" => "/opt/mysql/data", "space_used" => "600GB", "space_available" => "424GB", "total_space" => "1024GB", "percent_used" => 66, "percent_free" => 34);

$diskVolumes[] = $vol;

$vol = array("volume" => "/opt/mysql/tmp", "space_used" => "10GB", "space_available" => "20GB", "total_space" => "30GB", "percent_used" => 34, "percent_free" => 66);
 
$diskVolumes[] = $vol; 

echo json_encode($diskVolumes);

echo "\n\n";

