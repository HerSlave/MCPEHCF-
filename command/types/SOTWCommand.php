<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class SOTWCommand extends Command {

    /**
     * SOTWCommand constructor.
     */
    public function __construct() {
        parent::__construct("sotw", "Enable SOTW.", "/sotw");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender->isOp()) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $this->getCore()->setStartOfTheWorld();
        return;
    }
}