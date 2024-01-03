type rec socket = {on: (string, socket => unit) => unit, send: socket => unit}
type webSocketServerType = {port: int}

type connectionServerType = {on: (string, socket => unit) => unit}
let sockets = ref([])
@new @module("ws") external server: webSocketServerType => connectionServerType = "Server"
let webServer = server({
  port: 8080,
})

webServer.on("connection", socket => {
  Belt.Array.push(sockets.contents, socket)
  socket.on("message", msg => {
    Belt.Array.forEach(sockets.contents, s => s.send(msg))
  })
  socket.on("close", (_) => {
    sockets.contents = Array.filter(sockets.contents, (s => s !== socket))
  })
})
