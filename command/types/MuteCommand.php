<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class MuteCommand extends Command {

    /**
     * MuteCommand constructor.
     */
    public function __construct() {
        parent::__construct("mute", "Mute a player.", "/mute <player> <reason> <minutes>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(($sender instanceof HCFPlayer and ($sender->hasPermission("permission.mod")))
            or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
            if(!isset($args[2])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $expiration = null;
            if(is_numeric($args[2])) {
                $punishTime = time();
                $expiration = $punishTime + ($args[2] * 60);
            }
            if($expiration === null) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $time = $expiration - $punishTime;
            $days = floor($time / 86400);
            $hours = floor(($time / 3600) % 24);
            $minutes = floor(($time / 60) % 60);
            $seconds = $time % 60;
            $time = "$days days, $hours hours, $minutes minutes, $seconds seconds";
            $player = $this->getCore()->getServer()->getPlayerExact($args[0]);
            if($player instanceof HCFPlayer) {
                $player->setMuted($expiration, $sender->getName(), $args[1]);
                $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("muteBroadcast", [
                    "name" => $player->getName(),
                    "effector" => $sender->getName(),
                    "time" => $time,
                    "reason" => $args[1]
                ]));
                return;
            }
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}