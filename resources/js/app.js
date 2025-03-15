import Echo from "laravel-echo";
import "./bootstrap"; // Ensure Echo is loaded through bootstrap.js

// Join the presence channel
window.Echo.join("presence-user-status")
    .here((users) => {
        console.log("Users in channell:", users);

        // Update user statuses on the page
        users.forEach((user) => {
            const userStatusElement = document.getElementById(
                `${user.id}-status`
            );
            if (userStatusElement) {
                userStatusElement.classList.remove("text-danger");
                userStatusElement.classList.add("text-primary");
                userStatusElement.textContent = "Online";
            }
        });
    })
    .joining((user) => {
        console.log("User joined:", user);
        const userStatusElement = document.getElementById(`${user.id}-status`);
        if (userStatusElement) {
            userStatusElement.classList.remove("text-danger");
            userStatusElement.classList.add("text-primary");
            userStatusElement.textContent = "Online";
        }
    })
    .leaving((user) => {
        console.log("User left:", user);
        const userStatusElement = document.getElementById(`${user.id}-status`);
        if (userStatusElement) {
            userStatusElement.classList.add("text-danger");
            userStatusElement.classList.remove("text-primary");
            userStatusElement.textContent = "Offline";
        }
    })
    .listen("UserStatusEvent", (data) => {
        console.log("Custom Event Data:", data);
        // Handle your custom event logic here
    });

window.Echo.private("broadcast-message").listen(".getChatMessage", (data) => {
    if (
        sender_id == data.chat.receiver_id &&
        receiver_id == data.chat.sender_id
    ) {
        let htmll =
            `<div class='distance-user-class'><h4> id='` +data.chat.id + "-chat"` ` +
            data.chat.message +
            `</h4></div>`;
        $(".chat-container").append(htmll);
    }
});


window.Echo.private("message-deleted").listen("MessageDeletedEvent", (data) => {

        $('#' + data.id +'-chat' ).remove();
});
