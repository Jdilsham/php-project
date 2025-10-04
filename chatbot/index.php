<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="chatbot/styles/style.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    </head>

    <body class="min-h-[2000px]">
        <button class="flex fixed bottom-10 right-5 z-20 shadow-md" id="chat-bot-icon"><img src="chatbot/assets/chat-bot.png" class="w-[60px]" alt="Chat Bot"></button>
        <div id="chat-bot" class=" fixed bottom-20 right-2 z-10 w-[350px] h-[500px] rounded-lg">
            <div class="chat-bot-container relative hidden w-full p-2 h-full bg-gray-800 text-white flex flex-col rounded-lg">
                <div class="text-center relative chat-header text-green-400 text-2xl font-bold border-b-2 border-green-500 p-2">
                    <h2 class="my-2">Chat Bot</h2>
                    <button id="close_chat" class="absolute top-4 text-green-400 right-2 text-white hover:text-red-500" onclick="hideChatBot()"><img src="chatbot/assets/close.png" alt="Close" class="w-[25px]"></button>
                </div>
                <div class="chat-body relative p-4 my-4 overflow-y-auto flex-1">
                    <div id="mydiv">
                        <p>Hello! How can I assist you today?</p>
                    </div>
                </div>
                <div class="chat-footer relative border-green-400 bg-gray-700 w-[95%] p-2 mx-auto flex items-center justify-between">
                    <input type="text"  placeholder="Type your message..." class=" p-2 w-full md:w-[80%] rounded-lg bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button class="cursor-pointer" id="send_button"><img src="chatbot/assets/send.png" alt="send"  class="w-[35px] z-20"/></button>
                </div>
            </div>
        </div>

        <script src="chatbot/script.js"></script>
    </body>
</html>