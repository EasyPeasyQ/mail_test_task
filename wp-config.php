<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_test' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'uHnMP`dblA4;0xlIs&p+(ig%<83*fdYk}}-r`gu8V9J~#)_A+U}wD3]d$t/JNn,L' );
define( 'SECURE_AUTH_KEY',  '>=LUg@}:E=K;icG*xo5O.t>{*Ks+eR4o@?!qBP>Voz#)Qw(&3Bx<{Y_]MF.Yprb<' );
define( 'LOGGED_IN_KEY',    'M2uy|2,0PJ$Ce}L.Wb$w:T]&(,2LL1g4|N:Ib%6OTqD<D6|UuP(CySx.ZLuEg39;' );
define( 'NONCE_KEY',        't+`)Hq~m{)`d+vV4y#6`~A-[Jbgopd]$Q>~9A,-{/AmSl&TQh3&[rkg*Vj. Z_Py' );
define( 'AUTH_SALT',        '7veGx6[m`.q8V-cn9MI3N5ICES5F+N/&R_5`jr#;Dl5aXj5lIX%{jv,Baw`kOPE)' );
define( 'SECURE_AUTH_SALT', '&v=}DnBC%M@E`80Q/1RRFp5|;&!*V:Lw74X/e>aDyRMw/.]%yfKo}Fuofdr&F7>4' );
define( 'LOGGED_IN_SALT',   '?TwnKdFk@lG=!=~!)X[zlSn5hE~Z@{WdZ_zId.;i3@hg5mf[,;`?dgS^g<bW%<?C' );
define( 'NONCE_SALT',       '_ikhh+Z75Qas?>Y$D4PysjU`.}cQgZZnh>rM/&JGpE xNH--aO7OLpR^xEX)q>4f' );


define( 'HUBSPOT_KEY',		'28baad16-0648-4fb8-b107-c5e04c4af675' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
