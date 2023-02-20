<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class DemoteSubCommand extends SubCommand {

    /**
     * DemoteSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("demote", "/faction demote <player>");
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
        if($sender->getFaction() === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if($sender->getFactionRole() !== Faction::LEADER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $player = $this->getCore()->getServer()->getPlayer($args[1]);
        if(!$player instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        if(!$sender->getFaction()->isInFaction($player)) {
            $sender->sendMessage(Translation::getMessage("notFactionMember", [
                "name" => TextFormat::RED . $player->getName()
            ]));
            return;
        }
        if($player->getFactionRole() === Faction::RECRUIT) {
            $sender->sendMessage(Translation::getMessage("cannotDemote", [
                "name" => TextFormat::RED . $player->getName()
            ]));
            return;
        }
        foreach($sender->getFaction()->getOnlineMembers() as $member) {
            $member->sendMessage(Translation::getMessage("demoted", [
                "name" => TextFormat::GREEN . $player->getName(),
                "sender" => TextFormat::LIGHT_PURPLE . $sender->getName()
            ]));
        }
        $player->setFactionRole($player->getFactionRole() - 1);
    }
}