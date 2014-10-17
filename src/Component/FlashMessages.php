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
		FlashMessage::TYPE_INFO    => 'alert alert-info',
		FlashMessage::TYPE_SUCCESS => 'alert alert-success',
		FlashMessage::TYPE_WARNING => 'alert alert-warning',
		FlashMessage::TYPE_ERROR   => 'alert alert-error',
		NULL                       => 'alert',
	];


	public function __construct()
	{
	}


	protected function validateParent(Nette\ComponentModel\IContainer $parent)
	{
		if (!$parent instanceof Control) {
			throw new Nette\InvalidStateException("FlashMessages component can be attached only to the UI\\Control descendant.");
		}
		parent::validateParent($parent);
	}


	public function render()
	{
		$this->template->typeClasses = self::$typeClasses;
		$this->template->flashes = $this->parent->template->flashes;
	}

}
