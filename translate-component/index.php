<?php

require __DIR__ . '/vendor/autoload.php';

$translationsIni = \Translate\TranslationsImporter::byIni(__DIR__ . '/translations.ini');
$translationsJson = \Translate\TranslationsImporter::byJson(__DIR__ . '/translations.json');
$translationsXml = \Translate\TranslationsImporter::byXml(__DIR__ . '/translations.xml');

$translations = new \Translate\Translations([
	'a' => [
		'en' => 'a',
		'nl' => 'b' // backwards freaking language
	]
]);

$client = new \Translate\TranslateClient($translationsXml, 'NL');

echo $client->translate('a', 'en'); // a
echo "\n";

echo $client->translate('a'); // b
echo "\n";

$client->getTranslations()->set('a', 'nl', 'c');

echo $client->translate('a'); // c
echo "\n";
