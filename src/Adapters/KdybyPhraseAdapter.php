<?php
namespace Librette\FlashMessages\Adapters;

use Kdyby\Translation\Phrase;
use Librette\FlashMessages\IPhrase;
use Nette\Localization\ITranslator;
use Nette\Object;

/**
 * @author David Matejka
 */
class KdybyPhraseAdapter extends Object implements IPhrase
{

	/** @var Phrase */
	protected $phrase;


	public function __construct(Phrase $phrase)
	{
		$this->phrase = $phrase;
	}


	public function translate(ITranslator $translator)
	{
		return $this->phrase->translate($translator);
	}


	public function setMessage($message)
	{
		$this->phrase->message = $message;
	}


	public function setCount($count)
	{
		$this->phrase->count = $count;
	}


	public function setParameters($parameters)
	{
		$this->phrase->parameters = $parameters;
	}

}
