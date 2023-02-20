<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\faction\Faction;
use hcf\groups\Group;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class SetGroupCommand extends Command {

    /**
     * SetGroupCommand constructor.
     */
    public function __construct() {
        parent::__construct("setgroup", "Set a player's group.", "/setgroup <player> <group>");
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
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT groupId FROM players WHERE username = ?");
            $stmt->bind_param("s", $args[0]);
            $stmt->execute();
            $stmt->bind_result($groupId);
            $stmt->fetch();
            $stmt->close();
            if($groupId === null) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
        }
        $group = $this->getCore()->getGroupManager()->getGroupByName($args[1]);
        if(!$group instanceof Group) {
            $sender->sendMessage(Translation::getMessage("invalidGroup"));
            $sender->sendMessage(TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "GROUPS:");
            $sender->sendMessage(TextFormat::WHITE . implode(", ", $this->getCore()->getGroupManager()->getGroups()));
            return;
        }
        if(isset($groupId)) {
            $id = $group->getIdentifier();
            $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("UPDATE players SET groupId = ? WHERE username = ?");
            $stmt->bind_param("is", $id, $args[0]);
            $stmt->execute();
            $stmt->close();
        }
        else {
            $player->setGroup($group);
        }
        $sender->sendMessage(Translation::getMessage("setGroupSuccess", [
            "group" => $group->getColoredName(),
            "name" => TextFormat::GOLD . $player instanceof HCFPlayer ? $player->getName() : $args[0]
        ]));
        $player->setNameTag($group->getTagFormatFor($player, [
            "faction_rank" => $player->getFactionRoleToString(),
            "faction" => ($faction = $player->getFaction()) instanceof Faction ? $faction->getName() : ""
        ]));
    }
}