<?php

declare(strict_types=1);

namespace muqsit\portablecrafting;

use muqsit\invmenu\type\graphic\network\InvMenuGraphicNetworkTranslator;
use muqsit\invmenu\type\graphic\PositionedInvMenuGraphic;
use pocketmine\crafting\CraftingGrid;
use pocketmine\inventory\Inventory;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

final class CraftingGridInvMenuGraphic implements PositionedInvMenuGraphic{

	private int $grid_width;
	private PositionedInvMenuGraphic $inner;

	public function __construct(int $grid_width, PositionedInvMenuGraphic $graphic){
		$this->grid_width = $grid_width;
		$this->inner = $graphic;
	}

	public function getPosition() : Vector3{
		return $this->inner->getPosition();
	}

	public function send(Player $player, ?string $name) : void{
		$this->inner->send($player, $name);
	}

	public function sendInventory(Player $player, Inventory $inventory) : bool{
		if($this->inner->sendInventory($player, $inventory)){
			$player->setCraftingGrid(new CraftingGrid($player, $this->grid_width));
			return true;
		}
		return false;
	}

	public function remove(Player $player) : void{
		$this->inner->remove($player);
	}

	public function getNetworkTranslator() : ?InvMenuGraphicNetworkTranslator{
		return $this->inner->getNetworkTranslator();
	}
}