<?php

namespace Foolz\FoolFuuka\Plugins\RandomAnon\Model;

use Foolz\FoolFuuka\Model\Comment;

class RandomAnon
{ 
  public static function process($result)
  {
    $data = $result->getObject();
    if (!$data->radix->getValue('plugin_randomanon_enable'))
    {
      return null;
    }
    $names = ['<span class="burning">Kan Csoma</span>', 'Teszt Elek', 'Masztur Bálint', 'Pun Cili', 'Fag Ottó', 'Hűtvetá Rolandó', 'Ge Cili', 'Kandisz Nóra', 'Kis Loli', 'Nullre Ferenc', 'Citad Ella :C', 'Vezekényi Lacika', 'Kiss László Zsolt']; //TODO worst practice
    $opname = 'Op Elemér';//table.opname, global.opname
    $hourname = 'Ték Elek';
    $getname = 'Ték Elek';
    $name8 = 'Regg Eliz';
    $name12 = 'Ebéd Elek';
    $name18 = 'Vacs Izóra';
    if ($data->comment->name_processed === $data->radix->getValue('anonymous_default_name'))
    {
      if($opname && ($data->comment->poster_ip === false))//getPostById($data->comment->thread_id)->poster_ip)
      {
        $name = $opname;
      }
      else
      {
        mt_srand($data->comment->poster_ip);
        $name = $names[mt_rand(0, count($names)-1)];
      }
      $result->setParam('name', $name);
      $result->set($result->getParam('name'));
    }
    return null;
  }
}

