<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class UnmuteCommand extends Command {

    /**
     * UnmuteCommand constructor.
     */
    public function __construct() {
        parent::__construct("unmute", "Unmute a player.", "/unmute <player>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(($sender instanceof HCFPlayer and $sender->hasPermission("permission.admin"))
            or $sender instanceof ConsoleCommandSender or $sender->isOp()) {
            if(!isset($args[0])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT effector, reason, expiration FROM mutes WHERE username = ?;");
            $stmt->bind_param("s", $args[0]);
            $stmt->execute();
            $stmt->bind_result($effector, $reason, $expiration);
            $stmt->fetch();
            $stmt->close();
            if($effector === null and $reason === null and $expiration === null) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("DELETE FROM mutes WHERE username = ?;");
            $stmt->bind_param("s", $args[0]);
            $stmt->execute();
            $stmt->close();
            $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("punishmentRelivedBroadcast", [
                "name" => $args[0],
                "effector" => $sender->getName()
            ]));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}