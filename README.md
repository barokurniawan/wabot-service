# wabot-service
A WhatsApp API client that connects through the WhatsApp Web browser app

It uses Puppeteer to run a real instance of Whatsapp Web to avoid getting blocked.

NOTE: I can't guarantee you will not be blocked by using this method, although it has worked for me. WhatsApp does not allow bots or unofficial clients on their platform, so this shouldn't be considered totally safe.

## Installation
The module is now available on npm! `npm i whatsapp-web.js`

Please note that Node v8+ is required due to Puppeteer.

## Usage 
Send a text message :
`http://localhost:3002/?phone=6282215512601&message=keren%20euy+jhhk`

Send a document : 
`http://localhost:3002/?phone=6282215512601&mime=application/pdf&filename=dosis.pdf&file=https://www.pmadocs.com/fever_and_pain_medication_dosages.pdf`
