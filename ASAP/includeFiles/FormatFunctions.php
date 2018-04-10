<?php
    function formatStringTd($strVal) {
        return "<td>" . $strVal . "</td>";
    }

    function formatDate($dbDate) {
        $dateTypedDate = date_create($dbDate);
        return date_format($dateTypedDate, "m/d/Y");
    }

    function formatDateTd($dbDate) {
        return "<td style='text-align:center'>" . formatDate($dbDate) . "</td>";
    }

    function formatDollar($dbDecimal) {
        return "$" . number_format($dbDecimal, 2, ".", ",");
    }

    function formatDollarTd($dbDecimal) {
        return "<td style='text-align:right'>" . formatDollar($dbDecimal) . "</td>";
    }

    function formatInt($dbInt) {
        return number_format($dbInt, 0, ".", ",");
    }

    function formatIntTd($dbInt) {
        return "<td style='text-align:right'>" . formatInt($dbInt) . "</td>";
    }
?>