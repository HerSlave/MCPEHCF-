<?php

namespace hcf\command\types;

use hcf\command\modalForm\KitListForm;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class KitCommand extends Command {

    /**
     * KitCommand constructor.
     */
    public function __construct() {
        parent::__construct("kit", "Manage your kits", "/kit");
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
        $sender->sendForm(new KitListForm($sender));
    }
}