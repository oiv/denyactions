<?php
/**
 * DokuWiki Plugin denyactions (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Otto Vainio <otto@valjakko.net>
 */

if(!defined('DOKU_INC')) die();

class action_plugin_denyactions_rev extends DokuWiki_Action_Plugin {

    function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TPL_ACT_RENDER', 'BEFORE', $this, 'handle_start', array());
    }

    function handle_start(Doku_Event $event, $param) {
        global $INFO;
        global $lang;
        $pif=pageinfo();

        $style=$this->getConf('denystyle');
        $drev=$this->getConf('denyrev');
        $perm = auth_quickaclcheck($ID);
        if($perm < AUTH_EDIT){
          if ($drev && $pif['rev'] !== 0) {
            if ($style==='login') {
              global $ACT;
              $ACT = 'denied';
            } else {
              if ($style==='msg') {
                $this->setupLocale();
                msg($this->lang['actiondenied'],-1);
              }
              $event->preventDefault();
              $event->stopPropagation();
            }
          }
        }
    }
}
