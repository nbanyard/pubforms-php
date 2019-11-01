<?php
namespace ShbPubForms;
// Avoid messing with Composer directores: pick up fonts from our directory
define('FPDF_FONTPATH', __DIR__ . '/../fonts');

const FONT = 'Muli';
const HMARGIN = 30.0;
const VMARGIN = 30.0;
const TITLE_SIZE = 20.0;
const HEADING_SIZE = 14.0;
const INSTRUCTION_SIZE = 10.0;
const LABEL_SIZE = 6.0;
const FIELD_SIZE = 10.0;
const PADDING = 2.0;

/*
 * Lines must be broken on word boundaries, so assume on avarage lines use this
 * amount of the available space.
 */
const FUDGE_FACTOR = 0.78;

class Renderer {

  private $pdf;

  function __construct() {
    $this->pdf = new \FPDF('P', 'pt', 'A4');
    $this->pdf->AddFont(FONT, '', 'Muli-ExtraLight.php');
    $this->pdf->AddFont(FONT, 'I', 'Muli-ExtraLightItalic.php');
    $this->pdf->AddFont(FONT, 'B', 'Muli-Regular.php');
    $this->pdf->AddFont(FONT, 'BI', 'Muli-RegularItalic.php');
  }

  function FormForPub($pub) {
    $this->AddMetadata($pub);
    foreach ((new FormTemplate)() as $page) {
      $this->Render($page, $pub);
    }
  }

  function AddMetadata($pub) {
    $this->pdf->SetTitle($pub['PubID'] . ': ' . $pub['Name'] . ', ' . $pub['Town'], true);
    $this->pdf->SetAuthor('Surrey/Hants Borders CAMRA', true);
    $this->pdf->SetCreator('SHB Pubs Form Creator', true);
    $this->pdf->SetSubject('Survey Form for WhatPub and GBG', true);
  }

  function Render($page, $pub) {
    $this->pdf->SetMargins(HMARGIN, VMARGIN);

    $this->left = VMARGIN;
    $this->top = HMARGIN;
    $this->right = VMARGIN;
    $this->bottom = HMARGIN;

    $fullWidth = $this->pdf->GetPageWidth();
    $fullHeight = $this->pdf->GetPageHeight();

    $width = $fullWidth - $this->left - $this->right;
    $height = $fullHeight - $this->top - $this->bottom;

    $this->pdf->SetAutoPageBreak(False, $this->bottom);

    $vscale = new Vscale($height, $page->GetHeight());
    $page->Render($this, $vscale, 0, 0, $width, 0, $pub);
  }

  function AddPage() {
    $this->pdf->AddPage();
  }

  function DrawTitle($x, $y, $w, $h, $text) {
    error_log($text);
    $this->pdf->SetFont(FONT, 'B', TITLE_SIZE);
    $this->pdf->SetXY($x + $this->left, $y + $this->top);
    $this->pdf->Cell($w, $h, $text, 0, 1, 'L', False);
  }

  function DrawHeading($x, $y, $w, $h, $text) {
    $this->pdf->SetFont(FONT, 'B', HEADING_SIZE);
    $this->pdf->SetXY($x + $this->left, $y + $this->top);
    $this->pdf->Cell($w, $h, $text, 0, 1, 'L', False);
  }

  function DrawInstruction($x, $y, $w, $h, $text) {
    $this->pdf->SetFont(FONT, 'I', INSTRUCTION_SIZE);
    $this->pdf->SetXY($x + $this->left, $y + $this->top);
    $this->pdf->Cell($w, $h, $text, 0, 1, 'L', False);
  }

  function DrawLabel($x, $y, $w, $h, $text) {
    $this->pdf->SetFont(FONT, 'B', LABEL_SIZE);
    $this->pdf->SetXY($x + $this->left, $y + $this->top + 1.0);
    $this->pdf->MultiCell($w, $h / 2.0 - 2.0, $text, 0, 'R', False);
  }

  function DrawTabelLabel($x, $y, $w, $h, $text) {
    $this->pdf->SetFont(FONT, 'B', LABEL_SIZE);
    $this->pdf->SetXY($x + $this->left, $y + $this->top);
    $this->pdf->MultiCell($w, $h, $text, 0, 'C', False);
  }

  function DrawField($x, $y, $w, $h, $text) {
    $this->pdf->Rect($x + $this->left, $y + $this->top, $w, $h, 'D');
    $this->pdf->SetXY($x + $this->left + PADDING, $y + $this->top + PADDING);

    $lineHeight = FIELD_SIZE * 3.0 / 2.0;
    $availableH = $h - PADDING * 2.0;
    $availableW = $w - PADDING * 2.0;

    $this->pdf->SetFont(FONT, '', FIELD_SIZE);
    $textW = $this->pdf->GetStringWidth($text);
    if ($h < $lineHeight * 2.0 && $textW > $availableW && $textW < $availableW * 2.0) {
      $this->pdf->SetFont(FONT, '', FIELD_SIZE * $availableW / $textW * 0.9);
    } else if ($textW / ($availableW * FUDGE_FACTOR) > $availableH / $lineHeight) {
      // The Go version of FPDF has SplitText which helps find whether
      // text fits into the available area, this is the next best thing.
      $scale = sqrt($availableH * $availableW * FUDGE_FACTOR / ($lineHeight * $textW));
      $lines = ceil(($textW * $scale) / ($availableW * FUDGE_FACTOR));
      $lineHeight = $availableH / $lines;
      $this->pdf->SetFont(FONT, '', $lineHeight * 2.0 / 3.0);
    }

    $this->pdf->MultiCell($availableW, $lineHeight, $text, 0, 'L', False);
  }

  function Output() {
    $this->pdf->Output();
  }
}
?>
