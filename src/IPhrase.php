<?php declare(strict_types = 1);

namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;

interface IPhrase
{
	public function translate(ITranslator $translator): string;


	public function setMessage(string $message): void;


	public function setCount(int $count): void;


	public function setParameters(array $parameters): void;
}
