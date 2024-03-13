// main.js

// Create a new Worker instance
const worker = new Worker('/backend/js/notification-worker.js');

// Send a message to the worker to trigger the notification after 3 seconds
setTimeout(() => {
//     worker.postMessage('showNotification');

}, 3000);
setInterval(() => {
        fetch('/api/tt')
      }, 2000);