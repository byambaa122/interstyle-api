<?php

function snakeCaseKeys(array $data) {
	$array = [];
	foreach ($data as $key => $value) {
		if (is_array($value)) {
			$value = snakeCaseKeys($value);
		}

		$array[snake_case($key)] = $value;
	}

	return $array;
}

function camelCaseKeys(array $data) {
	$array = [];
	foreach ($data as $key => $value) {
		if (is_array($value)) {
			$value = camelCaseKeys($value);
		}

		$array[camel_case($key)] = $value;
	}

	return $array;
}
