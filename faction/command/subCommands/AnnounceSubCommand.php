<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class AnnounceSubCommand extends SubCommand {

    /**
     * AnnounceSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("announce", "/faction announce <message>");
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
        if(!isset($args[1])) {
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        if($sender->getFaction() === null) {
            $sender->sendMessage(Translation::getMessage("beInFaction"));
            return;
        }
        if($sender->getFactionRole() < Faction::OFFICER) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        array_shift($args);
        $message = implode(" ", $args);
        foreach($sender->getFaction()->getOnlineMembers() as $player) {
            $player->addTitle(TextFormat::GREEN . TextFormat::BOLD . "Announcement", TextFormat::GRAY . $message, 20, 60, 20);
        }
    }
}