import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Pusher configuration
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY, // From your .env file
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // From your .env file
    forceTLS: true // Use TLS for secure connections
});
