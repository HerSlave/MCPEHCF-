<?php

namespace hcf\command\types;

use hcf\command\utils\Command;
use hcf\groups\GroupManager;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ListCommand extends Command {

    /**
     * ListCommand constructor.
     */
    public function __construct() {
        parent::__construct("list", "List current online players.", "/list");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        $players = [];
        $rankedPlayers = [];
        $staffs = [];
        $youtubers = [];
        foreach($this->getCore()->getServer()->getOnlinePlayers() as $player) {
            if(!$player instanceof HCFPlayer) {
                return;
            }
            if($player->getGroup()->getIdentifier() === GroupManager::PLAYER) {
                $players[] = $player->getName();
                continue;
            }
            if($player->getGroup()->getIdentifier() >= GroupManager::JUNIOR and $player->getGroup()->getIdentifier() <= GroupManager::PRIMAL) {
                $rankedPlayers[] = $player->getName();
                continue;
            }
            if($player->getGroup()->getIdentifier() === GroupManager::YOUTUBER) {
                $youtubers[] = $player->getName();
                continue;
            }
            else {
                $staffs[] = $player->getName();
            }
        }
        $onlinePlayers = count($this->getCore()->getServer()->getOnlinePlayers());
        $times = round((count($players) / $onlinePlayers) * 20);
        $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::GOLD . str_repeat("|", $times) . TextFormat::GRAY . str_repeat("|", 20 - $times) . TextFormat::DARK_GRAY . "] " . Translation::getMessage("listMessage", [
            "group" => TextFormat::GOLD . "Players",
            "count" => TextFormat::DARK_GRAY . "(" . TextFormat::BOLD . TextFormat::GOLD . count($players) . TextFormat::RESET . TextFormat::DARK_GRAY . ")",
            "list" => TextFormat::WHITE . implode(", ", $players)
        ]));
        $times = round((count($rankedPlayers) / $onlinePlayers) * 20);
        $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::YELLOW . str_repeat("|", $times) . TextFormat::GRAY . str_repeat("|", 20 - $times) . TextFormat::DARK_GRAY . "] " . Translation::getMessage("listMessage", [
            "group" => TextFormat::YELLOW . "Ranked Players",
            "count" => TextFormat::DARK_GRAY . "(" . TextFormat::BOLD . TextFormat::YELLOW . count($rankedPlayers) . TextFormat::RESET . TextFormat::DARK_GRAY . ")",
            "list" => TextFormat::WHITE . implode(", ", $rankedPlayers)
        ]));
        $times = round((count($youtubers) / $onlinePlayers) * 20);
        $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::WHITE . str_repeat("|", $times) . TextFormat::GRAY . str_repeat("|", 20 - $times) . TextFormat::DARK_GRAY . "] " . Translation::getMessage("listMessage", [
            "group" => TextFormat::WHITE . "You" . TextFormat::RED . "Tubers",
            "count" => TextFormat::DARK_GRAY . "(" . TextFormat::BOLD . TextFormat::RED . count($youtubers) . TextFormat::RESET . TextFormat::DARK_GRAY . ")",
            "list" => TextFormat::WHITE . implode(", ", $youtubers)
        ]));
        $times = round((count($staffs) / $onlinePlayers) * 20);
        $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::LIGHT_PURPLE . str_repeat("|", $times) . TextFormat::GRAY . str_repeat("|", 20 - $times) . TextFormat::DARK_GRAY . "] " . Translation::getMessage("listMessage", [
            "group" => TextFormat::LIGHT_PURPLE . "Staffs",
            "count" => TextFormat::DARK_GRAY . "(" . TextFormat::BOLD . TextFormat::LIGHT_PURPLE . count($staffs) . TextFormat::RESET . TextFormat::DARK_GRAY . ")",
            "list" => TextFormat::WHITE . implode(", ", $staffs)
        ]));
    }
}