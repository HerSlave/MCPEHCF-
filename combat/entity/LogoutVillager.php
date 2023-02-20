<?php

namespace hcf\combat\entity;

use hcf\HCF;
use hcf\HCFPlayer;
use hcf\level\LevelManager;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\entity\Entity;
use pocketmine\entity\Villager;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\Item;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\utils\TextFormat;

class LogoutVillager extends Villager {

    /** @var string */
    private $name = "";

    /** @var int */
    private $time;

    public function initEntity(): void {
        parent::initEntity();
        $this->setMaxHealth(200);
        $this->setHealth(200);
    }

    /**
     * @param int $tickDiff
     *
     * @return bool
     */
    public function entityBaseTick(int $tickDiff = 1): bool {
        parent::entityBaseTick($tickDiff);
        $server = HCF::getInstance()->getServer();
        if($server->getPlayer($this->name) !== null) {
            $this->flagForDespawn();
            return false;
        }
        if((!$this->isAlive()) and (!$this->closed)) {
            $this->flagForDespawn();
            return false;
        }
        if($this->name === null) {
            return false;
        }
        $time = 120 - (time() - $this->time);
        if($time <= 0) {
            LevelManager::fakeDeath($this);
            $this->getLevel()->broadcastLevelSoundEvent($this, LevelSoundEventPacket::SOUND_HURT);
            $this->flagForDespawn();
            return false;
        }
        $minutes = floor($time / 60);
        $seconds = $time % 60;
        if($seconds < 10) {
            $seconds = "0$seconds";
        }
        $this->setNameTag(TextFormat::YELLOW . TextFormat::BOLD . $this->name . " " . TextFormat::RESET . TextFormat::WHITE . floor($this->getHealth()) . TextFormat::RED . TextFormat::BOLD . " HP " . TextFormat::RESET . TextFormat::GREEN . "$minutes:$seconds");
        return $this->isAlive();
    }

    /**
     * @param EntityDamageEvent $source
     *
     * @throws TranslationException
     */
    public function attack(EntityDamageEvent $source): void {
        if(($this->getHealth() - $source->getFinalDamage()) > 0) {
            parent::attack($source);
            return;
        }
        $server = HCF::getInstance()->getServer();
        $stmt = HCF::getInstance()->getMySQLProvider()->getDatabase()->prepare("SELECT kills FROM players WHERE username = ?");
        $stmt->bind_param("s", $this->name);
        $stmt->execute();
        $stmt->bind_result($kills);
        $stmt->fetch();
        $stmt->close();
        $message = Translation::getMessage("death", [
            "name" => TextFormat::GREEN . $this->name . TextFormat::DARK_GRAY . "[" . TextFormat::DARK_GREEN . TextFormat::BOLD . $kills . TextFormat::RESET . TextFormat::DARK_GRAY . "]",
        ]);
        if($source instanceof EntityDamageByEntityEvent) {
            $killer = $source->getDamager();
            if($killer instanceof HCFPlayer) {
                if($killer->getFaction() !== null and $killer->getFaction()->isInFaction($this->name) === true) {
                    $source->setCancelled();
                    $killer->sendMessage(Translation::getMessage("attackFactionAssociate"));
                    return;
                }
                $killer->addKills();
                $message = Translation::getMessage("deathByPlayer", [
                    "name" => TextFormat::GREEN . $this->name . TextFormat::DARK_GRAY . "[" . TextFormat::DARK_GREEN . TextFormat::BOLD . $kills . TextFormat::RESET . TextFormat::DARK_GRAY . "]",
                    "killer" => TextFormat::RED . $killer->getName() . TextFormat::DARK_GRAY . "[" . TextFormat::DARK_RED . TextFormat::BOLD . $killer->getKills() . TextFormat::RESET . TextFormat::DARK_GRAY . "]"
                ]);
            }
        }
        $server->broadcastMessage($message);
        $provider = HCF::getInstance()->getMySQLProvider();
        $username = $this->name;
        $time = 3600;
        $stmt = $provider->getDatabase()->prepare("SELECT lives FROM players WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($lives);
        $stmt->fetch();
        $stmt->close();
        if($lives > 0) {
            $stmt = $provider->getDatabase()->prepare("UPDATE players SET lives = lives - 1, invincibilityTime = ? WHERE username = ?");
            $stmt->bind_param("si", $time, $username);
            $stmt->execute();
            $stmt->close();
        }
        else {
            $timestamp = time();
            $stmt = $provider->getDatabase()->prepare("UPDATE players SET deathBanTime = ?, invincibilityTime = ? WHERE username = ?");
            $stmt->bind_param("iis", $timestamp, $time, $username);
            $stmt->execute();
            $stmt->close();
        }
        $drops = [];
        $namedTag = $server->getOfflinePlayerData($this->name);
        $items = $namedTag->getListTag("Inventory")->getAllValues();
        foreach($items as $item) {
            $item = Item::nbtDeserialize($item);
            $drops[] = $item;
        }
        $level = $server->getDefaultLevel();
        $spawn = $level->getSpawnLocation();
        $namedTag->setTag(new ListTag("Inventory", [], NBT::TAG_Compound));
        $namedTag->setTag(new ListTag("Pos", [
            new DoubleTag("", $spawn->x),
            new DoubleTag("", $spawn->y),
            new DoubleTag("", $spawn->z)
        ], NBT::TAG_Double));
        $namedTag->setTag(new StringTag("Level", $level->getFolderName()));
        $server->saveOfflinePlayerData($this->name, $namedTag);
        foreach($drops as $item) {
            $this->getLevel()->dropItem($this, $item);
        }
        LevelManager::fakeDeath($this);
        $this->getLevel()->broadcastLevelSoundEvent($this, LevelSoundEventPacket::SOUND_HURT);
        $this->flagForDespawn();
    }

    /**
     * @param Entity $attacker
     * @param float $damage
     * @param float $x
     * @param float $z
     * @param float $base
     */
    public function knockBack(Entity $attacker, float $damage, float $x, float $z, float $base = 0.4): void {

    }

    /**
     * @param HCFPlayer $player
     */
    public function setPlayer(HCFPlayer $player): void {
        $this->name = $player->getName();
        $this->setNameTag(TextFormat::YELLOW . TextFormat::BOLD . $player->getName());
        $this->time = time();
    }
}