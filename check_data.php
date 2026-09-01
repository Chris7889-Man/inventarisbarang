<?php
foreach (["transaksis", "detail_transaksis", "barangs"] as $t) {
    echo "== " . $t . " ==\n";
    $rows = DB::table($t)->get();
    foreach ($rows as $r) {
        print_r($r);
    }
}