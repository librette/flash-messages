<?php
namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\Object;

/**
 * @author David Matejka
 */
class DummyTranslator extends Object implements ITranslator
{

	function translate($message, $count = NULL)
	{
		return $message;
	}

}
