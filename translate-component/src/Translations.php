<?php

namespace Translate;

/**
 * collection of translations
 */
class Translations
{
	/** @var array */
	protected $translations;

	/**
	 * construct
	 *
	 * @param array $translations
	 */
	public function __construct(array $translations)
	{
		$this->translations = $this->format($translations);
	}

	/**
	 * make lang not upper
	 *
	 * @param array $translations
	 * @return array
	 */
	protected function format(array $translations)
	{
		foreach ($translations as $key => $languages) {
			foreach ($languages as $lang => $value) {
				unset($translations[$key][$lang]);

				$translations[$key][strtolower($lang)] = $value;
			}
		}

		return $translations;
	}

	/**
	 * get translation
	 *
	 * @param string $key
	 * @param string $lang
	 * @return string
	 */
	public function get(string $key, string $lang)
	{
		return $this->translations[$key][strtolower($lang)] ?? $key;
	}

	/**
	 * set translation
	 *
	 * @param string $key
	 * @param string $lang
	 * @param string $val
	 * @return self
	 */
	public function set(string $key, string $lang, string $val)
	{
		$this->translations[$key][strtolower($lang)] = $val;

		return $this;
	}
}
