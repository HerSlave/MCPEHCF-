<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class KickSubCommand extends SubCommand {

    /**
     * KickSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("kick", "/faction kick <player>");
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
        $player = $this->getCore()->getServer()->getPlayer($args[1]) !== null ? $this->getCore()->getServer()->getPlayer($args[1]) : $args[1];
        if(!$sender->getFaction()->isInFaction($player)) {
            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
            return;
        }
        if($player instanceof HCFPlayer) {
            $role = $player->getFactionRole();
            $name = $player->getName();
        }
        else {
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT factionRole FROM players WHERE username = ?");
            $stmt->bind_param("s", $player);
            $stmt->execute();
            $stmt->bind_result($role);
            $stmt->fetch();
            $stmt->close();
            $name = $args[1];
        }
        if($sender->getFactionRole() < $role) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        foreach($sender->getFaction()->getOnlineMembers() as $member) {
            $member->sendMessage(Translation::getMessage("factionLeave", [
                "name" => TextFormat::GREEN . $name
            ]));
        }
        $sender->getFaction()->removeMember($player);
    }
}