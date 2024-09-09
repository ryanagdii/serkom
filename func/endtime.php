<?php
    $endtime = microtime(true);
    $executiontime = $endtime - $starttime;
    $memory = memory_get_usage();
    echo "Page load selama " . number_format($executiontime, 5) . " detik<br>";
    echo "Memory used " . number_format($memory, 0, ',', '.') . " byte";
?>