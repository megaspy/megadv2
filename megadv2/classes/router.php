<?php
namespace megadv2\classes
{
class router
{
public $controller = "";
public $action = "";
public $id = "";

private $def_controller = "index";
private $def_action = "index";
private $directories = array();

public function set_dir($dir)
{
$this->directories[] = $dir;
}

public function route($r)
{


$p = explode("/", $r,3);
if ($p[0] <> '')
 {
 $this->controller = $p[0];
 if ($p[1] <> '')
   {
   $this->action = $p[1];
   $this->id = $p[2];
   } else
   {
   $this->action = $this->def_action;
   $this->id = "";   
   }
 return true;  
 } else
 {
 $this->controller = $this->def_controller;
 $this->action = $this->def_action;
 $this->id = "";
 return false;
 }

}


}
}
?>