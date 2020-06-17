const TelegramBot = require('node-telegram-bot-api'); 
const request = require('request'); 
let config = require('dotenv').config().parsed;
const token = config.Token; 
const bot = new TelegramBot(token, {
  polling: true
});
var exec = require('child_process').exec;
bot.onText(/\/getqh/, function onLoveText(msg) 
{
  const chatId = msg.chat.id;
  exec('bash ./get.sh', function (error,stdout,stderr) {
    if(stdout.length >1) {
      bot.sendMessage(chatId, stdout);
    } else {
      bot.sendMessage(chatId, '获取失败');
    }
  });
});

bot.onText(/\/check (.+)|\/check/, function onLoveText(msg,  match, rep, repMsg) 
{
	let message = bot.getMsgWithReply(repMsg);
	exec('bash ./get.sh'+ message);
});

bot.onText(/\/start|\/help/, (msg, match) => {
	const chatId = msg.chat.id;
	bot.sendMessage(chatId, '戳 /getqh 获取一条甜甜的情话哟~');
});
