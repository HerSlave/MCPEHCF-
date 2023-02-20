<?php

namespace hcf\groups;

use hcf\HCF;
use pocketmine\utils\TextFormat;

class GroupManager implements GroupIdentifiers {

    /** @var HCF */
    private $core;

    /** @var Group[] */
    private $groups = [];

    /**
     * GroupManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $core->getServer()->getPluginManager()->registerEvents(new GroupListener($core), $core);
        $this->init();
    }

    public function init(): void {
        $this->addGroup(new Group("Player", TextFormat::GOLD . TextFormat::BOLD . "PLAYER", self::PLAYER, 1800,
            TextFormat::GOLD . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::GOLD . TextFormat::BOLD . "PLAYER" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": {message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::GOLD . TextFormat::BOLD . "Player" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter"
            ]));
        $this->addGroup(new Group("Junior", TextFormat::YELLOW . TextFormat::BOLD . "JUNIOR", self::JUNIOR, 1500,
            TextFormat::YELLOW . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "JUNIOR" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::WHITE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "Junior" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter",
                "kit.junior"
            ]));
        $this->addGroup(new Group("Grand", TextFormat::BLUE . TextFormat::BOLD . "GRAND", self::GRAND, 1200,
            TextFormat::BLUE . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::BLUE . TextFormat::BOLD . "GRAND" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::WHITE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::BLUE . TextFormat::BOLD . "Grand" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter",
                "kit.junior",
                "kit.grand"
            ]));
        $this->addGroup(new Group("Prime", TextFormat::DARK_RED . TextFormat::BOLD . "PRIME", self::PRIME, 900,
            TextFormat::DARK_RED . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "PRIME" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::WHITE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "Prime" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter",
                "kit.junior",
                "kit.grand",
                "kit.prime"
            ]));
        $this->addGroup(new Group("Valet", TextFormat::RED . TextFormat::BOLD . "Valet", self::PRIMAL, 600,
            TextFormat::RED . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::RED . TextFormat::BOLD . "Valet" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::WHITE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::RED . TextFormat::BOLD . "Valet" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter",
                "kit.junior",
                "kit.grand",
                "kit.prime",
                "kit.primal"
            ]));
        $this->addGroup(new Group("Trainee", TextFormat::GREEN . TextFormat::BOLD . "TRAINEE", self::TRAINEE, 0,
            TextFormat::GREEN . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::GREEN . TextFormat::BOLD . "TRAINEE" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::GREEN . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::GREEN . TextFormat::BOLD . "Trainee" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "permission.staff",
                "kit.food",
                "kit.starter"
            ]));
        $this->addGroup(new Group("Moderator", TextFormat::YELLOW . TextFormat::BOLD . "MODERATOR", self::MODERATOR, 0,
            TextFormat::YELLOW . "⚔ " . TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "MODERATOR" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::YELLOW . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "Moderator" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "permission.staff",
                "permission.mod",
                "pocketmine.command.ban.ip",
                "kit.food",
                "kit.starter",
                "kit.grand",
                "kit.primal",
                "kit.archer",
                "kit.bard",
                "kit.builder",
                "kit.diamond",
                "kit.miner",
                "kit.rogue",
                "invsee"
            ]));
        $this->addGroup(new Group("Senior Moderator", TextFormat::YELLOW . TextFormat::BOLD . "SENIOR MODERATOR", self::SENIOR_MODERATOR, 0,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "SENIOR MODERATOR" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::YELLOW . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::YELLOW . TextFormat::BOLD . "Senior Moderator" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "permission.staff",
                "permission.mod",
                "pocketmine.command.ban.ip",
                "kit.food",
                "kit.starter",
                "kit.grand",
                "kit.primal",
                "kit.archer",
                "kit.bard",
                "kit.builder",
                "kit.diamond",
                "kit.miner",
                "kit.rogue",
                "invsee"
            ]));
        $this->addGroup(new Group("Admin", TextFormat::DARK_RED . TextFormat::BOLD . "ADMIN", self::ADMIN, 0,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "ADMIN" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::DARK_RED . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "Admin" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "permission.staff",
                "permission.mod",
                "permission.admin",
                "pocketmine.command.ban.ip",
                "pocketmine.command.teleport",
                "kit.food",
                "kit.starter",
                "kit.grand",
                "kit.primal",
                "kit.archer",
                "kit.bard",
                "kit.builder",
                "kit.diamond",
                "kit.miner",
                "kit.rogue",
                "invsee"
            ]));
        $this->addGroup(new Group("Senior Admin", TextFormat::DARK_RED . TextFormat::BOLD . "SENIOR ADMIN",self::SENIOR_ADMIN, 0,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "SENIOR ADMIN" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::DARK_RED . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_RED . TextFormat::BOLD . "Senior Admin" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "permission.staff",
                "permission.mod",
                "permission.admin",
                "pocketmine.command.ban.ip",
                "pocketmine.command.teleport",
                "pocketmine.command.gamemode",
                "kit.food",
                "kit.starter",
                "kit.grand",
                "kit.primal",
                "kit.archer",
                "kit.bard",
                "kit.builder",
                "kit.diamond",
                "kit.miner",
                "kit.rogue",
                "invsee"
            ]));
        $this->addGroup(new Group("Manager", TextFormat::DARK_PURPLE . TextFormat::BOLD . "MANAGER",self::MANAGER, 0,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_PURPLE . TextFormat::BOLD . "MANAGER" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::DARK_PURPLE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::DARK_PURPLE . TextFormat::BOLD . "Manager" . TextFormat::RESET . TextFormat::WHITE . " {player}"));
        $this->addGroup(new Group("Owner", TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "OWNER", self::OWNER, 0,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "OWNER" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::LIGHT_PURPLE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "Owner" . TextFormat::RESET . TextFormat::WHITE . " {player}"));
        $this->addGroup(new Group("YouTuber", TextFormat::WHITE . TextFormat::BOLD . "YOU" . TextFormat::RED . "TUBER", self::YOUTUBER, 300,
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::WHITE . TextFormat::BOLD . "YOU" . TextFormat::RED . "TUBER" . TextFormat::RESET . TextFormat::WHITE . " {player}" . TextFormat::GRAY . ": " . TextFormat::WHITE . "{message}",
            TextFormat::DARK_AQUA . "{faction_rank}{faction} ". TextFormat::WHITE . TextFormat::BOLD . "You" . TextFormat::RED . "Tuber" . TextFormat::RESET . TextFormat::WHITE . " {player}", [
                "kit.food",
                "kit.starter",
                "kit.grand",
                "kit.primal",
                "kit.archer",
                "kit.bard",
                "kit.builder",
                "kit.diamond",
                "kit.miner",
                "kit.rogue"
            ]));
    }

    /**
     * @param int $identifier
     *
     * @return Group|null
     */
    public function getGroupByIdentifier(int $identifier): ?Group {
        return $this->groups[$identifier] ?? null;
    }

    /**
     * @return Group[]
     */
    public function getGroups(): array {
        return $this->groups;
    }

    /**
     * @param string $name
     *
     * @return Group
     */
    public function getGroupByName(string $name): ?Group {
        foreach($this->groups as $group) {
            if($group->getName() === $name) {
                return $group;
            }
        }
        return null;
    }

    /**
     * @param Group $group
     */
    public function addGroup(Group $group): void {
        $this->groups[$group->getIdentifier()] = $group;
    }
}