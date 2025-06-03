if (window.location.pathname.includes("contact")) {
document.getElementById('contact-form').addEventListener('submit', function (event) {
  event.preventDefault();
  document.getElementById('confirmation-modal').style.display = 'flex';
});

document.getElementById('confirm-yes').addEventListener('click', function (event) {
  event.preventDefault();
  sendMail();
  document.getElementById('confirmation-modal').style.display = 'none';
});

document.getElementById('confirm-no').addEventListener('click', function () {
  document.getElementById('confirmation-modal').style.display = 'none';
});

function sendMail() {
  let parms = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    phone: document.getElementById('phone').value,
    subject: document.getElementById('subject').value,
    message: document.getElementById('message').value,
  };

  emailjs.send("service_evzgarf", "template_6hy9mj9", parms)
    .then(() => {
      showNotification("Email Sent Successfully!!");

      // Reload the page after a delay (e.g., 3 seconds) to allow the notification to be seen
      setTimeout(() => {
        location.reload();
      }, 3000);
    })
    .catch(err => console.error("Error:", err));
}


function showNotification(message) {
  const notification = document.getElementById('notification');
  notification.textContent = message;
  notification.style.display = 'block';

  // Hide the notification after 3 seconds
  setTimeout(() => {
    notification.style.display = 'none';
  }, 3000);
}

}