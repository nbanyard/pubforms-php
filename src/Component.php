<?php
namespace ShbPubForms;
/*
 * The form template is made up of a load of components
 *
 * Each knows its logical size, and can render its contents for a given pub
 */
abstract class Component {
  abstract public function GetHeight();
  abstract public function Render($renderer, $vscale, $x, $y, $w, $h, $pub);

  protected const LABEL_FRACTION = 0.2;

  /*
   * Use the template engine to expande a template for a given pub's data
   */
  protected function ExpandTemplate($template, $pub)
  {
    $m = new \Mustache_Engine([
      'escape' => function($value) { return $value; }
    ]);
    //return $template;
    return iconv('utf-8', 'iso-8859-15//TRANSLIT', trim($m->render($template, $pub)));
  }
}
?>
