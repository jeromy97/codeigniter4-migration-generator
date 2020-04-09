<?php

$templateFile = "template.txt";

file_exists($templateFile)
	or exit ($templateFile . " not found...");

echo "Enter migration name..." . PHP_EOL;
$migrationName = readline();
$migrationName = str_replace(' ', '_', $migrationName);

echo "Please enter the path of the Codeigniter 3 root folder or leave blank to generate the migration as a separate file..." . PHP_EOL;
$codeigniterDir = readline();

if ($codeigniterDir == '') {
	$path = "migrations\\";
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
}
else{
	$path = $codeigniterDir . "\\application\\migrations\\";
	if (!file_exists($path)) {
		mkdir($path, 0777, false);
	}
}

$migrationNumber = date('YmdHis');

$fileName = $path . $migrationNumber . '_' . strtolower($migrationName) . '.php';

$content = file_get_contents($templateFile);
$content = str_replace('{MIGRATION_NAME}', ucfirst(strtolower($migrationName)), $content);

try {
	file_put_contents($fileName, $content);
	echo $fileName . " was succesfully created!" . PHP_EOL;
} catch (Exception $e) {
	echo "Migration could not be created: " . $e->getMessage() . PHP_EOL;
}
