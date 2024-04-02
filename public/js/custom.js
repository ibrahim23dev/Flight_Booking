// your-custom-script.js
const newMessageCountElement = document.getElementById('new-message-count');
const lastSenderElement = document.getElementById('last-sender');

let newMessageCount = 0;
let lastSenderName = '';

function updateHeaderUI(senderName) {
    newMessageCount++;
    lastSenderName = senderName;
    // newMessageCountElement.textContent = newMessageCount;
    // lastSenderElement.textContent = lastSenderName;
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialize UI and Echo setup here (if needed)
   updateHeaderUI();
});
