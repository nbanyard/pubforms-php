<?php
namespace ShbPubForms;
/*
 * Abstract height
 *
 * Instances are made up of various proportions of different elements.
 *
 * The Vscale class converts these to physical sizes.
 */
class Height {
  public $title;
  public $heading;
  public $instruction;
  public $label;
  public $field;

  function __construct($parts) {
      $this->title = $parts['title'] ?: 0.0;
      $this->heading = $parts['heading'] ?: 0.0;
      $this->instruction = $parts['instruction'] ?: 0.0;
      $this->label = $parts['label'] ?: 0.0;
      $this->field = $parts['field'] ?: 0.0;
  }

  function Add($other) {
    return new Height([
      'title' => $this->title + $other->title,
      'heading' => $this->heading + $other->heading,
      'instruction' => $this->instruction + $other->instruction,
      'label' => $this->label + $other->label,
      'field' => $this->field + $other->field
    ]);
  }

  function GreaterThan($other) {
    return $this->title + $this->heading + $this->instruction + $this->label + $this->field >
      $other->title + $other->heading + $other->instruction + $other->label + $other->field;
  }
}
?>
