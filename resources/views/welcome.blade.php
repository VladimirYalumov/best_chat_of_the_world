<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
  </head>
  <body>
      <script>
        document.getElementById('ol'); // вставить строку "after" после <ol>
        const socket = io(window.location.protocol + '//' + window.location.hostname + ':5000', { transport : ['websocket'] });
        socket.on( 'user', function(data) {
            console.log(data);
            let liLast = document.createElement('li');
            liLast.innerHTML = JSON.stringify(data);
            ol.append(liLast); // вставить liLast в конец <ol>
          }
        );

        function send(){
          const request = new XMLHttpRequest();
          const url = 'http://localhost/test/'+document.getElementById('input').value;
          request.open('GET', url);
          request.send();
        }
      </script>
      <input id="input" type="text" /><button onclick="send()">Send</button>
      <ol id="ol"></ol>
  </body>
</html>
