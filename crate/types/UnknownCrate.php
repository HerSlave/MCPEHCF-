<?php

namespace hcf\crate\types;

use hcf\crate\Crate;
use hcf\crate\Reward;
use hcf\HCF;
use hcf\HCFPlayer;
use hcf\item\CustomItem;
use hcf\item\types\CrateKey;
use hcf\item\types\Crowbar;
use hcf\translation\Translation;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;

class UnknownCrate extends Crate {

    /**
     * UnknownCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::UNKNOWN, $position, [
            new Reward(new CustomItem(Item::DIAMOND_HELMET, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Helmet", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_HELMET, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Helmet");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_CHESTPLATE, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Chestplate", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION ));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Chestplate");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_LEGGINGS, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Leggings", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Leggings");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_BOOTS, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Boots", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 4)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), HCF::MAX_PROTECTION));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 4));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Boots");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Fortune Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 4),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 4));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Fortune Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Silk Touch Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 5),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 5));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 4));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Silk Touch Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Fire Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), HCF::MAX_SHARPNESS),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FIRE_ASPECT), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), HCF::MAX_SHARPNESS));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FIRE_ASPECT), 2));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Fire Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Looting Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), HCF::MAX_SHARPNESS),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), HCF::MAX_SHARPNESS));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Looting Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::BOW, TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Bow", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), HCF::MAX_POWER),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::INFINITY), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::BOW, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), HCF::MAX_POWER));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::INFINITY), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::DARK_RED . "Summer " . TextFormat::RESET . TextFormat::RED . "Bow");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x4)"), function(HCFPlayer $player) {
                $player->addLives(4);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x5)"), function(HCFPlayer $player) {
                $player->addLives(5);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x6)"), function(HCFPlayer $player) {
                $player->addLives(6);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
            }),
            new Reward(new CustomItem(Item::TRIPWIRE_HOOK, TextFormat::RESET . TextFormat::RED . TextFormat::BOLD . "Ability Key", [
                "",
                TextFormat::RESET . TextFormat::GRAY . "Tap the Ability Crate to receive rewards."
            ]), function(HCFPlayer $player) {
                $item = new CrateKey(HCF::getInstance()->getCrateManager()->getCrate(Crate::ABILITY));
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EXPERIENCE_BOTTLE, 0, 96), function(HCFPlayer $player) {
                $item = Item::get(Item::EXPERIENCE_BOTTLE, 0, 96);
                $player->getInventory()->addItem($item);
            }),
            new Reward(new Crowbar(1, 6), function(HCFPlayer $player) {
                $item = new Crowbar(1, 6);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::BEACON, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::BEACON, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 8);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLDEN_APPLE, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLDEN_APPLE, 0, 16);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 2), function(HCFPlayer $player) {
                $item = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 2);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::COBWEB, 0, 48), function(HCFPlayer $player) {
                $item = Item::get(Item::COBWEB, 0, 48);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::IRON_BLOCK, 0, 32), function(HCFPlayer $player) {
                $item = Item::get(Item::IRON_BLOCK, 0, 32);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLD_BLOCK, 0, 32), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLD_BLOCK, 0, 32);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::DIAMOND_BLOCK, 0, 24), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BLOCK, 0, 24);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EMERALD_BLOCK, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::EMERALD_BLOCK, 0, 16);
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
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::DARK_RED . TextFormat::BOLD .  "UNKNOWN Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
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
