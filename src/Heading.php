<?php
namespace ShbPubForms;
/*
 * A heading is another simple text template to be drawn quite large
 */
class Heading extends Component {
  private $text;

  public function __construct($opts) {
    $this->text = $opts['text'];
  }

  public function GetHeight() {
    return new Height(['heading' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $text = $this->ExpandTemplate($this->text, $pub);
    if ($h == 0.0) {
      $h = $vscale->Calculate($this->GetHeight());
    }
    $renderer->DrawHeading($x, $y, $w, $h, $text);
    return [$x + $w, $y + $h];
  }
}
?>
