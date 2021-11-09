<?php

declare(strict_types=1);

namespace muqsit\portablecrafting;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

final class PortableCrafting extends PluginBase{

	public const INV_MENU_TYPE_WORKBENCH = "portablecrafting:workbench";

	public static function WORKBENCH() : InvMenu{
		return InvMenu::create(self::INV_MENU_TYPE_WORKBENCH);
	}

	protected function onEnable() : void{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}

		InvMenuHandler::getTypeRegistry()->register(self::INV_MENU_TYPE_WORKBENCH, new CraftingTableInvMenuType());
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if($sender instanceof Player){
			self::WORKBENCH()->send($sender);
		}
		return true;
	}
}