async function test() {
  const WebSocket = require("ws");

  let clients = [new WebSocket("ws://localhost:8080")];
  clients.map((client) => {
    client.on("message", (msg) => console.log(msg.toString()));
  });
  await new Promise((resolve) => clients[0].once("open", resolve));
  clients[0].send("Hello!");
}

test();
