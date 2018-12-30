<?php
/**
 * DokuWiki Plugin denyactions (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Otto Vainio <otto@valjakko.net>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_denyactions_act extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {

       $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'handle_action_act_preprocess');
   
    }

    public function handle_action_act_preprocess(Doku_Event $event, $param) {
      global $ID;
	    global $lang;
	    $todeny=$this->getConf('denyactions');
      $style=$this->getConf('denystyle');
	    $do = $event->data;
      echo 
      $this->setupLocale();
      $perm = auth_quickaclcheck($ID);
      if($perm < AUTH_EDIT){
        if (stristr($todeny,$do)) {
          $event->data='show';	
          if ($style==='msg') {
            msg($this->lang['actiondenied'],-1);
          } else if ($style==='login') {
            global $ACT;
            $ACT = 'denied';
            $event->preventDefault();
            $event->stopPropagation();

          } 
        }
      }
    }
}

// vim:ts=4:sw=4:et:
