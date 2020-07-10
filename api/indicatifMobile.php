<?php
	require '../config/constant.php';
	$getAll = file_get_contents('indicatifMobileNumber.json');
	if (is_form_valid($_GET['country'])) {
		if ($_GET['country'] == "All") {
			echo $getAll;
		} else {
			$search = strtolower($_GET['country']);
			$result = "";
			$json_data = json_decode($getAll, true);
			foreach ($json_data as $country) {
				if (strtolower($country['name']) == $search || strtolower($country['code']) == $search) {
					$result = $country;
				}
			}
			if ($result != "") {
				echo json_encode($result);
			} else {
				echo "Country not found";
			}
		}
	} else {
		echo "Select your country";
	}
?>