<?php
namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;

/**
 * @author David Matejka
 */
interface IPhrase
{

	public function translate(ITranslator $translator);


	public function setMessage($message);


	public function setCount($count);


	public function setParameters($parameters);
}
