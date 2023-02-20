<?php

namespace hcf\command\types;

use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class PVPCommand extends Command {

    /**
     * PVPCommand constructor.
     */
    public function __construct() {
        parent::__construct("pvp", "Enable pvp.", "/pvp <enable/lives>");
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
        if($args[0] === "enable") {
            if($sender->isInvincible()) {
                $sender->sendMessage(Translation::getMessage("enablePVP"));
                $sender->setInvincible(0);
                return;
            }
            $sender->sendMessage(Translation::getMessage("isNotInvincible"));
        }
        if($args[0] === "lives") {
            $sender->sendMessage(Translation::getMessage("lives", [
                "amount" => TextFormat::GREEN . $sender->getLives()
            ]));
        }
    }
}