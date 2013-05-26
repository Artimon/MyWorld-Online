<?php

class ViewHelper_ContentBox {
	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $content;

	/**
	 * @var string
	 */
	private $class = '';

	/**
	 * @var string
	 */
	private $actions = '';

	/**
	 * @var bool
	 */
	private $attention = false;

	/**
	 * @var bool
	 */
	private $closable = true;

	/**
	 * @param string $title
	 * @param string $content
	 */
	public function __construct($title, $content) {
		$this->title = (string)$title;
		$this->content = (string)$content;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->get();
	}

	/**
	 * @param string $title
	 * @param string $content
	 * @return ViewHelper_ContentBox
	 */
	public static function create($title, $content) {
		return new self($title, $content);
	}

	/**
	 * @param string $class
	 * @return ViewHelper_ContentBox
	 */
	public function setClass($class) {
		$this->class = $class;

		return $this;
	}

	/**
	 * @param string $actions
	 * @return ViewHelper_ContentBox
	 */
	public function setActions($actions) {
		$this->actions = $actions;

		return $this;
	}

	/**
	 * @return ViewHelper_ContentBox
	 */
	public function setAttention() {
		$this->attention = true;

		return $this;
	}

	/**
	 * @return ViewHelper_ContentBox
	 */
	public function setSticky() {
		$this->closable = false;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get() {
		$boxClass = $this->class
			? ' ' . $this->class
			: '';

		$headerClass = $this->attention
			? ' attention'
			: '';

		$actions = '';
		if ($this->actions) {
			$actions = "<div class='actions'>{$this->actions}</div>";
		}

		$close = '';
		if ($this->closable) {
			$close = "<a href='javascript:;' class='entypo-cancel close'></a>";
		}

		return "
			<div class='box{$boxClass}'>
				<h3 class='head{$headerClass}'>
					{$this->title}{$close}
				</h3>
				<div class='body'>
					{$this->content}
				</div>
				{$actions}
			</div>";
	}
}