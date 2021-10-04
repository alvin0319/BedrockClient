<?php

declare(strict_types=1);

require dirname(__DIR__) . "/vendor/autoload.php";


$prop = (new ReflectionClass(\pocketmine\network\mcpe\protocol\PacketPool::class))->getProperty("pool");

$prop->setAccessible(true);

/** @var SplFixedArray $values */
$values = $prop->getValue(\pocketmine\network\mcpe\protocol\PacketPool::getInstance());

const EOL = PHP_EOL;
const TAB = "\t";

$imports = [];

$strings = "final class DefaultBedrockPacketHandler{" . EOL;

foreach($values->toArray() as $packet){
	if($packet instanceof \pocketmine\network\mcpe\protocol\ServerboundPacket && !$packet instanceof \pocketmine\network\mcpe\protocol\ClientboundPacket){
		$imports[] = (new ReflectionClass($packet))->getNamespaceName() . "\\" . (new ReflectionClass($packet))->getShortName();

		$strings .= TAB . "final public function " . toPacketMethodName($packet) . "(" . ((new ReflectionClass($packet))->getShortName()) . " \$packet) : bool{ return false; }" . EOL;
	}
}

function toPacketMethodName(\pocketmine\network\mcpe\protocol\ServerboundPacket $packet) : string{
	$packetName = (new ReflectionClass($packet))->getShortName();
	$lastChar = substr($packetName, 0, strlen($packetName) - strlen("packet"));
	return "handle" . $lastChar;
}

file_put_contents("client_bound_packet.php", "<?php\n\n namespace alvin0319\\BedrockClient; " . implode("\n", array_map(fn(string $import) => "use " . $import . ";", $imports)) . " $strings" . EOL . "}");