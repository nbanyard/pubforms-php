<?php
namespace ShbPubForms;

class FormTemplate {
  public function __invoke() {
    return [
      new Page([
        new Title(['text' => '{{ PubID }}:  {{ Name }}, {{ Town }}']),
        new Heading(['text' => 'Identification']),
        new Columns([
          'gap' => 13,
          'columns' => [
            [
              new Text(['label' => 'County', 'value' => '{{ County }}']),
              new Text(['label' => 'Town', 'value' => '{{ Town }}']),
              new Text(['label' => 'District', 'value' => '{{ District }}']),
              new Text(['label' => 'Name', 'value' => '{{ Name }}']),
              new Text(['label' => 'Alternative name', 'value' => '{{ AltName }}']),
              new Text(['label' => 'Previous name', 'value' => '{{ PreviousName }}', 'height' => 2])
            ],
            [
              new Text(['label' => 'Surveyor', 'value' => '{{ Surveyor }}']),
              new Text(['label' => 'Survey date', 'value' => '{{ SurveyDate }}']),
              new Text(['label' => 'Licensee', 'value' => '{{ Licensee }}']),
              new Text(['label' => 'Licensee type', 'value' => '{{ LicenseeType }}']),
              new Text(['label' => 'Tie', 'value' => '{{ TieDegree }}']),
              new Text(['label' => 'Owning company', 'value' => '{{ Owner }}']),
              new Text(['label' => 'Operator', 'value' => '{{ Operator }}']),
            ]
          ]
        ]),
        new Heading(['text' => 'Contact details']),
        new Columns([
          'gap' => 13,
          'columns' => [
            [
              new Text(['label' => 'Steet', 'value' => '{{ Street }}']),
              new Text(['label' => 'Post code', 'value' => '{{ Postcode }}']),
              new Text(['label' => 'Post town', 'value' => '{{ Posttown }}']),
              new Boolean(['label' => 'Hard to find (remote)', 'value' => '{{ HardToFind }}']),
              new Text(['label' => 'Directions', 'value' => '{{ Directions }}', 'height' => 2]),
              new Text(['label' => 'Opening hours', 'value' => '{{ OpeningTimes }}', 'height' => 2]),
              new Text(['label' => 'Food hours', 'value' => '{{ MealTimes }}', 'height' => 2]),
            ],
            [
              new Text(['label' => 'Telephone', 'value' => '{{ Telephone }}']),
              new Text(['label' => 'Website', 'value' => '{{ Website }}', 'height' => 3]),
              new Text(['label' => 'Email', 'value' => '{{ Email }}']),
              new Boolean(['label' => 'Publish email?', 'value' => '{{ EmailPublish }}']),
              new Text(['label' => 'Facebook', 'value' => '{{ Facebook }}']),
              new Text(['label' => 'Twitter', 'value' => '{{ Twitter }}']),
              new Text(['label' => 'Premises type', 'value' => '{{ PremisesType }}']),
              new Text(['label' => 'Type comment', 'value' => '{{ PremisesTypeComment }}']),
            ]
          ]
        ]),
        new Heading(['text' => 'Facilities']),
        new Columns([
          'gap' => 13,
          'columns' => [
            [
              new Boolean(['label' => 'Real fire', 'value' => '{{ RealFire }}']),
              new Boolean(['label' => 'Quiet pub', 'value' => '{{ Quiet }}']),
              new Boolean(['label' => 'Family friendly', 'value' => '{{ FamilyFriendly }}', 'comment' => '{{ FamilyFriendlyComment }}']),
              new Boolean(['label' => 'Garden', 'value' => '{{ Garden }}', 'comment' => '{{ GardenComment }}']),
              new Boolean(['label' => 'Accommodation', 'value' => '{{ Accommodation }}', 'comment' => '{{ AccommodationComment }}']),
              new Boolean(['label' => 'Lunchtime meals', 'value' => '{{ LunchtimeMeals }}', 'comment' => '{{ LunchtimeMealsComment }}']),
              new Boolean(['label' => 'Evening meals', 'value' => '{{ EveningMeals }}', 'comment' => '{{ EveningMealsComment }}']),
              new Boolean(['label' => 'Restaurant', 'value' => '{{ Restaurant }}', 'comment' => '{{ RestaurantComment }}']),
              new Boolean(['label' => 'Separate public bar', 'value' => '{{ SeparateBar }}']),
              new Boolean(['label' => 'Disabled access (inc. WC)', 'value' => '{{ DisabledAccess }}', 'comment' => '{{ DisabledAccessComment }}']),
              new Boolean(['label' => 'Games', 'value' => '{{ Games }}', 'comment' => '{{ GamesComment }}']),
              new Boolean(['label' => 'Smoking', 'value' => '{{ Smoking }}', 'comment' => '{{ SmokingComment }}']),
              new Boolean(['label' => 'Member discount', 'value' => '{{ MemberDiscountScheme }}', 'comment' => '{{ MemberDiscountSchemeComment }}']),
              new Boolean(['label' => 'Live music', 'value' => '{{ LiveMusic }}', 'comment' => '{{ LiveMusicComment }}']),
              new Boolean(['label' => 'Newspapers', 'value' => '{{ Newspapers }}']),
              new Boolean(['label' => 'Club allows CAMRA', 'value' => '{{ ClubAllowsCAMRAVisitors }}']),
            ],
            [
              new Boolean(['label' => 'Bus near Distance (m)', 'value' => '{{ Bus }}', 'comment' => '{{ BusDistance }}']),
              new Text(['label' => 'Bus routes', 'value' => '{{ BusRoutes }}', 'height' => 3]),
              new Boolean(['label' => 'Camping Distance (m)', 'value' => '{{ Camping }}', 'comment' => '{{ CampingDistance }}']),
              new Boolean(['label' => 'Real cider', 'value' => '{{ Cider }}', 'comment' => '{{ CiderComment }}']),
              new Boolean(['label' => 'WiFi', 'value' => '{{ WiFi }}', 'comment' => '{{ WiFiComment }}']),
              new Boolean(['label' => 'Parking', 'value' => '{{ Parking }}', 'comment' => '{{ ParkingComment }}']),
              new Boolean(['label' => 'Function room', 'value' => '{{ FunctionRoom }}', 'comment' => '{{ FunctionRoomComment }}']),
              new Boolean(['label' => 'Line glasses', 'value' => '{{ LinedGlasses }}']),
              new Boolean(['label' => 'Misleading dispense', 'value' => '{{ MisleadingDispense }}', 'comment' => '{{ MisleadingDispenseComment }}']),
              new Boolean(['label' => 'Cask breather', 'value' => '{{ CaskBreather }}', 'comment' => '{{ CaskBreatherComment }}']),
              new Text(['label' => 'Historic interest', 'value' => 'See over']),
              new Boolean(['label' => 'Sports TV', 'value' => '{{ SportsTV }}', 'comment' => '{{ SportsTVComment }}']),
              new Boolean(['label' => 'Dog friendly', 'value' => '{{ DogFriendly }}', 'comment' => '{{ DogFriendlyComment }}']),
            ]
          ]
        ]),
      ]),
      new Page([
        new Heading(['text' => 'Pub watch']),
        new Columns([
          'gap' => 13,
          'columns' => [
            [
              new Text(['label' => 'Premises status', 'value' => '{{ PremisesStatus }}']),
              new Text(['label' => 'Change type', 'value' => '{{ ChangeType }}']),
              new Text(['label' => 'Change date', 'value' => '{{ ChangeDate }}']),
            ],
            [
              new Text(['label' => 'Status comment', 'value' => '{{ PremisesStatusComment }}', 'height' => 2]),
              new Text(['label' => 'Closure date', 'value' => '{{ ClosedDate }}']),
            ]
          ]
        ]),
        new Heading(['text' => 'Real ale availability and guide recommendations']),
        new Columns([
          'gap' => 13,
          'columns' => [
            [
              new Boolean(['label' => 'Real ale', 'value' => '{{ RealAle }}']),
              new Boolean(['label' => 'Cask Marque', 'value' => '{{ CaskMarque }}']),
              new Boolean(['label' => 'LocAle', 'value' => '{{ LocAle }}', 'comment' => '{{ LocAleComment }}']),
            ],
            [
              new Boolean(['label' => 'Beer, Bed & Breakfast', 'value' => '{{ RecommendBBB }}']),
              new Boolean(['label' => 'Good Pub Food', 'value' => '{{ RecommendGPF }}']),
              new Boolean(['label' => 'Family Pubs', 'value' => '{{ RecommendPFF }}']),
              new Boolean(['label' => 'Cider Guide', 'value' => '{{ RecommendGCG }}']),
            ]
          ]
        ]),
        new Heading(['text' => 'Beer']),
        new Beers(),
        new Heading(['text' => 'WhatPub Description']),
        new Instruction(['text' => 'Please review this description for improvements and out of date material.']),
        new Description(['text' => '{{ Description }}', 'height' => 8]),
    /*
    new Heading(['text' => 'GBG Description']),
    new Instruction(['text' => 'This description must be between 50 and 80 words.']),
    new Description(['text' => '{{ GBGDescription }}', 'height' => 5]),
     */
        new Heading(['text' => 'Historic Interest']),
        new Instruction(['text' => 'This description is now included on WhatPub.']),
        new Description(['text' => '{{ HistoricInterest }}', 'height' => 3]),
      ])
    ];
  }
}
?>
