<?php declare(strict_types = 1);

namespace Librette\FlashMessages\Component;

use Librette\FlashMessages\FlashMessage;
use Nette;
use Nette\Application\UI\Control;


class FlashMessages extends Control
{

	public static $typeClasses = [
		FlashMessage::TYPE_INFO => 'alert alert-info',
		FlashMessage::TYPE_SUCCESS => 'alert alert-success',
		FlashMessage::TYPE_WARNING => 'alert alert-warning',
		FlashMessage::TYPE_ERROR => 'alert alert-danger',
		null => 'alert',
	];

	/** @var array|null */
	private $typeClassMapping;


	public function __construct()
	{
	}


	public function setTypeClassMapping(array $typeClassMapping): void
	{
		$this->typeClassMapping = $typeClassMapping;
	}


	protected function validateParent(Nette\ComponentModel\IContainer $parent): void
	{
		if (!$parent instanceof Control) {
			throw new Nette\InvalidStateException("FlashMessages component can be attached only to the UI\\Control descendant.");
		}
		parent::validateParent($parent);
	}


	public function render(): void
	{
		assert($this->template instanceof \stdClass);
		$this->template->typeClasses = $this->typeClassMapping ?: self::$typeClasses;
		$parent = $this->parent;
		assert($parent instanceof Control);
		assert($parent->template instanceof \stdClass);
		$this->template->flashes = $parent->template->flashes;
		assert($this->template instanceof Nette\Application\UI\ITemplate);
		if (!$this->template->getFile()) {
			$this->template->setFile(__DIR__ . '/flashMessages.latte');
		}
		$this->template->render();
	}

}
