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

class MysteriousCrate extends Crate {

    /**
     * MysteriousCrate constructor.
     *
     * @param Position $position
     */
    public function __construct(Position $position) {
        parent::__construct(self::MYSTERIOUS, $position, [
            new Reward(new CustomItem(Item::DIAMOND_HELMET, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Helmet", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_HELMET, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Helmet");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_CHESTPLATE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Chestplate", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_CHESTPLATE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Chestplate");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_LEGGINGS, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Leggings", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_LEGGINGS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Leggings");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_BOOTS, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Boots", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BOOTS, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::PROTECTION), ceil(HCF::MAX_PROTECTION / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 1));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FEATHER_FALLING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Boots");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Fortune Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 2));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::FORTUNE), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Fortune Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_PICKAXE, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Silk Touch Pickaxe", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_PICKAXE, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::EFFICIENCY), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SILK_TOUCH), 1));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Silk Touch Pickaxe");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::DIAMOND_SWORD, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Looting Sword", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 4)),
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2)
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_SWORD, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::SHARPNESS), ceil(HCF::MAX_SHARPNESS / 4)));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::LOOTING), 3));
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::UNBREAKING), 2));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Looting Sword");
                $player->getInventory()->addItem($item);
            }),
            new Reward(new CustomItem(Item::BOW, TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Bow", [], [
                new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 4))
            ]), function(HCFPlayer $player) {
                $item = Item::get(Item::BOW, 0, 1);
                $item->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(Enchantment::POWER), ceil(HCF::MAX_POWER / 4)));
                $item->setCustomName(TextFormat::RESET . TextFormat::BOLD . TextFormat::GREEN . "Mysterious " . TextFormat::RESET . TextFormat::DARK_GREEN . "Bow");
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
            new Reward(Item::get(Item::EXPERIENCE_BOTTLE, 0, 32), function(HCFPlayer $player) {
                $item = Item::get(Item::EXPERIENCE_BOTTLE, 0, 32);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::END_PORTAL_FRAME, 0, 1), function(HCFPlayer $player) {
                $item = Item::get(Item::END_PORTAL_FRAME, 0, 1);
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
            new Reward(Item::get(Item::COBWEB, 0, 16), function(HCFPlayer $player) {
                $item = Item::get(Item::COBWEB, 0, 16);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::IRON_BLOCK, 0, 12), function(HCFPlayer $player) {
                $item = Item::get(Item::IRON_BLOCK, 0, 12);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::GOLD_BLOCK, 0, 12), function(HCFPlayer $player) {
                $item = Item::get(Item::GOLD_BLOCK, 0, 12);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::DIAMOND_BLOCK, 0, 8), function(HCFPlayer $player) {
                $item = Item::get(Item::DIAMOND_BLOCK, 0, 8);
                $player->getInventory()->addItem($item);
            }),
            new Reward(Item::get(Item::EMERALD_BLOCK, 0, 6), function(HCFPlayer $player) {
                $item = Item::get(Item::EMERALD_BLOCK, 0, 6);
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
        $player->addFloatingText(Position::fromObject($this->getPosition()->add(0.5, 1.5, 0.5), $this->getPosition()->getLevel()), $this->getName(), TextFormat::GREEN . TextFormat::BOLD . "Mysterious Crate\n" . TextFormat::RESET . TextFormat::WHITE . "Left click to view rewards\nRight Click to open crate");
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
