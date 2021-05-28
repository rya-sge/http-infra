

<?php

$STATIC_APP = getenv('STATIC_APP');
$DYNAMIC_APP = getenv('DYNAMIC_APP');
?>

<VirtualHost *:80>
	ServerName incroyable.ch
	
	ProxyPass '/api/animals' 'http://<?php print "$DYNAMIC_APP"?>/'
	ProxyPassReverse '/api/animals' 'http://<?php print "$DYNAMIC_APP"?>/'
	
	ProxyPass '/' 'http://<?php print "$STATIC_APP"?>/'
	ProxyPassReverse '/' '<?php print "$STATIC_APP"?>/'
</VirtualHost>

