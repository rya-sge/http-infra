<?php

$STATIC_APP_1 = getenv('STATIC_APP_1');
$DYNAMIC_APP_1 = getenv('DYNAMIC_APP_1');

$STATIC_APP_2 = getenv('STATIC_APP_2');
$DYNAMIC_APP_2 = getenv('DYNAMIC_APP_2');
?>

<VirtualHost *:80>
	ServerName incroyable.ch
	
	<Proxy balancer://static>

		BalancerMember http://<?php print "$STATIC_APP_1"?>/ min=10 max=500 timeout=60 				loadfactor=1

		BalancerMember http://<?php print "$STATIC_APP_2"?>/ min=10 max=500 timeout=60 				loadfactor=1

	</Proxy>
	
	<Proxy balancer://dynamic>
		BalancerMember http://<?php print "$DYNAMIC_APP_1"?>/ min=10 max=500 timeout=60 				loadfactor=1

		BalancerMember http://<?php print "$DYNAMIC_APP_2"?>/ min=10 max=500 timeout=60 				loadfactor=1

	</Proxy>

P	ProxyPreserveHost On

	ProxyPass '/' balancer://static
	ProxyPassReverse '/' balancer://static

P	ProxyPass '/api/animals' balancer://cluster/

	ProxyPassReverse '/api/animals' balancer://cluster/

</VirtualHost>

