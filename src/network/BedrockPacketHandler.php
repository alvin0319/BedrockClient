<?php

declare(strict_types=1);

namespace alvin0319\BedrockClient\network;

use pocketmine\network\mcpe\protocol\ActorPickRequestPacket;
use pocketmine\network\mcpe\protocol\AnvilDamagePacket;
use pocketmine\network\mcpe\protocol\BlockPickRequestPacket;
use pocketmine\network\mcpe\protocol\BookEditPacket;
use pocketmine\network\mcpe\protocol\ClientCacheBlobStatusPacket;
use pocketmine\network\mcpe\protocol\ClientCacheStatusPacket;
use pocketmine\network\mcpe\protocol\ClientToServerHandshakePacket;
use pocketmine\network\mcpe\protocol\CommandBlockUpdatePacket;
use pocketmine\network\mcpe\protocol\CommandRequestPacket;
use pocketmine\network\mcpe\protocol\CraftingEventPacket;
use pocketmine\network\mcpe\protocol\CreatePhotoPacket;
use pocketmine\network\mcpe\protocol\InteractPacket;
use pocketmine\network\mcpe\protocol\ItemFrameDropItemPacket;
use pocketmine\network\mcpe\protocol\ItemStackRequestPacket;
use pocketmine\network\mcpe\protocol\LecternUpdatePacket;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\MapCreateLockedCopyPacket;
use pocketmine\network\mcpe\protocol\MapInfoRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\network\mcpe\protocol\NpcRequestPacket;
use pocketmine\network\mcpe\protocol\PacketHandlerDefaultImplTrait;
use pocketmine\network\mcpe\protocol\PacketHandlerInterface;
use pocketmine\network\mcpe\protocol\PacketViolationWarningPacket;
use pocketmine\network\mcpe\protocol\PlayerActionPacket;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\PlayerInputPacket;
use pocketmine\network\mcpe\protocol\PositionTrackingDBClientRequestPacket;
use pocketmine\network\mcpe\protocol\PurchaseReceiptPacket;
use pocketmine\network\mcpe\protocol\RequestChunkRadiusPacket;
use pocketmine\network\mcpe\protocol\ResourcePackChunkRequestPacket;
use pocketmine\network\mcpe\protocol\ResourcePackClientResponsePacket;
use pocketmine\network\mcpe\protocol\RiderJumpPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\SetLocalPlayerAsInitializedPacket;
use pocketmine\network\mcpe\protocol\SettingsCommandPacket;
use pocketmine\network\mcpe\protocol\SpawnExperienceOrbPacket;
use pocketmine\network\mcpe\protocol\StructureBlockUpdatePacket;
use pocketmine\network\mcpe\protocol\StructureTemplateDataRequestPacket;
use pocketmine\network\mcpe\protocol\SubClientLoginPacket;

/**
 * Class for handling incoming packets
 *
 * These following functions that defined on this class are {@see ServerboundPacket}, which mean packets are only sent from client
 *
 */

abstract class BedrockPacketHandler implements PacketHandlerInterface{
	use PacketHandlerDefaultImplTrait;
	
	final public function handleLogin(LoginPacket $packet) : bool{ return false; }

	final public function handleClientToServerHandshake(ClientToServerHandshakePacket $packet) : bool{ return false; }

	final public function handleResourcePackClientResponse(ResourcePackClientResponsePacket $packet) : bool{ return false; }

	final public function handleRiderJump(RiderJumpPacket $packet) : bool{ return false; }

	final public function handleInteract(InteractPacket $packet) : bool{ return false; }

	final public function handleBlockPickRequest(BlockPickRequestPacket $packet) : bool{ return false; }

	final public function handleActorPickRequest(ActorPickRequestPacket $packet) : bool{ return false; }

	final public function handlePlayerAction(PlayerActionPacket $packet) : bool{ return false; }

	final public function handleCraftingEvent(CraftingEventPacket $packet) : bool{ return false; }

	final public function handlePlayerInput(PlayerInputPacket $packet) : bool{ return false; }

	final public function handleSpawnExperienceOrb(SpawnExperienceOrbPacket $packet) : bool{ return false; }

	final public function handleMapInfoRequest(MapInfoRequestPacket $packet) : bool{ return false; }

	final public function handleRequestChunkRadius(RequestChunkRadiusPacket $packet) : bool{ return false; }

	final public function handleItemFrameDropItem(ItemFrameDropItemPacket $packet) : bool{ return false; }

	final public function handleCommandRequest(CommandRequestPacket $packet) : bool{ return false; }

	final public function handleCommandBlockUpdate(CommandBlockUpdatePacket $packet) : bool{ return false; }

	final public function handleResourcePackChunkRequest(ResourcePackChunkRequestPacket $packet) : bool{ return false; }

	final public function handleStructureBlockUpdate(StructureBlockUpdatePacket $packet) : bool{ return false; }

	final public function handlePurchaseReceipt(PurchaseReceiptPacket $packet) : bool{ return false; }

	final public function handleSubClientLogin(SubClientLoginPacket $packet) : bool{ return false; }

	final public function handleBookEdit(BookEditPacket $packet) : bool{ return false; }

	final public function handleNpcRequest(NpcRequestPacket $packet) : bool{ return false; }

	final public function handleModalFormResponse(ModalFormResponsePacket $packet) : bool{ return false; }

	final public function handleServerSettingsRequest(ServerSettingsRequestPacket $packet) : bool{ return false; }

	final public function handleSetLocalPlayerAsInitialized(SetLocalPlayerAsInitializedPacket $packet) : bool{ return false; }

	final public function handleLecternUpdate(LecternUpdatePacket $packet) : bool{ return false; }

	final public function handleClientCacheStatus(ClientCacheStatusPacket $packet) : bool{ return false; }

	final public function handleMapCreateLockedCopy(MapCreateLockedCopyPacket $packet) : bool{ return false; }

	final public function handleStructureTemplateDataRequest(StructureTemplateDataRequestPacket $packet) : bool{ return false; }

	final public function handleClientCacheBlobStatus(ClientCacheBlobStatusPacket $packet) : bool{ return false; }

	final public function handleSettingsCommand(SettingsCommandPacket $packet) : bool{ return false; }

	final public function handleAnvilDamage(AnvilDamagePacket $packet) : bool{ return false; }

	final public function handlePlayerAuthInput(PlayerAuthInputPacket $packet) : bool{ return false; }

	final public function handleItemStackRequest(ItemStackRequestPacket $packet) : bool{ return false; }

	final public function handlePositionTrackingDBClientRequest(PositionTrackingDBClientRequestPacket $packet) : bool{ return false; }

	final public function handlePacketViolationWarning(PacketViolationWarningPacket $packet) : bool{ return false; }

	final public function handleCreatePhoto(CreatePhotoPacket $packet) : bool{ return false; }


}