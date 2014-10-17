<?php
namespace Librette\FlashMessages\Component;

/**
 * @author David Matejka
 */
interface FlashMessagesFactory
{

	/**
	 * @return FlashMessages
	 */
	public function create();
}
