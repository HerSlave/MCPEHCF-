<?php

namespace hcf\area;

use hcf\HCF;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;

class AreaListener implements Listener {

    /** @var HCF */
    private $core;

    /**
     * AreaListener constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
    }

    /**
     * @priority HIGH
     * @param PlayerInteractEvent $event
     *
     * @throws  TranslationException
     */
    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        if((!$player instanceof HCFPlayer) or $player->isOp()) {
            return;
        }
        $block = $event->getBlock();
        $item = $event->getItem();
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($block->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getEditFlag() === false and ($item->getId() === Item::BUCKET or $item->getId() === Item::FLINT_AND_STEEL)) {
                    $event->setCancelled();
                    return;
                }
            }
        }
    }

    /**
     * @priority LOWEST
     * @param PlayerExhaustEvent $event
     */
    public function onPlayerExhaust(PlayerExhaustEvent $event): void {
        $player = $event->getPlayer();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getPvpFlag() === false) {
                    $event->setCancelled();
                    return;
                }
            }
        }
    }

    /**
     * @priority LOWEST
     * @param BlockBreakEvent $event
     *
     * @throws TranslationException
     */
    public function onBlockBreak(BlockBreakEvent $event): void {
        $block = $event->getBlock();
        $player = $event->getPlayer();
        if((!$player instanceof HCFPlayer) or $player->isOp()) {
            return;
        }
        if(abs($block->getX()) < HCF::EDIT and abs($block->getZ()) < HCF::EDIT and $player->getLevel()->getName() === $this->core->getServer()->getDefaultLevel()->getName()) {
            $player->sendMessage(Translation::getMessage("buildNearSpawn"));
            $event->setCancelled();
            return;
        }
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($block->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getEditFlag() === false) {
                    $player->sendMessage(Translation::getMessage("noPermission"));
                    $event->setCancelled();
                    return;
                }
            }
        }
        if($player->getLevel()->getFolderName() !== "wild") {
            $event->setCancelled();
            return;
        }
    }

    /**
     * @priority LOWEST
     * @param BlockPlaceEvent $event
     *
     * @throws TranslationException
     */
    public function onBlockPlace(BlockPlaceEvent $event): void {
        $block = $event->getBlock();
        $player = $event->getPlayer();
        if((!$player instanceof HCFPlayer) or $player->isOp()) {
            return;
        }
        if(abs($block->getX()) < HCF::EDIT and abs($block->getZ()) < HCF::EDIT and $player->getLevel()->getName() === $this->core->getServer()->getDefaultLevel()->getName()) {
            $player->sendMessage(Translation::getMessage("buildNearSpawn"));
            $event->setCancelled();
            return;
        }
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($block->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getEditFlag() === false) {
                    $player->sendMessage(Translation::getMessage("noPermission"));
                    $event->setCancelled();
                    return;
                }
            }
        }
        if($player->getLevel()->getFolderName() !== "wild") {
            $event->setCancelled();
            return;
        }
    }

    /**
     * @priority LOWEST
     * @param EntityDamageEvent $event
     */
    public function onEntityDamage(EntityDamageEvent $event): void {
        $entity = $event->getEntity();
        if(!$entity instanceof HCFPlayer) {
            return;
        }
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($entity->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getPvpFlag() === false) {
                    $event->setCancelled();
                    return;
                }
            }
        }
    }

    /**
     * @priority LOWEST
     * @param ProjectileLaunchEvent $event
     */
    public function onProjectileLaunch(ProjectileLaunchEvent $event): void {
        $entity = $event->getEntity();
        if(!$entity instanceof HCFPlayer) {
            return;
        }
        $areaManager = $this->core->getAreaManager();
        $areas = $areaManager->getAreasInPosition($entity->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getPvpFlag() === false) {
                    $event->setCancelled();
                    return;
                }
            }
        }
    }
}