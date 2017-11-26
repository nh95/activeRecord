<?php
class Displaytable{


  public static function display($records){
  $html = "<html><body><table border = 1>";
  $html .= "<tr>";
  //Set the header using the 1st record
  foreach($records[0] as $key => $value){
  $html .="<th>" .$key. "</th>";
  }
  $html .= "</tr>";
  //generate rows
  foreach($records as $record){
  $html .= "<tr>";
  foreach ($record as $key => $value){
  $html .="<td>" .$value. "</td>";
  }
  $html .= "</tr>";
  }
  $html .="</table>";
  echo $html;
  }

}



?>
