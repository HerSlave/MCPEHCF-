<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\faction\FactionException;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class DisbandSubCommand extends SubCommand {

    /**
     * DisbandSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("disband", "/faction disband");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws FactionException
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if($sender->getFaction() === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if($sender->getFactionRole() !== Faction::LEADER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if($sender->getFaction()->isInDTRFreeze()) {
            $sender->sendMessage(Translation::getMessage("dtrFreeze"));
            return;
        }
        $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("disband", [
            "faction" => TextFormat::AQUA . $sender->getFaction()->getName()
        ]));
        $this->getCore()->getFactionManager()->removeFaction($sender->getFaction()->getName());
    }
}