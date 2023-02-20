<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class PingCommand extends Command {

    /**
     * PingCommand constructor.
     */
    public function __construct() {
        parent::__construct("ping", "Check ping.", "/ping [player]");
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
        if(isset($args[0])) {
            $player = $this->getCore()->getServer()->getPlayer($args[0]);
            if($player === null) {
                $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                return;
            }
        }
        if(isset($player)) {
            $ping = $player->getPing();
            $name = $player->getName() . "'s";
        }
        else {
            $ping = $sender->getPing();
            $name = "Your";
        }
        $sender->sendMessage(TextFormat::DARK_RED . "$name ping: " .  TextFormat::WHITE . "$ping milliseconds");
    }
}