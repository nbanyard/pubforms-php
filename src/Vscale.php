<?php
namespace ShbPubForms;
/*
 * Class to calculate physical height from logical layout height
 *
 * The height of most components is based on the font size, some components
 * (currently field) are computed at construction from the number of units on
 * the page.
 */
class Vscale {
  private $titleScale;
  private $headingScale;
  private $instructionScale;
  private $labelScale;
  private $fieldScale;

  function __construct($physicalHeight, $layoutHeight) {
    $this->titleScale = TITLE_SIZE * 2.5 / 2.0;
    $this->headingScale = HEADING_SIZE * 3.5 / 2.0;
    $this->instructionScale = INSTRUCTION_SIZE * 3.0 / 2.0;
    $this->labelScale = LABEL_SIZE * 3.0 / 2.0;
    if ($layoutHeight->field == 0.0) {
      $this->fieldScale = 27.0;
    } else {
      $this->fieldScale = (
        $physicalHeight -
        $layoutHeight->title * $this->titleScale -
        $layoutHeight->heading * $this->headingScale -
        $layoutHeight->instruction * $this->instructionScale -
        $layoutHeight->label * $this->labelScale
      ) / $layoutHeight->field;
    }

    if ($thisl->fieldScale > 27.0) {
      $thisl->fieldScale = 27.0;
    }
  }

  function Calculate($layoutHeight) {
    return $layoutHeight->title * $this->titleScale +
      $layoutHeight->heading * $this->headingScale +
      $layoutHeight->instruction * $this->instructionScale +
      $layoutHeight->label * $this->labelScale +
      $layoutHeight->field * $this->fieldScale;
  }
}
?>
