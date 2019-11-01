<?php
namespace ShbPubForms;
/*
 * Texts have two components: a label, a value
 *
 * Some text fields can be large, so they can be a few times the height of a
 * normal text field.
 */
class Text extends Component {
  private $label;
  private $value;
  private $height;

  public function __construct($opts) {
    $this->label = $opts['label'] ?: '';
    $this->value = $opts['value'] ?: '';
    $this->height = $opts['height'] ?: 0.0;
  }

  public function GetHeight() {
    if ($this->height > 0) {
      return new Height(['field' => $this->height]);
    }
    return new Height(['field' => 1.0]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $value = $this->ExpandTemplate($this->value, $pub);

    $labelHeight = $vscale->Calculate(new Height(['label' => 2.0]));
    if ($h == 0.0) {
      if ($this->height > 0.0) {
        $fieldHeight = $vscale->Calculate(new Height(['field' => $this->height]));
      } else {
        $fieldHeight = $vscale->Calculate(new Height(['field' => 1.0]));
      }
    } else {
      $fieldHeight = $h;
    }

    if ($labelHeight > $fieldHeight) {
      $labelHeight = $fieldHeight;
    }

    $labelY = $y + ($fieldHeight - $labelHeight) / 2.0;
    $labelWidth = $w * self::LABEL_FRACTION;

    $renderer->DrawLabel($x, $labelY, $labelWidth, $labelHeight, $this->label);
    $renderer->DrawField($x + $labelWidth, $y, $w - $labelWidth, $fieldHeight, $value);

    return [$x + $w, $y + $fieldHeight];
  }
}
?>
