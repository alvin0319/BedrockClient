<?php

declare(strict_types=1);

namespace alvin0319\BedrockClient\raknet;

use alvin0319\BedrockClient\network\BedrockPacketHandler;
use InvalidArgumentException;
use pocketmine\network\mcpe\protocol\PacketDecodeException;
use pocketmine\network\mcpe\protocol\PacketPool;
use pocketmine\network\mcpe\protocol\ServerboundPacket;
use React\EventLoop\Loop;
use React\EventLoop\TimerInterface;
use function count;

final class RakNetClient{

	protected RakNetThread $thread;

	protected TimerInterface $timer;

	protected ?BedrockPacketHandler $handler = null;

	public function __construct(protected string $targetAddress, protected int $targetPort){
		if($this->targetPort < 0 || $this->targetPort > 65535){
			throw new InvalidArgumentException("Invalid port $this->targetPort");
		}
		$this->thread = new RakNetThread($this->targetAddress, $this->targetPort);
		$this->thread->start(PTHREADS_INHERIT_ALL);
	}

	public function setPacketHandler(BedrockPacketHandler $handler) : void{
		$this->handler = $handler;
	}

	public function bind() : void{
		$this->timer = Loop::addPeriodicTimer(1, function() : void{
			$packetBuffers = $this->thread->getIncomingPackets();
			if(count($packetBuffers) > 0){
				foreach($packetBuffers as $buffer){
					try{
						$packet = PacketPool::getInstance()->getPacket($buffer);
						$packet->decode($buffer);
						if(!$packet instanceof ServerboundPacket){
							// TODO: Log non-serverbound packet has received
							continue;
						}
						if($this->handler !== null){
							$packet->handle($this->handler);
						}
					}catch(PacketDecodeException $e){
						// TODO: Log packet decode exception
					}
				}
			}
		});
	}

	public function disconnect() : void{
		Loop::cancelTimer($this->timer);
		$this->thread->setClosed(true);
	}
}