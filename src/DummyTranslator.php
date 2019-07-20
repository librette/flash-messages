<?php declare(strict_types = 1);

namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\SmartObject;

class DummyTranslator implements ITranslator
{
	use SmartObject;


	function translate($message, ...$parameters): string
	{
		return $message;
	}
}
