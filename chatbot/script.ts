document.addEventListener("DOMContentLoaded", ():void => {
    const send_button: boolean | any | null = document.querySelector('#send_button');
    if (!send_button) return;

    // console.log('Send button found!');
    send_button.disabled = true;
    const chatInput: HTMLInputElement | null = document.querySelector('.chat-footer input[type="text"]');

    chatInput?.addEventListener('keydown', function(event: KeyboardEvent): void {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission
            if (chatInput && chatInput.value.trim() !== '') {
                send_button.click(); // Trigger the click event on the send button
            }
        }
        // Enable the send button when there is input
        if (chatInput && chatInput.value.trim() !== '') {
            send_button.disabled = false;
        } else {
            send_button.disabled = true; // Disable if input is empty
        }
    });


    send_button.addEventListener('click', function():void {
        
        if (!chatInput) return;
        const userMessage: string = chatInput.value;
        if (!userMessage) return;
        // Display user message in chat body
        const chatBody: HTMLElement | null = document.querySelector('.chat-body #mydiv');
        if (chatBody) {
            const userMessageElement: HTMLParagraphElement = document.createElement('p');
            userMessageElement.className = 'p-3 bg-gray-600 my-2 rounded-l-md rounded-tr-md text-white max-w-xs break-words'; // Optional: Add a class for styling
            userMessageElement.textContent = userMessage;
            chatBody.appendChild(userMessageElement);

            // execute chat bot answer part
            executeChatBot(userMessage);
        }
        // Clear input field
        chatInput.value = '';
        send_button.disabled = true; // Disable the button after sending
        console.log('Send button clicked! This is where you would handle sending the message.');
        
        // Scroll to bottom after adding user message
        scrollToBottom();
    });
});

function hideChatBot(): void {
    const chatBot: HTMLElement | null = document.querySelector('.chat-bot-container');
    if (chatBot) {
        chatBot.classList.add('hidden'); // Add the 'hidden' class to hide the chat bot
    }
}

document.querySelector('#chat-bot-icon')?.addEventListener('click', function() {
    const chatBot = document.querySelector('.chat-bot-container') ? document.querySelector('.chat-bot-container') as HTMLElement : null;
    if (!chatBot) return;
    if( chatBot.classList.contains('hidden')) {
        chatBot.classList.remove('hidden');
    } else {
        chatBot.classList.add('hidden');
    }
});

function executeChatBot(userInput: string): void {
    if (userInput != null && userInput.trim() !== '') {
        // Load Ajax Data to match userInput and give the proper answer for the user
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(): void {
            if (this.readyState === 4 && this.status === 200) {
                try {
                    const data = JSON.parse(this.responseText);
                    const [botResponse, link] = findBestResponse(userInput.toLowerCase(), data);
                    displayBotResponse(botResponse, link);
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    displayBotResponse("Sorry, I'm having trouble processing your request right now.", '');
                }
            } else if (this.readyState === 4) {
                console.error('Error loading responses:', this.status);
                displayBotResponse("Sorry, I'm having trouble connecting right now. Please try again later.", '');
            }
        };
        
        xhttp.open("GET", "./responses.json", true);
        xhttp.send();
    } else {
        return;
    }
}

function findBestResponse(userInput: string, data: any): any[] {
    const responses = data.responses;
    
    if (!responses || !Array.isArray(responses)) {
        console.error('Invalid responses data format');
        return ["I'm sorry, I didn't understand that. How can I help you?", ''];
    }
    
    const normalizedInput = userInput.toLowerCase().trim();
    
    // Try to find a matching response based on keywords
    for (const responseObj of responses) {
        for (const keyword of responseObj.keywords) {
            if (normalizedInput.indexOf(keyword.toLowerCase()) !== -1) {
                if(responseObj.link && typeof responseObj.link === 'string') {
                    return [responseObj.response, responseObj.link];
                }
                return [responseObj.response, ''];
            }
        }
    }
    // If no keyword matches, return the default response
    if(normalizedInput.indexOf("clear") !== -1) {
        const chatBody: HTMLElement | null = document.querySelector('.chat-body #mydiv');
        if (chatBody) {
            chatBody.innerHTML = ''; // Clear the chat body
        }
        return ["Chat cleared. How can I assist you further?", ''];
    }

    if (data.defaultResponse && typeof data.defaultResponse === 'string') {
        return [data.defaultResponse, ''];
    }

    return ["I'm sorry, I didn't understand that. How can I help you?", ''];
}

function displayBotResponse(response: string, link: string): void {
    const chatBody: HTMLElement | null = document.querySelector('.chat-body #mydiv');
    if (chatBody) {
        
        setTimeout(() => {
            const botMessageElement: HTMLParagraphElement = document.createElement('p');
            botMessageElement.className = 'p-3 bg-green-500 my-2 rounded-r-md rounded-tl-md text-white max-w-xs break-words ml-auto'; // Bot message styling
            if(link.trim() !== '') {
                link = `<a href="${link}" target="_blank" class="text-blue-300 underline">${link}</a>`;
                response += link; // Append the link to the response
            }
            // Set the bot message text
            botMessageElement.innerHTML = response;
            chatBody.appendChild(botMessageElement);
            
            
            scrollToBottom();
        }, 1000);
    }
}

function scrollToBottom(): void {
    const chatBody: HTMLElement | null = document.querySelector('.chat-body');
    if (chatBody) {
        chatBody.scrollTop = chatBody.scrollHeight; // Scroll to the bottom of the chat body
    }
}