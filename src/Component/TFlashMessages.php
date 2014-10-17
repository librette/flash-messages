<?php
namespace Librette\FlashMessages\Component;

/**
 * @author David Matejka
 */
trait TFlashMessages
{

	/** @var FlashMessagesFactory */
	protected $flashMessagesFactory;


	public function injectFlashMessagesFactory(FlashMessagesFactory $factory = NULL)
	{
		$this->flashMessagesFactory = $factory;
	}


	protected function createComponentFlashMessages()
	{
		if ($this->flashMessagesFactory) {
			return $this->flashMessagesFactory->create();
		} else {
			return new FlashMessages();
		}
	}
}
