<?php

namespace hcf\crate\types;

use hcf\crate\Crate;
use hcf\crate\Reward;
use hcf\HCF;
use hcf\HCFPlayer;
use hcf\item\CustomItem;
use hcf\translation\Translation;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\utils\TextFormat;

class AncientCrate extends Crate {

    /**
     * AncientCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::ANCIENT, $position, [
            new Reward(new CustomItem(Item::DIAMOND_HELMET, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Helmet", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_HELMET, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Helmet");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_CHESTPLATE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Chestplate", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Chestplate");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_LEGGINGS, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Leggings", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Leggings");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_BOOTS, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Boots", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Boots");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Fortune Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Fortune Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Silk Touch Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 3));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Silk Touch Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Looting Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 3)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 3)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Looting Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::BOW, TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Bow", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 3))
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::BOW, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 3)));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GOLD . "Ancient " . TextFormat::RESET . TextFormat::YELLOW . "Bow");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::APPLE, TextFormat::RESET . TextFormat::GREEN . TextFormat::BOLD . "Lives (x1)"), function(HCFPlayer $player) {
                $player->addLives(1);
                $player->sendMessage(Translation::getMessage("lives", [
                    "amount" => TextFormat::GREEN . $player->getLives()
                ]));
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
            new Reward(Item::get(Item::EXPERIENCE_BOTTLE, 0, 48), function(HCFPlayer $player) {
                $item = Item::get(Item::EXPERIENCE_BOTTLE, 0, 48);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::BEACON, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::BEACON, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 2), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 2);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLDEN_APPLE, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLDEN_APPLE, 0, 8);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::ENCHANTED_GOLDEN_APPLE, 0, 1);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::COBWEB, 0, 24), function(HCFPlayer $player) {
                $item = Item::get(Item::COBWEB, 0, 24);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::IRON_BLOCK, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::IRON_BLOCK, 0, 16);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLD_BLOCK, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLD_BLOCK, 0, 16);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::DIAMOND_BLOCK, 0, 12), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BLOCK, 0, 12);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EMERALD_BLOCK, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::EMERALD_BLOCK, 0, 8);
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
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::GOLD . TextFormat::BOLD . "Ancient Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
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
