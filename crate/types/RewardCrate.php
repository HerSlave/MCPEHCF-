<?php

namespace hcf\crate\types;

use hcf\crate\Crate;
use hcf\crate\Reward;
use hcf\HCF;
use hcf\HCFPlayer;
use hcf\item\CustomItem;
use hcf\item\types\CrateKey;
use hcf\translation\Translation;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;

class RewardCrate extends Crate {

    /**
     * RewardCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::REWARD, $position, [
            new Reward(new CustomItem(Item::DIAMOND_HELMET, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Helmet"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_HELMET, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Helmet");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_CHESTPLATE, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Chestplate"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Chestplate");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_LEGGINGS, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Leggings"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Leggings");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_BOOTS, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Boots"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Boots");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Pickaxe"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_AQUA . "Sword"), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::AQUA . "Reward " . TextFormat::RESET . TextFormat::DARK_GREEN . "Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x1)"), function(HCFPlayer $player) {
                $player->addLives(1);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => $player->getLives()
                ]));
            }),
            new Reward(Item::get(Item::EXPERIENCE_BOTTLE, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::EXPERIENCE_BOTTLE, 0, 8);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLDEN_APPLE, 0, 3), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLDEN_APPLE, 0, 3);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::COBWEB, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::COBWEB, 0, 8);
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::TRIPWIRE_HOOK, TextFormat::RESET . TextFormat::RED . TextFormat::BOLD . "Mysterious Key", [
                "",
                TextFormat::RESET . TextFormat::GRAY . "Tap the Mysterious Crate to receive rewards."
            ]), function(HCFPlayer $player) {
                $item = new CrateKey(HCF::getInstance()->getCrateManager()->getCrate(Crate::MYSTERIOUS));
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::TRIPWIRE_HOOK, TextFormat::RESET . TextFormat::RED . TextFormat::BOLD . "Ability Key", [
                "",
                TextFormat::RESET . TextFormat::GRAY . "Tap the Ability Crate to receive rewards."
            ]), function(HCFPlayer $player) {
                $item = new CrateKey(HCF::getInstance()->getCrateManager()->getCrate(Crate::ABILITY));
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::IRON_BLOCK, 0, 3), function(HCFPlayer $player) {
                $item = Item::get(Item::IRON_BLOCK, 0, 3);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLD_BLOCK, 0, 3), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLD_BLOCK, 0, 3);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::DIAMOND_BLOCK, 0, 2), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BLOCK, 0, 2);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EMERALD_BLOCK, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::EMERALD_BLOCK, 0, 1);
                $player->getInventory()->addItem($item);
            })
        ]);
    }

    /**
     * @param HCFPlayer $player
     */
    public function spawnTo(HCFPlayer $player): void {
        $particle = $player->getFloatingText($this->getName());
        if($particle !== null) {
            return;
        }
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::AQUA . TextFormat::BOLD . "Reward Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
    }

    /**
     * @param HCFPlayer $player
     */
    public function despawnTo(HCFPlayer $player): void {
        $particle = $player->getFloatingText($this->getName());
        if($particle !== null) {
            $particle->despawn($player);
        }
    }
}
