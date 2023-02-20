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

class ExoticCrate extends Crate {

    /**
     * ExoticCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::EXOTIC, $position, [
            new Reward(new CustomItem(Item::DIAMOND_HELMET, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Helmet", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_HELMET, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Helmet");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_CHESTPLATE, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Chestplaate", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Chestplate");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_LEGGINGS, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Leggings", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Leggings");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_BOOTS, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Boots", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 4)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 4));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Boots");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Fortune Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Fortune Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Silk Touch Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 4),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 4));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Silk Touch Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Looting Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 2)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 2)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Looting Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::BOW, TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Bow", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 2))
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::BOW, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 2)));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Exotic " . TextFormat::RESET . TextFormat::DARK_PURPLE . "Bow");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x2)"), function(HCFPlayer $player) {
                $player->addLives(2);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x3)"), function(HCFPlayer $player) {
                $player->addLives(3);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x4)"), function(HCFPlayer $player) {
                $player->addLives(4);
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
            new Reward(Item::get(Item::EXPERIENCE_BOTTLE, 0, 64), function(HCFPlayer $player) {
                $item = Item::get(Item::EXPERIENCE_BOTTLE, 0, 64);
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
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 2), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 3);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 4), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 4);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLDEN_APPLE, 0, 12), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLDEN_APPLE, 0, 12);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::COBWEB, 0, 32), function(HCFPlayer $player) {
                $item = Item::get(Item::COBWEB, 0, 32);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::IRON_BLOCK, 0, 24), function(HCFPlayer $player) {
                $item = Item::get(Item::IRON_BLOCK, 0, 24);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLD_BLOCK, 0, 24), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLD_BLOCK, 0, 24);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::DIAMOND_BLOCK, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BLOCK, 0, 16);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EMERALD_BLOCK, 0, 12), function(HCFPlayer $player) {
                $item = Item::get(Item::EMERALD_BLOCK, 0, 12);
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
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "Exotic Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
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
