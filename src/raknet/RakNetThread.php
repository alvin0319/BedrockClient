<?php

declare(strict_types=1);

namespace alvin0319\BedrockClient\raknet;

use alvin0319\BedrockClient\encryption\BaseEncryptionException;
use alvin0319\BedrockClient\encryption\EncryptionContext;
use pocketmine\network\mcpe\protocol\serializer\ItemTypeDictionary;
use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;
use pocketmine\network\mcpe\protocol\serializer\PacketSerializerContext;
use pocketmine\network\mcpe\protocol\ServerboundPacket;
use raklib\generic\Socket;
use raklib\utils\InternetAddress;
use Thread;
use Throwable;
use Volatile;
use function random_int;

final class RakNetThread extends Thread{

	protected int $guid; // RakNet UUID

	protected bool $closed = false;

	protected Socket $socket;

	protected ?EncryptionContext $context = null;

	protected Volatile $packetBuffer;

	protected Volatile $incomingPackets;

	public function __construct(protected string $bindAddress, protected int $bindPort){
		$this->guid = Thread::getCurrentThreadId();
		$this->packetBuffer = new Volatile();
		$this->incomingPackets = new Volatile();
	}

	public function setEncryptionEnabled(bool $encryptionEnabled = false, ?string $encryptionKey = null) : void{
		if($encryptionEnabled){
			if($encryptionKey === null){
				throw new BaseEncryptionException("Encryption key cannot be null if encryption is enabled");
			}
			$this->context = EncryptionContext::fakeGCM($encryptionKey);
			EncryptionContext::$ENABLED = true;
		}else{
			EncryptionContext::$ENABLED = false;
		}
	}

	public function sendPacket(ServerboundPacket $packet) : void{
		$serializer = PacketSerializer::encoder(new PacketSerializerContext(new ItemTypeDictionary([])));
		$packet->encode($serializer);
		$this->packetBuffer[] = $serializer->getBuffer();
	}

	public function sendPacketImmediately(ServerboundPacket $packet) : void{
		$serializer = PacketSerializer::encoder(new PacketSerializerContext(new ItemTypeDictionary([])));
		$packet->encode($serializer);
		$buffer = $serializer->getBuffer();
		if($this->context !== null){
			$buffer = $this->context->encrypt($buffer);
		}
		$this->socket->writePacket($buffer, $this->bindAddress, $this->bindPort);
	}

	public function setClosed(bool $closed) : void{
		$this->closed = $closed;
		if($this->closed){
			$this->socket->close();
		}
	}

	public function isClosed() : bool{
		return $this->closed;
	}

	public function run() : void{
		$this->socket = new Socket(new InternetAddress("0.0.0.0", random_int(10000, 65535), RakNet::RAKNET_VER));
		while(!$this->closed){
			while($this->packetBuffer->count() > 0){
				/** @var string $chunk */
				$chunk = $this->packetBuffer->shift();
				if($this->context !== null){
					try{
						$chunk = $this->context->encrypt($chunk);
					}catch(Throwable $e){

					}
				}
				$this->socket->writePacket($chunk, $this->bindAddress, $this->bindPort);
			}
			$sourceAddress = null;
			$sourcePort = null;
			while(($packetBuffer = $this->socket->readPacket($sourceAddress, $sourcePort)) !== null){
				if($this->context !== null){
					$packetBuffer = $this->context->decrypt($packetBuffer);
				}
				$this->incomingPackets[] = $packetBuffer;
			}
		}
		$this->closed = true;
	}

	public function getIncomingPackets() : array{
		$res = [];
		while($this->incomingPackets->count() > 0){
			$chunk = $this->incomingPackets->shift();
			$res[] = (string) $chunk;
		}
		return $res;
	}
}