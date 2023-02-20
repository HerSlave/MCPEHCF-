<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\FactionException;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class CreateSubCommand extends SubCommand {

    /**
     * CreateSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("create", "/faction create <name>");
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
        if($sender->getFaction() !== null) {
            $sender->sendMessage(Translation::getMessage("mustLeaveFaction"));
            return;
        }
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        if(strlen($args[1]) > 30) {
            $sender->sendMessage(Translation::getMessage("factionNameTooLong"));
            return;
        }
        $faction = $this->getCore()->getFactionManager()->getFaction($args[1]);
        if($faction !== null) {
            $sender->sendMessage(Translation::getMessage("existingFaction", [
                "faction" => TextFormat::RED . $args[1]
            ]));
            return;
        }
        $this->getCore()->getFactionManager()->createFaction($args[1], $sender);
        $this->getCore()->getServer()->broadcastMessage(Translation::getMessage("factionCreate", [
            "faction" => TextFormat::AQUA . $args[1],
            "name" => TextFormat::GREEN . $sender->getName()
        ]));
    }
}