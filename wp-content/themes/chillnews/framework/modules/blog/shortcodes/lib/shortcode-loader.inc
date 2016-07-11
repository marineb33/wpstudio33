<?php

namespace ChillNewsNamespace\Modules\Blog\Shortcodes\Lib;

/* 
	Sliders
*/
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostSliderClassic\PostSliderClassic;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostSliderSplit\PostSliderSplit;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostSliderInteractive\PostSliderInteractive;

/* 
	Layouts - shortcodes
*/
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutEight\PostLayoutEight;
use ChillNewsNamespace\Modules\Blog\Shortcodes\PostLayoutNine\PostLayoutNine;

/* 
	Blocks - combinations of several layouts
*/
use ChillNewsNamespace\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use ChillNewsNamespace\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ListShortcode
	 * @param ListShortcode $shortcode
	 */
	private function addShortcode(ListShortcode $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new PostSliderClassic());
		$this->addShortcode(new PostSliderSplit());
		$this->addShortcode(new PostSliderInteractive());
		$this->addShortcode(new PostLayoutOne());
        $this->addShortcode(new PostLayoutTwo());
        $this->addShortcode(new PostLayoutThree());
        $this->addShortcode(new PostLayoutFour());
        $this->addShortcode(new PostLayoutFive());
        $this->addShortcode(new PostLayoutSix());
        $this->addShortcode(new PostLayoutSeven());
        $this->addShortcode(new PostLayoutEight());
        $this->addShortcode(new PostLayoutNine());
		$this->addShortcode(new BlockOne());
		$this->addShortcode(new BlockTwo());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'renderHolders'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();