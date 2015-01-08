<?php

/**
 * This is email configuration file.
 *
 * Use it to configure email transports of Cake.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 */

/**
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 * 		Mail		- Send using PHP mail function
 * 		Smtp		- Send using SMTP
 * 		Debug		- Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email. Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {

    public $default = array(
        'transport' => 'Mail',
        'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );
    public $smtp = array(
        //'auth' => false,
        'transport' => 'Smtp',
        //'from' => 'no-replyP@vanzolini-ead.org.br',
        'from' => array('no-reply@vanzolini-ead.org.br' => 'Campeonato de Boliche – GTE'),
        'host' => 'smtphomologa.vanzolini-ead.org.br',
        'port' => 25,
        'timeout' => 30,
        'username' => null,
        'password' => null,
        'client' => null,
        'log' => false,
        //'domain' => 'vanzolini-gte.org.br',
        //'charset' => 'utf-8',
        //'headerCharset' => 'utf-8',
    );

}
