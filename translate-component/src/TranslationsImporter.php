<?php

namespace Translate;

use SimpleXMLElement;

class TranslationsImporter
{
	/**
	 * import by .ini
	 *
	 * @param string $path
	 * @return Translations
	 */
	public static function byIni(string $path)
	{
		$ini = parse_ini_file($path, true);

		if (!$ini) {
			return false;
		}

		return new Translations($ini);
	}

	/**
	 * import by .json
	 *
	 * @param string $path
	 * @return Translations
	 */
	public static function byJson(string $path)
	{
		$json = file_get_contents($path);

		if (!$json) {
			return false;
		}
		
		return new Translations(json_decode($json, true));
	}

	/**
	 * import by xml
	 *
	 * @param string $path
	 * @return Translations
	 */
	public static function byXml(string $path)
	{
		$xml = file_get_contents($path);

		$translations = [];

		$elements = new SimpleXMLElement($xml);
		foreach ($elements as $element) {
			if ($element->getName() !== 'translation') {
				continue;
			}

			$key = (string) $element->attributes()->key;

			foreach ($element->children() as $language) {
				$lang = (string) $language->getName();
				$val = (string) $language;

				$translations[$key][$lang] = $val;
			}
		}

		return new Translations($translations);
	}
}
