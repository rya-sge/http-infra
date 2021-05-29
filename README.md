# README

## **DockerFile**

Cette partie indique, dans l'ordre, ce que fait le dockerfile

1) Le dockerfile copie apache2_foreground dans le usr/local/bin

## **apache2_foreground**
Script exécuté au démarrage du container. Il permet l'utilisation de variables d'environnement.
```
#!/bin/bash
set -e

echo "Setup for the res labo"
echo "Static app URL : $STATIC_APP"
echo "Dynamic app URL: $DYNAMIC_APP"
php /var/apache2/templates/config-template.php > /etc/apache2/sites-available/01-reverse-proxy.conf

# Note: we don't just use "apache2ctl" here because it itself is just a shell-script wrapper around apache2 which provides extra functionality like "apache2ctl start" for launching apache2 in the background.
# (also, when run as "apache2ctl <apache args>", it does not use "exec", which leaves an undesirable resident shell process)

: "${APACHE_CONFDIR:=/etc/apache2}"
: "${APACHE_ENVVARS:=$APACHE_CONFDIR/envvars}"
if test -f "$APACHE_ENVVARS"; then
	. "$APACHE_ENVVARS"
fi

# Apache gets grumpy about PID files pre-existing
: "${APACHE_RUN_DIR:=/var/run/apache2}"
: "${APACHE_PID_FILE:=$APACHE_RUN_DIR/apache2.pid}"
rm -f "$APACHE_PID_FILE"

# create missing directories
# (especially APACHE_RUN_DIR, APACHE_LOCK_DIR, and APACHE_LOG_DIR)
for e in "${!APACHE_@}"; do
	if [[ "$e" == *_DIR ]] && [[ "${!e}" == /* ]]; then
		# handle "/var/lock" being a symlink to "/run/lock", but "/run/lock" not existing beforehand, so "/var/lock/something" fails to mkdir
		#   mkdir: cannot create directory '/var/lock': File exists
		dir="${!e}"
		while [ "$dir" != "$(dirname "$dir")" ]; do
			dir="$(dirname "$dir")"
			if [ -d "$dir" ]; then
				break
			fi
			absDir="$(readlink -f "$dir" 2>/dev/null || :)"
			if [ -n "$absDir" ]; then
				mkdir -p "$absDir"
			fi
		done

		mkdir -p "${!e}"
	fi
done

exec apache2 -DFOREGROUND "$@"

```

## **Template du reverse proxy**
Utilisation de code php afin d'avoir accès à des variables d'environnement. Ces variables permettent de ne PAS avoir à coder les ProxyPass en dur dans le fichier config, mais bien de les spécifier au démarrage du container comme présenté en-dessous.
```
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

```

## **Utilisation**
1) Lancer les container des images apache_php et express_dynamic et récupérer leurs IP respectives. (Les méthodes sont explicitées dans les premières parties du labo.)
2) Lancer la commande suivante ```docker run -d -e STATIC_APP=172.17.0.x:80 -e DYNAMIC_APP=172.17.0.y:3000 --name apache_reverse -p 8080:80 http_infra_sauge_viotti/reverse_proxy```
3) STATIC_APP doit contenir l'IP du container apache_php et DYNAMIC_APP doit contenir celle du express_dynamic
4) Accédez au site et vous devriez voir apparaître "espece : prime=XXX". Cela indique que le contenu dynamique fonctionne.




## Sources annexes:

https://httpd.apache.org/docs/2.4/fr/mod/mod_proxy_http.html
