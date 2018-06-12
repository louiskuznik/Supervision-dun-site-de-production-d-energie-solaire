<?php

function SelectMois($current_month, $current_year, $month, $sSelect, $sOption, $selectedDate = null)
{
    $options = sprintf($sOption, '', '[Pas de sélection]');
    for($i = 0, $m = $current_month, $y = $current_year; $i < 12; $i++, $m--)
    {
        if($m < 1)
        {
            $m = 12;
            $y--;
        }
        $value = $current_year .'-'. sprintf("%02d",$m);
        if(!is_null($selectedDate) && $selectedDate == $value)
        {
            $value .= '" selected="selected';
        }
        $label = $month[(int)$m] ." - ". $y;
        $options .= sprintf($sOption, $value, $label);
    }
    $select = sprintf($sSelect, $options);
    return $select;
}
$month = array(
     1 => 'Janvier',
     2 => 'Février',
     3 => 'Mars',
     4 => 'Avril',
     5 => 'Mai',
     6 => 'Juin',
     7 => 'Juillet',
     8 => 'Août',
     9=> 'Septembre',
    10=> 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
);

/*** Code du formulaire */
$sForm = <<<CODE_HTML
<form action="{$_SERVER['PHP_SELF']}" method="post" name="monform" id="monform">
  <div>
%s  </div>
</form>
CODE_HTML;

/*** Code de la liste de sélection */
$sSelect = <<<CODE_HTML
    <select name="date" id="date" size="1" onchange="document.forms['monform'].submit();">
%s    </select>
CODE_HTML;

/*** Code pour une option de sélectionn*/
$sOption = <<<CODE_HTML
      <option value="%s">%s</option>
CODE_HTML;

$selectedDate = isset($_POST['date']) ? $_POST['date'] : null;
// Recherche de la date du jour
$current_month = date('m');
$current_year  = date('Y');
$listeChoix = SelectMois($current_month, $current_year, $month, $sSelect, $sOption, $selectedDate);
$formulaire = sprintf($sForm, $listeChoix);
echo($formulaire);

?>