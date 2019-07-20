<?php declare(strict_types = 1);

namespace Librette\FlashMessages\Component;

interface FlashMessagesFactory
{
	public function create(): FlashMessages;
}
