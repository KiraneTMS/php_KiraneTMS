<?php

$jml = isset($_GET['jml']) ? intval($_GET['jml']) : 0;

echo "<h2 style='text-align: center; margin-bottom: 20px;'>Table of Sums</h2>";

echo "<table border='1' style='border-collapse: collapse; width: 50%; margin: auto; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);'>\n";
for ($a = $jml; $a > 0; $a--) {
    $total = 0;

    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }

    echo "<tr>
            <td colspan='$jml' style='text-align: left; background-color: #f4f4f4; padding: 10px; border: 1px solid #ccc; border-radius: 4px; text-align: center;'>Total: $total</td>
          </tr>\n";
    
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td style='width: 20px; height: 20px; text-align: center; padding: 5px; border: 1px solid #ccc; border-radius: 4px; vertical-align: middle;'>$b</td>";
    }
    echo "</tr>\n";
}
echo "</table>";
?>
