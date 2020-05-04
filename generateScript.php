<?php

$templateFile = "template.txt";

file_exists($templateFile)
	or exit ($templateFile . " not found...");

echo "Enter the desired migration name in seperate words. For example: \"My beautifull Migration\"." . PHP_EOL;
$migrationName = readline();

echo "Enter the path of the Codeigniter 4 root folder or leave blank to generate the migration as a separate file..." . PHP_EOL;
$codeigniterDir = readline();

if ($codeigniterDir == '') {
	$path = "migrations\\";
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
}
else{
	$path = $codeigniterDir . "\\app\\Database\\Migrations\\";
	if (!file_exists($path)) {
		mkdir($path, 0777, false);
	}
}

$migrationNumber = date('Y-m-d-His');

$migrationFileName = strtolower(str_replace(' ', '_', $migrationName));
$fileName = $path . $migrationNumber . '_' . $migrationFileName . '.php';

$migrationClassName = str_replace(' ', '', ucwords(strtolower($migrationName)));
$content = file_get_contents($templateFile);
$content = str_replace('{MIGRATION_NAME}', $migrationClassName, $content);

try {
	file_put_contents($fileName, $content);
	echo $fileName . " was succesfully created!" . PHP_EOL;
} catch (Exception $e) {
	exit ("Migration could not be created: " . $e->getMessage() . PHP_EOL);
}
