<?php

function limit() {
    $para = C("VAR_PAGE") ?: "page";
    $page = I("param.$para") ?: 0;
    $size = I("param.size") ?: C("DEFAULT_PAGE_SIZE");
    $res = sprintf("%s,%s", $page, $size);
    return $res;
}
