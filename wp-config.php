<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'FP|w_)W@#_n|7=.1~GCa6m)y1,ji+diWuQ;,U [uTmYUVP.hsJ4ifYH.1)YR#7I9');
define('SECURE_AUTH_KEY',  'MXh3tv[h-w9<YG?~:|yqPHNW?xL#c^$--$Rq8mq5<sC/?@k8P>dzS;CL4dGd;hb|');
define('LOGGED_IN_KEY',    'jRJEn+T7u4@ERyqEupw<8_Rd|o2bUGA%t~7YT&:<Mrm^8D+I[c4v4}YVcXSVh?pl');
define('NONCE_KEY',        'J{|yh1%/CG(7nuY9*V2;50~jk~y`-vhE<Ji2&J^e*4E!-B/U)G-Lu(X8!@S,L=9r');
define('AUTH_SALT',        'w8558fp5mTR%jlD{$N/U#,c)GQ+AMdHU(&WlC4M@=h)MKP~V%.mu:o5Pd`K-lrjt');
define('SECURE_AUTH_SALT', '+Zr#FWC:v@Cj:LTZ,,;`LWj2k2f@!Ncv=x|#WO4j0!{<1CF%%En%Ra@$n&p[$Hg]');
define('LOGGED_IN_SALT',   'YL;l*Gv$,`>TH**$j{*<it!XsVLA/b)+TfI^.`[vf5f8KbgIPsLmzD)5hnV%XgHK');
define('NONCE_SALT',       '-wT#jKx66^lO,Z!/mpjG:kcQWJI%zS{Y0u{D7?rxXTGEfKC7(p2IX),ix~r2bozl');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_cesi_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');