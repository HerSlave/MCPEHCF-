<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;

class SpectateCommand extends Command {

    /**
     * SpectateCommand constructor.
     */
    public function __construct() {
        parent::__construct("spectate", "Spectate a player.", "/spectate <on/off> [player}");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if($sender instanceof HCFPlayer) {
            if(isset($args[0])) {
                if(!$sender->isOp()) {
                    if(!$sender->hasPermission("permission.staff")) {
                        $sender->sendMessage(Translation::getMessage("noPermission"));
                        return;
                    }
                }
                switch($args[0]) {
                    case "on":
                        if(!isset($args[1])) {
                            $sender->sendMessage(Translation::getMessage("usageMessage", [
                                "usage" => $this->getUsage()
                            ]));
                            return;
                        }
                        $player = $this->getCore()->getServer()->getPlayer($args[1]);
                        if($player === null) {
                            $sender->sendMessage(Translation::getMessage("invalidPlayer"));
                            return;
                        }
                        $sender->teleport($player);
                        $sender->setGamemode(HCFPlayer::SPECTATOR);
                        break;
                    case "off":
                        if($sender->getGamemode() === HCFPlayer::SPECTATOR) {
                            $sender->setGamemode(HCFPlayer::SURVIVAL);
                            $sender->teleport($this->getCore()->getServer()->getDefaultLevel()->getSpawnLocation());
                        }
                        break;
                }
                return;
            }
            $sender->sendMessage(Translation::getMessage("usageMessage", [
                "usage" => $this->getUsage()
            ]));
            return;
        }
        $sender->sendMessage(Translation::getMessage("noPermission"));
        return;
    }
}