<?php
namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\SmartObject;

/**
 * @author David Matejka
 */
class DummyTranslator implements ITranslator
{

	use SmartObject;

	function translate($message, ...$parameters): string
	{
		return $message;
	}

}
