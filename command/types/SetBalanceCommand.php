<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class SetBalanceCommand extends Command {

    /**
     * SetBalanceCommand constructor.
     */
    public function __construct() {
        parent::__construct("setbalance", "Set a player's balance.", "/setbalance <player> <amount>", ["setbal"]);
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
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $player = $this->getCore()->getServer()->getPlayer($args[0]);
        if(!$player instanceof HCFPlayer) {
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT balance FROM players WHERE username = ?");
            $stmt->bind_param("s", $args[0]);
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $result->free();
            $stmt->close();
            $balance = $row["balance"];
            if($balance === null) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
        }
        if(!is_numeric($args[1])) {
            $sender->sendMessage(Translation::getMessage("notNumeric"));
            return;
        }
        if(isset($balance)) {
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("UPDATE players SET balance = ? WHERE username = ?");
            $stmt->bind_param("is", $args[1], $args[0]);
            $stmt->execute();
        }
        else {
            $player->setBalance($args[1]);
        }
        $sender->sendMessage(Translation::getMessage("setBalanceSuccess", [
            "amount" => TextFormat::GREEN . "$" . $args[1],
            "name" => $player instanceof HCFPlayer ? $player->getName() : $args[0]
        ]));
    }
}