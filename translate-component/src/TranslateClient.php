<?php

namespace Translate;

/**
 * client to interract with translations
 */
class TranslateClient
{
	/** @var Translations */
	protected $translations;

	/** @var string */
	protected $lang;

	/**
	 * construct
	 *
	 * @param Translations $translations
	 * @param string $lang default language
	 */
	public function __construct(Translations $translations, string $lang = 'en')
	{
		$this->translations = $translations;
		$this->lang = strtolower($lang);
	}

	/**
	 * set default language
	 *
	 * @param string $lang
	 * @return self
	 */
	public function setLanguage(string $lang)
	{
		$this->lang = $lang;

		return $this;
	}

	/**
	 * translate
	 *
	 * @param string $key
	 * @param string $lang
	 * @return string
	 */
	public function translate(string $key, string $lang = null)
	{
		if ($lang === null) {
			$lang = $this->lang;
		}

		return $this->translations->get($key, strtolower($lang));
	}

	/**
	 * get translations
	 *
	 * @return Translations
	 */
	public function getTranslations()
	{
		return $this->translations;
	}
}
