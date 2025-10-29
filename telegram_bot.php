<?php

// ✅ Telegram 消息发送函数（固定 Token，可改为 .env 或配置项）
function sendTelegramMessage($text) {
    $token = '';
    $chatId = '';

    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

// ✅ 工单开启通知
add_hook('TicketOpen', 1, function($vars) {
    $dept = $vars['deptname'];
    $subject = $vars['subject'];
    $userId = $vars['userid'];
    $ticketId = $vars['ticketid'];
    $msg = "📨 用户 {$userId} 提交工单：[$dept] {$subject}\n";
    $msg .= "🔗 [查看工单](https://www.abc.com/admin/supporttickets.php?action=view&id={$ticketId})";
    sendTelegramMessage($msg);
});

// ✅ 工单回复通知（管理员回复）
add_hook('TicketAdminReply', 1, function($vars) {
    $ticketId = $vars['ticketid'];
    $admin = $vars['admin'];
    $message = $vars['message'];
    $msg = "💬 管理员 {$admin} 回复了工单 #{$ticketId}\n";
    $msg .= "📝 回复内容：{$message}\n";
    $msg .= "🔗 [查看工单](https://www.abc.com/admin/supporttickets.php?action=view&id={$ticketId})";
    sendTelegramMessage($msg);
});

// ✅ 工单回复通知（用户回复）
add_hook('TicketUserReply', 1, function($vars) {
    $ticketId = $vars['ticketid'];
    $userId = $vars['userid'];
    $message = $vars['message'];
    $msg = "📩 用户 {$userId} 回复了工单 #{$ticketId}\n";
    $msg .= "📝 回复内容：{$message}\n";
    $msg .= "🔗 [查看工单](https://www.abc.com/admin/supporttickets.php?action=view&id={$ticketId})";
    sendTelegramMessage($msg);
});

// ✅ 模块错误 / 自动化错误通知
add_hook('ModuleCreateFailed', 1, function($vars) {
    $error = $vars['params']['error'];
    $userId = $vars['params']['userid'];
    $msg = "❗ 模块创建失败：用户 {$userId}\n错误信息：{$error}";
    sendTelegramMessage($msg);
});

// ✅ 退款申请通知
add_hook('CancellationRequest', 1, function($vars) {
    $serviceId = $vars['id'];
    $userid = $vars['userid'];
    $reason = $vars['reason'];
    $msg = "📉 用户 {$userid} 提交退款申请（服务ID：{$serviceId}）：{$reason}\n";
    $msg .= "🔗 [查看服务](https://www.abc.com/admin/clientsservices.php?id={$serviceId})";
    sendTelegramMessage($msg);
});