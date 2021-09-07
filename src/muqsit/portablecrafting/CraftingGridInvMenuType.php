<?php

declare(strict_types=1);

namespace muqsit\portablecrafting;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\graphic\InvMenuGraphic;
use muqsit\invmenu\type\graphic\PositionedInvMenuGraphic;
use muqsit\invmenu\type\InvMenuType;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;
use pocketmine\block\VanillaBlocks;
use pocketmine\inventory\Inventory;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;

final class CraftingGridInvMenuType implements InvMenuType{

	private int $grid_width;
	private InvMenuType $inner;

	public function __construct(int $grid_width){
		$this->grid_width = $grid_width;
		$this->inner = InvMenuTypeBuilders::BLOCK_FIXED()
			->setBlock(VanillaBlocks::CRAFTING_TABLE())
			->setSize(9)
			->setNetworkWindowType(WindowTypes::WORKBENCH)
			->build();
	}

	public function createGraphic(InvMenu $menu, Player $player) : ?InvMenuGraphic{
		$inner = $this->inner->createGraphic($menu, $player);
		return $inner instanceof PositionedInvMenuGraphic ? new CraftingGridInvMenuGraphic($this->grid_width, $inner) : null;
	}

	public function createInventory() : Inventory{
		return $this->inner->createInventory();
	}
}