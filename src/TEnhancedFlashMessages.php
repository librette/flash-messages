<?php declare(strict_types = 1);

namespace Librette\FlashMessages;

use Nette\Localization\ITranslator;

/**
 * @mixin \Nette\Application\UI\Control
 */
trait TEnhancedFlashMessages
{
	/** @var ITranslator|null */
	private $flashMessagesTranslator;


	/**
	 * @param string|IPhrase $message
	 * @return FlashMessage
	 */
	public function flashMessage($message, string $type = FlashMessage::TYPE_INFO, ?int $count = null, array $parameters = []): \stdClass
	{
		if (!$message instanceof IPhrase) {
			$message = new Phrase($message, $count, $parameters);
		}

		$id = $this->getParameterId('flash');
		$messages = $this->getPresenter()->getFlashSession()->$id;
		$messages[] = $flash = new FlashMessage($this->getTranslator(), $message);
		$flash->setType($type);
		$this->getTemplate()->flashes = $messages;
		$this->getPresenter()->getFlashSession()->$id = $messages;

		return $flash;
	}


	public function injectFlashMessagesTranslator(ITranslator $translator = null): void
	{
		$this->flashMessagesTranslator = $translator;
	}


	protected function getTranslator(): ITranslator
	{
		if ($this->flashMessagesTranslator === null) {
			$presenter = $this->getPresenter(false);
			if ($presenter && $translator = $presenter->getContext()->getByType('Nette\Localization\ITranslator', false)) {
				$this->flashMessagesTranslator = $translator;
			} else {
				$this->flashMessagesTranslator = new DummyTranslator();
			}
		}

		return $this->flashMessagesTranslator;
	}
}
