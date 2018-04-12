<?php

// General functions
$siteName = $db->query("SELECT sitename FROM boardly_settings")->fetchColumn();

//$alerts = $db->query("SELECT alerts FROM boardly")->fetchColumn();
