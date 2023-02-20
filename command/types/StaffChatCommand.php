<?php

namespace hcf\command\types;

use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class StaffChatCommand extends Command {

    /**
     * StaffChatCommand constructor.
     */
    public function __construct() {
        parent::__construct("staffchat", "Toggle staff chat.", "/staffchat", ["sc"]);
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if((!$sender instanceof HCFPlayer) or (!$sender->hasPermission("permission.staff"))) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $mode = HCFPlayer::PUBLIC;
        if($sender->getChatMode() !== HCFPlayer::STAFF) {
            $mode = HCFPlayer::STAFF;
        }
        $sender->setChatMode($mode);
        $sender->sendMessage(Translation::getMessage("chatModeSwitch", [
            "mode" =>  TextFormat::GREEN . strtoupper($sender->getChatModeToString())
        ]));
    }
}