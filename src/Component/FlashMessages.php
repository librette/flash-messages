<?php
namespace Librette\FlashMessages\Component;

use Librette\FlashMessages\FlashMessage;
use Nette;
use Nette\Application\UI\Control;


/**
 * @author David Matejka
 */
class FlashMessages extends Control
{

	public static $typeClasses = [
		FlashMessage::TYPE_INFO => 'alert alert-info',
		FlashMessage::TYPE_SUCCESS => 'alert alert-success',
		FlashMessage::TYPE_WARNING => 'alert alert-warning',
		FlashMessage::TYPE_ERROR => 'alert alert-danger',
		NULL => 'alert',
	];

	/** @var array|null */
	private $typeClassMapping;


	public function __construct()
	{
	}


	/**
	 * @param array
	 */
	public function setTypeClassMapping(array $typeClassMapping)
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


	public function render()
	{
		$this->template->typeClasses = $this->typeClassMapping ?: self::$typeClasses;
		$this->template->flashes = $this->parent->template->flashes;
		if (!$this->template->getFile()) {
			$this->template->setFile(__DIR__ . '/flashMessages.latte');
		}
		$this->template->render();
	}

}
