<?php

use app\controllers\Auth;
use app\controllers\Home;
use app\cores\Database;
use app\cores\Router;
use app\constant\Config;
use app\controllers\AuditLog;
use app\controllers\NewPassword;
use app\controllers\Dashboard;
use app\controllers\UploadPrestasi;
use app\middlewares\AdminMiddleware;
use app\middlewares\StudentMiddleware;


require_once "helpers/env.php";
require_once "vendor/autoload.php";

$db = new Database(Config::getConfig());

$app = new Router();
$app::get("/", [Home::class, "index"]);

$app::get("/login", [Auth::class, "renderLogin"]);
$app::post("/post-login", [Auth::class, "login"]);

$app::get("/forgot-password",[NewPassword::class,"renderForgotPassword"]);
$app::post("/send-password",[NewPassword::class,"handleForgotPassword"]);

$app::get("/change-password",[NewPassword::class,"renderChangePassword"]);

$app::post("/change-password/new-password",[NewPassword::class,"changePassword"]);

$app::get("/dashboard/admin/:nip", [Dashboard::class, "adminDashboard"], [AdminMiddleware::class]);
$app::get("/dashboard/mahasiswa/:nim", [Dashboard::class, "studentDashboard"],[StudentMiddleware::class]);

$app::get("/dashboard/admin/:nip/log-data",[AuditLog::class,"renderLogData"],[AdminMiddleware::class]);
$app::post("/dashboard/admin/:nip/log-data/search",[AuditLog::class,"getFilteredLog"],[AdminMiddleware::class]);

$app::get("/dashboard/mahasiswa/:nim/upload-prestasi",[UploadPrestasi::class,"renderWeb"],[StudentMiddleware::class]);
$app::post("/dashboard/mahasiswa/:nim/submit-prestasi",[UploadPrestasi::class,"upload"],[StudentMiddleware::class]);

$app::get("/logout", [Auth::class, "logout"]);
$app::run();