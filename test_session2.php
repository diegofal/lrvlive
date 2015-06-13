<?
session_start();

echo "Old session: ".session_id();

session_regenerate_id();

echo "<br /> New session id: ".session_id();