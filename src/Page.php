<?php
namespace ShbPubForms;
/*
 * The page component holds a load of other components
 *
 * Its height is the sum of the heights of its components, when it is rendered
 * it creates a new page and then renders each of its components, one under the
 * other.
 */
class Page extends Component {
  private $components;

  public function __construct($components) {
    $this->components = $components;
  }

  public function GetHeight() {
    $totalHeight = new Height([]);
    foreach ($this->components as $component) {
      $totalHeight = $totalHeight->Add($component->GetHeight());
    }
    return $totalHeight;
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $renderer->AddPage();
    foreach ($this->components as $component) {
      $y = $component->Render($renderer, $vscale, $x, $y, $w, $h, $pub)[1];
    }
    return [$x + $w, $y + $h];
  }
}
?>
