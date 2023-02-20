<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

class GiveKeysCommand extends Command {

    /**
     * GiveKeysCommand constructor.
     */
    public function __construct() {
        parent::__construct("givekeys", "Give crate keys to a player.", "/givekeys <player> <crate> [amount = 1]");
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
            if(!isset($args[2])) {
                $sender->sendMessage(Translation::getMessage("usageMessage", [
                    "usage" => $this->getUsage()
                ]));
                return;
            }
            $player = $this->getCore()->getServer()->getPlayer($args[0]);
            if($player === null) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
            $crate = $this->getCore()->getCrateManager()->getCrate($args[1]);
            if($crate === null) {
                $sender->sendMessage(Translation::getMessage("invalidCrate"));
                return;
            }
            $amount = is_numeric($args[2]) ? (int)$args[2] : 1;
            $player->getInventory()->addItem((new CrateKey($crate))->setCount($amount));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}