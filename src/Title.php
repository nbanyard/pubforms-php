<?php
namespace ShbPubForms;
/*
 * A title is a simple text template to be drawn nice and large
 */
class Title extends Component {
  private $text;

  public function __construct($opts) {
    $this->text = $opts['text'];
  }

  public function GetHeight() {
    return new Height(['title' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $text = $this->ExpandTemplate($this->text, $pub);

    if ($h == 0.0) {
      $h = $vscale->Calculate($this->GetHeight());
    }
    $renderer->DrawTitle($x, $y, $w, $h, $text);
    return [$x + $w, $y + $h];
  }
}
?>
