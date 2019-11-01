<?php
namespace ShbPubForms;
/*
 * Instructions just have one block of text
 */
class Instruction extends Component {
  private $text;
  private $height;

  public function __construct($opts) {
    $this->text = $opts['text'];
    $this->height = $opts['height'];
  }

  public function GetHeight() {
    if ($this->height > 0) {
      return new Height(['instruction' => $this->height]);
    }
    return new Height(['instruction' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $text = $this->ExpandTemplate($this->text, $pub);

    if ($h == 0.0) {
      $h = $vscale->Calculate($this->GetHeight());
    }

    $renderer->DrawInstruction($x, $y, $w, $h, $text);

    return [$x + $w, $y + $h];
  }
}
?>
