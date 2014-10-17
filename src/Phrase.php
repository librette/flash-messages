<?php
namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;
use Nette\Object;

/**
 * @author David Matejka
 */
class Phrase extends Object implements IPhrase
{

	/** @var string */
	protected $message;

	/** @var int */
	protected $count;

	/** @var array */
	protected $parameters;


	function __construct($message, $count, $parameters)
	{
		$this->parameters = $parameters;
		$this->count = $count;
		$this->message = $message;
	}


	public function translate(ITranslator $translator)
	{
		return $translator->translate($this->message, $this->count, $this->parameters);
	}


	public function setMessage($message)
	{
		$this->message = $message;
	}


	public function setCount($count)
	{
		$this->count = $count;
	}


	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}

}
