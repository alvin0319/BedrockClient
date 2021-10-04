<?php

declare(strict_types=1);

namespace alvin0319\BedrockClient;

use function extension_loaded;
use function fwrite;
use function phpversion;
use function version_compare;

if(!extension_loaded("pthreads")){
	fwrite(STDERR, "BedrockClient requires pthreads in order to run.");
	exit(1);
}

if(version_compare($curPthreadsVer = phpversion("pthreads"), "3.2.1dev", ">=") === false){
	fwrite(STDERR, "BedrockClient requires pthreads >= 3.2.1dev, but you have $curPthreadsVer");
	exit(1);
}

if(!extension_loaded("crypto")){
	fwrite(STDERR, "BedrockClient requires crypto in order to run.");
}

final class BedrockClient{

}