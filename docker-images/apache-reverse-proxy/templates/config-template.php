<?php

$STATIC_APP_1 = getenv('STATIC_APP_1');
$DYNAMIC_APP_1 = getenv('DYNAMIC_APP_1');

$STATIC_APP_2 = getenv('STATIC_APP_2');
$DYNAMIC_APP_2 = getenv('DYNAMIC_APP_2');
?>

<VirtualHost *:80>
	ServerName incroyable.ch
	
	<Location "/balancer-manager">
	 SetHandler balancer-manager	
	</Location>
	Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED
	
	<Proxy balancer://static>

		BalancerMember 'http://<?php print "$STATIC_APP_1"?>' route=1

		BalancerMember 'http://<?php print "$STATIC_APP_2"?>' route=2
		
		ProxySet stickysession=ROUTEID
		 				

	</Proxy>
	
	<Proxy balancer://dynamic>
	
		BalancerMember 'http://<?php print "$DYNAMIC_APP_1"?>' route=1

		BalancerMember 'http://<?php print "$DYNAMIC_APP_2"?>' route=2
		
		ProxySet stickysession=ROUTEID			

	</Proxy>

	ProxyPreserveHost On


	ProxyPass '/api/animals' "balancer://dynamic/"

	ProxyPassReverse '/api/animals' "balancer://dynamic/"
	
	
	ProxyPass '/balancer-manager'!
	
	ProxyPass '/' "balancer://static/"
        ProxyPassReverse '/' "balancer://static/"

</VirtualHost>

