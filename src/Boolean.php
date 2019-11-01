<?php
namespace ShbPubForms;
/*
 * Booleans have three components: a label, yes/no value, optional comment
 *
 * They are always one field high.
 */
class Boolean extends Component {
  private $label;
  private $value;
  private $comment;

  public function __construct($opts) {
    $this->label = $opts['label'];
    $this->value = $opts['value'];
    $this->comment = $opts['comment'];
  }

  public function GetHeight() {
    return new Height(['field' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $value = $this->ExpandTemplate($this->value, $pub);
    $comment = $this->ExpandTemplate($this->comment, $pub);

    $labelHeight = $vscale->Calculate(new Height(['label' => 2.0]));

    if ($h == 0.0) {
      $fieldHeight = $vscale->Calculate(new Height(['field' => 1.0]));
    } else {
      $fieldHeight = $h;
    }

    if ($labelHeight > $fieldHeight) {
      $labelHeight = $fieldHeight;
    }

    $labelY = $y + ($fieldHeight - $labelHeight) / 2.0;
    $labelWidth = $w * self::LABEL_FRACTION;

    $boolWidth = $fieldHeight * 3.0 / 2.0;

    $renderer->DrawLabel($x, $labelY, $labelWidth, $labelHeight, $this->label);
    $renderer->DrawField($x + $labelWidth, $y, $boolWidth, $fieldHeight, $value);

    if ($this->comment) {
      $renderer->DrawField($x + $labelWidth + $boolWidth, $y, $w - $labelWidth - $boolWidth, $fieldHeight, $comment);
    }

    return [$x + $w, $y + $fieldHeight];
  }
}
?>
