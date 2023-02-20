<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\task\TeleportHomeTask;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\utils\TextFormat;

class HomeSubCommand extends SubCommand {

    /**
     * HomeSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("home", "/faction home");
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
        if($sender->getFaction()->getHome() === null) {
            $sender->sendMessage(Translation::getMessage("homeNotSet"));
            return;
        }
        if($sender->isInvincible() and $this->getCore()->isStartOfTheWorld() === false) {
            $sender->sendMessage(Translation::getMessage("mayNotEnterWhilePvpTimerOn"));
            return;
        }
        if(($claim = $this->getCore()->getFactionManager()->getClaimInPosition($sender->asPosition())) !== null and $claim->getFaction()->isInFaction($sender) === false) {
            $sender->sendMessage(Translation::getMessage("teleportHomeInClaim"));
            return;
        }
        if($claim !== null and $claim->getFaction()->isInFaction($sender) === true) {
            $home = $sender->getFaction()->getHome();
            $sender->teleport($home);
            $sender->sendMessage(TextFormat::GREEN . "You have successfully teleport to your location.");
            $sender->getLevel()->addSound(new EndermanTeleportSound($sender));
            return;
        }
        $areas = $this->getCore()->getAreaManager()->getAreasInPosition($sender);
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getPvpFlag() === false) {
                    $home = $sender->getFaction()->getHome();
                    $sender->teleport($home);
                    $sender->sendMessage(TextFormat::GREEN . "You have successfully teleport to your location.");
                    $sender->getLevel()->addSound(new EndermanTeleportSound($sender));
                    return;
                }
            }
        }
        if($sender->isTeleporting()) {
            return;
        }
        $sender->setTeleporting();
        $this->getCore()->getScheduler()->scheduleRepeatingTask(new TeleportHomeTask($sender, 10), 20);
    }
}