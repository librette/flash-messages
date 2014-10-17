<?php
namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\Object;

/**
 * @author David Matejka
 */
class FlashMessage extends Object
{

	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_ERROR = 'error';

	/** @var string */
	protected $message;

	/** @var string */
	protected $type;

	/** @var ITranslator */
	protected $translator;

	/** @var IPhrase */
	protected $phrase;


	/**
	 * @param ITranslator
	 * @param IPhrase
	 */
	public function __construct(ITranslator $translator, IPhrase $phrase)
	{
		$this->translator = $translator;
		$this->phrase = $phrase;
	}


	/**
	 * @param string
	 * @return self
	 */
	public function setType($type)
	{
		$this->type = $type;

		return $this;
	}


	/**
	 * @return self
	 */
	public function success()
	{
		$this->setType(self::TYPE_SUCCESS);

		return $this;
	}


	/**
	 * @return self
	 */
	public function error()
	{
		$this->setType(self::TYPE_ERROR);

		return $this;
	}


	/**
	 * @return string
	 */
	public function getMessage()
	{
		if ($this->message === NULL && $this->translator) {
			$this->message = $this->phrase->translate($this->translator);
		}

		return $this->message;
	}


	/**
	 * @param string
	 * @return self
	 */
	public function setMessage($message)
	{
		if ($this->isUnserialized()) {
			$this->message = $message;
		} else {
			$this->phrase->setMessage($message);
			$this->message = NULL;
		}

		return $this;
	}


	/**
	 * @param array
	 * @throws InvalidStateException when object is unserialized
	 * @return self
	 */
	public function setParameters(array $parameter)
	{
		$this->validateState(__FUNCTION__);
		$this->phrase->setParameters($parameter);
		$this->message = NULL;

		return $this;
	}


	/**
	 * @param int
	 * @throws InvalidStateException when object is unserialized
	 * @return self
	 */
	public function setCount($count)
	{
		$this->validateState(__FUNCTION__);
		$this->phrase->setCount($count);
		$this->message = NULL;

		return $this;
	}


	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}


	public function __sleep()
	{
		$this->message = $this->getMessage();

		return ['message', 'type'];
	}


	private function validateState($method)
	{
		if ($this->isUnserialized()) {
			throw new InvalidStateException("You cannot call method $method on unserialized FlashMessage object");
		}
	}


	/**
	 * @return bool
	 */
	private function isUnserialized()
	{
		return $this->translator === NULL;
	}
}
