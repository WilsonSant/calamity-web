const WebSocket = require("ws");
const http = require("http")
const express = require("express")
const port = 8080
const server = http.createServer(express)
const webSocketServer = new WebSocket.Server({
  server
});
webSocketServer.on("connection", (socket) => {
  socket.on("message", (msg) => {
    webSocketServer.clients.forEach((client) => {
      client.send(msg)
    })
  })
})

server.listen(port)