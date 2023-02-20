<?php

namespace hcf\command;

use hcf\command\types\AddLivesCommand;
use hcf\command\types\AddMoneyCommand;
use hcf\command\types\AddPermissionCommand;
use hcf\command\types\AliasCommand;
use hcf\command\types\BalanceCommand;
use hcf\command\types\BalanceTopCommand;
use hcf\command\types\BanCommand;
use hcf\command\types\BanListCommand;
use hcf\command\types\BroadcastCommand;
use hcf\command\types\EOTWCommand;
use hcf\command\types\FocusCommand;
use hcf\command\types\FreezeCommand;
use hcf\command\types\GiveKeysCommand;
use hcf\command\types\KeyAllCommand;
use hcf\command\types\KickCommand;
use hcf\command\types\KitCommand;
use hcf\command\types\ListCommand;
use hcf\command\types\LogoutCommand;
use hcf\command\types\MapKitCommand;
use hcf\command\types\MuteCommand;
use hcf\command\types\MuteListCommand;
use hcf\command\types\PardonCommand;
use hcf\command\types\PingCommand;
use hcf\command\types\PVPCommand;
use hcf\command\types\ReclaimCommand;
use hcf\command\types\RepopulateChunkCommand;
use hcf\command\types\ReviveCommand;
use hcf\command\types\SetBalanceCommand;
use hcf\command\types\SetGroupCommand;
use hcf\command\types\SOTWCommand;
use hcf\command\types\SpectateCommand;
use hcf\command\types\StaffChatCommand;
use hcf\command\types\SubtractMoneyCommand;
use hcf\command\types\TagCommand;
use hcf\command\types\TellCommand;
use hcf\command\types\TellLocationCommand;
use hcf\command\types\UnmuteCommand;
use hcf\command\types\VoteCommand;
use hcf\command\types\XYZCommand;
use hcf\faction\command\FactionCommand;
use hcf\HCF;
use hcf\wayPoint\command\WayPointCommand;
use pocketmine\command\Command;
use pocketmine\plugin\PluginException;

class CommandManager {

    /** @var HCF */
    private $core;

    /**
     * CommandManager constructor.
     *
     * @param HCF $core
     */
    public function __construct(HCF $core) {
        $this->core = $core;
        $this->registerCommand(new AddLivesCommand());
        $this->registerCommand(new AddMoneyCommand());
        $this->registerCommand(new AddPermissionCommand());
        $this->registerCommand(new AliasCommand());
        $this->registerCommand(new BalanceCommand());
        $this->registerCommand(new BalanceTopCommand());
        $this->registerCommand(new BanCommand());
        $this->registerCommand(new BanListCommand());
        $this->registerCommand(new BroadcastCommand());
        $this->registerCommand(new EOTWCommand());
        $this->registerCommand(new FactionCommand());
        $this->registerCommand(new FocusCommand());
        $this->registerCommand(new FreezeCommand());
        $this->registerCommand(new GiveKeysCommand());
        $this->registerCommand(new KeyAllCommand());
        $this->registerCommand(new KickCommand());
        $this->registerCommand(new KitCommand());
        $this->registerCommand(new ListCommand());
        $this->registerCommand(new LogoutCommand());
        $this->registerCommand(new MapKitCommand());
        $this->registerCommand(new MuteCommand());
        $this->registerCommand(new MuteListCommand());
        $this->registerCommand(new PardonCommand());
        $this->registerCommand(new PingCommand());
        $this->registerCommand(new PVPCommand());
        $this->registerCommand(new ReclaimCommand());
        $this->registerCommand(new RepopulateChunkCommand());
        $this->registerCommand(new ReviveCommand());
        $this->registerCommand(new SetBalanceCommand());
        $this->registerCommand(new SetGroupCommand());
        $this->registerCommand(new SOTWCommand());
        $this->registerCommand(new SpectateCommand());
        $this->registerCommand(new StaffChatCommand());
        $this->registerCommand(new SubtractMoneyCommand());
        $this->registerCommand(new TagCommand());
        $this->registerCommand(new TellCommand());
        $this->registerCommand(new TellLocationCommand());
        $this->registerCommand(new UnmuteCommand());
        $this->registerCommand(new VoteCommand());
        $this->registerCommand(new WayPointCommand());
        $this->registerCommand(new XYZCommand());
        $this->unregisterCommand("about");
        $this->unregisterCommand("me");
        $this->unregisterCommand("particle");
        $this->unregisterCommand("title");
    }

    /**
     * @param Command $command
     */
    public function registerCommand(Command $command): void {
        $commandMap = $this->core->getServer()->getCommandMap();
        $existingCommand = $commandMap->getCommand($command->getName());
        if($existingCommand !== null) {
            $commandMap->unregister($existingCommand);
        }
        $commandMap->register($command->getName(), $command);
    }

    /**
     * @param string $name
     */
    public function unregisterCommand(string $name): void {
        $commandMap = $this->core->getServer()->getCommandMap();
        $command = $commandMap->getCommand($name);
        if($command === null) {
            throw new PluginException("Invalid command: $name to un-register.");
        }
        $commandMap->unregister($commandMap->getCommand($name));
    }
}