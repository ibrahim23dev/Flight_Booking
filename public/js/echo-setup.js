// echo-setup.js
const pusher = new Pusher('360c973d62dcd2644878', {
    cluster: 'ap2',
    encrypted: true,
});

const channel = pusher.subscribe('chatify-channel.' + userId);

channel.bind('messaging', function (data) {
    console.log('messaging event received:', data);
    // Handle new message event, e.g., update UI or show notifications
    updateHeaderUI(data.senderName);
});
