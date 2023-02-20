<?php

namespace hcf\groups;

use hcf\faction\Faction;
use hcf\HCF;
use hcf\HCFPlayer;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

class GroupListener implements Listener {

    /** @var HCF */
    private $core;

    /**
     * GroupListener constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
    }

    /**
     * @priority HIGHEST
     * @param PlayerChatEvent $event
     */
    public function onPlayerChat(PlayerChatEvent $event): void {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getPlayer();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $mode = $player->getChatMode();
        $faction = $player->getFaction();
        if($faction === null and ($mode === HCFPlayer::FACTION or $mode === HCFPlayer::ALLY)) {
            $mode = HCFPlayer::PUBLIC;
            $player->setChatMode($mode);
        }
        if($mode === HCFPlayer::PUBLIC) {
            $event->setFormat($player->getGroup()->getChatFormatFor(
                $player, $event->getMessage(), [
                "faction_rank" => $player->getFactionRoleToString(),
                "faction" => ($faction = $player->getFaction()) instanceof Faction ? $faction->getName() : ""
            ]));
            return;
        }
        $event->setCancelled();
        if($mode === HCFPlayer::STAFF) {
            /** @var HCFPlayer $staff */
            foreach($this->core->getServer()->getOnlinePlayers() as $staff) {
                $group = $staff->getGroup();
                if($group->getIdentifier() >= Group::TRAINEE and $group->getIdentifier() <= Group::OWNER) {
                    $staff->sendMessage(TextFormat::DARK_GRAY . "[" . $player->getGroup()->getColoredName() . TextFormat::RESET . TextFormat::DARK_GRAY . "] " . TextFormat::WHITE . $player->getName() . TextFormat::GRAY . ": " . $event->getMessage());
                }
            }
            return;
        }
        if($player->getChatMode() === HCFPlayer::FACTION) {
            $onlinePlayers = $faction->getOnlineMembers();
            foreach($onlinePlayers as $onlinePlayer) {
                $onlinePlayer->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::BOLD . TextFormat::RED . "FC" . TextFormat::RESET . TextFormat::DARK_GRAY . "] " . TextFormat::WHITE . $player->getName() . TextFormat::GRAY . ": " . $event->getMessage());
            }
        }
        else {
            $allies = $faction->getAllies();
            $onlinePlayers = $faction->getOnlineMembers();
            foreach($allies as $ally) {
                if(($ally = $this->core->getFactionManager()->getFaction($ally)) === null) {
                    continue;
                }
                $onlinePlayers = array_merge($ally->getOnlineMembers(), $onlinePlayers);
            }
            foreach($onlinePlayers as $onlinePlayer) {
                $onlinePlayer->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::BOLD . TextFormat::GOLD . "AC" . TextFormat::RESET . TextFormat::DARK_GRAY . "] " . TextFormat::WHITE . $player->getName() . TextFormat::GRAY . ": " . $event->getMessage());
            }
        }
    }

    /**
     * @priority NORMAL
     * @param EntityRegainHealthEvent $event
     */
    public function onEntityRegainHealth(EntityRegainHealthEvent $event): void {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getEntity();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $player->setScoreTag(TextFormat::WHITE . floor($player->getHealth()) . TextFormat::RED . TextFormat::BOLD . " HP");
    }

    /**
     * @priority NORMAL
     * @param EntityDamageEvent $event
     */
    public function onEntityDamage(EntityDamageEvent $event): void {
        if($event->isCancelled()) {
            return;
        }
        $player = $event->getEntity();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $player->setScoreTag(TextFormat::WHITE . floor($player->getHealth()) . TextFormat::RED . TextFormat::BOLD . " HP");
    }
}