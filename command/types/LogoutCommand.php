<?php

namespace hcf\command\types;

use hcf\command\task\LogoutTask;
use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class LogoutCommand extends Command {

    /**
     * LogoutCommand constructor.
     */
    public function __construct() {
        parent::__construct("logout", "Log out of the server.");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof HCFPlayer) {
            $this->getCore()->getScheduler()->scheduleRepeatingTask(new LogoutTask($sender, 10), 20);
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}