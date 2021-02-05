<?php

declare(strict_types=1);

namespace muqsit\portablecrafting;

use Closure;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\metadata\MenuMetadata;
use pocketmine\crafting\CraftingGrid;
use pocketmine\player\Player;

class CraftingGridInvMenu extends InvMenu{
	
	/** @var Closure */
	protected $crafting_grid_creator;

	/**
	 * @param MenuMetadata $type
	 * @param Closure $crafting_grid_creator
	 * 
	 * @phpstan-param Closure(Player) : CraftingGrid $crafting_grid_creator
	 */
	public function __construct(MenuMetadata $type, Closure $crafting_grid_creator){
		parent::__construct($type);
		$this->crafting_grid_creator = $crafting_grid_creator;
	}

	public function sendInventory(Player $player) : bool{
		if(parent::sendInventory($player)){
			$player->setCraftingGrid(($this->crafting_grid_creator)($player));
			return true;
		}
		return false;
	}
}