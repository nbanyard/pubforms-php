<?php
namespace ShbPubForms;
/*
 * Description fields just have one large box
 */
class Description extends Component {
  private $text;
  private $height;

  public function __construct($opts) {
    $this->text = $opts['text'];
    $this->height = $opts['height'];
  }

  public function GetHeight() {
    if ($this->height > 0) {
      return new Height(['field' => $this->height]);
    }
    return new Height(['field' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $text = $this->ExpandTemplate($this->text, $pub);

    if ($h == 0.0) {
      $h = $vscale->Calculate($this->GetHeight());
    }

    $renderer->DrawField($x, $y, $w, $h, $text);

    return [$x + $w, $y + $h];
  }
}
?>
