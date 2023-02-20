<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class LeaderSubCommand extends SubCommand {

    /**
     * LeaderSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("leader", "/faction leader <player>");
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
        if((!$player->getFaction()->isInFaction($sender)) or $player->getFaction() === null) {
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        if($sender->getFactionRole() !== Faction::LEADER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $sender->setFactionRole(Faction::OFFICER);
        $player->setFactionRole(Faction::LEADER);
        foreach($sender->getFaction()->getOnlineMembers() as $member) {
            $member->sendMessage(Translation::getMessage("promotion", [
                "name" => TextFormat::GREEN . $player->getName(),
                "position" => TextFormat::GOLD . "leader"
            ]));
        }
    }
}