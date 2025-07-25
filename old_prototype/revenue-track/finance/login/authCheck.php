<?php
// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'finance') {
header("Location: ../login/");
exit;
}