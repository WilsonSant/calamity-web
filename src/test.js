const WebSocket = require('ws');
const server = new WebSocket.Server({
  port: 8080
});
let sockets = [];
server.on('connection', function(socket) {
  sockets.push(socket);
  socket.send("Hello!")
  socket.on('message', function(msg) {
  console.log('msg',msg.toString())  
    sockets.forEach(s => s.send(msg));
  });
  socket.on('close', function() {
    sockets = sockets.filter(s => s !== socket);
  });
});