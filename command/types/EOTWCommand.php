<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class EOTWCommand extends Command {

    /**
     * EOTWCommand constructor.
     */
    public function __construct() {
        parent::__construct("eotw", "Enable or disable EOTW.", "/eotw <on/off>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(isset($args[0])) {
            if(!$sender->isOp()) {
                $sender->sendMessage(Translation::getMessage("noPermission"));
                return;
            }
            switch($args[0]) {
                case "on":
                    $this->getCore()->setEndOfTheWorld();
                    break;
                case "off":
                    $this->getCore()->setEndOfTheWorld(false);
                    break;
                default:
                    $sender->sendMessage(Translation::getMessage("usageMessage", [
                        "usage" => $this->getUsage()
                    ]));
                    break;
            }
            return;
        }
        $sender->sendMessage(Translation::getMessage("usageMessage", [
            "usage" => $this->getUsage()
        ]));
        return;
    }
}