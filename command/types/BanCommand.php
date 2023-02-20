<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class BanCommand extends Command {

    /**
     * BanCommand constructor.
     */
    public function __construct() {
        parent::__construct("ban", "Ban a player.", "/ban <player> <reason> [days]");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(($sender instanceof HCFPlayer and $sender->hasPermission("permission.mod"))
            or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
            if(!isset($args[1])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $expiration = null;
            if(isset($args[2]) and is_numeric($args[2])) {
                $punishTime = time();
                $expiration = $punishTime + ($args[2] * 86400);
            }
            $player = $this->getCore()->getServer()->getPlayerExact($args[0]);
            if($player instanceof HCFPlayer) {
                $uuid = $player->getRawUniqueId();
                $name = $sender->getName();
                $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("INSERT INTO bans(uuid, username, effector, reason, expiration) VALUES(?, ?, ?, ?, ?);");
                $stmt->bind_param("ssssi", $uuid, $args[0], $name, $args[1], $expiration);
                $stmt->execute();
                $stmt->close();
                $time = "Permanent";
                if($expiration !== null and isset($punishTime)) {
                    $time = $expiration - $punishTime;
                    $days = floor($time / 86400);
                    $hours = floor(($time / 3600) % 24);
                    $minutes = floor(($time / 60) % 60);
                    $seconds = $time % 60;
                    $time = "$days days, $hours hours, $minutes minutes, $seconds seconds";
                }
                $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("banBroadcast", [
                    "name" => $player->getName(),
                    "effector" => $sender->getName(),
                    "time" => $time,
                    "reason" => $args[1]
                ]));
                $player->close(null, Translation::getMessage("banMessage", [
                    "name" => $sender->getName(),
                    "reason" => $args[1],
                    "time" => $time
                ]));
                return;
            }
            else {
                $name = $sender->getName();
                $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT uuid FROM players WHERE username = ?");
                $stmt->bind_param("s", $args[0]);
                $stmt->execute();
                $stmt->bind_result($uuid);
                $stmt->fetch();
                $stmt->close();
                if($uuid !== null) {
                    $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("INSERT INTO bans(uuid, username, effector, reason, expiration) VALUES(?, ?, ?, ?, ?);");
                    $stmt->bind_param("ssssi", $uuid, $args[0], $name, $args[1], $expiration);
                    $stmt->execute();
                    $stmt->close();
                    $time = "Permanent";
                    if($expiration !== null and isset($punishTime)) {
                        $time = $expiration - $punishTime;
                        $days = floor($time / 86400);
                        $hours = floor(($time / 3600) % 24);
                        $minutes = floor(($time / 60) % 60);
                        $seconds = $time % 60;
                        $time = "$days days, $hours hours, $minutes minutes, $seconds seconds";
                    }
                    $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("banBroadcast", [
                        "name" => $args[0],
                        "effector" => $sender->getName(),
                        "time" => $time,
                        "reason" => $args[1]
                    ]));
                    return;
                }
            }
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}