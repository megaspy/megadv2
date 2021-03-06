<?php
namespace megadv2\classes
{
class core
{
private static $router = false; 
private static $conf = array();
private static $modules = array();

static function arr($arr,$value,$default)
{
if (isset($arr[$value]))
  {
  return $arr[$value];
  } else
  {
  return $default;
  }
}

static function router()
{
if (self::$router) 
  {
  return self::$router;
  } else
  {
  self::$router = new router();
  return self::$router;
  }
}

static function init()
{
self::load_conf();

}

static function load_conf($grp = ".")
{
if ($grp == "") $grp = ".";

if ($grp == '.') 
{
if (file_exists('app/config/config.php')) {
self::$conf['.'] = include('app/config/config.php'); 
} else return false;
} else
{
if (file_exists('app/config/'.$grp.'.php')) {
self::$conf[$grp] = include('app/config/'.$grp.'.php');
} elseif(file_exists('megadv2/modules/'.$grp.'/config/'.$grp.'.php')) {
self::$conf[$grp] = include('megadv2/modules/'.$grp.'/config/'.$grp.'.php');
} else return false;
}
return true;
}

static function conf($grp = ".")
{
if ($grp == "") $grp = ".";

if (!isset(self::$conf[$grp])) {
self::load_conf($grp);
}
return self::$conf[$grp];
}

//--------------
static function controller($controller_name)
{
$class_name = 'app\controller\\'.$controller_name;
return new $class_name();
}

static function view($template)
{
return new view($template);
}

static function model($model_name)
{
$class_name = 'app\model\\'.$model_name;
return new $class_name();
}


static function load_module($mod_name)
{
if (!(isset(self::$modules[$mod_name])))
{
self::load_conf($mod_name);
$class_name = "\\megadv2\\modules\\$mod_name\\".$mod_name;
self::$modules[$mod_name] = $class_name::getInstance();
}

}

static function module($mod_name)
{
if(isset(self::$modules[$mod_name]))
{
return self::$modules[$mod_name];
}
}



}}
?>