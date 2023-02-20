<?php

namespace hcf\faction\command\subCommands;

use hcf\command\utils\SubCommand;
use hcf\faction\Faction;
use hcf\HCFPlayer;
use hcf\translation\Translation;
use hcf\translation\TranslationException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class InfoSubCommand extends SubCommand {

    /**
     * InfoSubCommand constructor.
     */
    public function __construct() {
        parent::__construct("info", "/faction info [faction]");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     *
     * @throws TranslationException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof HCFPlayer) {
            $sender->sendMessage(Translation::getMessage("noPermission"));
            return;
        }
        if(!isset($args[1])) {
            if($sender->getFaction() === null) {
                $sender->sendMessage(Translation::getMessage("beInFaction"));
                return;
            }
            $faction = $sender->getFaction();
        }
        else {
            $faction = $this->getCore()->getFactionManager()->getFaction($args[1]);
            if($faction === null) {
                $sender->sendMessage(Translation::getMessage("invalidFaction"));
                return;
            }
        }
        $home = "";
        if($faction->getHome() !== null) {
            $home = TextFormat::GRAY . " ({$faction->getHome()->getFloorX()}, {$faction->getHome()->getFloorZ()})";
        }
        $sender->sendMessage(TextFormat::DARK_RED . TextFormat::BOLD . $faction->getName() . TextFormat::RESET . TextFormat::DARK_GRAY . " [" . TextFormat::GRAY . count($faction->getMembers()) . "/" . Faction::MAX_MEMBERS . TextFormat::DARK_GRAY . "]" . $home);
        $members = [];
        $memberKills = [];
        $name = $faction->getName();
        $stmt = $this->getCore()->getMySQLProvider()->getDatabase()->prepare("SELECT kills, username FROM players WHERE faction = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($kills, $username);
        while($stmt->fetch()) {
            $memberKills[$username] = $kills;
        }
        $stmt->close();
        foreach($faction->getMembers() as $member) {
            if(($player = $this->getCore()->getServer()->getPlayer($member)) !== null) {
                $members[] = TextFormat::GREEN . $player->getName() . TextFormat::DARK_GRAY . "[" . TextFormat::DARK_RED . TextFormat::BOLD . $memberKills[$member] . TextFormat::RESET . TextFormat::DARK_GRAY . "]";
                continue;
            }
            $members[] = TextFormat::WHITE . $member . TextFormat::DARK_GRAY . "[" . TextFormat::DARK_RED . TextFormat::BOLD . $memberKills[$member] . TextFormat::RESET . TextFormat::DARK_GRAY . "]";
        }
        $dtrFreeze = "Not enabled";
        if($faction->isInDTRFreeze() === true) {
            $time = $faction->getDTRFreezeTime();
            $minutes = floor($time / 60);
            $seconds = $time % 60;
            $dtrFreeze =  "$minutes minutes, $seconds seconds";
        }
        $raidable = "";
        if($faction->getDTR() <= 0) {
            $raidable = TextFormat::RED . TextFormat::DARK_RED . " (RAIDABLE)";
        }
        $sender->sendMessage(TextFormat::RED . " Members: " . implode(TextFormat::GRAY . ", ", $members));
        $sender->sendMessage(TextFormat::RED . " Allies: " . TextFormat::WHITE . implode(", ", $faction->getAllies()));
        $sender->sendMessage(TextFormat::RED . " Home: " . TextFormat::WHITE . implode((array)TextFormat::GRAY, $home));
        $sender->sendMessage(TextFormat::RED . " DTR: " . TextFormat::WHITE . $faction->getDTR() . $raidable);
        $sender->sendMessage(TextFormat::RED . " DTR Freeze: " . TextFormat::WHITE . $dtrFreeze);
        $sender->sendMessage(TextFormat::RED . " Balance: " . TextFormat::WHITE . "$" . $faction->getBalance());
    }
}