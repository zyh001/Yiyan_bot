from telethon.sync import TelegramClient, utils

api_id = '1089079'
api_hash = '7799f8caaabbc8087bf6614bdd7cb069'
bot = TelegramClient('🐶机器人', api_id, api_hash)
channel = 'https://t.me/qinghua_box'
 
async def main():
    messages = bot.iter_messages(channel, limit=50)
    msges = '';
    async for message in messages:
        msg = str(message.message)
        msge = msg.replace("\r", r"\r").replace('\n', r'\n')
        # print(msge)
        msges = msges + msge + "\n"
    with open('./db.txt', 'a+') as file:
        file.write(msges)

with bot:
    bot.loop.run_until_complete(main())
