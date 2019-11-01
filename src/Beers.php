<?php
namespace ShbPubForms;
/*
 * Beer tables - fancy stuff - no parameters, just loads of internal logic
 */
class Beers extends Component {
  const PERM_BEERS = 6.0;
  const CHANGE_BEERS = 3.0;

  public function GetHeight() {
    return new Height([
      'label' => 3.0,
      'field' => self::PERM_BEERS + self::CHANGE_BEERS + 1.0
    ]);
  }

  public function Render($renderer, $vscale, $x, $y, $w, $h, $pub) {
    $breweryX = $x;
    $breweryWidth = $w / 4.0;
    $beerX = $breweryX + $breweryWidth;
    $beerWidth = $w / 4.0;
    $dispenseX = $beerX + $beerWidth;
    $dispenseWidth = $vscale->Calculate(new Height(['field' => 1.25]));
    $commentX = $dispenseX + $dispenseWidth;
    $commentWidth = $w - $commentX;

    $labelHeight = $vscale->Calculate(new Height(['label' => 1.0]));
    $fieldHeight = $vscale->Calculate(new Height(['field' => 1.0]));
    $changeSummaryLabelY = $y + $labelHeight + self::PERM_BEERS * $fieldHeight;
    $changeSummaryY = $changeSummaryLabelY + $labelHeight;
    $changeY = $changeSummaryY + $fieldHeight;

    // Perm beers
    $renderer->DrawTabelLabel($breweryX, $y, $breweryWidth, $labelHeight, 'Regular Brewery/Brand');
    $renderer->DrawTabelLabel($beerX, $y, $beerWidth, $labelHeight, 'Regular Beer');
    $renderer->DrawTabelLabel($dispenseX, $y, $dispenseWidth, $labelHeight, 'H/G');
    $renderer->DrawTabelLabel($commentX, $y, $commentWidth, $labelHeight, 'House name/Comment');

    $regularBeers = json_decode($pub['RegularBeers']);
    for ($i = 0; $i < self::PERM_BEERS; ++$i) {
      $iY = $y + $labelHeight + $i * $fieldHeight;
      $renderer->DrawField($breweryX, $iY, $breweryWidth, $fieldHeight, $regularBeers[$i]->BR);
      $renderer->DrawField($beerX, $iY, $beerWidth, $fieldHeight, $regularBeers[$i]->BE);
      $renderer->DrawField($dispenseX, $iY, $dispenseWidth, $fieldHeight, $regularBeers[$i]->D);
      $renderer->DrawField($commentX, $iY, $commentWidth, $fieldHeight, $regularBeers[$i]->C);
    }

    // Changing beers summary
    $renderer->DrawTabelLabel($breweryX, $changeSummaryLabelY, $breweryWidth, $labelHeight, 'Number of changing beers');
    $renderer->DrawField($breweryX, $changeSummaryY, $breweryWidth, $fieldHeight, $pub['ChangingBeerNumber']);
    $renderer->DrawTabelLabel($dispenseX, $changeSummaryLabelY, $dispenseWidth, $labelHeight, 'H/G');
    $renderer->DrawField($dispenseX, $changeSummaryY, $dispenseWidth, $fieldHeight, $pub['ChangingBeerDispense']);
    $renderer->DrawTabelLabel($commentX, $changeSummaryLabelY, $commentWidth, $labelHeight, 'Changing beer source: Local / Region / National');
    $renderer->DrawField($commentX, $changeSummaryY, $commentWidth, $fieldHeight, $pub['ChangingBeerSource']);

    // Changing beers
    $renderer->DrawTabelLabel($breweryX, $changeY, $breweryWidth + $beerWidth, $labelHeight, 'Typical Changing Beers');
    $renderer->DrawTabelLabel($commentX, $changeY, $commentWidth, $labelHeight, 'Comment about changing beers');

    $typicalBeers = explode(';', $pub['TypicalChangingBeers']);
    for ($i = 0; $i < self::CHANGE_BEERS; ++$i) {
      $iY = $changeY + $labelHeight + $i * $fieldHeight;
      $renderer->DrawField($breweryX, $iY, $breweryWidth + $beerWidth, $fieldHeight, $typicalBeers[$i]);
    }
    $renderer->DrawField($commentX, $changeY + $labelHeight, $commentWidth, self::CHANGE_BEERS * $fieldHeight, $pub['ChangingBeerComment']);

    if ($h == 0.0) {
      $h = $vscale->Calculate($this->GetHeight());
    }
    return [$x + $w, $y + $h];
  }
}
?>
