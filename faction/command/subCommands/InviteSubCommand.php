<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class InviteSubCommand extends SubCommand {

    /**
     * InviteSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("invite", "/faction invite <player>");
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
        if($sender->getFactionRole() === Faction::MEMBER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if(count($sender->getFaction()->getMembers()) >= Faction::MAX_MEMBERS) {
            $sender->sendMessage(Translation::getMessage("factionMaxMembers", [
                "faction" => TextFormat::RED . $sender->getFaction()->getName()
            ]));
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
        $sender->getFaction()->addInvite($player);
        $sender->sendMessage(Translation::getMessage("inviteSentSender", [
            "name" => TextFormat::GREEN . $player->getName()
        ]));
        $player->sendMessage(Translation::getMessage("inviteSentPlayer", [
            "faction" => TextFormat::GREEN . $sender->getFaction()->getName()
        ]));
    }
}