<?php

declare(strict_types=1);

namespace BeeAZ\AcidIsland\generator\Basic;

use pocketmine\item\StringToItemParser;
use pocketmine\world\ChunkManager;
use pocketmine\world\generator\Generator;

class Basic extends Generator {

	public function __construct(int $seed, string $preset) {
		parent::__construct($seed, $preset);
	}

	public function generateChunk(ChunkManager $world, $chunkX, $chunkZ) : void {
		$chunk = $world->getChunk($chunkX, $chunkZ);
		for ($Z = 0; $Z < 16; ++$Z) {
			for ($X = 0; $X < 16; ++$X) {
				$chunk->setFullBlock($X, 0, $Z, StringToItemParser::getInstance()->parse('BEDROCK')->getBlock()->getStateId());
				for ($y = 1; $y < 65; ++$y) {
					$chunk->setFullBlock($X, $y, $Z, StringToItemParser::getInstance()->parse('WATER')->getBlock()->getStateId());
				}
			}
		}
		if ($chunkX == 0 && $chunkZ == 0) {
			for ($x = 4; $x < 11; $x++) {
				for ($z = 4; $z < 11; $z++) {
					$chunk->setFullBlock($x, 64, $z, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
				}
			}
			for ($x = 4; $x < 11; $x++) {
				for ($z = 4; $z < 11; $z++) {
					$chunk->setFullBlock($x, 63, $z, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
				}
			}
			for ($x = 5; $x < 10; $x++) {
				for ($z = 5; $z < 10; $z++) {
					$chunk->setFullBlock($x, 63, $z, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
					$chunk->setFullBlock($x, 68, $z, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
				}
			}
			for ($x = 6; $x < 9; $x++) {
				for ($z = 6; $z < 9; $z++) {
					$chunk->setFullBlock($x, 69, $z, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
					$chunk->setFullBlock($x, 62, $z, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
				}
			}
			$chunk->setFullBlock(7, 60, 7, StringToItemParser::getInstance()->parse('BEDROCK')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 61, 7, StringToItemParser::getInstance()->parse('SAND')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 62, 7, StringToItemParser::getInstance()->parse('SAND')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 63, 7, StringToItemParser::getInstance()->parse('SAND')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 64, 8, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 64, 9, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 64, 7, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 64, 6, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 64, 5, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 64, 8, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 64, 9, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 64, 7, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 64, 6, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 64, 8, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 64, 9, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 64, 7, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 64, 6, StringToItemParser::getInstance()->parse('GRASS')->getBlock()->getStateId());
			$chunk->setFullBlock(4, 65, 7, StringToItemParser::getInstance()->parse('CRAFTING_TABLE')->getBlock()->getStateId());
			$chunk->setFullBlock(4, 65, 8, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(4, 65, 9, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(5, 65, 9, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(5, 65, 10, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(6, 65, 10, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 65, 10, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 65, 10, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 65, 10, StringToItemParser::getInstance()->parse('OAK_FENCE')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 65, 10, StringToItemParser::getInstance()->parse('HAY_BALE')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 65, 9, StringToItemParser::getInstance()->parse('HAY_BALE')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 66, 9, StringToItemParser::getInstance()->parse('HAY_BALE')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 65, 8, StringToItemParser::getInstance()->parse('HAY_BALE')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 65, 9, StringToItemParser::getInstance()->parse('HAY_BALE')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 67, 8, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 65, 7, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 66, 7, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 67, 7, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 68, 7, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 69, 7, StringToItemParser::getInstance()->parse('OAK_LOG')->getBlock()->getStateId());
			$chunk->setFullBlock(5, 69, 7, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 69, 5, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 69, 7, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 69, 9, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 70, 6, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(6, 70, 7, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 70, 7, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 70, 8, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 71, 7, StringToItemParser::getInstance()->parse('OAK_LEAVES')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 61, 8, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(8, 61, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 61, 6, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(6, 61, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(5, 62, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 62, 5, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(9, 62, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 62, 9, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(4, 63, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 63, 4, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(7, 63, 10, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 63, 7, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 63, 8, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 63, 9, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 63, 6, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
			$chunk->setFullBlock(10, 63, 5, StringToItemParser::getInstance()->parse('DIRT')->getBlock()->getStateId());
		}
	}

	public function populateChunk(ChunkManager $world, $chunkX, $chunkY) : void {
	}
}
