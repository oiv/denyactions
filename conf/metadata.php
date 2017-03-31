<?php
/**
 * Options for the denyactions plugin
 *
 * @author Otto Vainio <otto@valjakko.net>
 */


$meta['denyactions'] = array('Actions to deny from read only users. (media, index, etc)');
$meta['denyrev'] = array('onoff');
$meta['denystyle'] = array('multichoice', '_choices' => array('silent', 'msg', 'login'));
