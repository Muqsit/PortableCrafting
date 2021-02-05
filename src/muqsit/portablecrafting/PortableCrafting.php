<?php

declare(strict_types=1);

namespace muqsit\portablecrafting;

use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\metadata\SingleBlockMenuMetadata;
use pocketmine\block\VanillaBlocks;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\crafting\CraftingGrid;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

final class PortableCrafting extends PluginBase{

	public const INV_MENU_TYPE_WORKBENCH = "portablecrafting:workbench";

	public static function WORKBENCH() : CraftingGridInvMenu{
		$type = InvMenuHandler::getMenuType(self::INV_MENU_TYPE_WORKBENCH);
		assert($type !== null);
		return new CraftingGridInvMenu($type, static function(Player $player) : CraftingGrid{
			return new CraftingGrid($player, CraftingGrid::SIZE_BIG);
		});
	}

	protected function onEnable() : void{
		if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
		InvMenuHandler::registerMenuType(new SingleBlockMenuMetadata(self::INV_MENU_TYPE_WORKBENCH, CraftingGrid::SIZE_BIG ** 2, WindowTypes::WORKBENCH, VanillaBlocks::CRAFTING_TABLE()));
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		if($sender instanceof Player){
			self::WORKBENCH()->send($sender);
		}
		return true;
	}
}