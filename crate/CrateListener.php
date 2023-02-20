<?php

namespace hcf\crate;

use hcf\HCF;
use hcf\HCFPlayer;
use hcf\item\CustomItem;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;

class CrateListener implements Listener {

    /** @var HCF */
    private $core;

    /**
     * CrateListener constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
    }

    /**
     * @param PlayerJoinEvent $event
     */
    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        foreach($this->core->getCrateManager()->getCrates() as $crate) {
            $crate->spawnTo($player);
        }
    }

    /**
     * @priority LOWEST
     * @param PlayerInteractEvent $event
     *
     * @throws TranslationException
     */
    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $value = false;
        $block = $event->getBlock();
        $currentCrate = null;
        foreach($this->core->getCrateManager()->getCrates() as $crate) {
            if($crate->getPosition()->equals($block)) {
                $event->setCancelled();
                $currentCrate = $crate;
                $value = true;
                break;
            }
        }
        if($value === false) {
            return;
        }
        if($event->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK) {
            $item = $player->getInventory()->getItemInHand();
            $tag = $item->getNamedTagEntry(CustomItem::CUSTOM);
            if($tag instanceof CompoundTag) {
                if($item->getId() === Item::TRIPWIRE_HOOK) {
                    $crate = $this->core->getCrateManager()->getCrate($tag->getString(CrateKey::CRATE));
                    if($crate->getPosition()->equals($event->getBlock())) {
                        $crate->try($player);
                        return;
                    }
                }
            }
            else {
                $player->sendMessage(Translation::getMessage("noKeys"));
                $player->knockBack($player, 0, $player->getX() - $block->getX(), $player->getZ() - $block->getZ(), 1);
            }
        }
        if($event->getAction() === PlayerInteractEvent::LEFT_CLICK_BLOCK) {
            $currentCrate->getInventory()->send($player);
        }
    }
}