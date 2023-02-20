<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;

class KeyAllCommand extends Command {

    /**
     * KeyAllCommand constructor.
     */
    public function __construct() {
        parent::__construct("keyall", "Give crate keys to all players..", "/keyall <crate> <amount>");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof ConsoleCommandSender or $sender->isOp()) {
            if(!isset($args[1])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $crate = $this->getCore()->getCrateManager()->getCrate($args[0]);
            if($crate === null) {
                $sender->sendMessage(Translation::getMessage("invalidCrate"));
                return;
            }
            $amount = is_numeric($args[1]) ? (int)$args[1] : 1;
            foreach($this->getCore()->getServer()->getOnlinePlayers() as $player) {
                $player->getInventory()->addItem((new CrateKey($crate))->setCount($amount));
            }
            $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("keyAll", [
                "name" => TextFormat::AQUA . $sender->getName(),
                "amount" => TextFormat::YELLOW . $amount,
                "type" => TextFormat::GRAY . $crate->getName()
            ]));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}