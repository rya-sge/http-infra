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
	
	<Proxy balancer://static>

		BalancerMember 'http://<?php print "$STATIC_APP_1"?>'

		BalancerMember 'http://<?php print "$STATIC_APP_2"?>'  				

	</Proxy>
	
	<Proxy balancer://dynamic>
		BalancerMember 'http://<?php print "$DYNAMIC_APP_1"?>' 

		BalancerMember 'http://<?php print "$DYNAMIC_APP_2"?>' 			

	</Proxy>

	ProxyPreserveHost On


	ProxyPass '/api/animals' "balancer://dynamic/"

	ProxyPassReverse '/api/animals' "balancer://dynamic/"
	
	
	ProxyPass '/balancer-manager'!
	
	ProxyPass '/' "balancer://static/"
        ProxyPassReverse '/' "balancer://static/"

</VirtualHost>

