<?php
namespace ShbPubForms;
/*
 * Columns render two or more columns of components side by side
 *
 * The height of a Columns object is the greatest height of any column.
 * For GetHeight this is a best guess (see Height::GreaterThan).
 * When rendering the height is correct (even if the Vscale is not correctly
 * calebrated).
 */
class Columns extends Component {
  private $gap;
  private $columns;

  public function __construct($opts) {
    $this->gap = $opts['gap'];
    $this->columns = $opts['columns'];
  }

  public function GetHeight() {
    $maxHeight = new Height([]);
    foreach ($this->columns as $column) {
      $thisHeight = new Height([]);
      foreach ($column as $component) {
        $thisHeight = $thisHeight->Add($component->GetHeight());
      }
      if ($thisHeight->GreaterThan($maxHeight)) {
        $maxHeight = $thisHeight;
      }
    }
    return $maxHeight;
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $columnWidth = ($w + $this->gap) / count($this->columns) - $this->gap;

    $maxY = 0.0;
    foreach ($this->columns as $i => $column) {
      $columnX = ($columnWidth + $this->gap) * $i;
      $columnY = $y;
      foreach ($column as $component) {
        $columnY = $component->Render($renderer, $vscale, $columnX, $columnY, $columnWidth, 0.0, $pub)[1];
      }
      if ($columnY > $maxY) {
        $maxY = $columnY;
      }
    }

    return [$x + $w, $maxY];
  }
}
?>
