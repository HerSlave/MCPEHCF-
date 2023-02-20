<?php

namespace hcf\command\modalForm;

use hcf\HCF;
use hcf\HCFPlayer;
use hcf\kit\task\SetClassTask;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use libs\form\MenuForm;
use libs\form\MenuOption;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class KitListForm extends MenuForm {

    /**
     * KitListForm constructor.
     *
     * @param HCFPlayer $player
     */
    public function __construct(HCFPlayer $player) {
        $title = TextFormat::BOLD . TextFormat::AQUA . "Kits";
        $text = "Select a kit. Any extra items will be dropped!";
        $kits = $player->getCore()->getKitManager()->getKits();
        $options = [];
        foreach($kits as $kit) {
            $options[] = new MenuOption($kit->getName());
        }
        parent::__construct($title, $text, $options);
    }

    /**
     * @param Player $player
     * @param int $selectedOption
     *
     * @throws TranslationException
     */
    public function onSubmit(Player $player, int $selectedOption): void {
        if(!$player instanceof HCFPlayer) {
            return;
        }
        $uuid = $player->getRawUniqueId();
        $name = $this->getOption($selectedOption)->getText();
        $time = time();
        $lowercaseName = strtolower($name);
        if(!$player->hasPermission("kit.$lowercaseName")) {
            $player->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        $kit = $player->getCore()->getKitManager()->getKitByName($name);
        $stmt = $player->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT $lowercaseName FROM kitCooldowns WHERE uuid = ?");
        $stmt->bind_param("s", $uuid);
        $stmt->execute();
        $stmt->bind_result($cooldown);
        $stmt->fetch();
        $stmt->close();
        $cooldown = $kit->getCooldown() - ($time - $cooldown);
        if($cooldown > 0) {
            $days = floor($cooldown / 86400);
            $hours = $hours = floor(($cooldown / 3600) % 24);
            $minutes = floor(($cooldown / 60) % 60);
            $seconds = $time % 60;
            $time = "$days days, $hours hours, $minutes minutes, $seconds seconds";
            $player->sendMessage(Translation::getMessage("kitCooldown", [
                "time" => TextFormat::RED . $time
            ]));
            return;
        }
        $player->addTitle(TextFormat::GREEN . TextFormat::BOLD . "Equipped", TextFormat::GRAY . $name . " Kit");
        foreach($kit->getItems() as $index => $item) {
            $id = $item->getId();
            if($id === Item::CHAIN_HELMET or $id === Item::GOLD_HELMET or $id === Item::IRON_HELMET or $id === Item::DIAMOND_HELMET or $id === Item::LEATHER_CAP) {
                if($player->getArmorInventory()->isSlotEmpty(ArmorInventory::SLOT_HEAD) === false) {
                    $player->getLevel()->dropItem($player, $item);
                    continue;
                }
                $player->getArmorInventory()->setHelmet($item);
                continue;
            }
            if($id === Item::CHAIN_CHESTPLATE or $id === Item::GOLD_CHESTPLATE or $id === Item::IRON_CHESTPLATE or $id === Item::DIAMOND_CHESTPLATE or $id === Item::LEATHER_CHESTPLATE) {
                if($player->getArmorInventory()->isSlotEmpty(ArmorInventory::SLOT_CHEST) === false) {
                    $player->getLevel()->dropItem($player, $item);
                    continue;
                }
                $player->getArmorInventory()->setChestplate($item);
                continue;
            }
            if($id === Item::CHAIN_LEGGINGS or $id === Item::GOLD_LEGGINGS or $id === Item::IRON_LEGGINGS or $id === Item::DIAMOND_LEGGINGS or $id === Item::LEATHER_LEGGINGS) {
                if($player->getArmorInventory()->isSlotEmpty(ArmorInventory::SLOT_LEGS) === false) {
                    $player->getLevel()->dropItem($player, $item);
                    continue;
                }
                $player->getArmorInventory()->setLeggings($item);
                continue;
            }
            if($id === Item::CHAIN_BOOTS or $id === Item::GOLD_BOOTS or $id === Item::IRON_BOOTS or $id === Item::DIAMOND_BOOTS or $id === Item::LEATHER_BOOTS) {
                if($player->getArmorInventory()->isSlotEmpty(ArmorInventory::SLOT_FEET) === false) {
                    $player->getLevel()->dropItem($player, $item);
                    continue;
                }
                $player->getArmorInventory()->setBoots($item);
                continue;
            }
            if($player->getInventory()->canAddItem($item)) {
                $player->getInventory()->addItem($item);
                continue;
            }
            $player->getLevel()->dropItem($player, $item);
        }
        $stmt = $player->getCore()->getMySQLProvider()->getDatabase()->prepare("UPDATE kitCooldowns SET $lowercaseName = ? WHERE uuid = ?");
        $stmt->bind_param("is", $time, $uuid);
        $stmt->execute();
        $stmt->close();
        HCF::getInstance()->getScheduler()->scheduleDelayedTask(new SetClassTask($player), 1);
        return;
    }
}