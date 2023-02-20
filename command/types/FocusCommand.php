<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class FocusCommand extends Command {

    /**
     * FocusCommand constructor.
     */
    public function __construct() {
        parent::__construct("focus", "Make a player's nametag stand out.", "/focus <player>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if(!isset($args[0])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $player = $sender->getServer()->getPlayer($args[0]);
        if(!$player instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        $sender->focus($player);
        $sender->sendMessage(Translation::getMessage("focus", [
            "name" => TextFormat::YELLOW . $player->getName()
        ]));
    }
}