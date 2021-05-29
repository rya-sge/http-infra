# README

## **DockerFile**

Cette partie indique, dans l'ordre, ce que fait le dockerfile


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
[?2004h[?1049h[22;0;0t[1;24r(B[m[4l[?7h[39;49m[?1h=[?1h=[?25l[39;49m(B[m[H[2J(B[0;7m  GNU nano 4.8                       New Buffer                                 [1;79H(B[m[22;16H(B[0;7m[ Welcome to nano.  For basic help, type Ctrl+G. ](B[m[23d(B[0;7m^G(B[m Get Help  (B[0;7m^O(B[m Write Out (B[0;7m^W(B[m Where Is  (B[0;7m^K(B[m Cut Text  (B[0;7m^J(B[m Justify   (B[0;7m^C(B[m Cur Pos[24d(B[0;7m^X(B[m Exit[14G(B[0;7m^R(B[m Read File (B[0;7m^\(B[m Replace   (B[0;7m^U(B[m Paste Text(B[0;7m^T(B[m To Spell  (B[0;7m^_(B[m Go To Line[22d[2d[39;49m(B[m[?12l[?25h[?25l[1;71H(B[0;7mModified(B[m[2dN[?12l[?25h[?25lo[?12l[?25h[?25lt[?12l[?25h[?25lh[?12l[?25h[?25li[?12l[?25h[?25ln[?12l[?25h[?25lg[?12l[?25h[?25l[22;18H(B[0;7mline 1/2 (50%), col 8/8 (100%), char 7/8 (87%) ](B[m[2;8H[?12l[?25h[?25l[22d(B[0;7mSave modified buffer?                                                           [23;1H Y(B[m Yes[K[24d(B[0;7m N(B[m No  [14G   (B[0;7m^C(B[m Cancel[K[22;23H[?12l[?25h[?25l[?12l[?25h[?25l[?12l[?25h[?25l[22;33H[1K (B[0;7m[ Cancelled ](B[m[K[23d(B[0;7m^G(B[m Get Help  (B[0;7m^O(B[m Write Out (B[0;7m^W(B[m Where Is  (B[0;7m^K(B[m Cut Text  (B[0;7m^J(B[m Justify   (B[0;7m^C(B[m Cur Pos[24d(B[0;7m^X(B[m Exit[14G(B[0;7m^R(B[m Read File (B[0;7m^\(B[m Replace   (B[0;7m^U(B[m Paste Text(B[0;7m^T(B[m To Spell  (B[0;7m^_(B[m Go To Line[22d[2;8H[?12l[?25h[?25lc[?12l[?25h[?25l[?12l[?25h[24;1H[?1049l[23;0;0t[?1l>[?2004l
