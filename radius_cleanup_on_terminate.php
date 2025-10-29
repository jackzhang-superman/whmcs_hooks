<?php
use WHMCS\Database\Capsule;

/**
 * 当服务 Terminate 时，自动清空对应 RADIUS 用户的
 * 1) radacct（计费/流量）
 * 2) radpostauth（认证历史）
 */
add_hook('AfterModuleTerminate', 1, function($vars) {
    try {
        $params = $vars['params'];

        $username = trim($params['username']);
        if ($username === '') return;

        // ✅ 复用模块内数据库配置项，无需硬编码
        $radiusHost = $params['serverip'];
        $radiusUser = $params['serverusername'];
        $radiusPass = $params['serverpassword'];
        $radiusDB   = $params['serveraccesshash']; // 用作 DB 名

        $dsn = "mysql:host={$radiusHost};dbname={$radiusDB};charset=utf8mb4";
        $pdo = new PDO($dsn, $radiusUser, $radiusPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $pdo->beginTransaction();

        // 清理计费记录（流量来源）
        $pdo->prepare("DELETE FROM radacct WHERE username = ?")->execute([$username]);

        // 清理认证历史
        $pdo->prepare("DELETE FROM radpostauth WHERE username = ?")->execute([$username]);

        $pdo->commit();

        logActivity("RADIUS cleanup OK: {$username} (SID={$vars['serviceid']})");
    }
    catch (\Throwable $e) {
        if (isset($pdo) && $pdo->inTransaction()) $pdo->rollBack();
        logActivity("RADIUS cleanup FAILED (SID={$vars['serviceid']}): ".$e->getMessage());
    }
});
