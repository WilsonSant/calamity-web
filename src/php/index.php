<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
</head>

<body class="bg-gradient-to-tr from-amber-300 to-red-500">
    <div class="flex flex-col space-y-3 h-screen items-center justify-center">
        <div id="square" class="bg-sky-200 flex flex-row items-center p-10 space-y-10 rounded border border-2 border-black">
            <div class="flex flex-col">
                <label for="">Posição</label>
                <input type="number" id="position" class="border border-black rounded">
            </div>
            <div class="p-3 ml-5 mb-10">
                <div>
                    <input type="radio" name="default-radio" id="lucio" value="lucio">
                    <label for="lucio" class="">Lúcio</label>
                </div>
                <div>
                    <input type="radio" id="greymane" value="greymane" name="default-radio">
                    <label class="" for="greymane">Greymane</label>
                </div>
                <div>
                    <input type="radio" id="varian" value="varian" name="default-radio">
                    <label class="" for="varian">Varian</label>
                </div>
                <div>
                    <input type="radio" id="dehaka" value="dehaka" name="default-radio">
                    <label class="" for="dehaka">Dehakaa</label>
                </div>
            </div>
            <button id="button" class="bg-red-400 p-5 rounded">Enviar</button>
        </div>
        <h1 class="font-bold">Selecione a posição</h1>
    </div>
    <script>
        (function() {
            const button = document.getElementById("button");
            const positionInput = document.getElementById("position");

            let ws;
            ws = new WebSocket("ws://localhost:8080");
            ws.onopen = () => {
                console.log("Conectado");
            };

            button.onclick = () => {
                let selectedName = "";
                let radios = document.getElementsByName("default-radio");
                radios.forEach((radio) => {
                    if (radio.checked) {
                        selectedName = radio.value;
                    }
                });

                let position = positionInput.value;
                let data = {
                    position: position,
                    name: selectedName
                };
                ws.send(JSON.stringify(data));
            };
        })();
    </script>
</body>

</html>