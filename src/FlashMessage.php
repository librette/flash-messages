<?php declare(strict_types = 1);

namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\SmartObject;

/**
 * @property-read string $message
 * @property-read string $type
 */
class FlashMessage extends \stdClass
{
	use SmartObject;

	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_ERROR = 'error';

	/** @var null|string */
	protected $message;

	/** @var string */
	protected $type;

	/** @var null|ITranslator */
	protected $translator;

	/** @var IPhrase */
	protected $phrase;


	public function __construct(ITranslator $translator, IPhrase $phrase)
	{
		$this->translator = $translator;
		$this->phrase = $phrase;
	}


	public function setType(string $type): self
	{
		$this->type = $type;

		return $this;
	}


	public function success(): self
	{
		$this->setType(self::TYPE_SUCCESS);

		return $this;
	}


	public function error(): self
	{
		$this->setType(self::TYPE_ERROR);

		return $this;
	}


	public function info(): self
	{
		$this->setType(self::TYPE_INFO);

		return $this;
	}


	public function warning(): self
	{
		$this->setType(self::TYPE_WARNING);

		return $this;
	}


	public function getMessage(): string
	{
		if ($this->message === null && $this->translator !== null) {
			$this->message = $this->phrase->translate($this->translator);
		}
		assert($this->message !== null);

		return $this->message;
	}


	public function setMessage(string $message): self
	{
		if ($this->isUnserialized()) {
			$this->message = $message;
		} else {
			$this->phrase->setMessage($message);
			$this->message = null;
		}

		return $this;
	}


	/**
	 * @throws InvalidStateException when object is unserialized
	 */
	public function setParameters(array $parameter): self
	{
		$this->validateState(__FUNCTION__);
		$this->phrase->setParameters($parameter);
		$this->message = null;

		return $this;
	}


	/**
	 * @throws InvalidStateException when object is unserialized
	 */
	public function setCount(int $count): self
	{
		$this->validateState(__FUNCTION__);
		$this->phrase->setCount($count);
		$this->message = null;

		return $this;
	}


	public function getType(): ?string
	{
		return $this->type;
	}


	public function __sleep()
	{
		$this->message = $this->getMessage();

		return ['message', 'type'];
	}


	private function validateState(string $method): void
	{
		if ($this->isUnserialized()) {
			throw new InvalidStateException("You cannot call method $method on unserialized FlashMessage object");
		}
	}


	private function isUnserialized(): bool
	{
		return $this->translator === null;
	}
}
