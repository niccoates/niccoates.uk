document.querySelector("#contactForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const form = e.target;
  const status = document.querySelector("#formStatus");

  status.textContent = "Sending...";

  const formData = new FormData(form);

  try {
    const response = await fetch("/sendmail.php", {
      method: "POST",
      body: formData,
    });

    const result = await response.json();

    if (result.success) {
      status.textContent = "Thanks! Your message has been sent.";
      form.reset();
    } else {
      status.textContent = "Sorry, there was an error sending your message.";
    }
  } catch (err) {
    status.textContent = "Network error. Please try again.";
  }
});
