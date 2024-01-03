type socket
type webSocketServerType = {port: int}

type connectionServerType = {on: (string, socket => unit) => unit}
let sockets: array<socket> = []
@new @module("ws") external server: webSocketServerType => connectionServerType = "Server"
let webServer = server({
  port: 8080,
})

webServer.on("connection", socket => {
  Js.Array2.push(sockets, socket)
  socket.on("message", msg => {
    Js.Array.forEach(s => s.send(msg))
  })
})
