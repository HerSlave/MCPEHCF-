<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class TellLocationCommand extends Command {

    /**
     * TellLocationCommand constructor.
     */
    public function __construct() {
        parent::__construct("telllocation", "Broadcast current location to faction members.", "/telllocation", ["tl"]);
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
        foreach($sender->getFaction()->getOnlineMembers() as $player) {
            $player->sendMessage(Translation::getMessage("location", [
                "name" => TextFormat::GREEN . $sender->getName(),
                "x" => $sender->getFloorX(),
                "y" => $sender->getFloorY(),
                "z" => $sender->getFloorZ()
            ]));
        }
    }
}