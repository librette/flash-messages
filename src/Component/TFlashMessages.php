<?php declare(strict_types = 1);

namespace Librette\FlashMessages\Component;

trait TFlashMessages
{
	/** @var FlashMessagesFactory */
	protected $flashMessagesFactory;


	public function injectFlashMessagesFactory(FlashMessagesFactory $factory = null)
	{
		$this->flashMessagesFactory = $factory;
	}


	protected function createComponentFlashMessages(): FlashMessages
	{
		if ($this->flashMessagesFactory) {
			return $this->flashMessagesFactory->create();
		}
		return new FlashMessages();
	}
}
