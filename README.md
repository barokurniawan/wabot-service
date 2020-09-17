# wabot-service (XBOT)
A WhatsApp API client that connects through the WhatsApp Web browser app with 
support multiple account in one instance application

It uses Puppeteer to run a real instance of Whatsapp Web to avoid getting blocked.

NOTE: I can't guarantee you will not be blocked by using this method, although it has worked for me. WhatsApp does not allow bots or unofficial clients on their platform, so this shouldn't be considered totally safe.

## Installation
1. `docker-compose up --build`.
2. Install GUI dependency, type `composer install` in wabot_gui container.
3. Run `npm install` in wabot_engine container to install/update [whatsapp-web.js](https://github.com/pedroslopez/whatsapp-web.js) and puppeter.
4. CHMOD */gui/strage/* to *0777*. 
5. Run `php artisan key:generate`.
6. Setup database connection (pgsql) then run `php artisan migrate` from inside *wabot_gui* container.

## Usage 
Send a text message :
```
http://localhost:8080/api/message?phone=6282215512601&message=test+message
```

Send a document : 
```
http://localhost:8080/api/message?phone=6282215512601&mime=application/pdf&filename=dosis.pdf&file=https://www.pmadocs.com/fever_and_pain_medication_dosages.pdf

//To send image with caption, use "send a document" end point, with message parameter. 
//Caption only visible on image
```

Device Information : 
```
http://localhost:8080/api/device
```

Reset Device (downtime) : 
```
http://localhost:8080/api/device
```

Check server health : 
```
http://localhost:8080/api/health
```

# Thanks to
[whatsapp-web.js](https://github.com/pedroslopez/whatsapp-web.js)

# Looking for contributors

Currently we are looking for contributor, Contact me by sending an email (check my bio).



