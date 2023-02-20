<?php

namespace hcf\groups;

use hcf\HCFPlayer;
use pocketmine\utils\TextFormat;

class Group implements GroupIdentifiers {

    /** @var string */
    private $name;

    /** @var string */
    private $coloredName;

    /** @var int */
    private $identifier;

    /** @var int */
    private $deathBanTime;

    /** @var string */
    private $chatFormat;

    /** @var string */
    private $tagFormat;

    /** @var array */
    private $permissions = [];

    /**
     * Group constructor.
     *
     * @param string $name
     * @param string $coloredName
     * @param int $identifier
     * @param int $deathBanTime
     * @param string $chatFormat
     * @param string $tagFormat
     * @param array $permissions
     *
     */
    public function __construct(string $name, string $coloredName, int $identifier, int $deathBanTime, string $chatFormat, string $tagFormat, array $permissions = []) {
        $this->name = $name;
        $this->coloredName = $coloredName;
        $this->identifier = $identifier;
        $this->deathBanTime = $deathBanTime;
        $this->chatFormat = $chatFormat;
        $this->tagFormat = $tagFormat;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColoredName(): string {
        return $this->coloredName;
    }

    /**
     * @return int
     */
    public function getIdentifier(): int {
        return $this->identifier;
    }

    /**
     * @return int
     */
    public function getDeathBanTime(): int {
        return $this->deathBanTime;
    }

    /**
     * @param HCFPlayer $player
     * @param string $message
     * @param array $args
     *
     * @return string
     */
    public function getChatFormatFor(HCFPlayer $player, string $message, array $args = []): string {
        $format = $this->chatFormat;
        foreach($args as $arg => $value) {
            $format = str_replace("{" . $arg . "}", $value, $format);
        }
        $format = str_replace("{player}", $player->getDisplayName(), $format);
        $message = TextFormat::clean($message);
        return str_replace("{message}", $message, $format);
    }

    /**
     * @param HCFPlayer $player
     * @param array $args
     *
     * @return string
     */
    public function getTagFormatFor(HCFPlayer $player, array $args = []): string {
        $format = $this->tagFormat;
        foreach($args as $arg => $value) {
            $format = str_replace("{" . $arg . "}", $value, $format);
        }
        return str_replace("{player}", $player->getDisplayName(), $format);
    }

    /**
     * @return string[]
     */
    public function getPermissions(): array {
        return $this->permissions;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->name;
    }
}