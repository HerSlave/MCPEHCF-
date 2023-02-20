<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class KickCommand extends Command {

    /**
     * KickCommand constructor.
     */
    public function __construct() {
        parent::__construct("kick", "Kick a player.", "/kick <player> <reason>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(($sender instanceof HCFPlayer and $sender->hasPermission("permission.staff"))
            or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
            if(!isset($args[1])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $player = $this->getCore()->getServer()->getPlayerExact($args[0]);
            if(!$player instanceof HCFPlayer) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
            $name = $player->getName();
            $sender = $sender->getName();
            $reason = (string)$args[1];
            $player->close("", Translation::getMessage("kickMessage", [
                "name" => $sender,
                "reason" => $reason
            ]));
            $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("kickBroadcast", [
                "name" => $name,
                "effector" => $sender,
                "reason" => $reason
            ]));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}