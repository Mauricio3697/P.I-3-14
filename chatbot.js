// Leitor de QR Code
const qrcode = require('qrcode-terminal');
const { Client, Buttons, List, MessageMedia } = require('whatsapp-web.js'); 
const client = new Client();

// Geração do QR Code no terminal
client.on('qr', qr => {
    qrcode.generate(qr, { small: true });
});

// Confirmação de conexão
client.on('ready', () => {
    console.log('Tudo certo! WhatsApp conectado.');
});

// Inicializa o cliente
client.initialize();

// Função de delay com digitação simulada
const delay = ms => new Promise(res => setTimeout(res, ms));

async function digitarEEsperar(chat, tempo = 3000) {
    await delay(tempo);
    await chat.sendStateTyping();
    await delay(tempo);
}

// Atendimento
client.on('message', async msg => {
    const texto = msg.body.toLowerCase().trim();
    const chat = await msg.getChat();

    // Saudações e menu principal
    if (['menu', 'oi', 'olá', 'ola', 'tarde', 'noite', 'dia'].some(p => texto.includes(p)) && msg.from.endsWith('@c.us')) {
        const contact = await msg.getContact();
        const name = contact.pushname?.split(" ")[0] || "cliente";

        let saudacao;
        const hora = new Date().getHours();
        if (hora < 12) saudacao = "Bom dia";
        else if (hora < 18) saudacao = "Boa tarde";
        else saudacao = "Boa noite";

        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, `${saudacao}, ${name}! 👋\n\nSou o Assistente da *Transportes Terraplanagem Ferreira Junior*. Como posso ajudá-lo hoje? Digite o número da opção desejada:\n\n1 - 🏢 Quem Somos\n2 - 🚜 Nossos Serviços\n3 - 📍 Localização\n4 - 💬 Solicitar um Orçamento\n5 - 👨‍💼 Falar com Atendente`);
        return;
    }

    // Opção 1 - Quem Somos
    if (texto === '1') {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '*🏢 Quem Somos*\n\nSomos a Transportes Terraplanagem Ferreira Junior, especializada em escavação, demolição, terraplanagem, retirada de entulho e muito mais.');
        const audio = MessageMedia.fromFilePath('quem_somos.mp3');
        await client.sendMessage(msg.from, audio);
        return;
    }

    // Opção 2 - Nossos Serviços
    if (texto === '2') {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '*🚜 Nossos Serviços*\n\n• Escavação\n• Demolição Estrutural\n• Retirada e Transporte de Entulho\n• Aterramento de Solo\n• Regularização de Solo\n• Nivelamento de Terreno');
        const audio = MessageMedia.fromFilePath('servicos.mp3'); 
        await client.sendMessage(msg.from, audio);
        return;
    }

    // Opção 3 - Localização
    if (texto === '3') {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '📍 A Transportes Terraplanagem Ferreira Junior está localizada em *Caieiras - SP*.\n\nConfira no mapa: https://maps.app.goo.gl/PZbUG543L8Rfyz5Z7');
        const audio = MessageMedia.fromFilePath('localizacao.mp3');
        await client.sendMessage(msg.from, audio);
        return;
    }

    // Opção 4 - Solicitar Orçamento
    if (texto === '4') {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '*💬 Para solicitar um orçamento*, envie as seguintes informações:\n\n📌 *Tipo de serviço* (ex: escavação, demolição...)\n📍 *Endereço da obra*\n📅 *Prazo estimado para início*\n📞 *Nome completo e telefone para contato*\n\nAssim que recebermos, entraremos em contato o mais breve possível. Obrigado!');
        return;
    }

    // Opção 5 - Falar com atendente
    if (texto === '5') {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '👨‍💼 Um de nossos atendentes irá falar com você em instantes.\n\nEnquanto isso, envie sua dúvida ou solicitação para agilizar o atendimento.');
        const audio = MessageMedia.fromFilePath('falar_com_atendente.mp3');
        await client.sendMessage(msg.from, audio);
        return;
    }

    // Opção inválida
    if (!['1', '2', '3', '4', '5'].includes(texto)) {
        await digitarEEsperar(chat);
        await client.sendMessage(msg.from, '❌ *Opção inválida.*\nPor favor, digite o número correspondente a uma das opções do menu. Digite *menu* para ver as opções novamente.');
    }
});
