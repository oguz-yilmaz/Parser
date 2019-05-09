<?php
error_reporting(0);

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

$csvFile = file('moldex-regain.csv');
    $data = [];
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
}

$cnt = 0;

foreach ($data as $value) {
	if($cnt > 0){
//		if (strpos($value[0], 'www.moldex.com') !== false) {
			$url0 = parse_url($value[0]);
			$url1 = parse_url($value[1]);
			$url2 = parse_url($value[2]);
			$url3 = parse_url($value[3]);

			$path0 = $url0['path'];
			$path1 = $url1['path'];
			$path2 = $url2['path'];
			$path3 = $url3['path'];
		echo $path0."--".$path1."--".$path2."<br>";

			echo " location ~ ^{$path0}$ {
      			return 301 \$scheme://\$server_name{$path2};
			}";
			echo "Redirect 301 $path0  https://www.heatshieldproducts.com$path1 <br>";
//		}
	}

	$cnt++;
}

