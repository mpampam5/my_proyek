<?php defined('BASEPATH') OR exit('No direct script access allowed');
/** mpampam
 *
 */
class Core
{

  Public function controllerList() {
    $CI =& get_instance();
    $CI->load->helper('directory');
    $rootpath = 'application/modules/backend/controllers/';
    $fileinfos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootpath));
    foreach($fileinfos as $pathname => $fileinfo) {
        if (!$fileinfo->isFile()) continue;
        if ($this->_secureReturnedFileName($pathname) == '') continue;
        $result[] = $this->_secureReturnedFileName($pathname);
    }
    // $not_access = array('administrator','core','dashboard','level','login','main_menu','setting_umum');
    $not_access = array();
    $controller = array_diff($result,$not_access);
    return $controller;
  }



  private function _secureReturnedFileName($file) {

    $permitted_file_extension = '.php';

    if (strpos($file, $permitted_file_extension) == TRUE) {

      $secure = str_replace(array('.php','application/modules/backend/controllers/'),'',strtolower($file));
      $secure2 = str_replace(array('application/modules/backend/controllers\\',''),'',$secure);
      return $secure2;
    }
  }


}


 ?>
