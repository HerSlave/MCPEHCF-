<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ChatSubCommand extends SubCommand {

    /**
     * ChatSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("chat", "/faction chat [mode]", ["c"]);
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
        if(isset($args[1])) {
            switch($args[1]) {
                case "p":
                case "public":
                    $mode = HCFPlayer::PUBLIC;
                    break;
                case "a":
                case "ally":
                    $mode = HCFPlayer::ALLY;
                    break;
                case "f":
                case "faction":
                    $mode = HCFPlayer::FACTION;
                    break;
                default:
                    $mode = $sender->getChatMode() + 1;
                    break;
            }
        }
        else {
            $mode = $sender->getChatMode() + 1;
        }
        if($mode > 2) {
            $mode = 0;
        }
        $sender->setChatMode($mode);
        $sender->sendMessage(Translation::getMessage("chatModeSwitch", [
            "mode" =>  TextFormat::GREEN . strtoupper($sender->getChatModeToString())
        ]));
    }
}