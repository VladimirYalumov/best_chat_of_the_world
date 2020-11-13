const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http);

const port = 5000;

var redis  = require("redis");
var subscriber = redis.createClient(6379, "redis");

// подписываемся на изменения в каналах redis
subscriber.on('message', function(channel, message) {
    // пересылаем сообщение из канала redis в комнату socket.io
    io.emit('user', message);
  });

  io.origins('*:*');
  
  // открываем соединение socket.io
  io.on('connection', function(socket){
    // подписываемся на канал redis 'eustatos' в callback
    subscriber.subscribe('test');
  });
  
  http.listen(
    port,
    function() {
      console.log('Listen at ' + port);
    }
  );