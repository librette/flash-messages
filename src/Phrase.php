<?php declare(strict_types = 1);

namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\SmartObject;

class Phrase implements IPhrase
{
	use SmartObject;

	/** @var string */
	protected $message;

	/** @var int|null */
	protected $count;

	/** @var array */
	protected $parameters;


	function __construct(string $message, ?int $count, array $parameters)
	{
		$this->parameters = $parameters;
		$this->count = $count;
		$this->message = $message;
	}


	public function translate(ITranslator $translator): string
	{
		return $translator->translate($this->message, $this->count, $this->parameters);
	}


	public function setMessage(string $message): void
	{
		$this->message = $message;
	}


	public function setCount(int $count): void
	{
		$this->count = $count;
	}


	public function setParameters(array $parameters): void
	{
		$this->parameters = $parameters;
	}
}
