<?php
class SortArray {
    public function sortArray($arrayToSort) {
        sort($arrayToSort);
             foreach ($arrayToSort as $key => $val) {
                echo "arrayToSort[" . $key . "] = " . $val . "\n";
             }  
    }
}

class ReverseSortArray {
    public function sortArray($arrayToSort) {
        rsort($arrayToSort);
             foreach ($arrayToSort as $key => $val) {
                echo "arrayToSort[" . $key . "] = " . $val . "\n";
             }  
    }
}

function sortAnyArray($arrayToSort, $arraySorter = new SortArray)
{
    return $arraySorter->sortArray($arrayToSort);
}

$arrayToSort = array("B", "A", "f", "C");
echo sortAnyArray($arrayToSort);
echo "<br/>";
echo sortAnyArray($arrayToSort, new ReverseSortArray);
?>
